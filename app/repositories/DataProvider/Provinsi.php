<?php

namespace Repositories\DataProvider;
use BackOffice\ChartController;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Project: ehousing-3.0
 * Date: 6/11/16
 * Time: 19:58
 */
class Provinsi
{
    const DEFAULT_LIMIT = 10;

    protected $statisticResults;
    protected $provinsiId;
    protected $limit = self::DEFAULT_LIMIT;
    protected $year;

    /**
     * Provinsi constructor.
     * @param $provinsiId
     */
    function __construct($provinsiId = null)
    {
        $this->provinsiId = $provinsiId;
    }

    /**
     * @param $provinsiId
     * @return static
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public static function create($provinsiId = null)
    {
        $provinsi = new static($provinsiId);
        return $provinsi;

    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @param $regionCode
     * @return mixed
     * @throws ProvinsiNotFoundException
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getDetail()
    {
        $provinsi = \Provinsi::with(array(
            'profil' => function($q) {
                $q->orderBy('TahunBerlaku','desc');
                $q->take(1);
            },
            'konfigurasiSitus'
        ))
            ->find($this->provinsiId);

        if( ! is_null($provinsi) )
            return $provinsi;

        throw new ProvinsiNotFoundException;
    }

    /**
     * @param $provinsiId
     * @param array $categoryId
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getPostByCategory($categoryId = array())
    {


        $post = \Post::select(['post.*','user.Nama'])
            ->leftJoin('user','user.UserId', '=', 'post.CreateUid')
            ->whereRaw(\DB::raw('post.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'));

        if(count($categoryId) > 0)
            $post->whereIn('post.KategoriId', $categoryId);

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId)
        {
            $post->where(function($query) {
                $query->where('post.KodeProvinsi', $this->provinsiId)
                    ->orWhere('post.KodeProvinsi', '-')
                    ->orWhereNull('post.KodeProvinsi');
            });
        }

        $results = $post->orderBy('post.CreateDate','desc')
            ->take($this->limit)
            ->get();


        if(! is_null($results))
            return $results;

        throw new PostNotFoundException();
    }

    /**
     * @param null $regionCode
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getNews()
    {
        $results = $this->getPostByCategory(array(1,2));
        $this->limit = self::DEFAULT_LIMIT;
        return $results;
    }

    /**
     * @param null $id
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getInformasi()
    {
        return $this->getPostByCategory(array(3));
    }

    /**
     * @param null $provinsiId
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws PostNotFoundException
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getPrograms()
    {
        return $this->getPostByCategory(array(7));
    }

    public function getFileByCategory($categoryId = array())
    {
        $file = \Berkas::with('referensi')
            ->whereRaw(\DB::raw('file.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'));

        /*$file = \Berkas::select(array(
            'file.url',
            'file.categoryfile',
            'file.description',
            'file.filename',
            'file.fileext',
            'file.downloadcounter',
            'file.Judul',
            'file.file_size',
            'referensi.Deskripsi'
        ))
            ->leftJoin('referensi','referensi.KodeRef','=','file.categoryfile')
            ->whereRaw(\DB::raw('file.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'));*/

