<?php
//load konfigurasi website
$site   = $this->konfigurasi_model->listing();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- CKEDITOR -->
  <script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/ckeditor/samples/js/sample.js" type="text/javascript"></script>
</head>