<div class="container" style="background: #eee; padding: 50px 0; margin-bottom: 50px;">
    <div class="row">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <h2 style="color: #9a9898;font-size: 25px;">Intro toFrench Language And Culture </h2>
        </div>
        <div class="col-lg-1">
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <?php $module = $this->module_model->fromId(intval($this->uri->segment(3))); ?>
            <h3 class="oswald"><?php echo $module->module_name; ?></h3>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">

            <?php if ($quiz_query) : ?>
                <h2 class="oswald"><?php echo $unit_string . " : " . $quiz_query->title; ?></h2>
                <p><?php echo $quiz_query->description; ?></p>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>
            <div class="row">

                <?php
                $question_query = $this->quiz_question_model->get_selected_where(array('module_quiz_id' => intval($this->uri->segment(4))));
                if (isset($queryReviewQuiz)) {
                    $question_array = unserialize($queryReviewQuiz->ques_ans);
                    //print_pre($question_array);
                }
                ?>

                <?php if ($question_query) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($question_query->result() as $question_row) : ?>
                        <div class="col-lg-12">
                            <div class="quiz_section">
                                <h3><?php echo $i; ?>. <?php echo $question_row->question; ?></h3>
                                <?php
                                $option_a_error = NULL;
                                $option_b_error = NULL;
                                $option_c_error = NULL;
                                $option_d_error = NULL;
                                $correct_answer_given = NULL;

                                $given_answer = $question_array[$question_row->id][0];

                                if (strcasecmp(trim($given_answer), trim($question_row->correct_ans)) == 0) {
                                   $correct_answer_given = $question_row->correct_ans;
                                }

                                if ($given_answer == "option_a" && strcasecmp(trim($correct_answer_given), trim("option_a")) != 0) {
                                    $option_a_error = "option_error";
                                }

                                if ($given_answer == "option_b" && strcasecmp(trim($correct_answer_given), trim("option_b")) != 0) {
                                    $option_b_error = "option_error";
                                }

                                if ($given_answer == "option_c" && strcasecmp(trim($correct_answer_given), trim("option_c")) != 0) {
                                    $option_c_error = "option_error";
                                }

                                if ($given_answer == "option_d" && strcasecmp(trim($correct_answer_given), trim("option_d")) != 0) {
                                    $option_d_error = "option_error";
                                }

                                ?>

                                <ul class="ans_review">
                                    <li data-option="option_a" class="<?php echo ($question_row->correct_ans == "option_a") ? " correct " : NULL; ?> <?php echo $option_a_error; ?>">A. <?php echo $question_row->option_a; ?></li>
                                    <li data-option="option_b" class="<?php echo ($question_row->correct_ans == "option_b") ? " correct " : NULL; ?> <?php echo $option_b_error; ?>">B. <?php echo $question_row->option_b; ?></li>
                                    <li data-option="option_c" class="<?php echo ($question_row->correct_ans == "option_c") ? " correct " : NULL; ?> <?php echo $option_c_error; ?>">C. <?php echo $question_row->option_c; ?></li>
                                    <li data-option="option_d" class="<?php echo ($question_row->correct_ans == "option_d") ? " correct " : NULL; ?> <?php echo $option_d_error; ?>">D. <?php echo $question_row->option_d; ?></li>
                                    <input type="hidden" id="chosen_ans" name="question_ans[<?php echo $question_row->id ?>][]" value="">
                                </ul>
                                <p>
                                    <strong>Correct Answer:</strong> <?php echo $question_row->explanation ?>
                                </p>

                            </div>
                        </div>
                     
                        <?php $i++; ?>
                    <?php endforeach; ?>



                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="<?php echo site_url('dashboard/course_home') ?>" class="btn btn-color btn-sm" style="width:150px"> Course Home </a>
                </div>
            </div>


            <?php echo form_close(); ?>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
</div>