<div class="container">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        
        <li class="breadcrumb-item active">Change Password</li>
    </ol>

    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <?php echo form_open('', "class=\"\" autocomplete=\"off\"") ?>

            <div class="form-group">
                <p>
                <?php $memberQuery = $this->members_model->fromId($member_id); ?>
                <strong>Your username:</strong> <?php echo $memberQuery->email;?><br>
                <strong>Course Start Date:</strong> <?php echo custom_date_format($memberQuery->start_date);?><br>
                <strong>Course End Date:</strong> <?php echo custom_date_format($memberQuery->end_date);?><br>
                </p>
             
            </div>
            <div class="form-group">
                <label>New Password</label>

                <?php echo form_password('new_password', '', "id=\"inputNewPassword\" class=\"form-control\"  placeholder=\"Enter new password\""); ?>
                <?php echo form_error('new_password') ?>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>

                <?php echo form_password('conf_password', '', "id=\"inputConfirmPassword\" class=\"form-control\" placeholder=\"Enter cofirm password\""); ?>
                <?php echo form_error('conf_password') ?>
            </div>

            <?php echo form_button(array("type" => "submit", "class" => "btn btn-success", "content" => "Change Password &rarr;")) ?>



            <?php echo form_close(); ?>
        </div>
        <div class="col-lg-4"></div>
    </div>


</div>
<!-- /.container-fluid -->





