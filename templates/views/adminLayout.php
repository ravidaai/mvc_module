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
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo site_url(); ?>/assets/css/theme-default.css" />
    <!-- EOF CSS INCLUDE -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/datatable'); ?>/media/css/jquery.dataTables.css">


    <style>
        .dataTable thead tr th[class*="no-sort"]:after {
            content: "" !important;
        }
    </style>


    <script>
        var base_path = '<?php echo site_url(); ?>';
    </script>

    <script src="<?php echo site_url(); ?>assets/jchain/jquery.chained.js"></script>


    <style>
        .panel-heading ul li {
            margin-left: 5px;
        }

        .table-responsive {
            overflow-x: visible !important;
        }
    </style>

</head>

<body>
    <!-- START PAGE CONTAINER -->
    <div class="container-fluid header001">
        <div class="row">
            <div class="col-lg-2">
            <span class="navbar-brand" href="#">American<span>Ways</span></span>
            </div>
        
        </div>
    
  </div><!-- /.container-fluid -->

<nav class="navbar navbar-default sub-header001">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url('members/dashboard'); ?>">User Stats</a></li>
                <li><a href="<?php echo site_url('student/roster') ?>">Students</a></li>
                <li><a href="<?php echo site_url('student/alumni') ?>">Alumni</a></li>
                <li><a href="<?php echo site_url('student/guest_roster') ?>">Guests</a></li>
                <li><a href="<?php echo site_url('student/group_roster') ?>">Groups</a></li>
                <li><a href="<?php echo site_url('setting/manage') ?>">Course Settings </a></li>
                <li><a href="<?php echo site_url('course') ?>">Course Content</a></li>
                <li><a href="<?php echo site_url('email_setting/manage') ?>">Email Settings</a></li>
                <li><a href="<?php echo site_url('members/edit_profile') ?>">Admin Settings</a></li>
                <li><a href="<?php echo site_url('members/logout') ?>">Sign Out</a></li>
       
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div class="container-fluid">

    
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        echo getFlashMessage('flash_error');
                        echo getFlashMessage('flash_success');
                        ?>
                    </div>
                </div>

                <?php
                $this->load->view($module . '/' . $template);
                ?>

           

      
    </div>

    <!-- END PAGE CONTAINER -->
   

    <!-- START SCRIPTS -->
    <!-- START PLUGINS -->
    <?php /**
     * <script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins/jquery/jquery.min.js"></script>
     * **/ ?>

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

    <!--<script type="text/javascript" src="--><?php
                                                ?>
    <!--/assets/js/settings.js"></script>-->
    <script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/plugins.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/actions.js"></script>

    <script type="text/javascript" src="<?php echo site_url(); ?>/assets/js/demo_dashboard.js"></script>
    <script type="text/javascript" src="<?php echo site_url(); ?>/assets/validation/dist/jquery.validate.min.js"></script>
    <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

    <script src="<?php echo site_url(); ?>/assets/jchain/jquery.chained.js?v=1.0.0" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo site_url(); ?>/assets/jchain/jquery.chained.remote.js?v=1.0.0" type="text/javascript" charset="utf-8"></script>

    <script src="<?php echo site_url('assets/datatable'); ?>/media/js/jquery.dataTables.min.js"></script>


    <script>
        (function($) {

            //$("input#order_val").bind('change keyup focus click keydown', function(){
            $("input#order_val").bind('keyup', function() {
                var textbox = $(this);
                var module = textbox.attr('name').split("_");
                var module_type = module[0];
                var module_type_id = module[1];
                var id = module[2];
                var module_order = textbox.val();
                //console.log(module);
                //$( "<span></span>" ).insertAfter( textbox );
                //$(textbox).prop('disabled', true);
                $.ajax({
                    url: '<?php echo site_url('course/check_order'); ?>',
                    method: 'POST',
                    data: {
                        module_type: module_type,
                        module_type_id: module_type_id,
                        module_order: module_order,
                        id: id,
                        my_csrf_token: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: 'json',
                    success: function(data) {

                        // $(".add-row").prop('disabled', false);
                        //$(textbox).prop('disabled', false);
                        if (data.status == 1) {

                            textbox.css("border", "solid 2px green");
                            window.location.replace("<?php echo site_url('course'); ?>");

                        } else {
                            textbox.css("border", "solid 2px red");
                        }
                    }
                });

            });

            $("input#quiz_order_val").bind('keyup', function() {
                var textbox = $(this);
                var _name = textbox.attr('name').split("_");
                var _type = _name[0];
                var _id = _name[1];

                var question_order = textbox.val();

                $.ajax({
                    url: '<?php echo site_url('course/check_quiz_order'); ?>',
                    method: 'POST',
                    data: {
                        question_id: _id,
                        order: question_order,
                        my_csrf_token: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 1) {

                            textbox.css("border", "solid 2px green");
                            window.location.replace("<?php echo site_url('course/add_modules/' . $this->uri->segment(3) . '/quiz/' . $this->uri->segment(5)); ?>");
                            //http://localhost/proj/amways/course/add_modules/9/quiz/7

                        } else {
                            textbox.css("border", "solid 2px red");
                        }
                    }
                });

            });


            $('#example').DataTable(
                {
  "pageLength": 25
}
            );

            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });


            $("#questionForm").validate({
                rules: {
                    question: "required",

                },
                messages: {
                    question: "Please enter your question"

                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `help-block` class to the error element
                    error.addClass("help-block");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents(".col-sm-5").addClass("has-success").removeClass("has-error");
                }
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


        function ask(msg) {
            var r = confirm(msg);
            if (r == true) {
                return true;
            } else {
                return false;
            }
        }

        $("input#meta[type='checkbox']").on("change", function() {
            if ($(this).is(":checked"))
                $(this).val("Y");
            else
                $(this).val("");
        });

        $("input#meta[type='radio']").on("change", function() {
            if ($(this).is(":checked"))
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





        //add and remove textbox
        $(".add-row").click(function() {

            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var country = $("#country").val();
            var email = $("#email").val();

            var markup = "<tr>";

            markup += "<td>";
            markup += "<label><input type='checkbox' name='record'></label>";
            markup += "</td>";

            markup += "<td>";
            markup += "<input type='textbox' name='fname[]' required  class='form-control' value='" + fname + "'>";
            markup += "</td>";

            markup += "<td>";
            markup += "<input type='textbox' name='lname[]' required  class='form-control' value='" + lname + "'>";
            markup += "</td>";

            markup += "<td>";
            //markup +="<input type='textbox' name='country[]' required  class='form-control' value='" + country + "'>";
            markup += "<select name='country[]' required  class='form-control'>";
            <?php
            $country_rows = $this->country_model->get_selected_rows(array('id', 'country_name'), 'country_name', 'ASC');
            if ($country_rows) {
                $country_arr[''] = 'Country';
                foreach ($country_rows->result() as $row) {
                    echo 'markup +="<option value=\'' . $row->id . '\'>' . $row->country_name . '</option>";';
                }
            }
            ?>

            markup += "</select>";
            markup += "</td>";

            markup += "<td>";
            markup += "<input type='email' name='email[]' required  class='form-control email_variable'  value='" + email + "'>";
            markup += "</td>";

            markup += "</tr>";


            //var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='textbox' name='name[]' value='" + name + "'></td><td><input type='textbox' name='email[]' value='" + email + "'></td></tr>";
            //var markup = "<tr><td><input type='checkbox' name='record'></td><td><input type='textbox' name='name[]' value='" + name + "'></td><td><input type='textbox' name='email[]' value='" + email + "'></td></tr>";
            $(".add-row").prop('disabled', true);
            $("#email_validation_msg").html('');

            var add_flag = true;
            $('.email_variable').each(function(i, obj) {
                if (email.toLowerCase().trim() == $(obj).val().toLowerCase().trim()) {
                    add_flag = false;
                    return false;
                }
            });


            if (add_flag) {
                $.ajax({
                    url: '<?php echo site_url('student/check_email'); ?>',
                    method: 'POST',
                    data: {
                        email_var: email,
                        my_csrf_token: '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    dataType: 'json',
                    success: function(data) {
                        $(".add-row").prop('disabled', false);

                        if (data.status == 1) {

                            country_index = $("select#country").prop('selectedIndex');

                            $("#fname").val("");
                            $("#lname").val("");
                            $('select#country option:first-child').attr("selected", "selected");
                            $("#email").val("");

                            //document.getElementById("country").selectedIndex = "2";
                            $("table tbody").append(markup);
                            $('table tbody tr:last').find('select').prop('selectedIndex', country_index);


                        } else {
                            $("#email_validation_msg").html(data.status);
                        }
                    }
                });
            } else {
                $(".add-row").prop('disabled', false);
            }


        });

        // Find and remove selected table rows
        $(".delete-row").click(function() {
            $("table tbody").find('input[name="record"]').each(function() {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });

        //invoice
        $(document).on('change', '#userfile_invoice', function() {
            var name = document.getElementById("userfile_invoice").files[0].name;

            var form_data = new FormData();

            var other_data = $('#formInvoice').serializeArray();
            $.each(other_data, function(key, input) {
                form_data.append(input.name, input.value);
            });

            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['pdf']) == -1) {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("userfile_invoice").files[0]);
            var f = document.getElementById("userfile_invoice").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 3000000) {
                alert("Image File Size is very big");
            } else {
                form_data.append("userfile", document.getElementById('userfile_invoice').files[0]);
                $.ajax({
                    url: "<?php echo site_url('student/upload_invoice/' . $this->uri->segment(3)) ?>",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#uploading_status').html("<p class='text-success'>Uploading...</p>");
                    },
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.status == "success") {
                            //console.log(data);
                            window.location.replace(data.redirect_uri);
                            $('#uploading_status').html(null);
                        } else {
                            $('#uploading_status').html(data);
                        }

                    }
                });
            }
        });

        //receipt
        $(document).on('change', '#userfile_receipt', function() {
            var name = document.getElementById("userfile_receipt").files[0].name;

            var form_data = new FormData();

            var other_data = $('#formReceipt').serializeArray();
            $.each(other_data, function(key, input) {
                form_data.append(input.name, input.value);
            });

            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['pdf']) == -1) {
                alert("Invalid Image File");
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("userfile_receipt").files[0]);
            var f = document.getElementById("userfile_receipt").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 3000000) {
                alert("Image File Size is very big");
            } else {
                form_data.append("userfile", document.getElementById('userfile_receipt').files[0]);
                $.ajax({
                    url: "<?php echo site_url('student/upload_receipt/' . $this->uri->segment(3)) ?>",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#uploading_status').html("<p class='text-success'>Uploading...</p>");
                    },
                    success: function(response) {
                        var data = JSON.parse(response);

                        if (data.status == "success") {
                            //console.log(data);
                            window.location.replace(data.redirect_uri);
                            $('#uploading_status').html(null);
                        } else {
                            $('#uploading_status').html(data);
                        }

                    }
                });
            }
        });

        //file
        $("#upload_invoice_link").on('click', function(e) {
            e.preventDefault();
            $("#userfile_invoice:hidden").trigger('click');
        });

        $("#upload_receipt_link").on('click', function(e) {
            e.preventDefault();
            $("#userfile_receipt:hidden").trigger('click');
        });

        (function($) {



            // Delete gallery box
            $('.del_gallery_box').on('click', function() {
                /// $('.input_wrapper').remove();
                alert('hello');
            });
            // Delete gallery thumbnail
            $('.img_gallery_delete').on('click', function(event) {
                event.preventDefault();
                var gmid = $(this).attr('data-id');
                var csrf = $("input[name=my_csrf_token]").val();
                var url = '<?= base_url('post/delete_post_gallery') ?>' + '/' + gmid;
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        my_csrf_token: csrf
                    },
                    success: function(data) {
                        $('.box' + gmid).remove();
                    },
                    error: function() {
                        alert('Error');
                    }
                });
            });




        }(jQuery));
    </script>

</body>

</html>