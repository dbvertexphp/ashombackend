<?php include('header.php');?>
  <?php include('sidebar.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contact Us
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Contact Us</li>
      </ol>
    </section>

    <!-- Main content -->



    <?php  if($error=$this->session->flashdata('msg')){  ?>
<div class="row">
<div class="col-lg-6">
<div class="alert alert-success" style="margin-left: 14px;margin-top: 10px;">
<?= $error; ?>
</div>
</div>
</div>

<?php } ?>

    <section class="content">

      <div class="row">

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data = $this->db->order_by("created", "desc")->get("contact_us")->result();
        foreach($data as $index => $value){  ?>
            <tr>
                <td><?=$index+1?></td>
                <td><?=$value->name?></td>
                <td><?=$value->email?></td>
                <td><?=$value->subject?></td>
                <td><?=$value->message?></td>
            </tr>
        <?php } ?>
        </tbody>
</table>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
  <?php include('footer.php'); ?>
