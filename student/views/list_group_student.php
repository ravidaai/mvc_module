<?php
                    $group_model = $this->members_model->fromId($this->uri->segment(3));
                    $institution_model = $this->members_model->fromId($group_model->group_id);
                    $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(3)));
                ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $institution_model->institution; ?> | <?php echo $group_model->session_name; ?> | <?php echo $page_header ?></h3>
                <ul>
                    <li><a href="<?php echo site_url('student/session/'.$group_model->group_id); ?>"
                               class="btn btn-success pull-right"
                               role="button" ><i class="fa fa-backward"></i> Back</a></li>
                    </ul>

            </div>
            

<?php echo form_open(site_url('student/customMail'), "class=\"\" autocomplete=\"off\"") ?>
<input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
<div class="form-row">
    <div class="col-md-12" style="margin-top: 19px;">
    
    <a href="<?php echo site_url('student/add_group_student/'.$this->uri->segment(3)); ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add Group Student</a>
      <button type="submit" name="action_mail" value="mail" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Send Email</button>
      <!-- <a href="<?php //echo site_url('student/export_roster_csv/'.$export); ?>" class="btn btn-primary">Download</a> -->
      <button type="submit" name="action_invite" value="invite" class="btn btn-primary">Invite</button>
      <a class="btn btn-primary" href="<?php echo site_url('student/print_to_pdf/'.$this->uri->segment(3)); ?>" target="_blank">Print</a>
     
    </div>
  </div>

            <div class="panel-body">
                <div class="clearfix"></div>

                

                <p style="font-size: 14px;">

                <strong>Institution:</strong> <?php echo $institution_model->institution; ?> <br>
                <strong>Session:</strong> <?php echo $group_model->session_name; ?><br>
                <strong>Start Date:</strong> <?php echo custom_date_format($group_model->start_date); ?><br>
                <strong>End Date:</strong> <?php echo custom_date_format($group_model->end_date); ?><br>
                <strong>Enrollment:</strong> <?php echo $enrollment; ?>
                </p>
                <div class="clearfix"></div>
                <div class="table-responsive">

                        <table class="table table-bordered" id="example">
                            <thead>
                            <tr>
                            <th width="2%">
                            <input type="checkbox" name="check_all" id="checkAll" value="all" class="custom-control-input">
                            </th>
                                <th width="2%">SN</th>
                                <th width="2%">Logins</th>
                                <th width="9%">First Name</th>
                                <th width="9%">Last Name</th>
                               
                                <th width="10%">Country</th>
                                <th width="12%">Email</th>
                                <th width="10%">Date Added</th>
                                <th width="6%">Status</th>
                                <th width="4%">Manage Student</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row): ?>
                                <?php 
                                //$country = $this->country_model->fromId($row->country);
                                ?>
                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
                                    <td class="text-center">
                                    <input type="checkbox" name="my_check[]"  value="<?php echo $row->id; ?>" class="custom-control-input">
                                    </td>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $row->total_login; ?></td>
                                        <td><?php echo ucfirst($row->first_name); ?></td>
                                        <td><?php echo ucfirst($row->last_name) ?></td>
                                        <td>
                                            <?php
                                            $country = $this->country_model->fromId( $row->country);
                                            echo $country->country_name;
                                            ?>
                                        </td>
                                        <td><?php echo $row->email; ?></td>
                                        <td ><?php echo custom_date_format($row->created); ?></td>
                                        <td class="text-center">
                                            <?php
                                                if($row->status){
                                                    echo "<a href=\"".site_url("members/block_group_student/".$row->id."/".$this->uri->segment(3))."\"><strong>Active</strong></a>";
                                                } 

                                                if(!$row->status){
                                                    echo "<a href=\"".site_url("members/active_group_student/".$row->id."/".$this->uri->segment(3))."\" style=\"color:red;\"><strong>Block</strong></a>";
                                                }
                                                
                                            ?>
                                        </td>
                                        <td class="centtext-centerer">
                                        <a href="<?php echo site_url('student/edit_student_group/'.$row->id.'/'.$row->group_id); ?>" class="btn btn-info" style="padding:2px 5px 0px 5px; float:left;"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?php echo site_url('student/delete_group_student/'.$row->id.'/'.$this->uri->segment(3));?>" class="btn btn-danger" style="padding:2px 5px 0px 5px; float:right;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
                                    
                                        </td>

                                    </tr>
                                    <?php $i++;; ?>
                                <?php endforeach; ?>

                            <?php } else { ?>

                                <tr class="odd">

                                    <td colspan="5">No records</td>

                                </tr>

                            <?php }; ?>

                            </tbody>
                        </table>

                    <?php echo $links;?>

                </div>
            </div>
            </form>

        </div>

    </div>
</div>