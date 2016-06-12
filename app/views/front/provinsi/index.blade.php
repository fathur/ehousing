@extends('layout')

@section('content')
        <!-- Content Header -->
<div class="row m-b-sm m-t-lg">
    <div class="col-md-6">
        <div class="profile-image">
            <img src="<?php echo base_url('assets/img/upload/lambang-diy.png');?>" class="img-circle circle-border m-b-md" alt="profile">
        </div>
        <div class="profile-info">
            <div class="">
                <div>
                    <h2 class="no-margins">
                        Provinsi <?php echo $row['Nama'];?>
                    </h2>
                    <h4><?php echo $row['Tagline'];?></h4>
                    <small>
                        <?php echo strip_tags(character_limiter($row['Deskripsi'],170));?>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table small m-b-xs">
            <tbody>
            <tr>
                <td>
                    <strong><?php echo number_format($row['TotalLuas']);?></strong> Luas Wilayah (Km²)
                </td>
                <td>
                    <strong><?php echo number_format($row['TotalPenduduk']);?></strong> Total Penduduk
                </td>
                <td>
                    <strong><?php echo $row['PctPertumbuhanPenduduk'];?> %</strong> Pertumbuhan Penduduk /Thn
                </td>

            </tr>
            <tr>
                <td>
                    <strong><?php echo number_format($row['TotalPendudukMiskinKota']);?></strong> Penduduk Miskin Kota
                </td>
                <td>
                    <strong><?php echo number_format($row['PajakDaerah']);?></strong> Pajak Daerah
                </td>
                <td>
                    <strong><?php echo number_format($row['TotalPendudukMiskinDesa']);?></strong> Penduduk Miskin Desa
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?php echo number_format($row['KepadatanPenduduk']);?></strong> Kepadatan Penduduk (Jiwa Km²)
                </td>
                <td>
                    <strong><?php echo number_format($row['BacklogRumah']);?></strong> Backlog Rumah (Unit)
                </td>
                <td>
                    <a href="<?php echo base_url('home/profile/provinsi/');?>" class="btn btn-info btn-rounded btn-xs">More Detail</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row m-b-lg m-l-sm text-navy">
    <strong>Wilayah Lain</strong> :
    <a href="<?php echo base_url('home/setregion/0');?>" class='btn btn-white btn-xs'>Nasional</a>
    <a href="<?php echo base_url('home/setregion/11');?>" class="btn btn-white btn-xs">Aceh</a>
    <a href="<?php echo base_url('home/setregion/51');?>" class="btn btn-white btn-xs">Bali</a>
    <a href="<?php echo base_url('home/setregion/36');?>" class="btn btn-white btn-xs">Banten</a>
    <a href="<?php echo base_url('home/setregion/17');?>" class="btn btn-white btn-xs">Bengkulu</a>
    <a href="<?php echo base_url('home/setregion/34');?>" class="btn btn-white btn-xs">DI Yogyakarta</a>
    <?php
    /* foreach($top5provinsi as $p)
    {
        echo "<a href='".base_url('home/setregion/'.$p['KodeProvinsi'])."' class='btn btn-white btn-xs'>".$p['NamaProvinsi']."</a>";
    } */
    ?>
    <a href="#" class="btn btn-white btn-xs" data-toggle="modal" data-target="#more_wilayah">More »</a>
</div>
<!-- End Content Header -->

