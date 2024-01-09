<div class="container">
    <div class="row">
    <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <h2 style="color: #9a9898;font-size: 25px;"><?php echo $this->setting_model->get('course_home_text_one'); ?></h2>
        </div>
        <div class="col-lg-1">
        </div>
    </div>


    <div class="row mt-2">
    <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <h3>Course Home</h3>
            <p><?php echo $this->setting_model->get('course_home_text_two'); ?></p>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

    <?php
    $queryModule = $this->module_model->get_all_rows('_order');
    if ($queryModule) {
        $i = 0;
        foreach ($queryModule->result() as $rowModule) :

            ?>
            <div class="row mt-2">
            <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
                    <ul class="list-unstyled list-group">
                        <li class="module-title list-group-item"><?php echo $rowModule->module_name; ?></li>

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
                                    echo "<li class=\"module-content list-group-item\">";
                                        echo "<ul class=\"row list-unstyled\">";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\">Unit ".$lesson."</li>";
                                        echo "<li class=\"col-lg-9 col-sm-6 col-xs-6\"><a href=\"".site_url('dashboard/play_video/'.$rowVideoModule->module_id."/Unit".$lesson)."\" class=\"links\" title=\"Video\">".$rowVideoModule->title."</a></li>";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\"><a href=\"".site_url('dashboard/play_video/'.$rowVideoModule->module_id."/Unit".$lesson)."\" class=\"links\" title=\"Video\"><i class=\"far fa-play-circle\"></i></a></li>";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\">".$rowVideoModule->duration."</li>";
                                        echo "</ul>";
                                    echo "</li>";

                                    
                                }

                                if (strcasecmp($moduleType, 'slide') == 0) {
                                    $rowSlideModule = $this->module_slide_model->fromId($moduleTypeId);
                                    echo "<li class=\"module-content list-group-item\">";
                                        echo "<ul class=\"row list-unstyled\">";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\">Unit ".$lesson."</li>";
                                        echo "<li class=\"col-lg-9 col-sm-6 col-xs-6\"><a href=\"#\" class=\"links\">".$rowSlideModule->title."</a></li>";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\"><a href=\"#\" class=\"links\" title=\"Slide\"><i class=\"fas fa-book-open\"></i></a></li>";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\"></li>";
                                        echo "</ul>";
                                    echo "</li>";
                                }

                                if (strcasecmp($moduleType, 'quiz') == 0) {
                                    $rowQuizModule = $this->module_quiz_model->fromId($moduleTypeId);
                                    echo "<li class=\"module-content list-group-item\">";
                                        echo "<ul class=\"row list-unstyled\">";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\">Unit ".$lesson."</li>";
                                        echo "<li class=\"col-lg-9 col-sm-6 col-xs-6\"><a href=\"#\" class=\"links\">".$rowQuizModule->title."</a></li>";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\"><a href=\"#\" class=\"links\" title=\"Quiz\"><i class=\"far fa-question-circle\"></i></a></li>";
                                        echo "<li class=\"col-lg-1 col-sm-2 col-xs-6\"></li>";
                                        echo "</ul>";
                                    echo "</li>";
                                }
                                $lesson++;
                            }
                            
                        }
                        ?>


                        <!-- <li class="module-content list-group-item">
                            <ul class="row list-unstyled">
                                <li class="col-lg-3 col-sm-2 col-xs-6">Lession 1</li>
                                <li class="col-lg-7 col-sm-6 col-xs-6"><a href="#" class="links">The French Alphabet</a></li>
                                <li class="col-lg-1 col-sm-2 col-xs-6"><a href="#" class="links"><i class="far fa-play-circle"></i></a></li>
                                <li class="col-lg-1 col-sm-2 col-xs-6">14.4</li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
                <div class="col-lg-1">
        </div>
            </div>
            <?php
            $i++;
        endforeach;
    }
    ?>






</div>