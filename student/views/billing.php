<?php
                    $group_model = $this->members_model->fromId($this->uri->segment(3));
                    $institution_model = $this->members_model->fromId($group_model->group_id);
                    $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(3)));
                ?>

<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">

            <h3 class="panel-title"><?php echo $page_header ?></h3>
                <ul>
                    <li><a href="<?php echo site_url('student/group_roster'); ?>" class="btn btn-primary" role="button" style="float:right;"><i
                                class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a></li>
                    </ul>


                

            </div>


            <input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
            
            <div class="panel-body">
                <div class="clearfix"></div>


                <div class="row">
                    <div class="col-md-4">
                        

                        <h1 class="caption001"><?php echo $institution_model->institution; ?> | <?php echo $group_model->session_name; ?></h1>
                        <p style="font-size: 14px;">
                           
                            <strong>Start Date:</strong> <?php echo custom_date_format($group_model->start_date); ?><br>
                            <strong>End Date:</strong> <?php echo custom_date_format($group_model->end_date); ?><br>
                        </p>

                        <p style="font-size: 14px;">
                            <strong>Enrollment:</strong> <?php echo $enrollment; ?><br>
                            <strong>Per student rate:</strong> $ <?php echo $group_model->per_student_rate; ?><br>
                            <strong>Total payment due:</strong>
                            $<?php echo $group_model->per_student_rate * $enrollment; ?><br>
                            <strong>Payment due
                                date:</strong> <?php echo custom_date_format($group_model->payment_due_date); ?><br>
                        </p>

                        <div class="payment_status">
                            <h1 class="caption001">Payment Status</h1>
                            <p style="font-size: 14px;">
                                <?php
                                if ($group_model->payment_status) {
                                    echo "Paid in full. No further action is required.";
                                } else {
                                    echo "Your payment has not been received.";
                                }
                                ?>

                            </p>

                            <a href="<?php echo site_url("student/payment_paid_status/" . $group_model->id); ?>" class="btn btn-success" style="background-color: #2eaa64; border: none;width:66px;">Paid</a>
                            <a href="<?php echo site_url("student/payment_unpaid_status/" . $group_model->id); ?>" class="btn btn-danger">Unpaid</a>

                        </div>


                    </div>


                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_open_multipart(site_url("student/upload_invoice/" . $group_model->id), "name =\"formInvoice\" id =\"formInvoice\" class=\"\" autocomplete=\"off\"") ?>




                                <div class="pdf_icon">
                                    <?php if (@file_exists('./assets/uploads/' . $group_model->invoice) && !empty($group_model->invoice)): ?>
                                        <img src="<?php echo site_url('assets/img/pdf.png') ?>"/>
                                    <?php endif ?>
                                </div>

                                <div class="pdf_right_content">
                                <p><strong>INVOICE</strong></p>
                                    <p><a href="#" id="upload_invoice_link"><i class="fa fa-upload" aria-hidden="true"></i> Upload Invoice</a></p>
                                    
                                    <input type="file" name="userfile_invoice" id="userfile_invoice" size="50" style="display: none;"/>
                                    <?php
                                    if (@file_exists('./assets/uploads/' . $group_model->invoice) && !empty($group_model->invoice)) {
                                        echo "<p><a href='" . site_url('./assets/uploads/' . $group_model->invoice) . "' target='_blank'><i class=\"fa fa-search\" aria-hidden=\"true\"></i> View Invoice</a></p>";
                                        echo "<p><a href='" . site_url("student/delete_invoice/" . $group_model->id) . "'  onclick='return ask(\"Do you want to delete?\");'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete Invoice</a></p>";
                                    }else{
                                        echo "<p><i class=\"fa fa-search\" aria-hidden=\"true\"></i> View Invoice</p>";
                                        echo "<p><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete Invoice</p>";
                                    }
                                    ?>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-12">
                                <?php echo form_open_multipart(site_url("student/upload_receipt/" . $group_model->id), "name =\"formReceipt\" id =\"formReceipt\" class=\"\" autocomplete=\"off\"") ?>
                                <div class="pdf_icon">
                                    <?php if (@file_exists('./assets/uploads/' . $group_model->receipt) && !empty($group_model->receipt)): ?>
                                        <img src="<?php echo site_url('assets/img/pdf.png') ?>"/>
                                    <?php endif ?>
                                </div>
                                <div class="pdf_right_content">
                                <p><strong>RECEIPT</strong></p>
                                <p><a href="#" id="upload_receipt_link"><i class="fa fa-upload" aria-hidden="true"></i> Upload Receipt</a></p>
                                    <input type="file" name="userfile_receipt" id="userfile_receipt" class="form-control input-md" size="50" style="display: none;"/>
                                    <?php
                                    if (@file_exists('./assets/uploads/' . $group_model->receipt) && !empty($group_model->receipt)) {
                                        echo "<p><a href='" . site_url('./assets/uploads/' . $group_model->receipt) . "' target='_blank'><i class=\"fa fa-search\" aria-hidden=\"true\"></i> View Receipt</a></p>";
                                        echo "<p><a href='" . site_url("student/delete_receipt/" . $group_model->id) . "'  onclick='return ask(\"Do you want to delete?\");'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete Receipt</a></p>";
                                    }else{
                                        echo "<p><i class=\"fa fa-search\" aria-hidden=\"true\"></i> View Receipt</p>";
                                        echo "<p><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete Receipt</p>";
                                    }
                                    ?>

                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div id="uploading_status"></div>
                    </div>
                </div>


                <div class="clearfix"></div>

            </div>


        </div>

    </div>
</div>


