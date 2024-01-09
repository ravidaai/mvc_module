<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <?php
                $groupQuery = $this->members_model->fromId($this->uri->segment(3));
                ?>
                <h3 class="panel-title"><?php echo $groupQuery->institution . ' ' . $page_header ?></h3>

                <ul>
                  
                        <li><a href="<?php echo site_url('student/group_roster'); ?>"
                               class="btn btn-success pull-right"
                               role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                    </ul>

            </div>


            <?php echo form_open(site_url('student/customMail'), "class=\"\" autocomplete=\"off\"") ?>
            <div class="form-row">
                <div class="col-md-12" style="margin-top: 19px;">
                    <a href="<?php echo site_url('student/add_session/' . $this->uri->segment(3)); ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add session</a>

                    <!-- <button type="submit" name="action_mail" value="mail" class="btn btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Send Email</button> -->
                    <!-- <a href="<?php
                                    ?>" class="btn btn-primary">Download</a> -->
                    <input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
                </div>
            </div>

            <div class="panel-body">
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                <div class="table-responsive">

                    <table class="table table-bordered" id="example">
                        <thead>
                            <tr>

                                <th width="20%">Session Name</th>
                                <th width="20%">Start Date</th>
                                <th width="20%">End Date</th>
                                <th width="20%">Enrollment</th>
                                <th width="20%">Billing</th>
                                <th width="20%">Student Access</th>
                                <th width="2%">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row) : ?>
                                    <?php
                                    //$country = $this->country_model->fromId($row->country);
                                    $enrollment = $this->members_model->getWhereTotal(array('group_id' => $row->id));
                                    ?>
                                    <?php $class = (1 % $i) ? 'odd' : 'even'; ?>
                                    <td><a href="<?php echo site_url('student/session_roster/' . $row->id); ?>"><?php echo $row->session_name; ?></a></td>
                                    <td><?php echo custom_date_format($row->start_date); ?></td>
                                    <td><?php echo custom_date_format($row->end_date); ?></td>
                                    <td><?php echo $enrollment; ?></td>
                                    <td><a href="<?php echo site_url('student/billing/' . $row->id); ?>">View</a></td>
                                    <td class="text-center">
                                        <?php
                                        if ($row->group_status) {
                                            echo "<a href=\"" . site_url("members/block_group_roster_student/" . $row->id) . "\"><strong>Active</strong></a>";
                                        }

                                        if (!$row->group_status) {
                                            echo "<a href=\"" . site_url("members/active_group_roster_student/" . $row->id) . "\" style=\"color:red;\"><strong>Block</strong></a>";
                                        }

                                        ?>
                                    </td>

                                    <td class="centtext-centerer">
                                        <a href="<?php echo site_url('student/add_session/' . $row->group_id . '/' . $row->id); ?>" class="btn btn-info" style="padding:2px 5px 0px 5px; float:left;"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?php echo site_url('student/delete_roster_session/' . $row->group_id . '/' . $row->id); ?>" class="btn btn-danger" style="padding:2px 5px 0px 5px; float:right;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
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

                    <?php echo $links; ?>

                </div>
            </div>
            </form>

        </div>

    </div>
</div>