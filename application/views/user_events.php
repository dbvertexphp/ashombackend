.draw(false)<?php include('header.php');?>
  <?php include('sidebar.php');?>

<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

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
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
 <section class="content-header">
      <h1>Users Events</h1>
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
<div class="box">
<div class="box-body">
    <div class="tab-content">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>From Date</label>
            <input type="date" class="form-control" id="start_date_inp" name="start_date_inp" value="<?=date('Y-m-d', strtotime(date('Y-m-d').' -1 day'))?>" placeholder="Select start date">
          </div>
         </div>
         <div class="col-md-4">
          <div class="form-group">
            <label>To Date</label>
            <input type="date" class="form-control" id="end_date_inp" name="end_date_inp" value="<?=date('Y-m-d')?>" placeholder="Select end date">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <button type="date" id="datewisesor_btn" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
        <table id="example3">
                <thead>
                     <tr>
                       <th>Sr. No.</th>
                       <th>Event</th>
                       <th>Total Event</th>
                       <th>Total Users</th>
                     </tr>
                      </thead>
                    <tbody id="tableloads">

            		</tbody>
            </table>
		</div>
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
 const dtble = $('#example3').DataTable({
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

  $("#datewisesor_btn").click(function(){
      const start_date = $("#start_date_inp").val();
      const end_date = $("#end_date_inp").val();
  	  $.ajax({
        type: "POST",
        url: '<?=base_url()?>/api/webservice/usereventsdtbl',
        data: {start_date: start_date, end_date: end_date},
        success: function(res){
        console.log(res);
          dtble.clear().draw();
          res.data.map((obj, i) =>{
          	dtble.row.add([i+1, obj.event, obj.total_events, obj.total_users]).draw(false);
          });
        },
      });
  });
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
