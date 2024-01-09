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
            <div class="quiz_section">
            <h1 class="oswald text-center">Quiz Result</h1>
            <div class="row">
                <div class="col-lg-12 text-center">
                    your score: <?php echo $total_correct_ans?> / <?php echo $total_question?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <p><?php
                    if (array_key_exists($total_correct_ans,$quizScoresArr)){
                        echo $quizScoresArr[$total_correct_ans];
                    }else{
                        echo $quizScoresArr[$total_correct_ans+1];
                    }
                    
                    ?></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="<?php echo site_url('dashboard/review_quiz/'.$this->uri->segment(3).'/'.$this->uri->segment(4)) ?>" class="btn btn-color btn-sm" style="width:150px"> Review Quiz </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12 text-center">

                <a href="<?php echo site_url('dashboard/quiz/'.$this->uri->segment(3).'/'.$this->uri->segment(4)) ?>" class="btn btn-color btn-sm" style="width:150px"> Retake Quiz </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12 text-center">

                <a href="<?php echo site_url('dashboard/course_home') ?>" class="btn btn-color btn-sm" style="width:150px"> Course Home </a>
                </div>
            </div>
            </div>
            
        </div>
        <div class="col-lg-1">
        </div>
    </div>
</div>