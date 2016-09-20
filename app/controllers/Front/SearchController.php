<?php
/**
 * Created by PhpStorm.
 * User: akung
 * Date: 9/2/16
 * Time: 04:36
 */

namespace Front;

use Carbon\Carbon;

class SearchController extends \BaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $key = \Request::get('s');

        if ($key != '' || $key != null) {

            $resultProfile = $this->resultProfile($key);
            $resultTeknologiRancangBangun = $this->resultTeknologiRancangBangun($key);
            $resultBahanBangunan = $this->resultBahanBangunan($key);
            $resultProdukHukum = $this->resultProdukHukum($key);
            $resultProgramKegiatan = $this->resultProgramKegiatan($key);
            $resultInfoHunian = $this->resultInfoHunian($key);
            $resultInfoPublik = $this->resultInfoPublik($key);
            $resultPenelitian = $this->resultPenelitian($key);
            $resultInfoLink = $this->resultInfoLink($key);

            $results = [];

            if (count($resultProfile) > 0)
                $results['Profile'] = $resultProfile;

            if (count($resultTeknologiRancangBangun) > 0)
                $results['Teknologi Rancang Bangun'] = $resultTeknologiRancangBangun;

            if (count($resultInfoPublik) > 0)
                $results['Informasi Publik'] = $resultInfoPublik;

            if (count($resultProgramKegiatan) > 0)
                $results['Program dan Kegiatan'] = $resultProgramKegiatan;

            if (count($resultBahanBangunan) > 0)
                $results['Daftar Bahan Bangunan'] = $resultBahanBangunan;

            if (count($resultProdukHukum) > 0)
                $results['Daftar Produk Hukum'] = $resultProdukHukum;

            if (count($resultPenelitian) > 0)
                $results['Daftar Hasil Penelitian/Kajian'] = $resultPenelitian;

            /*if (count($resultInfoHunian) > 0)
                $results['Informasi Hunian'] = $resultInfoHunian;

            if (count($resultInfoLink) > 0)
                $results['Informasi Link'] = $resultInfoLink;*/

        }

        return \View::make('front.search.show', compact('results'));
    }

    private function resultProfile($key)
    {
        $r = \KonfigurasiSitus::with('provinsi')
            ->where('Nama', 'like', "%{$key}%")
            ->orWhere('Deskripsi', 'like', "%{$key}%")
            ->orWhere('tentang_kami', 'like', "%{$key}%")
            ->orWhere('Tagline', 'like', "%{$key}%")
            ->orWhere('Alamat1', 'like', "%{$key}%")
            ->orWhere('VisiMisi', 'like', "%{$key}%")
            ->orWhere('Email', 'like', "%{$key}%")
            ->orWhere('NamaGubernur', 'like', "%{$key}%")
            ->orWhere('NamaWakilGubernur', 'like', "%{$key}%")
            ->orWhere('ibukota', 'like', "%{$key}%")
            ->orWhere('PeriodeJabatan', 'like', "%{$key}%")
            ->orWhere('KelembagaanPerkim', 'like', "%{$key}%")
            ->orWhere('LetakGeografis', 'like', "%{$key}%")
            ->orWhere('Kabupaten', 'like', "%{$key}%")
            ->orWhere('Kota', 'like', "%{$key}%")
            ->orWhere('Website', 'like', "%{$key}%")
            ->orWhere('pendataan', 'like', "%{$key}%")
            ->orWhere('backlog', 'like', "%{$key}%")
            ->orWhere('rtlh', 'like', "%{$key}%")
            ->orWhere('sejuta_rumah', 'like', "%{$key}%")
            ->get();

        $format = [];
        foreach ($r as $item) {
            array_push($format, [
                'title'       => $item->Nama,
                'description' => $item->Deskripsi,
                'link'        => route('front.provinsi.dashboard', $item->provinsi->slug)
            ]);
        }

        return $format;
    }

    private function resultTeknologiRancangBangun($key)
    {
        $r = \Post::with('provinsi')
            ->where('PostStatus', '=', 1)
            ->where('PublishDate', '<', Carbon::now())
            ->whereRaw(\DB::raw('post.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'))
            ->whereIn('post.KategoriId', [3])
            ->where(function ($q) use ($key) {
                $q->where('Judul', 'like', "%{$key}%");
                $q->orWhere('IsiPost', 'like', "%{$key}%");

            })
            ->get();

        $format = [];
        foreach ($r as $item) {
            if (is_null($item->provinsi)) {
                // todo: punya nasional
                $link = '#';
            } else {
                $link = route('front.provinsi.post.show', [$item->provinsi->slug, $item->slug]);
            }

            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->IsiPost,
                'link'        => $link
            ]);
        }

        return $format;
    }

    private function resultInfoLink($key)
    {
        $r = \LinkInfo::where('linkinfo.ExpiryDate', '>', Carbon::now())
            ->where(function ($q) use ($key) {
                $q->where('Judul', 'like', "%{$key}%");
                $q->orWhere('Deskripsi', 'like', "%{$key}%");
                $q->orWhere('LinkInfo', 'like', "%{$key}%");
            })->get();

        $format = [];
        foreach ($r as $item) {
            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->Deskripsi
            ]);
        }

        return $format;
    }

    private function resultPenelitian($key)
    {
        $r = \Berkas::where('file.ExpiryDate', '>', Carbon::now())
            ->where('file.categoryfile', \Berkas::PENELITIAN)
            ->where(function ($q) use ($key) {
                $q->where('filename', 'like', "%{$key}%");
                $q->orWhere('description', 'like', "%{$key}%");
                $q->orWhere('Judul', 'like', "%{$key}%");
                $q->orWhere('raw_name', 'like', "%{$key}%");
                $q->orWhere('fileext', 'like', "%{$key}%");

            })->get();

        $format = [];
        foreach ($r as $item) {
            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->description,
                'link'        => route('front.file.download', $item->url)

            ]);
        }

        return $format;
    }

    private function resultInfoPublik($key)
    {
        $r = \Post::where('PostStatus', '=', 1)
            ->where('PublishDate', '<', Carbon::now())
            ->whereRaw(\DB::raw('post.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'))
            ->whereIn('post.KategoriId', [1, 2])
            ->where(function ($q) use ($key) {
                $q->where('Judul', 'like', "%{$key}%");
                $q->orWhere('IsiPost', 'like', "%{$key}%");

            })
            ->get();

        $format = [];
        foreach ($r as $item) {
            if (is_null($item->provinsi)) {
                // todo: punya nasional
                $link = '#';
            } else {
                $link = route('front.provinsi.post.show', [$item->provinsi->slug, $item->slug]);
            }

            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->IsiPost,
                'link'        => $link
            ]);
        }

        return $format;
    }

    private function resultInfoHunian($key)
    {
        $r = \Hunian::where('hunian.ExpiryDate', '>', Carbon::now())
            ->where(function ($q) use ($key) {
                $q->where('NamaHunian', 'like', "%{$key}%");
                $q->orWhere('Alamat', 'like', "%{$key}%");
                $q->orWhere('Koordinat', 'like', "%{$key}%");
                $q->orWhere('Website', 'like', "%{$key}%");
                $q->orWhere('nama_pengembang', 'like', "%{$key}%");
                $q->orWhere('JenisHunian', 'like', "%{$key}%");
            })->get();

        $format = [];
        foreach ($r as $item) {
            array_push($format, [
                'title'       => $item->NamaHunian,
                'description' => $item->Alamat
            ]);
        }

        return $format;

    }

    private function resultProgramKegiatan($key)
    {
        $r = \Post::where('PostStatus', '=', 1)
            ->where('PublishDate', '<', Carbon::now())
            ->whereRaw(\DB::raw('post.ExpiryDate > DATE_ADD(NOW(), INTERVAL 7 HOUR)'))
            ->whereIn('post.KategoriId', [7])
            ->where(function ($q) use ($key) {
                $q->where('Judul', 'like', "%{$key}%");
                $q->orWhere('IsiPost', 'like', "%{$key}%");

            })
            ->get();

        $format = [];
        foreach ($r as $item) {
            if (is_null($item->provinsi)) {
                // todo: punya nasional
                $link = '#';
            } else {
                $link = route('front.provinsi.post.show', [$item->provinsi->slug, $item->slug]);
            }

            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->IsiPost,
                'link'        => $link
            ]);
        }

        return $format;
    }

    private function resultProdukHukum($key)
    {
        $r = \Berkas::where('file.ExpiryDate', '>', Carbon::now())
            ->where('file.categoryfile', \Berkas::KEBIJAKAN)
            ->where(function ($q) use ($key) {
                $q->where('filename', 'like', "%{$key}%");
                $q->orWhere('description', 'like', "%{$key}%");
                $q->orWhere('Judul', 'like', "%{$key}%");
                $q->orWhere('raw_name', 'like', "%{$key}%");
                $q->orWhere('fileext', 'like', "%{$key}%");

            })->get();

        $format = [];
        foreach ($r as $item) {
            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->description,
                'link'        => route('front.file.download', $item->url)

            ]);
        }

        return $format;
    }

    private function resultBahanBangunan($key)
    {
        $r = \Berkas::where('file.ExpiryDate', '>', Carbon::now())
            ->where('file.categoryfile', \Berkas::STANDAR_HARGA_MATERIAL)
            ->where(function ($q) use ($key) {
                $q->where('filename', 'like', "%{$key}%");
                $q->orWhere('description', 'like', "%{$key}%");
                $q->orWhere('Judul', 'like', "%{$key}%");
                $q->orWhere('raw_name', 'like', "%{$key}%");
                $q->orWhere('fileext', 'like', "%{$key}%");
            })->get();

        $format = [];
        foreach ($r as $item) {
            array_push($format, [
                'title'       => $item->Judul,
                'description' => $item->description,
                'link'        => route('front.file.download', $item->url)
            ]);
        }

        return $format;
    }
}