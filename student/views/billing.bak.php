<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                
            </div>



<input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
<div class="form-row">
    <div class="col-md-12" style="margin-top: 19px;">
    
    <a href="<?php echo site_url('student/group_roster'); ?>" class="btn btn-primary" role="button"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a>
      
     
    </div>
  </div>

            <div class="panel-body">
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-4">
                        <?php
                            $group_model = $this->members_model->fromId($this->uri->segment(3));
                            $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(3)));
                            //print_r($group_model);
                        ?>

                        <p>
                        <strong>Student groups</strong><br>
                        Institution: <?php echo $group_model->institution; ?> <br>
                        Session: <?php echo $group_model->session_name; ?><br>
                        Start Date: <?php echo $group_model->start_date; ?><br>
                        End Date: <?php echo $group_model->end_date; ?><br>
                        </p>
                    </div>

                    <div class="col-md-4">
                    <p>
                        Enrollment: <?php echo $enrollment; ?><br>
                        Per student rate: $ <?php echo $group_model->per_student_rate; ?><br>
                        Total payment due: $<?php echo $group_model->per_student_rate*$enrollment; ?><br>
                        Payment due date: <?php echo custom_date_format($group_model->payment_due_date); ?><br>
                        </p>

                    </div>

                    <div class="col-md-4">
                    <a href="<?php echo site_url("student/payment_status/".$group_model->id); ?>">
                    <?php echo ($group_model->payment_status)?"Mark as Unpaid":"Mark as paid"; ?></a>. Click on “<?php echo ($group_model->payment_status)?"Mark as Unpaid":"Mark as paid"; ?>” to change it to <?php echo ($group_model->payment_status)?"Mark as paid":"Mark as unpaid"; ?>. 
                    <br>
                    <?php
                    if($group_model->payment_status){
                        echo "Paid in full";
                    }else{
                        echo "Payment is due by ".custom_date_format($group_model->payment_due_date);
                    }
                    ?>
                    <br>

                    <?php echo form_open_multipart(site_url("student/upload_invoice/".$group_model->id), "name =\"formInvoice\" id =\"formInvoice\" class=\"\" autocomplete=\"off\"") ?>
                    <?php
                    if(@file_exists('./assets/uploads/'.$group_model->invoice) && !empty($group_model->invoice)){
                        echo "<a href='".site_url('./assets/uploads/'.$group_model->invoice)."' target='_blank'>Open PDF</a>";
                        echo "<a href='".site_url("student/delete_invoice/".$group_model->id)."'  onclick='return ask(\"Do you want to delete?\");'>Delete PDF</a>";
                    }
                    ?>
                        <input type="file" name="userfile_invoice" class="form-control input-md" id="userfile_invoice" size="50" />
                        <?php //echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Upload Invoice")); ?>
                        <?php echo form_close(); ?>
                    <br>

                    <?php echo form_open_multipart(site_url("student/upload_receipt/".$group_model->id), "name =\"formReceipt\" id =\"formReceipt\" class=\"\" autocomplete=\"off\"") ?>
                    <?php
                    if(@file_exists('./assets/uploads/'.$group_model->receipt) && !empty($group_model->receipt)){
                        echo "<a href='".site_url('./assets/uploads/'.$group_model->receipt)."' target='_blank'>Open PDF</a>";
                        echo "<a href='".site_url("student/delete_receipt/".$group_model->id)."'  onclick='return ask(\"Do you want to delete?\");'>Delete PDF</a>";
                    }
                    ?>
                        <input type="file" name="userfile" class="form-control input-md" id="userfile" size="50" />
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Upload Receipt")); ?>
                        <?php echo form_close(); ?>


                        <?php echo form_open('', "name = \"uploadForm\" id = \"uploadForm\" class=\"\" autocomplete=\"off\"") ?>
                        <label>Select Image</label>
                        <input type="file" name="upload_file" id="upload_file"/>
                        <br />

                        <span id="uploaded_image"></span>
                        <?php echo form_close(); ?>


                   
                    </div>
                </div>

               
                <div class="clearfix"></div>
                
            </div>
           

        </div>

    </div>
</div>


