

<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
                
            </div>



<div class="form-row">
    <div class="col-md-12" style="margin-top: 19px;">
    <a href="<?php echo site_url('course/add_module/'); ?>" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add Module</a>

    </div>
  </div>

            <div class="panel-body">
                <div class="clearfix"></div>
                <div class="table-responsive">

                        <table class="table table-bordered" id="example">
                            <thead>
                            <tr>

                                <th width="20%">L.N.</th>
                                <th width="10%">Lession Name</th>
                                <th width="3%">Lession Type</th>
                                <th width="5%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($query) { ?>
                                <?php $i=1; ?>
                                <?php foreach ($query->result() as $row): ?>

                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
                                        <td>Lession <?php echo $i; ?></td>
                                        <td>Lession <?php echo $i; ?></td>
                                        <td>Lession <?php echo $i; ?></td>

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


        </div>

    </div>
</div>