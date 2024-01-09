
<div class="row">
    <!-- <div class="col-lg-12 d-flex justify-content-center "> -->
    <div class="col-lg-12">
    <?php
                    $group_model = $this->members_model->fromId($this->uri->segment(3));
                    $institution_model = $this->members_model->fromId($group_model->group_id);
                    $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$this->uri->segment(3)));
                ?>
                 <p style="font-size: 14px; font-weight:600;">
                 <strong>AmericanWays</strong><br> <?php echo $this->setting_model->get('course_title') ?><br>
<?php echo $institution_model->institution; ?>  <?php echo $group_model->session_name; ?> Student Roster 
<?php /* ?>
<strong>Session:</strong> <?php echo $group_model->session_name; ?><br>
<strong>Start Date:</strong> <?php echo custom_date_format($group_model->start_date); ?><br>
<strong>End Date:</strong> <?php echo custom_date_format($group_model->end_date); ?><br>
<strong>Enrollment:</strong> <?php echo $enrollment; ?>
<?php */ ?>

</p>

        <table class="table table-bordered" style="width:800px;" cellspacing="0">
        
            <thead>
            <tr>
                <th width="8%">SN</th>
                <th width="12%">Last Name </th>
                <th  width="12%">First Name</th>
                <th  width="14%">Country </th>
                <th  width="18%">Email  </th>
                <th  width="12%">Date Added </th>
            </tr>
            </thead>

            <tbody>
            <?php if ($query) { ?>
                <?php $i = 1; ?>
                <?php foreach ($query->result() as $row): ?>

                    <tr>
                    <td><?php echo $i; ?></td>
                        <td><?php echo $row->last_name; ?></td>
                        <td><?php echo $row->first_name; ?></td>
                        <td><?php
                            $country = $this->country_model->fromId( $row->country);
                            echo $country->country_name;
                            ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td ><?php echo custom_date_format($row->created); ?></td>
                    </tr>
                    <?php $i++;; ?>
                <?php endforeach; ?>

            <?php } else { ?>

                <tr class="odd">

                    <td colspan="5">No records</td>

                </tr>

            <?php }; ?>


            </tbody>
        </table>
    </div>
</div>

