<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                
            </div>


<?php echo form_open(site_url('student/customMail'), "class=\"\" autocomplete=\"off\"") ?>
<div class="form-row">
    <div class="col-md-12" style="margin-top: 19px;">
    <a href="<?php echo site_url('student/add_group/'); ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add group</a>

      <button type="submit" name="action_mail" value="mail" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Send Email</button>
      <button type="submit" name="action_invite" value="invite" class="btn btn-primary">Invite</button>
      <!-- <a href="<?php //echo site_url('student/export_roster_csv/'.$export); ?>" class="btn btn-primary">Download</a> -->
     <input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
    </div>
  </div>

            <div class="panel-body">
                <div class="clearfix"></div>
                <div class="table-responsive">

                        <table class="table table-bordered" id="example">
                            <thead>
                            <tr>
                            <th width="2%">
                            <input type="checkbox" name="check_all" id="checkAll" value="all" class="custom-control-input">
                            </th>
                                <th width="20%">Institution</th>
                                <th width="3%">Admin Logins</th>
                                <th width="20%">Group Admin</th>
                                <th width="20%">Email</th>
                                <th width="20%">Date Added</th>
                                <th width="20%">End Date</th>
                                <th width="6%">Admin Status</th>
                                <th width="2%">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row): ?>
                                <?php 
                                //$country = $this->country_model->fromId($row->country);
                                $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$row->id));
                                ?>
                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
                                    <td class="text-center">
                                    <input type="checkbox" name="my_check[]"  value="<?php echo $row->id; ?>" class="custom-control-input">
                                    </td>
                                    <td><a href="<?php echo site_url('student/session/'.$row->id); ?>"><?php echo $row->institution; ?></a></td>
                                    <td class="text-center"><?php echo $row->total_login; ?></td>
                                        <td><?php echo $row->group_name; ?></td>
                                        <td><?php echo $row->email; ?></td>
                                        <td ><?php echo custom_date_format($row->created); ?></td>
                                        <td ><?php echo custom_date_format($row->end_date); ?></td>
                                        <td class="text-center">
                                            <?php
                                                if($row->status){
                                                    echo "<a href=\"".site_url("members/block/".$row->id."/".$this->uri->segment(2))."\"><strong>Active</strong></a>";
                                                } 

                                                if(!$row->status){
                                                    echo "<a href=\"".site_url("members/active/".$row->id."/".$this->uri->segment(2))."\" style=\"color:red;\"><strong>Block</strong></a>";
                                                }
                                                
                                            ?>
                                        </td>

                                        

                                        <td class="centtext-centerer">
                                        <a href="<?php echo site_url('student/add_group/'.$row->id); ?>" class="btn btn-info" style="padding:2px 5px 0px 5px; float:left;"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?php echo site_url('student/delete_roster_group/'.$row->id);?>" class="btn btn-danger" style="padding:2px 5px 0px 5px; float:right;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
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