<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">User Stats</h3>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <p class="dashboard001"><?php echo $this->setting_model->get('course_title') ?></p>
                        <div class="table-responsive">
                            <table class="table">

                                <tbody>
                                    <tr>
                                        <td>Credit Card Students</td>
                                        <td>
                                            <?php
                $cnt = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'student', 'end_date>'=>date('Y-m-d'),'stripe_receipt_url!='=>''));
                echo $cnt;
                ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Credit Card Alumni</td>
                                        <td>
                                            <?php
                $cnt = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'student', 'end_date<'=>date('Y-m-d')));
                echo $cnt;
                ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Guests</td>
                                        <td>
                                            <?php
            $cnt = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'guest'));
            echo $cnt;
            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Groups</td>
                                        <td>
                                            <?php
            $cnt = $this->members_model->getWhereTotal(array('capability'=>'member', 'member_type'=>'group'));
            echo $cnt;
            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
                                            <div class="form-group row">
                                                <?php echo form_input('email', set_value('email', isset($result->email)?$result->email:''), "class=\"form-control\" placeholder=\"Search Student\""); ?>
                                                <?php echo form_error('email') ?>
                                            </div>
                                            <?php //echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Search &rarr;")) ?>
                                            <?php echo form_close(); ?>



                                            <!-- result start -->
                                            <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST"):
    if($roster){
      ?>

                                            <?php
    //$this->members_model->getWhereTotal(array('capability' => 'member', 'member_type' => 'student', 'end_date<' => date('Y-m-d')));
    if($roster[0]->end_date < date('Y-m-d') && strcasecmp($roster[0]->member_type,'guest')!=0){
    //echo '<a href="'.site_url('student/alumni').'">Go to roster [Almuni]</a> | <a href="'.site_url('student/add/'.$roster[0]->id).'">Edit</a>';
    echo '<a href="'.site_url('student/alumni').'">User location: Almuni</a>';
    }

    if(strcasecmp($roster[0]->member_type,'student')==0 && $roster[0]->end_date > date('Y-m-d')){
    //echo '<a href="'.site_url('student/roster').'">Go to roster [Student]</a> | <a href="'.site_url('student/add/'.$roster[0]->id).'">Edit</a>';
        if(!empty($roster[0]->group_id) && intval($roster[0]->group_id)>=1){
            //$groupQ = $this->members_model->fromId($roster[0]->group_id);

            $group_model = $this->members_model->fromId($roster[0]->group_id);
            $institution_model = $this->members_model->fromId($group_model->group_id);

            echo '<a href="'.site_url('student/session_roster/'.$roster[0]->group_id).'">User location: Group Roster</a> | '.$institution_model->institution.' | '.$group_model->session_name;
        }else{
            echo '<a href="'.site_url('student/roster').'">User location: Student</a>';
        }
    }

    if(strcasecmp($roster[0]->member_type,'group')==0){
    //echo '<a href="'.site_url('student/group_roster').'">Go to roster [Group]</a> | <a href="'.site_url('student/add_group/'.$roster[0]->id).'">Edit</a>';
    echo '<a href="'.site_url('student/group_roster').'">User location: Group</a>';
    }

    if(strcasecmp($roster[0]->member_type,'guest')==0){
    //echo '<a href="'.site_url('student/guest_roster').'">Go to roster [Guest]</a> | <a href="'.site_url('student/add/'.$roster[0]->id).'">Edit</a>';
    echo '<a href="'.site_url('student/guest_roster').'">User location: Guest</a>';
    }

?>

    <?php
    }else{
        echo "<span style=\"color:red;\">User does not exist</span>";
    }
    endif;
     
    ?>
                                            <!-- result end -->

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">

    </div>
</div>