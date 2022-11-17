<?php include('header.php');?>
  <?php include('sidebar.php');?>


<div class="content-wrapper">


    <section class="content-header">
      <h1>
        Add User
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add User</li>
      </ol>
    </section>

<div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;">

 <form method="POST" action="/admin/addaccessusers/">
 <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">First Name:</label>
   <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Firstname Name','name'=>'first_name','value'=>set_value('first_name')]);  ?>
   <span style="color:red"><?php  echo form_error('name');  ?></span>
  </div>
  </div>
  </div>
  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Last Name:</label>
   <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Lastname Name','name'=>'last_name','value'=>set_value('last_name')]);  ?>
   <span style="color:red"><?php  echo form_error('name');  ?></span>
  </div>
  </div>
  </div>

 <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Email :</label>

   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter Email','name'=>'email','value'=>set_value('email')]); ?>
   <span style="color:red"><?php  echo form_error('email');  ?></span>
   </div>
   </div>
   </div>




<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="body">Password:</label>

   <?php  echo form_input(['class'=>'form-control','placeholder'=>'Enter Password','name'=>'password','value'=>set_value('password')]); ?>
   <span style="color:red"><?php  echo form_error('password');  ?></span>
   </div>
   </div>
</div>




  <?php  echo form_submit(['type'=>'submit','class'=>'btn btn-primary','value'=>'Add']);  ?>

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


