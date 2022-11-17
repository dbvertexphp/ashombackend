<?php include('header.php');?>
  <?php include('sidebar.php');?>
<style>
  .d-none{
    display: none;
  }
  </style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Notification Alerts
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Notification Alerts</li>
      </ol>
    </section>
    
<div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;">
   <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">
  <?php
    if($this->session->flashdata('success')!=null){
    ?>
    <div class="alert alert-success"  role="alert">
         <?=$this->session->flashdata('success')?>
</div>
<?php }    ?>
     </div>
       </div>
 <?php echo form_open("admin/notification_line"); ?>
 <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group d-none">
    <label for="Title">Forum Notification Text :</label>
   		<?php echo form_input(['class'=>'form-control','placeholder'=>'Enter forum\'s notification text','name'=>'forum_text','value'=>($lines[0]->textline)]);  ?>
  </div>
   <div class="form-group d-none">
    <label for="Title">News Notification Text :</label>
   		<?php echo form_input(['class'=>'form-control','placeholder'=>'Enter news notification text', 'name'=>'news_text','value'=>($lines[1]->textline)]);  ?>
  </div>
   <div class="form-group">
    <label for="Title">Select News :</label>
   	<select class='form-control' name="selectedNews">
      <?php
      foreach($notifications as $n){ ?>
      <option <?=($lines[2]->textline==$n->id)?'selected':''?> value="<?=$n->id?>"><?=$n->title?></option>
      <?php } ?>
     </select>
  </div>
   <div class="form-group">
     <button class="btn btn-primary">Update</button>
   </div>
  </div>
  </div>
     <?=form_close()?>
</section>

</div>

</div>
 <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
  <?php include('footer.php'); ?>
