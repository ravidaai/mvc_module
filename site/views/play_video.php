<div class="container">
    <div class="row">
    <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <h2 style="color: #9a9898;font-size: 25px;">Elementary French for Beginners and New Learners</h2>
        </div>
        <div class="col-lg-1">
        </div>
    </div>


    <div class="row mt-2">
    <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <?php $module = $this->module_model->fromId($this->uri->segment(3)); ?>
            <h3><?php echo $module->module_name; ?></h3>
        </div>
        <div class="col-lg-1">
        </div>
    </div>

    <div class="row mt-4">
    <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
<?php
//         $getid3PHP_filename = realpath('getid3/getid3/getid3.php');
// if (!file_exists($getid3PHP_filename) || !include_once($getid3PHP_filename)) {
// 	die('Cannot open '.$getid3PHP_filename);
// }
// // Initialize getID3 engine
// $getID3 = new getID3;
?>    



            <?php if ($query) : ?>
                <?php foreach ($query->result() as $row) : ?>
                    <h2><?php echo $unit_string. " : " . $row->title; ?></h2>
                    <p><?php echo $row->description; ?></p>

                    <video id="my-player" class="video-js" width="850" controls preload="auto" poster="<?php echo site_url('assets/uploads/'.$row->video_image) ?>" data-setup='{}'>
                <source src="<?php echo $row->link; ?>" type="video/mp4"></source>
                <!-- <source src="//vjs.zencdn.net/v/oceans.webm" type="video/webm"></source>
                <source src="//vjs.zencdn.net/v/oceans.ogv" type="video/ogg"></source> -->
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="http://videojs.com/html5-video-support/" target="_blank">
                        supports HTML5 video
                    </a>
                </p>
            </video>
                <?php endforeach; ?>
            <?php else : ?>

            <?php endif; ?>
<div class="clearfix"></div>
<?php 
$next=NULL;
$next_q = $this->module_video_model->fetch(1, $page+1, array('module_id' => $module_id), '*', '_order', 'ASC');
if($next_q ){
foreach($next_q->result() as $next_row){
    $next = $next_row->title;
}
}
?>
            <?php echo $links; ?> <?php echo !empty( $next)? " <strong>".$next."</strong> ":NULL; ?>



        </div>
        <div class="col-lg-1">
        </div>
    </div>
</div>