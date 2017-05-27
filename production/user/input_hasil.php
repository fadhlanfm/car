<!-- QUERIES -->
<?php
session_start();
include_once('../../connect_db.php');
$id = $_GET['id'];
$query = "SELECT * FROM logbook WHERE id = '$id'";
  //execute the query
$result = $db->query( $query );
if (!$result)
{
  die("could not query the database: <br />".$db->error);
}
$row = $result->fetch_object();

if ($row->start > date("Y-m-d") || $row->start <= date("Y-m-d") and $row->end >= date("Y-m-d")) {
  $message = "Belum bisa input hasil. Karena program belum dimulai atau belum selesai";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'programs.php';
        </script>";
        exit;
}

$coba = $_SESSION['id'];
$query2 = "SELECT * FROM user WHERE username = '$coba'";
    //execute the query
$result2 = $db->query( $query2 );
if (!$result2)
{
  die("could not query the database: <br />".$db->error);
}
$row2 = $result2->fetch_object();
?>

<?php

if(isset($_SESSION['role']) && $_SESSION['role'] == 1)
{
  if (isset($_SESSION['unit']) && $_SESSION['unit'] == $row->kode_unit)
  {

  }
  else
  {
    echo 'tetottt';
    exit;
  }

} else if (isset($_SESSION['role']) && $_SESSION['role'] == -1) {
  header ('Location: ../../page_403.php');
  exit;
} else if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
  header ('Location: ../../page_403.php');
  exit;
}
else
{
  header ('Location: ../../page_4033.php');
  exit;

}

if ($row->status_res==1) {
  $message = "Hasil untuk program ini sudah diinput";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'programs.php';
        </script>";
}

