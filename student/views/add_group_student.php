<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                <ul>

                    <li><a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-success pull-right"
                            role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <?php
                    // $group_model = $this->members_model->fromId($this->uri->segment(3));
                    // $institution_model = $this->members_model->fromId($group_model->group_id);
                    // $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(3)));
                ?>

                <?php
                    $group_model = $this->members_model->fromId($this->uri->segment(3));
                    $institution_model = $this->members_model->fromId($group_model->group_id);
                    $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(3)));
                ?>

                <p style="font-size: 14px;padding: 12px;">

                    <span style="font-size:18px; font-weight:600;"><strong>Institution:</strong> <?php echo $institution_model->institution; ?></span> <br>
                    <span style="font-size:18px; font-weight:600;"><strong>Session:</strong> <?php echo $group_model->session_name; ?></span><br>
                    <strong>Start Date:</strong> <?php echo custom_date_format($group_model->start_date); ?><br>
                    <strong>End Date:</strong> <?php echo custom_date_format($group_model->end_date); ?><br>
                    <strong>Enrollment:</strong> <?php echo $enrollment; ?>
                </p>
                <div class="clearfix"></div>


                <div class="form-group row">
                    <div class="col-md-12">
                        <h1 style="font-size: 20px;border-bottom: solid 1px #dcdcdc; padding-bottom: 10px;">Enter
                            Student Details </h1>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="fname" placeholder="First Name" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="lname" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <select name='country' id="country" class='form-control'>
                            <?php
        $country_rows = $this->country_model->get_selected_rows( array('id','country_name'), 'country_name', 'ASC');
        if($country_rows)
        {
            foreach($country_rows->result() as $row){
                echo '<option value="'.$row->id.'">'.$row->country_name.'</option>';

            }

        }
        ?>
                        </select>
                        <!--    <input type="text" id="country" placeholder="Country"  class="form-control">-->
                    </div>
                    <div class="col-sm-3">
                        <input type="email" id="email" placeholder="Email Address" class="form-control">
                        <span id="email_validation_msg" style="color:red;"></span>
                    </div>
                    <div class="col-sm-2">
                        <input type="button" class="add-row btn btn-info " value="+Add ">
                    </div>
                </div>




               

            </div>
        </div>

        <div class="panel panel-warning">
        <div class="panel panel-body">
        <div class="row">
                    <div class="col-md-12">
                        <h1 style="font-size: 20px;border-bottom: solid 1px #dcdcdc; padding-bottom: 10px;">Students
                            Added</h1>
                    </div>
                </div>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" width="5%">Select</th>
                            <th scope="col" width="25%">First name</th>
                            <th scope="col" width="25%">Last name</th>
                            <th scope="col" width="15%">Country</th>
                            <th scope="col" width="15%">Email</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="panel-footer">
                    <?php echo form_button(array("type" => "button", "class" => "btn btn-info delete-row delete-btn001", "content" => "Delete Student ")); ?>
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Save &rarr;")); ?>


                </div>
        </div>
        </div>

    </div>


</div>

<?php echo form_close(); ?>