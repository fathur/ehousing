<?php
namespace Repositories\Navigasi;
use Carbon\Carbon;


/**
 * Class Builder
 * @package Repositories\Navigasi
 */
class Builder
{
    const KODE_PROFIL_PROFINSI = 201511020000;

    public static $exceptionFirstSegment = array(
        'test','login','logout','password','kontak','hunian','posts','post','link',
        'file','profile','statistik','program','berita','ehousing','back-office','hubungi-kami');

    public static function renderFront()
    {
        $nav = new static;

        $navigasi =  \Navigasi::where('Jenis','SB')
            ->where('ExpiryDate','>',Carbon::now())
            ->orderBy('Prioritas', 'asc')
            ->get();

        return $nav->buildMenu($navigasi);
    }

    /**
     * @author Fathur Rohman <fathur@dragoncapital.center>
     */
    public static function renderBack()
    {
        return \View::make('sidebar_back')->render();
    }

    protected function buildMenu($navigasi, $parent = 0)
    {
        $html = "";
        foreach ($navigasi as $item) {
            if($item->ParentKodeMenu ==  $parent)
            {
                if($this->checkProvinsi($item->URL) != '/profile') {
                    $arrow = $this->hasChildren($navigasi, $item->KodeMenu) ? '<span class="fa arrow"></span>' : '';

                    $html .= "<li class=''>
						<a href='" . url($this->checkProvinsi($item->URL)) . "'>
							<i class='{$item->Icon}'></i>
							<span class='nav-label'>{$item->Nama}</span> {$arrow}
						</a>";

                    if ($this->hasChildren($navigasi, $item->KodeMenu))
                        $html .= $this->buildSubMenu($navigasi, $item->KodeMenu);

                    $html .= "</li>";
                }
            }
        }

        return $html;
    }

    protected function buildSubMenu($navigasi, $parent = 0)
    {
        $result = "<ul class='nav nav-second-level collapse'>";
        foreach ($navigasi as $item) {
            if ($item->ParentKodeMenu == $parent)
            {
                $result.= "<li><a href='".url($this->checkProvinsi($item->URL))."'>{$item->Nama}</a>";
                if ($this->hasChildren($navigasi,$item->KodeMenu))
                    $result.= $this->buildSubMenu($navigasi,$item->KodeMenu);
                $result.= "</li>";
            }
        }

        $result .="</ul>";
        return $result;
    }

    protected function hasChildren($navigasi, $id)
    {
        foreach ($navigasi as $item) {
            if($item->ParentKodeMenu == $id)
                return true;
        }

        return false;
    }

    public function checkProvinsi($string)
    {
        $segmentProv = \Request::segment(1);

        if(in_array($segmentProv, static::$exceptionFirstSegment))
            return preg_replace('/\{(provinsi)\}/i', '', $string);

        return preg_replace('/\{(provinsi)\}/i', $segmentProv, $string);
    }


}