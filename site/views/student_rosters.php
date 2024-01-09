<div class="container">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <?php /**
        <li class="breadcrumb-item">
            <a href="<?php echo site_url('dashboard/session') ?>">&larr; Back</a>
        </li>
 * **/?>
        <li class="breadcrumb-item active"><strong style="font-size: 20px;"><?php echo $sessionQ->session_name; ?> Student Roster</strong></li>
    </ol>


     <!-- DataTables Example -->
     <div class="card mb-3" style="font-size: 14px;">
          <div class="card-header">
            <div class="row">
<!--              <div class="col-lg-2 col-xs-12 ">-->
<!--                <strong> Session:</strong> --><?php //echo $group->session_name; ?>
<!--              </div>-->

              <div class="col-lg-3 col-xs-12">
                <strong>Course Start Date:</strong> <?php echo custom_date_format($group->start_date); ?>
              </div>

              <div class="col-lg-3 col-xs-12">
                <strong>Course End Date:</strong> <?php echo custom_date_format($group->end_date); ?>
              </div>

              <div class="col-lg-2 col-xs-12">
             
                  <strong>Enrollment:</strong> <?php echo  $this->members_model->getWhereTotal(array('capability' => 'member', 'member_type' => 'Student','group_id'=>$group_id)) ?>
              </div>
              <div class="col-lg-2 col-xs-12">
              <strong><a href="<?php echo site_url('dashboard/student_rosters_pdf/'.$group_id) ?>" target="_blank">PRINT TO PDF</a></strong>
              </div>
                <div class="col-lg-2 col-xs-12">
                    <a href="<?php echo site_url('dashboard/session') ?>">&larr; Return to My Students</a>
                </div>

            </div>
          </div>
          <div class="card-body">          
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th class="no-sort">Last Name</th>
                    <th>First Name</th>
                    <th>Country </th>
                    <th>Email  </th>
                    <th>Date Added </th>
                  </tr>
                </thead>

                <tbody>
                <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row): ?>
                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
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
          <div class="card-footer small text-muted"><?php echo $links;?></div>
        </div>


</div>               

                
          