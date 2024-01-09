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
                                <?php echo "<span style=\"font-size:20px; font-weight:bold;\">" . $rowModule->module_name . "</span>"; ?>
                                <a href="<?php echo site_url('course/add_module/' . $rowModule->id); ?>" class="" style="padding:5px; font-size:15px;"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="<?php echo site_url('course/delete_module/' . $rowModule->id); ?>" class="" style="padding:5px;  font-size:15px;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="<?php echo site_url('course/add_modules/' . $rowModule->id . '/video'); ?>" class="btn btn-primary" style="padding:2px 5px 0px 5px;">Add video Lesson</a>
                                <a href="<?php echo site_url('course/add_modules/' . $rowModule->id . '/slide'); ?>" class="btn btn-primary" style="padding:2px 5px 0px 5px;">Add Slide Show</a>
                                <a href="<?php echo site_url('course/add_modules/' . $rowModule->id) . '/quiz'; ?>" class="btn btn-primary" style="padding:2px 5px 0px 5px;">Add Quiz</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    
                                <table class="table table-bordered" style="margin-top: 20px;">
                                        <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Unit Name</th>
                                                <th>Unit Type</th>
                                                <th>Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $lesson = 1;
                                            $queryVideoModule = $this->module_video_model->get_selected_query_where(array('module_id' => $rowModule->id), '*', 'ASC', '_order');
                                            $querySlideModule = $this->module_slide_model->get_selected_query_where(array('module_id' => $rowModule->id), '*', 'ASC', '_order');
                                            $queryQuizModule = $this->module_quiz_model->get_selected_query_where(array('module_id' => $rowModule->id), '*', 'ASC', '_order');


                                            if ($queryVideoModule) {

                                                $video_arr = [];
                                                foreach ($queryVideoModule->result() as $rowVideo) {

                                                    $video_arr["video_" . $rowVideo->id] = $rowVideo->_order;
                                                }
                                            }

                                            $querySlideModule = $this->module_slide_model->get_selected_query_where(array('module_id' => $rowModule->id), '*', 'ASC', '_order');
                                            if ($querySlideModule) {
                                                $slide_arr = [];
                                                foreach ($querySlideModule->result() as $rowSlide) {

                                                    $slide_arr["slide_" . $rowSlide->id] = $rowSlide->_order;
                                                }
                                            }

                                            $queryQuizModule = $this->module_quiz_model->get_selected_query_where(array('module_id' => $rowModule->id), '*', 'ASC', '_order');
                                            if ($queryQuizModule) {
                                                $quiz_arr = [];
                                                foreach ($queryQuizModule->result() as $rowQuiz) {
                                                    $quiz_arr["quiz_" . $rowQuiz->id] = $rowQuiz->_order;
                                                }
                                            }

                                            $dataSets = array_merge($video_arr, $slide_arr, $quiz_arr);
                                            asort($dataSets);
                                            //print_pre($dataSets);
                                            if (count($dataSets) >= 1) {

                                                foreach ($dataSets as $key => $value) {
                                                    $str = "";
                                                    $module_arr = explode("_", $key);
                                                    $moduleType = $module_arr[0];
                                                    $moduleTypeId = $module_arr[1];

                                                    if (strcasecmp($moduleType, 'video') == 0) {
                                                        $rowVideoModule = $this->module_video_model->fromId($moduleTypeId);
                                                        echo "<tr>";
                                                        echo "<td>";
                                                        echo "Unit ".$lesson;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $rowVideoModule->title;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "Video";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo form_input('video_'.$moduleTypeId."_".$rowVideoModule->id, $rowVideoModule->_order, "class=\"col-md-1\" id=\"order_val\"");
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<a href=\"" . site_url('course/add_modules/' . $rowModule->id . '/video/' . $moduleTypeId) . "\" class=\"btn btn-info\" style=\"padding:2px 5px 0px 5px;\"><i class=\"fa fa-pencil-square-o\"></i></a>";
                                                        echo "<a href=\"" . site_url('course/delete_modules/' . $rowModule->id . '/video/' . $moduleTypeId) . "\" class=\"btn btn-danger\" style=\"padding:2px 5px 0px 5px; margin-left:5px;\" onclick=\"return ask('Do you want to delete?');\"><i class=\"fa fa-trash-o\"></i></a>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }

                                                    if (strcasecmp($moduleType, 'slide') == 0) {
                                                        $rowSlideModule = $this->module_slide_model->fromId($moduleTypeId);
                                                        echo "<tr>";
                                                        echo "<td>";
                                                        echo "Lesson ".$lesson;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $rowSlideModule->title;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "Slide";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo form_input('slide_'.$moduleTypeId."_".$rowSlideModule->id, $rowSlideModule->_order, "class=\"col-md-1\" id=\"order_val\"");;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<a href=\"" . site_url('course/add_modules/' . $rowModule->id . '/slide/' . $moduleTypeId) . "\" class=\"btn btn-info\" style=\"padding:2px 5px 0px 5px;\"><i class=\"fa fa-pencil-square-o\"></i></a>";
                                                        echo "<a href=\"" . site_url('course/delete_modules/' . $rowModule->id . '/slide/' . $moduleTypeId) . "\" class=\"btn btn-danger\" style=\"padding:2px 5px 0px 5px; margin-left:5px;\" onclick=\"return ask('Do you want to delete?');\"><i class=\"fa fa-trash-o\"></i></a>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }

                                                    if (strcasecmp($moduleType, 'quiz') == 0) {
                                                        $rowQuizModule = $this->module_quiz_model->fromId($moduleTypeId);
                                                        echo "<tr>";
                                                        echo "<td>";
                                                        echo "Lesson ".$lesson;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo $rowQuizModule->title;
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "Quiz";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo form_input('quiz_'.$moduleTypeId."_".$rowQuizModule->id, $rowQuizModule->_order, "class=\"col-md-1\" id=\"order_val\"");
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<a href=\"" . site_url('course/add_modules/' . $rowModule->id . '/quiz/' . $moduleTypeId) . "\" class=\"btn btn-info\" style=\"padding:2px 5px 0px 5px;\"><i class=\"fa fa-pencil-square-o\"></i></a>";
                                                        echo "<a href=\"" . site_url('course/delete_modules/' . $rowModule->id . '/quiz/' . $moduleTypeId) . "\" class=\"btn btn-danger\" style=\"padding:2px 5px 0px 5px; margin-left:5px;\" onclick=\"return ask('Do you want to delete?');\"><i class=\"fa fa-trash-o\"></i></a>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
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