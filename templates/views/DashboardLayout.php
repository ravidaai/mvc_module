
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo isset($web_title)?$web_title:'American Ways'; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo site_url('assets/site/dashboard/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo site_url('assets/site/dashboard/vendor/datatables/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="<?php echo site_url('assets/site/dashboard/css/sb-admin.css'); ?>" rel="stylesheet">
  <link href=”//vjs.zencdn.net/7.0/video-js.min.css” rel=”stylesheet”>
  <script src=”//vjs.zencdn.net/7.0/video.min.js”></script>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">


<?php /* ?>
<a class="navbar-brand mr-1" href="<?php echo site_url(); ?>"><span class="american amways">American</span> <span class="ways amways">Ways</span></a>
<?php */ ?>
      

    



    <!-- Navbar -->
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">

       
        <li class="nav-item no-arrow">
       
          
        </li>

        <li class="nav-item no-arrow">
            <a class="btn btn-danger btn-sm" href="<?php echo site_url('dashboard/logout'); ?>">Logout</a>
        </li>

    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav" style="padding-top: 50px;">
      
    <?php
            $mem_type = $this->members_model->fromId($this->session->userdata('user_id'))
        ?>

        <?php if(strcasecmp($mem_type->member_type, "group")==0): ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo site_url('dashboard/session'); ?>">
                    <i class="fas fa-user-graduate"></i>
                    <span>My Students</span></a>
            </li>
        <?php endif; ?>

        <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url('dashboard/about_this_ourse'); ?>">
            <i class="fas fa-user-graduate"></i>
                <span>About This Course</span>
            </a>
        </li>
    
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url('dashboard/course_home'); ?>">
        <i class="fas fa-user-graduate"></i>
          <span>Course home</span>
        </a>
      </li>
        

      <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url('dashboard/course_evaluation'); ?>">
            <i class="fas fa-user-graduate"></i>
                <span>Course Evaluation</span>
            </a>
        </li>


       

        <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url('dashboard/support'); ?>">
            <i class="fas fa-user-graduate"></i>
                <span>Support</span>
            </a>
        </li>

       

      <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url('dashboard/change_password'); ?>">
        <i class="fas fa-user-graduate"></i>
          <span>Setting</span></a>
      </li>
    </ul>

    <div id="content-wrapper">
    <div class="container">
    <div class="row">
    <div class="col-md-8">
      <p>
       <?php 
       if(strcasecmp($this->router->fetch_class(), 'dashboard')==0 && strcasecmp($this->router->fetch_method(), 'session_billing')==0):
       ?>
Understanding American Government: An Introductory Guide for International Visitors
       <?php endif; ?>
        
      </p>
    </div>
    <div class="col-md-4" >
    <?php $mem_type = $this->members_model->fromId($this->session->userdata('user_id')); ?>
      <?php if(strcasecmp($mem_type->member_type, 'Student')==0): ?>
      <?php if($mem_type->member_flag=="group"): ?>
      <?php
      
      $groupQry = $this->members_model->fromId($mem_type->group_id);
      $collegeQry = $this->members_model->fromId($groupQry->group_id);
      ?>
      <p style="float:right;">
          <?php  echo $mem_type->first_name." ".$mem_type->last_name; ?><br>
          <?php  echo $collegeQry->institution;?>
        </p>
       <?php else: ?>
        <p style="float:right;">
            <?php  echo $mem_type->first_name." ".$mem_type->last_name; ?><br>
            <?php  echo $mem_type->institution;?>
          </p>
       <?php endif; ?>
        
          
      <?php elseif(strcasecmp($mem_type->member_type, 'Guest')==0): ?>
        <p style="float:right;">
          <?php  echo $mem_type->first_name." ".$mem_type->last_name; ?><br>
          <?php  echo $mem_type->institution;?>
        </p>
      <?php else: ?>
      <p style="float:right;">

      <?php  echo $mem_type->group_name; ?><br>
      <?php  echo $mem_type->institution;?>
      </p>
          
      <?php endif; ?>

    </div>
    </div>

    </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo "<strong>".getFlashMessage('flash_error')."</strong>";
                    echo "<strong>".getFlashMessage('flash_success')."</strong>";
                    ?>
                </div>
            </div>
        </div>



         

            <?php
            $this->load->view($module.'/'.$template);
            ?>

     

      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; AmericanWays <?php echo date('Y'); ?></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



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
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

  <script>
  (function($) {
    $('#dataTable').dataTable({
        "order": [],
        "ordering": false,
        "lengthMenu": [ 10, 25, 50 ],
        "pageLength":50
    });
  })(jQuery);
  </script>

</body>

</html>
