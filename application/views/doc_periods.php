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
    background-image: url("/assets/pdficon.png");
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
 <section class="content-header">
      <h1>Periods</h1>
</section>



<section class="content">
<div class="row">


<?php  if($msg=$this->session->flashdata('msg')):
 $country = $this->uri->segment(3);
 $company_id = $this->uri->segment(4);
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
<?php
     $country = $this->uri->segment(3);
     $company_id = $this->uri->segment(4);
     $year = $this->uri->segment(5);
     ?>
     <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
   <i class="fa fa-home"></i>
    <li class="breadcrumb-item"><a href="<?=base_url('admin/documents');?>">Document Home</a></li>
    <li class="breadcrumb-item"><a href="<?=base_url('admin/documents/'.$country);?>"><?=$country?></a></li>
    <li class="breadcrumb-item"><a href="<?=base_url('admin/documents/'.$country.'/'.$company_id);?>"><?=$this->db->get_where("companies", ["id"=>$company_id])->row()->Company_Name?></a></li>
   <li class="breadcrumb-item active" aria-current="page">Year <?=$year?></li>
  </ol>
</nav>
<div class="box">
 <div class="box-body">
    <table id="example3">
                <thead>
                <tr>
                  <th>S no.</th>
                   <th>Periods</th>
                </tr>
                </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><a href="<?=base_url()?>admin/Documents/<?=$country?>/<?=$company_id?>/<?=$year?>/Annual">Annual</a></td>
        </tr>
        <tr>
            <td>2</td>
            <td><a href="<?=base_url()?>admin/Documents/<?=$country?>/<?=$company_id?>/<?=$year?>/Q1">Quarter 1</a></td>
        </tr>
        <tr>
            <td>3</td>
            <td><a href="<?=base_url()?>admin/Documents/<?=$country?>/<?=$company_id?>/<?=$year?>/Q2">Quarter 2</a></td>
        </tr>
        <tr>
            <td>4</td>
            <td><a href="<?=base_url()?>admin/Documents/<?=$country?>/<?=$company_id?>/<?=$year?>/Q3">Quarter 3</a></td>
        </tr>
        <tr>
            <td>5</td>
            <td><a href="<?=base_url()?>admin/documents/<?=$country?>/<?=$company_id?>/<?=$year?>/Q4">Quarter 4</a></td>
        </tr>
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

    $('#example3,#example4,#example5').DataTable({

        "columnDefs": [{
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

