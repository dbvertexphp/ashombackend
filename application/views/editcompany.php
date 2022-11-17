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
        Edit Comapny
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Company</li>
      </ol>
    </section>

<div class="container" style="margin-top:20px;">

<section class="content" style="padding-left: 270px;">

<form action="" enctype='multipart/form-data' method="POST">

 <div class="row align-items-center justify-content-center">
 <div class="col-lg-6 col-xs-6">
 <input type="hidden" name="cid" value="<?=$company->id?>">
  <div class="form-group">
    <label for="Title">Company Name:</label>
   <input name="Company_Name" class="form-control" value="<?=$company->Company_Name?>" required>

  </div>
  </div>
  </div>
<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Company Image:</label>
    <div>
    <img src='<?php echo $company->image?>' alt='old_image' width="100" height="100"/>
   <input type="file" name="imagefile" class="form-control" accept="image/*">
      </div>
  </div>
  </div>
  </div>
  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Refrence No. :</label>
   <input type="number" name="Reference_No" class="form-control"  value="<?=$company->Reference_No?>" required>

  </div>
  </div>
  </div>

<div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Symbol :</label>
   <input name="SymbolTicker" class="form-control"  value="<?=$company->SymbolTicker?>" required>
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
   <option <?=($company->industry==$value->industry?"selected":"")?> value="<?=$value->industry?>"><?=$value->industry?></option>
   <?php } ?>
   </select>
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
   <option <?=($company->exchanges==$value->exchange?"selected":"")?> value="<?=$value->exchange?>"><?=$value->exchange?></option>
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
   <option <?=($company->company_status==$value->company_status?"selected":"")?> value="<?=$value->company_status?>"><?=$value->company_status?></option>
   <?php } ?>
   </select>
  </div>
  </div>
    </div>
 <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
    <label for="Title">Delisted Date :</label>
   <input name="DelistingDate" class="form-control"  value="<?=$company->DelistingDate?>" >
  </div>
  </div>
  </div>
  <div class="row">
 <div class="col-lg-6 col-xs-6">
  <div class="form-group">
   <input type="submit" class="btn btn-primary" name="submit" value="Update">
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
