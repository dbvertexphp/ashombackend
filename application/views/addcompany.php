<?php include('header.php');?>
  <?php include('sidebar.php');?>


<div class="content-wrapper">


    <section class="content-header">
    <?php
    if($this->session->flashdata('success')!=null){
    ?>
    <div class="alert alert-success" role="alert">
         <?=$this->session->flashdata('success')?>
</div>
<?php }    ?>
      <h1>
        Add Comapany
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add Company</li>
      </ol>
    </section>

<div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;">

<form action="" enctype='multipart/form-data' method="POST">
<div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">

  <div class="form-group">
    <label for="Title">Add Image:</label>
   <input type="file" name="imagefile" class="form-control" accept="image/*" required>

  </div>
  </div>
  </div>
 <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">

  <div class="form-group">
    <label for="Title">Company Name:</label>
   <input name="Company_Name" class="form-control" value="" required>

  </div>
  </div>
  </div>

  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Refrence No. :</label>
   <input type="number" name="Reference_No" class="form-control"  value="" required>

  </div>
  </div>
  </div>
<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Country :</label>
   <?php $countries = $this->db->get("countries")->result(); ?>
   <select class="form-control" name="Country">
   <?php
   foreach($countries as $value){ ?>
   <option value="<?=$value->country?>"><?=$value->country?></option>
   <?php } ?>
   </select>

  </div>
  </div>
  </div>
<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Symbol :</label>
   <input name="SymbolTicker" class="form-control"  value="" required>
  </div>
  </div>
  </div>

 <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Industry :</label>
   <?php $industries = $this->db->get("industries")->result(); ?>
   <select class="form-control" name="industry">
   <option value="">Default</option>
   <?php
   foreach($industries as $value){ ?>
   <option value="<?=$value->industry?>"><?=$value->industry?></option>
   <?php } ?>
   </select>
  </div>
  </div>
    </div>
  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Company Status :</label>
   <?php $companystatus = $this->db->get("companystatus")->result(); ?>
   <select class="form-control" name="company_status">
   <option value="">Default</option>
   <?php
   foreach($companystatus as $value){ ?>
   <option value="<?=$value->company_status?>"><?=$value->company_status?></option>
   <?php } ?>
   </select>
  </div>
  </div>
    </div>
 <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Delisted Date :</label>
   <input name="DelistingDate" class="form-control" value="" >
  </div>
  </div>
  </div>
  
  
   <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Exchanges :</label>
   <?php $exchanges = $this->db->get("exchanges")->result(); ?>
   <select class="form-control" name="exchanges">
   <option value="">Default</option>
   <?php
   foreach($exchanges as $value){ ?>
   <option value="<?=$value->exchange?>"><?=$value->exchange?></option>
   <?php } ?>
   </select>
  </div>
  </div>
    </div>
  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
   <input type="submit" class="btn btn-primary" name="submit" value="Add">
  </div>
  </div>
  </div>


  </form>

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
