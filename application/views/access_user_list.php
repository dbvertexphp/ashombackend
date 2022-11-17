<?php include('header.php');?>
  <?php include('sidebar.php');?>

<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
<script>
    <?php
    if($this->session->flashdata('msgsuccess')){
      echo 'swal("User Updated Successfully!","", "success");';
    }
    ?>
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>
        Access Users
      </h1>
   <ol style="float:left" class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Access Users</li>
      </ol>
</section>



<section class="content">
<div class="row">


<?php  if($msg=$this->session->flashdata('msg')):

$msg_class=$this->session->flashdata('msg_class')

 ?>
<div class="row">
<div class="col-lg-6">
<div class="alert <?= $msg_class ?>">
<?= $msg; ?>
</div>
</div>
</div>

<?php endif; ?>
</div>
<button onclick="window.location.href='/admin/adduseraccess'" class="btn btn-primary">Add New </button>
<div class="box">
<div class="box-body">
<table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr.</th>
                  <th>Name</th>
                  <th>Email</th>>
                  <th>Actions</th>
                </tr>
                </thead>
        <tbody>

          <?php foreach ($users as $value) {?>

                <tr id="row<?php echo $value->id; ?>">

                <td><?php echo  $value->id;?></td>
                <td><?php echo  $value->first_name." ".$value->last_name;?></td>
                <td><?php echo  $value->email;?></td>
                <td>
  <a href="<?php echo base_url("admin/edituser/$value->id"); ?>" class=""  title="Edit">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
 <button type="button" data-forumid="<?=$value->id?>" style="background:none; border:none;" class="deleteforumbtn" id="deleteaccess">
                    <span class="glyphicon glyphicon-trash" for="deleteaccess"></span>
</button>
                </a>

 </td>
                </tr>
                <?php } ?>
            </tbody>

            </table>
        </div>
    </div>
  </div>
</section>
        <script>
    $(document).ready(function(){

	$(document).on("click", ".deleteforumbtn", function(){
      var forumId = $(this).data("forumid");
    	alert(forumId);
    });  

    });

</script>
<script>

    $('#example3').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

</script>


<!-- <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
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

