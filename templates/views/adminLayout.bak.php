<!DOCTYPE html>
<html lang="en-US">
<head>
    <!-- META SECTION -->
    <title><?php echo $web_title; ?></title>
    <META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo site_url(); ?>/assets/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/datatable'); ?>/media/css/jquery.dataTables.css">

<style>
.dataTable thead tr th[class*="no-sort"]:after{
    content: "" !important;
}
</style>



    <script>
        var base_path = '<?php echo site_url(); ?>';
    </script>
    <!-- <script src="<?php echo site_url('assets/ckeditor/ckeditor.js') ?>"></script> -->
    <script src="<?php echo site_url(); ?>assets/jchain/jquery.chained.js"></script>

    <script type="text/javascript">
        //CKEDITOR.timestamp = Math.random().toString(36).substring( 0, 5 );
        $(document).ready(function() {

            var max_fields      = 200; //maximum input boxes allowed
            var wrapper_photo         = $(".input_fields_wrap_photo"); //Fields wrapper
            var add_button_photo      = $(".add_field_button_photo"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button_photo).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper_photo).append('<div><input type="text" name="post_media[photo]" readonly="readonly" onclick="openKCFinder(this)" value="Browse Library"/> <a href="#" class="remove_field" >Remove</a></div>'); //add input box
                }
            });

            $(wrapper_photo).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

            /****************************/

            var wrapper_video         = $(".input_fields_wrap_video"); //Fields wrapper
            var add_button_video      = $(".add_field_button_video"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button_video).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper_video).append('<div><input type="text" name="post_media[video]" readonly="readonly" onclick="openKCFinder(this)" value="Browse Library"/> <a href="#" class="remove_field" >Remove</a></div>'); //add input box
                }
            });

            $(wrapper_video).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

            /****************************/

            var wrapper_other         = $(".input_fields_wrap_other"); //Fields wrapper
            var add_button_other      = $(".add_field_button_other"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button_other).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper_other).append('<div><input type="text" name="post_media[other]" readonly="readonly" onclick="openKCFinder(this)" value="Browse Library"/> <a href="#" class="remove_field" >Remove</a></div>'); //add input box
                }
            });

            $(wrapper_other).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

        });

        function openKCFinder(field) {
            window.KCFinder = {
                callBack: function(url) {
                    field.value = url;
                    window.KCFinder = null;
                }
            };
            window.open('<?php echo site_url('assets/kcfinder') ?>/browse.php?type=files&dir=files/public', 'kcfinder_textbox',
                'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
                'resizable=1, scrollbars=0, width=800, height=600'
            );
        }
    </script>


    <style>
        .panel-heading ul li{margin-left: 5px;}
        .table-responsive{overflow-x: visible!important;}
    </style>

</head>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">

    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="" style="background: #019174;text-align: center; font-size:20px!important;">
                <a href="#"><strong> American  Ways</strong></a>
                <a href="#" class="x-navigation-control"></a></li>
            <li class="active"><a href="<?php echo site_url('members/dashboard'); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a></li>
            <li><a href="<?php echo site_url('student/roster') ?>"><span class="fa fa-long-arrow-right"></span>Student Roster</a></li>
            <li><a href="<?php echo site_url('student/alumni') ?>"><span class="fa fa-long-arrow-right"></span> Alumni Roster</a></li>
            <li><a href="<?php echo site_url('student/guest_roster') ?>"><span class="fa fa-long-arrow-right"></span>Guest Roster</a></li>
            <li><a href="<?php echo site_url('student/group_roster') ?>"><span class="fa fa-long-arrow-right"></span>Group Roster</a></li>
            <li><a href="<?php echo site_url('setting/manage') ?>"><span class="fa fa-long-arrow-right"></span> Settings</a></li>
            <li><a href="<?php echo site_url('members/edit_profile') ?>"><i class="fa fa-user fa-fw"></i> Edit Profile</a></li>
        </ul>


        <!-- END X-NAVIGATION -->
    </div>
    <!-- END PAGE SIDEBAR -->

    <!-- PAGE CONTENT -->
    <div class="page-content">
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <li class="pull-right">
                <a href="<?php echo site_url('members/logout') ?>">Logout</a>
            </li>

        </ul>

<!-- END BREADCRUMB -->

        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo getFlashMessage('flash_error');
                    echo getFlashMessage('flash_success');
                    ?>
                </div>
            </div>


          

            <?php
            $this->load->view($module.'/'.$template);
            ?>


        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->



