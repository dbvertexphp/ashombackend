<?php include('header.php');?>
  <?php include('sidebar.php');?>


<div class="content-wrapper">
    
    
    <section class="content-header">
      <h1>
        Edit Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Edit admin</li>
      </ol>
    </section>

<div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;">

 <?php echo form_open("admin/updateadmin/{$admin_detail->id} "); ?>
<!--<?php echo form_hidden('admin_id',$admin_detail->id); ?> -->
 <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">First Name:</label>
   <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter First Name','name'=>'first_name','value'=>set_value('first_name',$admin_detail->first_name)]);  ?>
  </div>
  </div>
  <div class="col-lg-6" style="margin-top:40px;">
   <?php  echo form_error('first_name');  ?>
  </div>
  </div>
 <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Last Name :</label>
  
   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter last Name','name'=>'last_name','value'=>set_value('last_name',$admin_detail->last_name)]); ?>
   </div>
   </div>
   <div class="col-lg-6" style="margin-top:40px;">
   <?php  echo form_error('last_name');  ?>
  </div>
   </div>
   
   
   <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Phone :</label>
  
   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter Phone no','name'=>'mobile','value'=>set_value('mobile',$admin_detail->mobile)]); ?>
   </div>
   </div>
   <div class="col-lg-6 col-xs-6" style="margin-top:40px;">
   <?php  echo form_error('mobile');  ?>
  </div>
   </div>
   
<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Email :</label>
  
   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter Email','name'=>'email','value'=>set_value('email',$admin_detail->email)]); ?>
   </div>
   </div>
   <div class="col-lg-6 " style="margin-top:40px;">
   <?php  echo form_error('email');  ?>
  </div>
</div>
   
   
   
   
   
  <?php  echo form_submit(['type'=>'submit','class'=>'btn btn-primary','value'=>'Update']);  ?>

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