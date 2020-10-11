<?php
//load konfigurasi website
$site   = $this->konfigurasi_model->listing();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- icon diambil dari konfigurasi website -->
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/upload/image/' . $site->icon) ?>" />
  <!-- SEO google -->
  <meta name="keywords" content="<?php echo $site->keywords ?>">
  <meta name="description" content="<?php echo $title ?>, <?php echo $site->deskripsi ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/magnific-popup.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/aos.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/util.css">

  <!-- css ku -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/shopmax/css/styleku.css">

  <link href="https://fonts.googleapis.com/css?family=Dancing+Script&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Alata&display=swap" rel="stylesheet">

  <style type="text/css" media="screen">
    ul.pagination {
      padding: 0 10px;
      background-color: whitesmoke;
      border-radius: 10px;
    }

    .pagination a,
    .pagination b {
      padding: 10px 20px;
      text-decoration: none;
      float: left;
    }

    .pagination a {
      background-color: whitesmoke;
      color: black;
    }

    .pagination b {
      background-color: #ee4266;
      color: white;
    }

    .pagination a:hover {
      background-color: #ee4266;
      color: whitesmoke;
    }
  </style>
</head>

<body>