<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<?php /**
* <script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/jquery/jquery.min.js"></script>
* **/?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/jquery.ajaxfileupload.js"></script>

<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->

<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1yrj7vduitug6t3wzxe3r5ypuxig4pqqxfeng7xrb3ggzx10"></script> -->
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('assets/tinymce/init-tinymce.js') ?>"></script>

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src='<?php echo site_url(); ?>/assets/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='<?php echo site_url(); ?>/assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='<?php echo site_url(); ?>/assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='<?php echo site_url(); ?>/assets/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->

<!--<script type="text/javascript" src="--><?php //echo site_url(); ?><!--/assets/js/settings.js"></script>-->
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/actions.js"></script>

<script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/demo_dashboard.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->

<script src="<?php echo site_url(); ?>/assets/jchain/jquery.chained.js?v=1.0.0" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo site_url(); ?>/assets/jchain/jquery.chained.remote.js?v=1.0.0" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo site_url('assets/datatable'); ?>/media/js/jquery.dataTables.min.js"></script>


<script>
    (function ($) {
    $('#example').DataTable(
        
    );
    
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    })(jQuery);
</script>

<script>

function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
        var i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
    var rnd_pwd = randomPassword(8);
    //$("div#rnd_pwd").val(rnd_pwd);
    $("input[name=conf_password]").val(rnd_pwd);
    $("input[name=pwd]").val(rnd_pwd);
}


    function ask(msg)
    {
        var r = confirm(msg);
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }

    $("input#meta[type='checkbox']").on("change",function(){
        if($(this).is(":checked"))
            $(this).val("Y");
        else
            $(this).val("");
    });

    $("input#meta[type='radio']").on("change",function(){
        if($(this).is(":checked"))
            $(this).val("Y");
        else
            $(this).val("");
    });

    $('#start_date').datepicker({
        //format: 'mm/dd/yyyy',
        format: 'yyyy-mm-dd',
    })

    $('#end_date').datepicker({
        //format: 'mm/dd/yyyy',
        format: 'yyyy-mm-dd',
    })

    $('#start_date_from').datepicker({
        format: 'yyyy-mm-dd',
    })

    $('#end_date_to').datepicker({
        format: 'yyyy-mm-dd',
    })

    $('#payment_due_date').datepicker({
        format: 'yyyy-mm-dd',
    })
    
    (function($){

      // Delete gallery box
        $('.del_gallery_box').on('click',function(){
           /// $('.input_wrapper').remove();
           alert('hello');
        });
        // Delete gallery thumbnail
        $('.img_gallery_delete').on('click',function(event){
            event.preventDefault();
                var gmid = $(this).attr('data-id');
                var csrf = $("input[name=my_csrf_token]").val();
                var url = '<?=base_url('post/delete_post_gallery') ?>' + '/' + gmid;  
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{my_csrf_token:csrf},
                    success:function(data){
                        $('.box'+gmid).remove();                       
                    },error:function(){
                        alert('Error');
                    }
                });
        });   


       //add and remove textbox
       $(".add-row").click(function(){
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var country = $("#country").val();
            var email = $("#email").val();

            var markup = "<tr>";
            
            markup +="<td>";
            markup +="<label><input type='checkbox' name='record'></label>";
            markup +="</td>";

            markup +="<td>";
            markup +="<input type='textbox' name='fname[]' required  class='form-control' value='" + fname + "'>";
            markup +="</td>";

            markup +="<td>";
            markup +="<input type='textbox' name='lname[]' required  class='form-control' value='" + lname + "'>";
            markup +="</td>";

            markup +="<td>";
            markup +="<input type='textbox' name='country[]' required  class='form-control' value='" + country + "'>";
            markup +="</td>";

            markup +="<td>";
            markup +="<input type='email' name='email[]' required  class='form-control email_variable'  value='" + email + "'>";
            markup +="</td>";

            markup +="</tr>";


            //var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='textbox' name='name[]' value='" + name + "'></td><td><input type='textbox' name='email[]' value='" + email + "'></td></tr>";
            //var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='textbox' name='name[]' value='" + name + "'></td><td><input type='textbox' name='email[]' value='" + email + "'></td></tr>";
            $(".add-row").prop('disabled', true);
            $("#email_validation_msg").html('');

            var add_flag = true;
            $('.email_variable').each(function(i, obj) {
                if(email.toLowerCase().trim() == $(obj).val().toLowerCase().trim()){
                    add_flag = false;
                    return false; 
                }
            });


      if(add_flag){
        $.ajax({
            url: '<?php echo site_url('student/check_email'); ?>',
            method: 'POST',
            data: {
                email_var: email,
                my_csrf_token: '<?php echo $this->security->get_csrf_hash();?>'
            },
            dataType: 'json',
            success: function(data) {
                $(".add-row").prop('disabled', false);
                
                if(data.status==1){
                   $("#fname").val("");
            $("#lname").val("");
            $("#country").val("");
            $("#email").val("");
                   
                    $("table tbody").append(markup);
                }else{
                    $("#email_validation_msg").html(data.status);
                }
            }
        });
      }else{
        $(".add-row").prop('disabled', false);
      }
            

});

