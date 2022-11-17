<?php include('header.php');?>
  <?php include('sidebar.php');?>

<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style type="text/css">

.dt-buttons{
    float: right!important;
}

    .buttons-excel{

      float: right!important;
    margin-left: 10px!important;
    margin-right: 10px!important;
    border-radius: 39px!important;
    background-color: #00c0ef!important;
    color: #fff!important;

    }
input{
    border:none;
}
.top-buffer { margin-top:20px; }

#pdfviewbox{
    border:2px solid black;
    width:200px;
    height:200px;
    background-image: url("/ashoms/assets/pdficon.png");
    background-repeat: no-repeat;
    background-position: bottom;
    background-position-y: 20%;
    background-size: 62%;
    border-radius: 19px;
}
#pdfviewbox span{
    width: inherit;
    bottom: 10px;
    text-align: center;
    position: absolute;
}
#pdfviewbox .unavailable{
    color:red;
}
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!-- <section class="content-header">-->
<!--      <h1>Select Countries</h1>-->
<!--</section>-->



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
 <section class="content-header">
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
   <i class="fa fa-home"></i>
    <li class="breadcrumb-item"><a href="#">Document Home</a></li>
  </ol>
</nav>
      <h1>Add Country</h1>
</section>
<div style="display:inline-block">
<form style="display: flex;" action="/admin/addcountry" method="post">
    <input class="form-control" style="width:200px;" placeholder="Enter Country Name" required name="country">
    <button class="btn btn-primary">Add Country</button>
</form>
</div>
 <section class="content-header">
      <h1>Countries List</h1>
</section>
<div class="box">
 <div class="box-body">
    <table id="example3">
                <thead>
                <tr>
                  <th>S no.</th>
                   <th>Country Name</th>
                 <?php
        if($user_type=="admin"){ ?>  <th>Action</th><?php } ?>
                </tr>
                </thead>
    <tbody>

    <?php
    $contries = $this->db->get("countries")->result(); $i=0;
    $session_id = $this->session->userdata('admin_id');
    $auth_countries = explode(",", $this->db->get_where("admin", ["id"=>$session_id])->row()->auth_countries);
    foreach($contries as $value){   $i++;
    
    if(in_array($value->id, $auth_countries)||($user_type=="admin")){
    ?>
    <tr>
            <td><?=$i?></td>
            <td><a href="<?=base_url('admin/documents/'.$value->country)?>"><?=$value->country?></a></td>
            <?php
        if($user_type=="admin"){ ?> <td><button class="btn btn-danger deletecountry" data-id="<?=$value->id?>">Delete</button></td><?php } ?>
        </tr>
<?php
}
} ?>
    </tbody>
</table>
  </div>
 </div>

</div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<script>
    $(".deletecountry").click(function(){
    var cid = $(this).data("id");
       Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "<?=base_url("admin/deletecountry")?>/"+cid;
  }
})
    })
</script>
<script>

    $('#example3,#example4,#example5').DataTable({

            dom: 'Bfrtip',
        buttons: [
            'excel',
        ],"columnDefs": [{
                "orderSequence": ["desc", "asc"],
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [[0, 'asc' ]]
        });

/*$('#example3,#example4,#example5').DataTable({
          dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });*/



    $('#example2').DataTable({
       "order": [ 0, "desc" ]
      /*'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,*/

    })

</script>

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

