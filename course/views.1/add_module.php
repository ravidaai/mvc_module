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
                            <label class=" control-label">Module Name <sup>*</sup></label>
                            <div class="">
                                <?php echo form_input('module_name', set_value('module_name',isset($result->module_name)?$result->module_name:''), "id=\"inputFullName\" class=\"form-control col-md-6\" placeholder=\"Module Name\""); ?>
                                <?php echo form_error('module_name') ?>
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


