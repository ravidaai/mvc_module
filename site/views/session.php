<div class="container">




     <!-- DataTables Example -->
     <div class="card mb-3">
          <div class="card-header">

              <strong style="font-size: 20px;">My Students</strong></div>
          <div class="card-body">
            <div class="table-responsive">
<!--                id="dataTable"-->
              <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                  <tr>
                 
                    <th>Session </th>
                    <th>Start Date</th>
                    <th>End Date </th>
                    <th>Enrollment </th>
                    <th>Student Roster </th>
                    <th>Billing Statement </th>
                  </tr>
                </thead>
                <!-- <tfoot>
                  <tr>
                  <th>Session </th>
                    <th>Start Date</th>
                    <th>End Date </th>
                    <th>Enrollment </th>
                    <th>Student Roster </th>
                    <th>Billing Statement </th>
                  </tr>
                </tfoot> -->
                <tbody>
                <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row): ?>
                                <?php 
                               
                                $enrollment = $this->members_model->getWhereTotal(array('group_id'=>$row->id));
                                ?>
                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
                                    
                                        <td><?php echo $row->session_name; ?></td>
                                        <td ><?php echo custom_date_format($row->start_date); ?></td>
                                        <td><?php echo custom_date_format($row->end_date); ?></td>
                                        <td><?php echo $enrollment; ?></td>
                                        <td><a href="<?php echo site_url('dashboard/student_rosters/'.$row->id); ?>">View</a></td>
                                        <td><a href="<?php echo site_url('dashboard/session_billing/'.$row->id); ?>">View</a></td>
                                    </tr>
                                    <?php $i++;; ?>
                                <?php endforeach; ?>

                            <?php } else { ?>

                                <tr class="odd">

                                    <td colspan="6">No records</td>

                                </tr>

                            <?php }; ?>

                
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"><?php echo $links;?></div>
        </div>


</div>               

                
          