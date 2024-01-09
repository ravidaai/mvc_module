<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
<!--                <ul>-->
<!--                    <li style="margin-left: 10px;"><a href="--><?php //echo site_url('student/outbox_compose/').'/'.$this->uri->segment(3); ?><!--" class="btn btn-success pull-right" role="button"><i class="fa fa-plus"></i>Compose Email</a></li>-->
<!---->
<!--                </ul>-->
            </div>


            <div class="panel-body">


                <div class="clearfix"></div>
                <div class="table-responsive">

                        <table class="table table-bordered" id="example">
                            <thead>
                            <tr>
                                <th width="10%">SN</th>
                                <th width="15%">Invoice ID</th>
                                <th width="30%">Paid For</th>
                                <th width="10%">Amount (USD)</th>
                                <th width="10%">Paid on</th>
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
                                        <td><?php echo $row->invoice_id?></td>
                                        <td><?php echo $row->paid_for?></td>
                                        <td><?php echo $row->amount/100?></td>
                                        <td class="center">
                                            <?php echo date('F j, Y', strtotime($row->created)); ?>
                                        </td>
                                        <td><a href="<?php echo site_url('student/export_invoice/').'/'.$row->id; ?>">Download</a> </td>
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