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
                $chosen_ans = [];
                if ($this->input->get('_a')) {
                    $_a_decode =  urldecode($this->input->get('_a'));
                    $chosen_ans = unserialize($_a_decode);
                    //print_pre($chosen_ans);
                }
                ?>
                <?php
                //get_selected_query_where(array('module_quiz_id' => $this->uri->segment(5)), '*', 'ASC', '_order');
                $question_query = $this->quiz_question_model->get_selected_query_where(array('module_quiz_id' => intval($this->uri->segment(4))), '*', 'ASC', '_order');
                ?>

                <?php if ($question_query) : ?>
                    <?php
                    $i = 1;
                    $active_a = NULL;
                    $active_b = NULL;
                    $active_c = NULL;
                    $active_d = NULL;
                    ?>
                    <?php foreach ($question_query->result() as $question_row) : ?>
                        <?php

                        if (count($chosen_ans) >= 1) {
                            $active_a = (strcasecmp($chosen_ans[$question_row->id][0], 'option_a') == 0) ? 'active' : NULL;
                            $active_b = (strcasecmp($chosen_ans[$question_row->id][0], 'option_b') == 0) ? 'active' : NULL;
                            $active_c = (strcasecmp($chosen_ans[$question_row->id][0], 'option_c') == 0) ? 'active' : NULL;
                            $active_d = (strcasecmp($chosen_ans[$question_row->id][0], 'option_d') == 0) ? 'active' : NULL;
                        }
                        ?>
                        <div class="col-lg-12">
                            <div class="quiz_section">
                                <h3><?php echo $i; ?>. <?php echo $question_row->question; ?></h3>
                                <ul class="ans">
                                    <li data-option="option_a" class="<?php echo $active_a; ?>">A. <?php echo $question_row->option_a; ?></li>
                                    <li data-option="option_b" class="<?php echo $active_b; ?>">B. <?php echo $question_row->option_b; ?></li>
                                    <li data-option="option_c" class="<?php echo $active_c; ?>">C. <?php echo $question_row->option_c; ?></li>
                                    <li data-option="option_d" class="<?php echo $active_d; ?>">D. <?php echo $question_row->option_d; ?></li>
                                    <?php if (count($chosen_ans) <= 0) : ?>
                                        <input type="hidden" id="chosen_ans" name="question_ans[<?php echo $question_row->id ?>][]" value="">
                                    <?php else : ?>
                                        <input type="hidden" id="chosen_ans" name="question_ans[<?php echo $question_row->id ?>][]" value="<?php echo $chosen_ans[$question_row->id][0]; ?>">
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>



                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-color btn-sm"> SUBMIT </button>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">Exit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to exit this quiz?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <a href="<?php echo site_url('dashboard/course_home') ?>" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>