<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>American Ways</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo site_url('assets/site/dashboard/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo site_url('assets/site/dashboard/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo site_url('assets/site/dashboard/css/sb-admin.css'); ?>" rel="stylesheet">

</head>

<body id="page-top">


  <div id="wrapper">



    <div id="content-wrapper">






        <div class="container-fluid">
            <div class="row">
<div class="col-lg-12">
  <p class="">
  <a href="javascript:void(0)" onclick = "window.print()">PRINT</a>
</p>
    
</div>
            </div>

                <?php
                $this->load->view($module.'/'.$template);
                ?>

        </div>


    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->



  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo site_url('assets/site/dashboard/vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/site/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo site_url('assets/site/dashboard/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo site_url('assets/site/dashboard/vendor/chart.js/Chart.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/site/dashboard/vendor/datatables/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo site_url('assets/site/dashboard/vendor/datatables/dataTables.bootstrap4.js'); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo site_url('assets/site/dashboard/js/sb-admin.min.js'); ?>"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo site_url('assets/site/dashboard/js/demo/datatables-demo.js'); ?>"></script>
  <script src="<?php echo site_url('assets/site/dashboard/js/demo/chart-area-demo.js'); ?>"></script>

</body>

</html>
