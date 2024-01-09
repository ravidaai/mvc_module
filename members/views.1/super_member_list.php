<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th class="center" width="5%">SN</th>
                            <th width="20%">Full Name</th>
                            <th class="center" width="15%">Email</th>
                            <th class="center" width="18%">User Name</th>
                            <th class="center" width="10%">User Type</th>
                            <th class="center" width="10%">Status</th>
                            <th class="center" width="13%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if ($query) { ?>
                            <?php $i = 1; ?>
                            <?php foreach ($query->result() as $row): ?>

                                <?php $class = (1 % $i)?'odd':'even'; ?>
                                <tr class="<?php echo $class ?>">
                                    <td class="center"><?php echo $i; ?></td>
                                    <td><?php echo $row->full_name ?></td>
                                    <td class="center"><?php echo $row->email ?></td>
                                    <td class="center"><?php echo $row->user_name ?></td>
                                    <td class="center"><?php echo ucfirst($row->capability) ?></td>
                                    <td class="center"><?php echo ($row->status)?'Enabled':'Disabled' ?></td>
                                    <td class="center"><a href="<?php echo site_url('members/super/edit_profile').'/'.$row->id ?>" class="action"><i class="fa fa-pencil-square-o"></i> </a> <a href="<?php echo site_url('members/super/member_delete').'/'.$row->id ?>" class="action" onclick="return ask('Do you want to delete this user?');"> <i class="fa fa-trash-o"></i> </a> <a href="<?php echo site_url('members/super/change_password').'/'.$row->id ?>" class="action" title="change password"> <i class="fa fa-unlock-alt"></i> </a></td>

                                </tr>
                                <?php $i++;; ?>
                            <?php endforeach; ?>

                        <?php } else { ?>

                            <tr class="odd">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="center"></td>
                                <td class="center"></td>

                            </tr>

                        <?php }; ?>


                        </tbody>
                    </table>
                    <?php if (!$query) { ?>
                        <p>No Users</p>
                    <?php }?>
                </div>
                <!-- /.table-responsive -->

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