// Find and remove selected table rows
$(".delete-row").click(function(){
    $("table tbody").find('input[name="record"]').each(function(){
        if($(this).is(":checked")){
            $(this).parents("tr").remove();
        }
    });
}); 

//file upload
        $(document).on('change', '#upload_file', function(){
            var name = document.getElementById("upload_file").files[0].name;

            var form_data = new FormData();


            /**************/

            // var form_data = new FormData();
            // var file_data = $('input[type="file"]')[0].files; // for multiple files
            // for(var i = 0;i<file_data.length;i++){
            //     form_data.append("file_"+i, file_data[i]);
            // }

            var other_data = $('#uploadForm').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });

            /**************/


            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['pdf']) == -1)
            {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("upload_file").files[0]);
            var f = document.getElementById("upload_file").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 3000000)
            {
                alert("Image File Size is very big");
            }
            else
            {
                //my_csrf_token: '<?php //echo $this->security->get_csrf_hash();?>'
                form_data.append("userfile", document.getElementById('upload_file').files[0]);
                $.ajax({
                    url:"<?php echo site_url('student/test_upload') ?>",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        $('#uploaded_image').html("<p class='text-success'>Uploading...</p>");
                    },
                    success:function(response)
                    {
                        var data = JSON.parse(response);
                        if(data.status=="success"){
                            window.location.replace(data.redirect_uri);
                            return false;
                        }else{
                            $('#uploaded_image').html(data);
                        }
                        
                    }
                });
            }
        });


        //invoice
        $(document).on('change', '#formInvoice', function(){
            var name = document.getElementById("userfile_invoice").files[0].name;

            var form_data = new FormData();

            var other_data = $('#formInvoice').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });

            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['pdf']) == -1)
            {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("userfile_invoice").files[0]);
            var f = document.getElementById("userfile_invoice").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 3000000)
            {
                alert("Image File Size is very big");
            }
            else
            {
                form_data.append("userfile", document.getElementById('userfile_invoice').files[0]);
                $.ajax({
                    url:"<?php echo site_url('student/upload_invoice/'.$this->uri->segment(3)) ?>",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        $('#uploaded_image').html("<p class='text-success'>Uploading...</p>");
                    },
                    success:function(response)
                    {
                        var data = JSON.parse(response);

                        if(data.status=="success"){
                            //console.log(data);
                            window.location.replace(data.redirect_uri);
                            $('#uploaded_image').html(null);
                        }else{
                            $('#uploaded_image').html(data);
                        }
                        
                    }
                });
            }
        });

        //receipt
        $(document).on('change', '#formInvoice', function(){
            var name = document.getElementById("userfile_invoice").files[0].name;

            var form_data = new FormData();

            var other_data = $('#formInvoice').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });

            var ext = name.split('.').pop().toLowerCase();
            if(jQuery.inArray(ext, ['pdf']) == -1)
            {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("userfile_invoice").files[0]);
            var f = document.getElementById("userfile_invoice").files[0];
            var fsize = f.size||f.fileSize;
            if(fsize > 3000000)
            {
                alert("Image File Size is very big");
            }
            else
            {
                form_data.append("userfile", document.getElementById('userfile_invoice').files[0]);
                $.ajax({
                    url:"<?php echo site_url('student/upload_invoice/'.$this->uri->segment(3)) ?>",
                    method:"POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        $('#uploaded_image').html("<p class='text-success'>Uploading...</p>");
                    },
                    success:function(response)
                    {
                        var data = JSON.parse(response);

                        if(data.status=="success"){
                            //console.log(data);
                            window.location.replace(data.redirect_uri);
                            $('#uploaded_image').html(null);
                        }else{
                            $('#uploaded_image').html(data);
                        }

                    }
                });
            }
        });

}(jQuery));




</script>

</body>
</html>
