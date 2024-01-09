
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Last Name </th>
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

                    <tr>
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

