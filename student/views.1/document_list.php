<div class="row">
    <div class="col-md-12">


        <div class="panel panel-warning">

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $page_header ?></h3>
<!--                <ul>-->
<!--                    <li style="margin-left: 10px;"><a href="--><?php //echo site_url('student/document_of/').'/'.$this->uri->segment(3); ?><!--" class="btn btn-success pull-right" role="button"><i class="fa fa-plus"></i>Compose Email</a></li>-->
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
                                <th width="10%">Document</th>
                                <th width="10%">Uploaded on</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($query) { ?>
                                <?php $i = 1; ?>
                                <?php foreach ($query->result() as $row): ?>

                                    <?php $class = (1 % $i)?'odd':'even'; ?>
                                    <tr class="<?php echo $class ?>">
                                        <td class="center"><?php echo $i; ?></td>

                                        <?php
                                        $preCountryQuery = $this->post_category_model->fromId($row->pre_country_id);
                                        $preCollegeQuery = $this->post_model->fromId($row->pre_college_id);
                                        ?>

                                        <td><a href="<?php echo site_url('assets/upload').'/'.$row->document; ?>" target="_blank"><?php echo "Docs for ".$preCountryQuery->title.' / '.$preCollegeQuery->title; ?></a></td>
                                        <td class="center">

                                            <?php echo date('F j, Y', strtotime($row->created)); ?>
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