        if(count($categoryId) > 0)
            $file->whereIn('file.categoryfile', $categoryId);

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId)
        {
            $file->where(function($query) {
                $query->where('file.KodeProvinsi', $this->provinsiId)
                    ->orWhere('file.KodeProvinsi', '-')
                    ->orWhereNull('file.KodeProvinsi');
            });

        }

        $results = $file->orderBy('file.createdate','desc')
            ->take($this->limit)
            ->get();

        if(! is_null($results))
            return $results;

        throw new FileNotFoundException();

    }

    /**
     * @param $provinsiId
     * @param int $limit
     * @return mixed
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getHunian()
    {
        $hunian = \Hunian::with('referensi')
            ->whereRaw(\DB::raw('hunian.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'));

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId) {
            $hunian->where('hunian.KodeProvinsi', $this->provinsiId);
        }

        $results = $hunian->orderBy('hunian.CreateDate','desc')
            ->take($this->limit)
            ->get();

        if(! is_null($results))
            return $results;

        throw new \Exception();
    }

    /**
     * @param $provinsiId
     * @param null $jenisKontak
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getContacts($jenisKontak = null)
    {
        $kontak = \Kontak::whereRaw(\DB::raw('kontak.ExpiryDate > NOW()'));

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId) {
            $kontak->where('kontak.KodeProvinsi', $this->provinsiId);
        }

        if( ! is_null($jenisKontak) || '' != $jenisKontak) {
            $kontak->where('kontak.JenisKontak', $jenisKontak);
        }

        $results = $kontak->orderBy('kontak.CreateDate','desc')
            ->take($this->limit)
            ->get();

        if(! is_null($results))
            return $results;

        throw new ContactNotFoundException();
    }

    /**
     * @param $provinsiId
     * @param int $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getContactDevelopers()
    {
        return $this->getContacts('dev');
    }

    /**
     * @param $provinsiId
     * @param $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getContactArsitek()
    {
        return $this->getContacts('ars');


    }

    /**
     * @param $provinsiId
     * @param $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getContactContractor()
    {
        return $this->getContacts('kon');
    }

    /**
     * @param $provinsiId
     * @param $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getContactTukang()
    {
        return $this->getContacts('tuk');

    }

    /**
     * @param $provinsiId
     * @param $limit
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     * @throws \Exception
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getContactSupplier()
    {
        return $this->getContacts('sup');
    }

    /**
     * @param int $provinsiId
     * @param int $tahun
     * @param $kolom
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getTotalProfileNumber($kolom)
    {
        $profil = \ProfilProvinsi::select(array(
            'TahunBerlaku',
            \DB::raw("SUM({$kolom}) AS jumlah")
        ))->where('TahunBerlaku', $this->year);

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId) {
            $profil->where('KodeProv', $this->provinsiId);
        }

        $results = $profil->groupBy('TahunBerlaku')->first();

        if(! is_null($results))
            return $results;
    }

    /**
     * @param $provinsiId
     * @param $tahun
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getTotalAnggaran()
    {
        return $this->getTotalProfileNumber('AnggaranKemenpera');
    }

    /**
     * @param $provinsiId
     * @param $tahun
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getTotalBacklog()
    {
        return $this->getTotalProfileNumber('BacklogRumah');
    }

    /**
     * @param $provinsiId
     * @param $tahun
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getTotalJumlahRumah()
    {
        return $this->getTotalProfileNumber('JumlahRT');
    }

    /**
     * @param $provinsiId
     * @param $tahun
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function getTotalAPBD()
    {
        return $this->getTotalProfileNumber('TotalAPBDProv');
    }

    public function getStatistik($kolom)
    {

        $profil = \ProfilProvinsi::select(array(
            'TahunBerlaku',
            \DB::raw("SUM({$kolom}) AS jumlah")
        ));

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId) {
            $profil->where('KodeProv', $this->provinsiId);
        }

        $results = $profil->groupBy('TahunBerlaku')
            ->orderBy('TahunBerlaku', 'ASC')
            ->get();


        if(! is_null($results))
        {
            $this->statisticResults = $results;
            return $this;
        }
    }

    public function getStatistikSource($kolom)
    {
        $jenis = null;

        foreach (\ProfileProvinsiSource::$kinds as $key => $val) {
            if($val['column'] === $kolom) {
                $jenis = $key;
                continue;
            }
        }

        $src = \ProfileProvinsiSource::select(array(
            \ProfileProvinsiSource::$kinds[$jenis]['source_column']
        ))
            ->distinct()
            ->leftJoin('ProfilProvinsi','ProfilProvinsi.KodeProfilProv','=','profile_provinsi_sources.profil_provinsi_id');

        if( ! is_null($this->provinsiId) || 0 != $this->provinsiId) {
            $src->where('ProfilProvinsi.KodeProv', $this->provinsiId);
        }

        return array_filter($src->lists(\ProfileProvinsiSource::$kinds[$jenis]['source_column']), function($el) {
            if($el != '')
                return $el;
        });
    }

    /**
     * Untuk data statistik
     *
     * @return mixed
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function showResults()
    {
        return $this->statisticResults;
    }

    /**
     * @return string
     * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
     */
    public function toHighcharts()
    {
        $map = array();
        foreach ($this->statisticResults as $result) {
            array_push($map, array(
                'name' => (int)$result->TahunBerlaku,
                'y' => (int)$result->jumlah
            ));
        }

        return json_encode($map);
    }

    public function getStatistikBacklog()
    {
        return $this->getStatistik('BacklogRumah');
    }

    public function getStatistikSourceBacklog()
    {
        return $this->getStatistikSource('BacklogRumah');
    }

    public function getStatistikAnggaran()
    {
        return $this->getStatistik('AnggaranKemenpera');
    }

    public function getStatistikSourceAnggaran()
    {
        return $this->getStatistikSource('AnggaranKemenpera');
    }

    public function getStatistikAPBD()
    {
        return $this->getStatistik('TotalAPBDProv');
    }

    public function getStatistikSourceAPBD()
    {
        return $this->getStatistikSource('TotalAPBDProv');
    }
}