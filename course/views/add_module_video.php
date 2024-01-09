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
                        <label class=" control-label">Video Title <sup>*</sup></label>
                        <div class="">
                            <?php echo form_input('title', set_value('title', isset($result->title) ? $result->title : ''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Video Title\""); ?>
                            <?php echo form_error('title') ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                        <label class=" control-label">Video Link <sup>*</sup></label>
                        <div class="">
                            <?php echo form_input('link', set_value('link', isset($result->link) ? $result->link : ''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Video Link\""); ?>
                            <?php echo form_error('link') ?>
                        </div>
                    </div>

                    <div class="form-group required row">
                        <label class=" control-label">Video Duration <sup>*</sup></label>
                        <div class="">
                            <?php echo form_input('duration', set_value('duration', isset($result->duration) ? $result->duration : ''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Video duration\""); ?>
                            <?php echo form_error('duration') ?>
                        </div>
                    </div>

                    <div class="form-group">
                            <div class="clearfix"></div>
                            <label>Video Poster </label>
                            <?php echo form_upload('video_image', '', "class=\"form-control\""); ?>
                            <?php echo form_error('video_image') ?>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <?php
                            if (isset($result->video_image)) {
                                $picture = $result->video_image;
                                if (@file_exists('./assets/uploads/' . $picture) && !empty($picture)) {
                                    echo "<div class=\"col-md-2\" style=\"margin-top:15px;\">";
                                    echo "<img src='" . site_url('./assets/uploads/' . $picture) . "' class=\"img-responsive\"/><br>";
                                    echo "<p style=\"text-align:center;\">";
                                    echo "<a href='" . site_url("course/delete_video_picture/". $this->uri->segment(3) . "/video/" . $this->uri->segment(5)) . "'  onclick='return ask(\"Do you want to delete?\");'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete</a>";
                                    echo "</p>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>


                    <div class="form-group required row">
                        <label class=" control-label">Video Description</label>
                        <div class="">
                            <?php echo form_input('description', set_value('description', isset($result->description) ? $result->description : ''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Video description\""); ?>
                            <?php echo form_error('description') ?>
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