<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-md-9">
        <!--<p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>-->
        <div class="jumbotron">
            <?php
            echo "<h1>E-Housing ".$this->session->userdata('RegionName')."</h1>
					<p>".$deskripsi_situs."</p>";
            ?>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><a href="<?php echo base_url('post/grid/berita');?>" class="btn-link"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Berita & Aktivitas</span> </a></h2>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <?php if(count($berita_aktivitas) > 0){
                            foreach($berita_aktivitas as $row){
                            $post_slug = url_title($row['Judul'], '-', TRUE)
                            ?>
                            <div class="col-sm-6 col-md-4">
                                <a href="<?php echo base_url('post/detail/'.$row['PostId'].'/'.$post_slug);?>" class="btn-link"><h3><?php echo $row['Judul'];?></h3></a>
                                <div class="small m-b-xs">
                                    <strong><?php echo $row['Nama'];?></strong> <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('dS M Y',strtotime($row['CreateDate']));?></span>
                                </div>
                                <p>
                                    <?php if(($row['Foto'])!=null or ($row['Foto'])!=""){
                                    echo "<img class='img-responsive' src='".base_url('uploads/post/'.$row['Foto'])."'>";
                                    }else{
                                    echo strip_tags(character_limiter($row['IsiPost'],200));
                                    }?>
                                </p>
                                <div class="small">
                                    <i class="fa fa-eye"> </i> <?php echo $row['JumlahVisit']>0?$row['JumlahVisit']:0; echo $row['JumlahVisit']<2?' view':' views'; ?>
                                </div>
                            </div>
                            <?php }}else{?>
                            <div class="alert alert-info">Tidak ditemukan data.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><a href="<?php echo base_url('post/grid/info');?>" class="btn-link"><i class="fa fa-th-large"></i> <span class="nav-label">Info e-Housing</span> </a></h2>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <?php
                            if(count($informasi) > 0){
                            foreach($informasi as $row){
                            $post_slug = url_title($row['Judul'], '-', TRUE);
                            ?>
                            <div class="col-sm-6 col-md-4">
                                <a href="<?php echo base_url('post/detail/'.$row['PostId'].'/'.$post_slug);?>" class="btn-link"><h3><?php echo $row['Judul'];?></h3></a>
                                <div class="small m-b-xs">
                                    <strong><?php echo $row['Nama'];?></strong> <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('dS M Y',strtotime($row['CreateDate']));?></span>
                                </div>
                                <p>
                                    <?php if(($row['Foto'])!=null or ($row['Foto'])!=""){
                                    echo "<img class='img-responsive' src='".base_url('uploads/post/'.$row['Foto'])."'>";
                                    }else{
                                    echo strip_tags(character_limiter($row['IsiPost'],200));
                                    }?>
                                </p>
                                <div class="small">
                                    <i class="fa fa-eye"> </i> <?php echo $row['JumlahVisit']>0?$row['JumlahVisit']:0; echo $row['JumlahVisit']<2?' view':' views'; ?>
                                </div>
                            </div>
                            <?php }}else{?>
                            <div class="alert alert-info">Tidak ditemukan data.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h2><a href="<?php echo base_url('post/grid/program');?>" class="btn-link"><i class="fa fa-home"></i> <span class="nav-label">Bantuan & Program Pemerintah</span> </a></h2>
                        <small>Berikut beberapa bantuan yang telah pemerintah setempat berikan untuk masyarakat, diantaranya:</small>
                        <ul class="todo-list m-t small-list ui-sortable">
                            <?php if(count($bantuan_pemerintah) > 0){
                            foreach($bantuan_pemerintah as $row){
                            $post_slug = url_title($row['Judul'], '-', TRUE);
                            echo "<li><a href='".base_url('post/detail/'.$row['PostId'].'/'.$post_slug)."'><i class='fa fa-check-square md-icon'></i> <span class='m-l-xs'>".$row['Judul']."</span></a></li>";
                            }
                            }else{
                            echo"<div class='alert alert-info'>Tidak ditemukan data.</div>";
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><a href="<?php echo base_url('file');?>" class="btn-link"><i class="fa fa-book"></i> <span class="nav-label"> Publikasi</span> </a></h2>
                    </div>
                    <div class="ibox-content">
                        <?php if(count($publikasi) > 0){
                        $i=0;
                        foreach($publikasi as $row){
                        if($i!=0){
                        echo'<div class="hr-line-dashed"></div>';
                        }$i++; ?>
                        <h3><a title="<?php echo $row['Judul']; ?>" href="<?php echo base_url('file/download/'.$row['url']);?>" target="_blank"><?php echo word_limiter($row['Judul'],6); ?></a></h3>
                        <?php
                        echo "<p>".character_limiter($row['description'],150)."</p>";
                        }
                        }else{
                        echo'<div class="alert alert-info">Tidak ditemukan data.</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h2><a href="#" class="btn-link"><i class="fa fa-rss"></i> <span class="nav-label">Hunian dalam Media Online</span> </a></h2>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <?php
                            $connected = @fsockopen("www.google.com", 80);
                            if ($connected){
                            $is_conn = "Berhasil";
                            fclose($connected);
                            }else{
                            $is_conn = "Gagal";
                            }
                            if($is_conn=="Berhasil"){
                            $list_rss[0]=  'http://inside.kompas.com/getrss/propertiarsitektur';
                            $list_rss[1]=  'http://inside.kompas.com/getrss/propertiberita';
                            $list_rss[2]=  'http://inside.kompas.com/getrss/propertikawasanterpadu';
                            $list_rss[3]=  'http://inside.kompas.com/getrss/propertihunian';
                            //$list_rss[4]=  'http://www.liputan6.com/feed/rss/';
                            $i=0;
                            foreach($list_rss as $items){
                            $rss = simplexml_load_file($items);
                            $rss_arr = array();
                            foreach ($rss->channel->item as $data) {
                            $rss_arr[$i]['title'] = (string)$data->title;
                            $rss_arr[$i]['link'] = (string)$data->link;
                            $rss_arr[$i]['created_on'] = (string)$data->pubDate;
                            $rss_arr[$i]['image'] = (string)$data->enclosure[0]['url'];
                            $rss_arr[$i]['description'] = (string)$data->description;
                            ?>
                            <div class="col-sm-6 col-md-4">
                                <a href="<?php echo $rss_arr[$i]['link'];?>" class="btn-link"><h3><?php echo $rss_arr[$i]['title'];?></h3></a>
                                <div class="small m-b-xs">
                                    <strong><?php echo $rss->channel->title;?></strong> <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo date('dS M Y',strtotime($rss_arr[$i]['created_on']));?></span>
                                </div>
                                <p>
                                    <?php if(($rss_arr[$i]['image'])!=null or ($rss_arr[$i]['image'])!=""){
                                    echo "<img class='img-responsive' src='".$rss_arr[$i]['image']."'>";
                                    }else{
                                    echo strip_tags(character_limiter($rss_arr[$i]['description'],200));
                                    }?>
                                </p>
                            </div>
                            <?php
                            if($i == 2)
                            break;
                            $i++;
                            }
                            }
                            }else{
                            echo'<div class="alert alert-danger"><i class="fa fa-warning"></i> Tidak ditemukan data.</div>';
                            }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!--/.col-xs-12.col-sm-9-->

    <div class="col-xs-12 col-md-3">
        <div class="list-group">
            <a href="<?php echo base_url('hunian/');?>" class="list-group-item active"><i class="fa fa-home"></i></small> Hunian</a>
            <?php if(count($menu_hunian) > 0){
            foreach($menu_hunian as $row){
            echo"<a href=".base_url('hunian/detail/'.$row['HunianId'])." class='list-group-item'><span class='pull-right'> <small>".$row['Deskripsi']."</small> </span>".$row['NamaHunian']."</a>";
            }
            }else{
            echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
            }
            ?>
        </div>
        <div class="list-group">
            <a href="<?php echo base_url('kontak/listkontak/developer');?>" class="list-group-item active"><i class="fa fa-connectdevelop"></i></small> Developer</a>
            <?php if(count($menu_developer) > 0){
            foreach($menu_developer as $row){
            echo"<a href='".base_url('kontak/detail/'.$row['KontakId'])."' class='list-group-item'><span class='pull-right hidden'> <small>".$row['CreateUid']."</small> </span>".$row['Nama']."</a>";
            }
            }else{
            echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
            }
            ?>
        </div>
        <div class="list-group">
            <a href="<?php echo base_url('kontak/listkontak/desain_arsitek');?>" class="list-group-item active"><i class="fa fa-object-group"></i></small> Desain & Arsitek</a>
            <?php if(count($menu_desain_arsitek) > 0){
            foreach($menu_desain_arsitek as $row){
            echo"<a href='".base_url('kontak/detail/'.$row['KontakId'])."' class='list-group-item'><span class='pull-right hidden'> <small>".$row['CreateUid']."</small> </span>".$row['Nama']."</a>";
            }
            }else{
            echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
            }
            ?>
        </div>
        <div class="list-group">
            <a href="<?php echo base_url('kontak/listkontak/kontraktor');?>" class="list-group-item active"><i class="fa fa-cogs"></i></small> Kontraktor</a>
            <?php if(count($menu_kontraktor) > 0){
            foreach($menu_kontraktor as $row){
            echo"<a href='".base_url('kontak/detail/'.$row['KontakId'])."' class='list-group-item'><span class='pull-right hidden'> <small>".$row['CreateUid']."</small> </span>".$row['Nama']."</a>";
            }
            }else{
            echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
            }
            ?>
        </div>
        <div class="list-group">
            <a href="<?php echo base_url('kontak/listkontak/tukang');?>" class="list-group-item active"><i class="fa fa-user"></i></small> Tukang</a>
            <?php if(count($menu_tukang) > 0){
            foreach($menu_tukang as $row){
            echo"<a href='".base_url('kontak/detail/'.$row['KontakId'])."' class='list-group-item'><span class='pull-right'> <small>".$row['Kompetensi']."</small> </span>".$row['Nama']."</a>";
            }
            }else{
            echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
            }
            ?>
        </div>
        <div class="list-group">
            <a href="<?php echo base_url('kontak/listkontak/suplier');?>" class="list-group-item active"> <i class="fa fa-support"></i></small> Suplier</a>
            <?php if(count($menu_suplier) > 0){
            foreach($menu_suplier as $row){
            echo"<a href='".base_url('kontak/detail/'.$row['KontakId'])."' class='list-group-item'><span class='pull-right'> <small>".$row['Kompetensi']."</small> </span>".$row['Nama']."</a>";
            }
            }else{
            echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
            }
            ?>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="<?php echo base_url('file/');?>" class="text-white"><i class="fa fa-download"></i> Unduh File</a>
            </div>
            <div class="panel-body list-group no-margins no-padding">
                <?php if(count($file_download) > 0){
                foreach($file_download as $row){
                $downloadcounter = ($row['downloadcounter']!=null) ? $row['downloadcounter'] : "0";
                echo '<a title="'.$row['Judul'].'" href="'.base_url('file/download/'.$row['url']).'" target="_blank" class="list-group-item"><span class="pull-right"> <small>'.$downloadcounter.' <i class="fa fa-download"></i></small> </span>'.character_limiter($row['Judul'],15).$row['fileext'].'</a>';}
                }else{
                echo"<span class='list-group-item'>Tidak ditemukan data.</span>";
                }
                ?>
            </div>
        </div>

    </div>

</div><!--/row-->

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Link</strong>

                        <ul class="list-group clear-list">
                            <li class="list-group-item">
                                <a href="<?php echo base_url('home/profile');?>" class="text-navy">Profil Ehousing</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('post/');?>" class="text-navy">Berita & Aktifitas</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('hunian/');?>" class="text-navy">Informasi Hunian</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url('kontak/');?>" class="text-navy">Stakeholder</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <strong>Most Visit</strong>
                        <ul class="list-group clear-list">
                            <?php if(count($GetTopPost) > 0){
                            foreach($GetTopPost as $row){
                            $post_slug = url_title($row['Judul'], '-', TRUE);
                            $num = $row['JumlahVisit']>0?$row['JumlahVisit']:'0';
                            $view = $row['JumlahVisit']<2?' view':' views';
                            echo'
												<li class="list-group-item">
													<span class="pull-right"><small>'.$num.' '.$view.' <i class="fa fa-eye"></i></small></span>
													<a href="'.base_url('post/detail/'.$row['PostId'].'/'.$post_slug).'" class="text-navy" title="'.$row['Judul'].'">'.character_limiter($row['Judul'],30).'</a>
												</li>
											';
                            }
                            }else{
                            echo'
											<li class="list-group-item">
												Tidak ditemukan data.
											</li>
										';
                            }?>
                        </ul>
                    </div>
                    <div class="col-md-4  m-t-lg text-center">
                        <p><small>Kunjungi juga kami di :</small></p>
								<span class="tooltip-demo">
								<?php if(count($facebook) > 0){
                                    foreach($facebook as $row){
                                    echo'<a class="btn btn-success btn-circle" type="button" title="" data-toggle="tooltip" data-placement="left" data-original-title="'.$row[Judul].'" href="'.$row[LinkInfo].'" target="_blank"><i class="fa fa-facebook"></i></a> ';
                                    }}?>
                                    <?php if(count($twitter) > 0){
                                    foreach($twitter as $row){
                                    echo'<a class="btn btn-info btn-circle" type="button" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="'.$row[Judul].'" href="'.$row[LinkInfo].'" target="_blank"><i class="fa fa-twitter"></i></a> ';
                                    }}?>
                                    <?php if(count($youtube) > 0){
                                    foreach($youtube as $row){
                                    echo'<a class="btn btn-danger btn-circle" type="button" title="" data-toggle="tooltip" data-placement="right" data-original-title="'.$row[Judul].'" href="'.$row[LinkInfo].'" target="_blank"><i class="fa fa-youtube"></i></a> ';
                                    }}?>
								</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
