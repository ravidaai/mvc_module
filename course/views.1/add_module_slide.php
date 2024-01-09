<?php echo form_open_multipart('', "class=\"\" autocomplete=\"off\"") ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $page_header ?></h3>
                    <ul>
                  
                        <li><a href="<?php echo $this->agent->referrer(); ?>"
                               class="btn btn-success pull-right"
                               role="button" style="margin-right: 15px;"><i class="fa fa-backward"></i> Back</a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    <div class="clearfix"></div>

                    <div class="panel-body">
                        <div class="form-group required row">
                            <label class=" control-label">Slide Title <sup>*</sup></label>
                            <div class="">
                                <?php echo form_input('title', set_value('title',isset($result->title)?$result->title:''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Video Title\""); ?>
                                <?php echo form_error('title') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="clearfix"></div>
                            <label>Slide </label>
                            <?php echo form_upload('slide_show[]', '', "class=\"form-control\" multiple"); ?>
                            <?php echo form_error('slide_show') ?>

                            
                        </div>

                        <div class="form-group">
                            <div class="row">
                            <?php
                                if(isset($result->slide_show)){
                                    $pictures = unserialize($result->slide_show);
                                    if(count($pictures)>=1){
                                        foreach($pictures as $picture){
                                            if (@file_exists('./assets/uploads/' . $picture) && !empty($picture)) {
                                                echo "<div class=\"col-md-2\" style=\"margin-top:15px;\">";
                                                    echo "<img src='" . site_url('./assets/uploads/' . $picture) . "' class=\"img-responsive\"/><br>";
                                                    echo "<p style=\"text-align:center;\">";
                                                        echo "<a href='" . site_url("course/delete_slide_picture/".$this->uri->segment(3)."/".$picture."/".$this->uri->segment(5)) . "'  onclick='return ask(\"Do you want to delete?\");'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i> Delete</a>";
                                                    echo "</p>";
                                                echo "</div>";
                                                
                                                
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group required row ">
                            <label class=" control-label">Slide Description</label>
                            <div class="">
                                <?php echo form_input('description', set_value('description',isset($result->description)?$result->description:''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Video description\""); ?>
                                <?php echo form_error('description') ?>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class=" control-label">Order</label>
                            <div class="">
                                <?php echo form_input('_order', set_value('_order',isset($result->_order)?$result->_order:''), "id=\"inputFullName\" class=\"form-control \" placeholder=\"Order\""); ?>
                                <?php echo form_error('_order') ?>
                            </div>
                        </div>



                        

                    </div>

                    <div class="panel-footer">
                        <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Submit &rarr;")); ?>
                        <?php echo form_button(array("type" => "Reset", "class" => "btn btn-danger", "content" => "Reset")); ?>

                    </div>

                </div>
            </div>

        </div>


    </div>

<?php echo form_close(); ?>