$message = "Anda akan submit hasil dari program ".$row->nama_program." ".$row2->username.". Pastikan Anda menginput hasil dengan tepat dan benar. Klik OK untuk melanjutkan ke halaman form";
        echo "<script type='text/javascript'>alert('$message');
        </script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="../../assets/gi.ico" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Isi Hasil Logbook</title>

  <!-- Bootstrap -->
  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

  <link rel="stylesheet" type="text/css" href="../../css/print.css" media="print" />

  <!-- Custom Theme Style -->
  <link href="../../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md" onload="setInterval('displayServerTime()', 1000);">


  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><span>Garuda Indonesia</span></a>
          </div>

          <div class="clearfix"></div>

          

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Beranda <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="index.php">Halaman Utama</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> CC Program <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="programs.php">Corporate Culture Program</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-cog"></i> Pengaturan<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="edit_username2.php">Ubah Username</a></li>
                    <li><a href="edit_password2.php">Ubah Password</a></li>
                  </ul>
                </li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->
          
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav hidden-print">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="../images/img.jpg" alt=""><?php

                  echo''.$row2->username.'';
                  ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="../acc_logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
              <li role="presentation">
                <a href="javascript:window.print()">
                  <i class="fa fa-print"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="x_panel">
          <div class="x_title">
            <h2>Input Hasil Logbook </h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="programs.php"><button class="btn btn-primary btn-xs">Kembali</button></a>
              </li>
            </ul>
            <div class="clearfix">
            </div>
          </div>
          <div class="x_content">
            <div class="x_content bs-example-popovers">
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Pastikan Anda mengisi form ini dengan tepat sesuai dengan hasil program "<?php echo $row->nama_program; ?>" dari <?php echo $row2->username;?>. Periksalah kembali sebelum Anda submit <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> </strong>
              </div>
            </div>
            <form action="post_hasil_logbook.php" method="POST"><br>
              <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-12">
                <label>Kode Unik</label>
                  <input readonly class="form-control" type="text" name="id" id="id" value="<?php echo $row->id ?>">
                </div> 
              </div> <br/> <hr>
              
              <?php
              // aktivitas0
              if ($row->target_flyhi0!=='') {
                ?>
                <h2>Merubah Perilaku</h2>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Perilaku</label>
                    <input readonly type="text" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 1</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_flyhi0; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi0; ?></span>
                   </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 1</label>
                      <input type="text" id="target" name="hasil_flyhi0" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi0; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_flyhi1!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 2</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_flyhi1; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi1; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 2</label>
                      <input type="text" id="target" name="hasil_flyhi1" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi1; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_flyhi2!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 3</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_flyhi2; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi2; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 3</label>
                      <input type="text" id="target" name="hasil_flyhi2" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi2; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_flyhi3!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 4</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_flyhi3; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi3; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 4</label>
                      <input type="text" id="target" name="hasil_flyhi3" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi3; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_flyhi4!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 5</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_flyhi4; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi4; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 5</label>
                      <input type="text" id="target" name="hasil_flyhi4" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_flyhi4; ?></span>
                    </div>
                  </div>
                </div><hr>
                <?php 
              }
              // aktivitas0
              if ($row->aktifitas0!=='') {
                ?>
                <hr>
                <h2>Nilai Tambah Untuk Perusahaan</h2>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Aktifitas 1</label>
                    <input readonly type="text" class="form-control" value="<?php echo $row->aktifitas0;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 1</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target0; ?>" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan0; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 1</label>
                      <input type="text" id="target" name="hasil0" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan0; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              } 

              // aktivitas1
              if ($row->aktifitas1!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Aktifitas 2</label>
                    <input readonly type="text" class="form-control" value="<?php echo $row->aktifitas1;?>">

                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 2</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target1;?>" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan1; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil2">Hasil 2</label>
                      <input type="text" id="target" name="hasil1" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan1; ?></span>
                    </div>
                  </div>
                </div> 
                <?php  
              } 

              // aktivitas2
              if ($row->aktifitas2!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Aktifitas 3</label>
                    <input readonly type="text" class="form-control" value="<?php echo $row->aktifitas2;?>">

                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 3</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target2;?>" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan2; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil3">Hasil 3</label>
                      <input type="text" id="target" name="hasil2" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan2; ?></span>
                    </div>
                  </div>
                </div> 
                <?php  
              } 

              // aktivitas3
              if ($row->aktifitas3!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Aktifitas 4</label>
                    <input readonly type="text" class="form-control" value="<?php echo $row->aktifitas3;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 4</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target3;?>" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan3; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil4">Hasil 4</label>
                      <input type="text" id="target" name="hasil3" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan3; ?></span>
                    </div>
                  </div>
                </div> 
                <?php 
              } 

              // aktivitas4
              if ($row->aktifitas4!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Aktifitas 5</label>
                    <input readonly type="text" class="form-control" value="<?php echo $row->aktifitas4;?>">

                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 5</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target4;?>" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan4; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil5">Hasil 5</label>
                      <input type="text" id="target" name="hasil4" class="form-control">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan4; ?></span>
                    </div>
                  </div>
                </div> <hr>
                <?php } ?>


                <!-- financial-->
                <?php if ($row->tujuan_capai_kinerja_0==1) { ?>
                <hr>
                <h2>Pendorong Tercapainya Kinerja Terbaik</h2>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Kinerja</label>
                    <input readonly type="text" class="form-control" value="Financial">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 1</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_financial0; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial0; ?></span>
                   </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 1</label>
                      <input type="text" id="target" name="hasil_financial0" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial0; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_financial1!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 2</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_financial1; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial1; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 2</label>
                      <input type="text" id="target" name="hasil_financial1" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial1; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_financial2!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 3</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_financial2; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial2; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 3</label>
                      <input type="text" id="target" name="hasil_financial2" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial2; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_financial3!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 4</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_financial3; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial3; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 4</label>
                      <input type="text" id="target" name="hasil_financial3" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial3; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_financial4!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 5</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_financial4; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial4; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 5</label>
                      <input type="text" id="target" name="hasil_financial4" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_financial4; ?></span>
                    </div>
                  </div>
                </div><br>
                <?php 
              } ?>
              <!-- financial-->

              <!-- customer -->
              <?php if ($row->tujuan_capai_kinerja_1==1) { ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Kinerja</label>
                    <input readonly type="text" class="form-control" value="Customer">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 1</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_customer0; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer0; ?></span>
                   </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 1</label>
                      <input type="text" id="target" name="hasil_customer0" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer0; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_customer1!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 2</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_customer1; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer1; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 2</label>
                      <input type="text" id="target" name="hasil_customer1" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer1; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_customer2!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 3</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_customer2; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer2; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 3</label>
                      <input type="text" id="target" name="hasil_customer2" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer2; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_customer3!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 4</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_customer3; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer3; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 4</label>
                      <input type="text" id="target" name="hasil_customer3" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer3; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_customer4!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 5</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_customer4; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer4; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 5</label>
                      <input type="text" id="target" name="hasil_customer4" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_customer4; ?></span>
                    </div>
                  </div>
                </div><br>
                <?php 
              } ?>
              <!-- customer -->

              <!-- ibp -->
              <?php if ($row->tujuan_capai_kinerja_2==1) { ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Kinerja</label>
                    <input readonly type="text" class="form-control" value="Internal Business Process">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 1</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_ibp0; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp0; ?></span>
                   </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 1</label>
                      <input type="text" id="target" name="hasil_ibp0" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp0; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_ibp1!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 2</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_ibp1; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp1; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 2</label>
                      <input type="text" id="target" name="hasil_ibp1" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp1; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_ibp2!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 3</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_ibp2; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp2; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 3</label>
                      <input type="text" id="target" name="hasil_ibp2" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp2; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_ibp3!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 4</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_ibp3; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp3; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 4</label>
                      <input type="text" id="target" name="hasil_ibp3" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp3; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_ibp4!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 5</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_ibp4; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp4; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 5</label>
                      <input type="text" id="target" name="hasil_ibp4" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_ibp4; ?></span>
                    </div>
                  </div>
                </div><br>
                <?php 
              } ?>
              <!-- ibp -->

              <!-- lg -->
              <?php if ($row->tujuan_capai_kinerja_3==1) { ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <label>Kinerja</label>
                    <input readonly type="text" class="form-control" value="Learning & Growth">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 1</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_lg0; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg0; ?></span>
                   </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 1</label>
                      <input type="text" id="target" name="hasil_lg0" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg0; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_lg1!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 2</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_lg1; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg1; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 2</label>
                      <input type="text" id="target" name="hasil_lg1" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg1; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_lg2!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 3</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_lg2; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg2; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 3</label>
                      <input type="text" id="target" name="hasil_lg2" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg2; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_lg3!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 4</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_lg3; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg3; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 4</label>
                      <input type="text" id="target" name="hasil_lg3" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg3; ?></span>
                    </div>
                  </div>
                </div>
                <?php 
              }
              // aktivitas0
              if ($row->target_lg4!=='') {
                ?>
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-xs-12">
                    <input readonly type="hidden" class="form-control" value="<?php echo $row->tujuan_merubah_perilaku;?>">
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="target1">Target 5</label>
                      <input readonly type="text" id="target" value="<?php echo $row->target_lg4; ?>" class="form-control">
                        <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg4; ?></span>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="input-field col s6 has-feedback">
                      <label for="hasil1">Hasil 5</label>
                      <input type="text" id="target" name="hasil_lg4" class="form-control" value="">
                      <span class="form-control-feedback right" aria-hidden="true" style="color: grey"><?php echo $row->satuan_lg4; ?></span>
                    </div>
                  </div>
                </div><hr><br>
                <?php 
              } ?>
              <!-- lg -->

              <div class="x_content bs-example" data-example-id="glyphicons-accessibility">
                <div class="alert alert-danger" role="alert">
                  <input type="checkbox" required>
                    Saya mengisi form ini dengan tepat dan benar sesuai dengan hasil program "<?php echo $row->nama_program; ?>" dari <?php echo $row2->username;?>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <button type="submit" value="Submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Corporate Culture Information Systems - GA
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="../../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../../vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="../../vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="../../vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="../../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="../../vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="../../vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="../../vendors/Flot/jquery.flot.js"></script>
  <script src="../../vendors/Flot/jquery.flot.pie.js"></script>
  <script src="../../vendors/Flot/jquery.flot.time.js"></script>
  <script src="../../vendors/Flot/jquery.flot.stack.js"></script>
  <script src="../../vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="../../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="../../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="../../vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="../../vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="../../vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="../../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="../../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="../js/moment/moment.min.js"></script>
  <script src="../js/datepicker/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../../build/js/custom.min.js"></script>

  <!-- /JQVMap -->

  <!-- Skycons -->
  <script>
    $(document).ready(function() {
      var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
      "clear-day", "clear-night", "partly-cloudy-day",
      "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
      "fog"
      ],
      i;

      for (i = list.length; i--;)
        icons.set(list[i], list[i]);

      icons.play();
    });
  </script>
  <!-- /Skycons -->

  <!-- Doughnut Chart -->
  <script>

    $(document).ready(function (){
      $("#clickme").click(function (){
        $('html, body').animate({
          scrollTop: $("#deskripsi").offset().top
        }, 500);
      });
    });

    $(document).ready(function(){
      var options = {
        legend: false,
        responsive: false
      };

      new Chart(document.getElementById("canvas1"), {
        type: 'doughnut',
        tooltipFillColor: "rgba(51, 51, 51, 0.55)",
        data: {
          labels: [
          "Economy Class",
          "Business Class",
          "First Class"
          ],
          datasets: [{
            data: [3412, 768, 475],
            backgroundColor: [
            "#9B59B6",
            "#26B99A",
            "#3498DB"
            ],
            hoverBackgroundColor: [
            "#B370CF",
            "#36CAAB",
            "#49A9EA"
            ]
          }]
        },
        options: options
      });
    });
  </script>
  <!-- /Doughnut Chart -->

  <!-- bootstrap-daterangepicker -->
  <script>
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      };

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <!-- /bootstrap-daterangepicker -->

  <!-- gauge.js -->
  <script>
    var opts = {
      lines: 12,
      angle: 0,
      lineWidth: 0.4,
      pointer: {
        length: 0.75,
        strokeWidth: 0.042,
        color: '#1D212A'
      },
      limitMax: 'false',
      colorStart: '#1ABC9C',
      colorStop: '#1ABC9C',
      strokeColor: '#F0F3F3',
      generateGradient: true
    };
    var target = document.getElementById('foo'),
    gauge = new Gauge(target).setOptions(opts);

    gauge.maxValue = 6000;
    gauge.animationSpeed = 32;
    gauge.set(3200);
    gauge.setTextField(document.getElementById("gauge-text"));
  </script>
  <!-- /gauge.js -->

  <script type="text/javascript">
    //set timezone
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
      }
    </script>

  </body>
  </html>
