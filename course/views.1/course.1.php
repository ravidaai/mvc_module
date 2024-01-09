

<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                
            </div>



<div class="form-row">
    <div class="col-md-12" style="margin-top: 19px;">
    <a href="<?php echo site_url('course/add_module/'); ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add Module</a>

    </div>
  </div>

            <div class="panel-body">
                <div class="clearfix"></div>

                    <?php
                        if ($queryModule) {
                            foreach ($queryModule->result() as $rowModule) {
                     ?>
                                <div class="row" style="padding:10px 0;">
                                    <div class="col-lg-12">
                                       <?php echo "<span style=\"font-size:20px; font-weight:bold;\">".$rowModule->module_name."</span>"; ?>
                                       <a href="<?php echo site_url('course/add_module/'.$rowModule->id); ?>" class="" style="padding:5px; font-size:15px;"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?php echo site_url('course/delete_module/'.$rowModule->id);?>" class="" style="padding:5px;  font-size:15px;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <a href="<?php echo site_url('course/add_modules/'.$rowModule->id.'/video'); ?>" class="btn btn-primary" style="padding:2px 5px 0px 5px;">Add video Lesson</a>
                        <a href="<?php echo site_url('course/add_modules/'.$rowModule->id.'/slide'); ?>" class="btn btn-primary" style="padding:2px 5px 0px 5px;">Add Slide Show</a>
                        <a href="<?php echo site_url('course/add_modules/'.$rowModule->id).'/quiz'; ?>" class="btn btn-primary" style="padding:2px 5px 0px 5px;">Add Quiz</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th>Lesson</th>
                                    <th>Lesson Name</th>
                                    <th>Lesson Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

<?php
$lesson= 1;
$queryVideoModule= $this->module_video_model->get_selected_query_where(array('module_id'=>$rowModule->id), '*', 'ASC', '_order');
$querySlideModule= $this->module_slide_model->get_selected_query_where(array('module_id'=>$rowModule->id), '*', 'ASC', '_order');
$queryQuizModule= $this->module_quiz_model->get_selected_query_where(array('module_id'=>$rowModule->id), '*', 'ASC', '_order');
?>

                                <?php
                                    $lesson= 1;
                                    $queryVideoModule= $this->module_video_model->get_selected_query_where(array('module_id'=>$rowModule->id), '*', 'ASC', '_order');
                                    if($queryVideoModule){
                                        
                                        foreach($queryVideoModule->result() as $rowVideo){
                                            ?>
                                            <tr>
                                            <td>Lesson <?php echo $lesson; ?></td>
                                                <td><?php echo $rowVideo->title; ?></td>
                                                <td>Video</td>
                                                <td>
                                                    <a href="<?php echo site_url('course/add_modules/'.$rowModule->id.'/video/'.$rowVideo->id); ?>" class="btn btn-info" style="padding:2px 5px 0px 5px;"><i class="fa fa-pencil-square-o"></i></a>
                                                    <a href="<?php echo site_url('course/delete_modules/'.$rowModule->id.'/video/'.$rowVideo->id);?>" class="btn btn-danger" style="padding:2px 5px 0px 5px;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                <?php
                                            $lesson++;
                                        }
                                    }
                                ?>

            <?php
                $querySlideModule= $this->module_slide_model->get_selected_query_where(array('module_id'=>$rowModule->id), '*', 'ASC', '_order');
                if($querySlideModule){
                    foreach($querySlideModule->result() as $rowSlide){
                        ?>
                        <tr>
                        <td>Lesson <?php echo $lesson; ?></td>
                            <td><?php echo $rowSlide->title; ?></td>
                            <td>Slide</td>
                            <td>
                                <a href="<?php echo site_url('course/add_modules/'.$rowModule->id.'/slide/'.$rowSlide->id); ?>" class="btn btn-info" style="padding:2px 5px 0px 5px;"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?php echo site_url('course/delete_modules/'.$rowModule->id.'/slide/'.$rowSlide->id);?>" class="btn btn-danger" style="padding:2px 5px 0px 5px;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
            <?php
                $lesson++;
                    }
                }
            ?>

<?php
                $queryQuizModule= $this->module_quiz_model->get_selected_query_where(array('module_id'=>$rowModule->id), '*', 'ASC', '_order');
                if($queryQuizModule){
                    foreach($queryQuizModule->result() as $rowQuiz){
                        ?>
                        <tr>
                        <td>Lesson <?php echo $lesson; ?></td>
                            <td><?php echo $rowQuiz->title; ?></td>
                            <td>Quiz</td>
                            <td>
                                <a href="<?php echo site_url('course/add_modules/'.$rowModule->id.'/quiz/'.$rowQuiz->id); ?>" class="btn btn-info" style="padding:2px 5px 0px 5px;"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?php echo site_url('course/delete_modules/'.$rowModule->id.'/quiz/'.$rowQuiz->id);?>" class="btn btn-danger" style="padding:2px 5px 0px 5px;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
            <?php
                $lesson++;
                    }
                }
            ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                    <?php

                            }
                        }
                    ?>

            </div>


        </div>

    </div>
</div>