<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                <ul>

                    <li><a href="<?php echo $this->agent->referrer(); ?>" class="btn btn-success pull-right" role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <div class="clearfix"></div>

                <div class="panel-body">
                    <div class="form-group required row">
                        <label class=" control-label">Quiz Title <sup>*</sup></label>
                        <div class="">
                            <?php echo form_input('title', set_value('title', isset($result->title) ? $result->title : ''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Quiz Title\""); ?>
                            <?php echo form_error('title') ?>
                        </div>
                    </div>


                    <div class="form-group required row">
                        <label class=" control-label">Quiz Description</label>
                        <div class="">
                            <?php echo form_input('description', set_value('description', isset($result->description) ? $result->description : ''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Quiz description\""); ?>
                            <?php echo form_error('description') ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                        <label class=" control-label">Order</label>
                        <div class="">
                            <?php echo form_input('_order', set_value('_order', isset($result->_order) ? $result->_order : ''), "id=\"inputFullName\" class=\"form-control \" placeholder=\"Order\""); ?>
                            <?php echo form_error('_order') ?>
                        </div>
                    </div>





                </div>

                <div class="panel-footer">
                    <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Save &rarr;")); ?>
                    <?php //echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>

                </div>

            </div>
        </div>

    </div>





</div>

<?php echo form_close(); ?>

<?php if ($this->uri->segment(5)) : ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addQuestion">Add Choices</button>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addQuizComment">Score Comments</button>
                </div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" style="margin-top: 20px;"> 
                        <thead>
                            <tr>
                                <th>QN</th>
                                <th>Question</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php

                                $lesson = 1;
                                $queryQuestion = $this->quiz_question_model->get_selected_query_where(array('module_quiz_id' => $this->uri->segment(5)), '*', 'ASC', '_order');

                                if ($queryQuestion) {

                                    foreach ($queryQuestion->result() as $rowQuestion) {
                                        ?>
                                        <tr>
                                            <td><?php echo $lesson; ?></td>
                                            <td><?php echo $rowQuestion->question; ?></td>
                                            <td>
                                                <?php
                                            echo form_input('question_'.$rowQuestion->id, $rowQuestion->_order, "class=\"col-md-4\" id=\"quiz_order_val\"");
                                            ?>   
                                            <?php //echo $rowQuestion->_order; ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#addQuestion_<?php echo $rowQuestion->id ?>" class="btn btn-info" style="padding:2px 5px 0px 5px;"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="<?php echo site_url('course/delete_question/' . $rowQuestion->id . "?back_url=" . current_url()); ?>" class="btn btn-danger" style="padding:2px 5px 0px 5px;" onclick="return ask('Do you want to delete?');"><i class="fa fa-trash-o"></i></a>
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
        </div>
    </div>









    <!-- MODAL: Add question -->
    <div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Question</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(site_url('course/add_question/' . $this->uri->segment(3) . "/quiz/" . $this->uri->segment(5)), "autocomplete=\"off\" id=\"questionForm\" class=\"form-horizontal\" name=\"questionForm\""); ?>

                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2">Question</label>
                        <div class="col-sm-10">
                            <textarea id="page_title" name="question" class="form-control" required></textarea>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2">Options</label>
                        <label class="control-label col-md-1" for="option_a">A</label>
                        <div class="col-md-9">
                            <textarea id="option_a" name="option_a" class="form-control" required></textarea>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2"></label>
                        <label class="control-label col-md-1" for="option_b">B</label>
                        <div class="col-md-9">
                            <textarea id="option_b" name="option_b" class="form-control" required></textarea>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2"></label>
                        <label class="control-label col-md-1" for="option_c">C</label>
                        <div class="col-md-9">
                            <textarea id="option_c" name="option_c" class="form-control parsley-error" required></textarea>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2"></label>
                        <label class="control-label col-md-1" for="option_d">D</label>
                        <div class="col-md-9">
                            <textarea id="option_d" name="option_d" class="form-control" required></textarea>

                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2">Correct Answer</label>
                        <div class="col-md-10">
                            <select class="form-control" name="correct_ans">
                                <option value="option_a">A</option>
                                <option value="option_b">B</option>
                                <option value="option_c">C</option>
                                <option value="option_d">D</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2">Explanation</label>
                        <div class="col-sm-10">
                            <textarea id="explanation" name="explanation" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-2">Order</label>
                        <div class="col-md-10">
                            <input type="number" min="1" id="_order" name="_order" class="form-control" value="" required>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="submit" value="Save" name="catSub" class="btn btn-primary">
                        <input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>




    <!-- MODAL: edit question -->
    <?php


    $queryQuestion = $this->quiz_question_model->get_selected_query_where(array('module_quiz_id' => $this->uri->segment(5)), '*', 'ASC', '_order');

    if ($queryQuestion) {

        foreach ($queryQuestion->result() as $rowQuestion) {
            ?>
            <div class="modal fade" id="addQuestion_<?php echo $rowQuestion->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Question</h4>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open(site_url('course/add_question/' . $this->uri->segment(3) . "/quiz/" . $this->uri->segment(5) . "/" . $rowQuestion->id), "autocomplete=\"off\" id=\"questionForm\" class=\"form-horizontal\" name=\"questionForm\""); ?>

                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2">Question</label>
                                <div class="col-sm-10">
                                    <textarea id="question" name="question" class="form-control" required><?php echo $rowQuestion->question ?></textarea>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2">Options</label>
                                <label class="control-label col-md-1" for="option_a">A</label>
                                <div class="col-md-9">
                                    <textarea id="option_a" name="option_a" class="form-control" required><?php echo $rowQuestion->option_a ?></textarea>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2"></label>
                                <label class="control-label col-md-1" for="option_b">B</label>
                                <div class="col-md-9">
                                    <textarea id="option_b" name="option_b" class="form-control" required><?php echo $rowQuestion->option_b ?></textarea>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2"></label>
                                <label class="control-label col-md-1" for="option_c">C</label>
                                <div class="col-md-9">
                                    <textarea id="option_c" name="option_c" class="form-control" required><?php echo $rowQuestion->option_c ?></textarea>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2"></label>
                                <label class="control-label col-md-1" for="option_d">D</label>
                                <div class="col-md-9">
                                    <textarea id="option_d" name="option_d" class="form-control" required><?php echo $rowQuestion->option_d ?></textarea>

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2">Correct Answer</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="correct_ans">
                                        <option value="option_a" <?php echo ($rowQuestion->correct_ans == "option_a") ? ' selected ' : NULL; ?>>A</option>
                                        <option value="option_b" <?php echo ($rowQuestion->correct_ans == "option_b") ? ' selected ' : NULL; ?>>B</option>
                                        <option value="option_c" <?php echo ($rowQuestion->correct_ans == "option_c") ? ' selected ' : NULL; ?>>C</option>
                                        <option value="option_d" <?php echo ($rowQuestion->correct_ans == "option_d") ? ' selected ' : NULL; ?>>D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-2">Explanation</label>
                                <div class="col-sm-10">
                                    <textarea id="explanation" name="explanation" class="form-control" required><?php echo $rowQuestion->explanation ?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                        <label class="control-label col-md-2">Order</label>
                        <div class="col-md-10">
                            <input type="number" min="1" id="_order" name="_order" class="form-control" value="<?php echo $rowQuestion->_order ?>" required>
                        </div>
                    </div>
                            <div class="box-footer">
                                <input type="submit" value="Save" name="Submit" class="btn btn-primary">
                                <input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php

    }
}
?>

    <!-- MODAL: Add Quiz Comment -->
    <div class="modal fade" id="addQuizComment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quiz Comment</h4>
                </div>
                <div class="modal-body">
                    <?php echo form_open(site_url('course/quiz_comment/'.$this->uri->segment(5)), "autocomplete=\"off\" id=\"quizComment\" class=\"form-horizontal\" name=\"quizComment\""); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <strong>Score</strong>
                        </div>
                        <div class="col-lg-6">
                            <strong>Comment</strong>
                        </div>

                    </div>
<?php 
$this->quiz_comment_model->primary_key = 'quiz_id';
$quiz_comment_query = $this->quiz_comment_model->fromId($this->uri->segment(5)); 
if($quiz_comment_query){
    $scores_arr = unserialize($quiz_comment_query->scores);
    $comments_arr = unserialize($quiz_comment_query->comments);
}

?>
                    <?php for ($i = 0; $i <= 10; $i++) : ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    <input type="text" name="scores[]" class="form-control" value="<?php echo isset($scores_arr[$i])?$scores_arr[$i]:NULL; ?>">
                                </div>
                                <div class="col-lg-10">
                                    <input type="text" name="comments[]" class="form-control" value="<?php echo isset($comments_arr[$i])?$comments_arr[$i]:NULL; ?>">
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>


                    <div class="box-footer">
                        <input type="submit" value="Save" name="catSub" class="btn btn-primary">
                        <input type="hidden" value="<?php echo current_url(); ?>" name="back_url">
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>