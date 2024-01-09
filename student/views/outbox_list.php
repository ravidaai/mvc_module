<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                <ul>
                    <li style="margin-left: 10px;"><a href="<?php echo site_url('student/outbox_compose/').'/'.$this->uri->segment(3); ?>" class="btn btn-success pull-right" role="button"><i class="fa fa-plus"></i>Compose Email</a></li>

                </ul>
            </div>


            <div class="panel-body">


                <div class="clearfix"></div>
                <div class="table-responsive">

                        <table class="table table-bordered" id="example">
                            <thead>
                            <tr>
                                <th width="10%">SN</th>
                                <th width="10%">Subject</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row): ?>

                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
                                        <td class="center"><?php echo $i; ?></td>
                                        <td><?php echo $row->subject?></td>
                                        <td class="center">

                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Actions
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="<?php echo site_url('student/outbox_compose').'/'.$this->uri->segment(3).'/'.$row->id ?>" class="action">Edit</a></li>
                                                    <li><a href="<?php echo site_url('student/delete/').$this->uri->segment(4).'/'.$row->id ?>" class="action" onclick="return ask('Do you want to delete?');">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>

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

                    <?php echo $links;?>

                </div>
            </div>
        </div>

    </div>
</div>