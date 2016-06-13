<?php
namespace Repositories\Navigasi;
use Carbon\Carbon;


/**
 * Class Builder
 * @package Repositories\Navigasi
 */
class Builder
{
    public static function render()
    {
        $nav = new static;

        $navigasi =  \Navigasi::where('Jenis','SB')
            ->where('ExpiryDate','>',Carbon::now())
            ->orderBy('Prioritas', 'asc')
            ->get();

        return $nav->buildMenu($navigasi);
    }

    protected function buildMenu($navigasi, $parent = 0)
    {
        $html = "";
        foreach ($navigasi as $item) {
            if($item->ParentKodeMenu ==  $parent)
            {
                $arrow = $this->hasChildren($navigasi, $item->KodeMenu) ? '<span class="fa arrow"></span>' : '';

                $html .= "<li class=''>
						<a href='".url($this->checkProvinsi($item->URL))."'>
							<i class='{$item->Icon}'></i>
							<span class='nav-label'>{$item->Nama}</span> {$arrow}
						</a>";

                if($this->hasChildren($navigasi, $item->KodeMenu))
                    $html .= $this->buildSubMenu($navigasi, $item->KodeMenu);

                $html .= "</li>";
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
        $exclude = array('test','login','password','kontak','hunian','posts','post','link',
            'file','profile','statistik','program','berita','ehousing');

        $segmentProv = \Request::segment(1);

        if(in_array($segmentProv, $exclude))
            return preg_replace('/\{(provinsi)\}/i', '', $string);

        return preg_replace('/\{(provinsi)\}/i', $segmentProv, $string);
    }
}