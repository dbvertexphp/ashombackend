<?php include('header.php');?>
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
 <section class="content-header">
      <h1>Documents</h1>
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
     <div style="width:90%" class="container">
    <div class="row">     
    <div class="col-md-4 col-sm-6 top-buffer">
        <label >Select Country</label>
    <select id="country_codes" class="form-control" name="country">
        <?php 
        $flag_country = "";
        $count = 0;
        foreach($countries as $value){ 
        if($count == 0)
        $flag_country=$value->Country;
        $count++;
        ?>
        <option value="<?=$value->Country?>"><?=$value->Country?></option>
        <?php } ?>
    </select>
     </div>
     <div class="col-md-4 col-sm-6 top-buffer">
    <label >Select Company</label>
    <select id="company_id" class="form-control" name="company_id">
        <option value="">Select Company</option>
        <?php
        $companies = $this->db->get_where("companies", ["Country"=>$flag_country])->result();
        foreach($companies as $value){ ?>
        <option value="<?=$value->id?>"><?=$value->Company_Name?></option>
        <?php } ?>
    </select>
     </div>
     <div class="col-md-4 col-sm-6 top-buffer">
         <label >Select Year</label>
    <select id="doc_year" class="form-control" name="year">
        <?php
        for($i=1990; $i<=2025; $i++){  ?>
        <option <?=($i==2021)?"selected":""?> value="<?=$i?>"><?=$i?></option>
        <?php } ?>
    </select>
     </div>
     <div class="col-md-4 col-sm-6 top-buffer">
         <label >Select Period</label>
    <select id="doc_period" class="form-control" name="period">
        <option value="y">Yearly</option>
        <option value="q1">Quarter 1</option>
        <option value="q2">Quarter 2</option>
        <option value="q3">Quarter 3</option>
        <option value="q4">Quarter 4</option>
    </select>
     </div>
     <div class="col-md-4 col-sm-6 top-buffer">
         <label >Select Document Type</label>
    <select class="form-control" id="doc_type" name="doc_type">
        <option value="All">All</option>
        <option value="BS">BS</option>
        <option value="CF">CF</option>
        <option value="CIE">CIE</option>
        <option value="IS">IS</option>
        <option value="ES">ES</option>
        <option value="Notes">Notes</option>
        <option value="OCI">OCI</option>
    </select>
     </div>
    </div>
    </div>
  </div>
 </div>
 <div class="box">
 <div class="box-body">
     <div style="width:90%" class="container">
    <div class="row">     
    <div class="col-md-4 col-sm-6 top-buffer">
        <div id="pdfviewbox">
            <span class="unavailable">No PDF Available</span>
        </div>
       </div>
       <div class="col-md-4 col-sm-6 top-buffer">
           <form method='post' action='' enctype="multipart/form-data">
            
          Select file : <input type="file" accept="image/*" name="file" id="file" class='form-control' required><br>
          <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
          
        </form>
       </div>       
    </div>
    </div> 
  </div>
 </div>   
</div>
</section>
<script>
    $(document).ready(function(){
$(document).on('change', '.agentcode', function(){            
var agentcode=$(this).val();
var user_id = $(this).data("userid");
var fkf=agentcode;
if(agentcode=="")
agentcode="x";
console.log(agentcode)
console.log(user_id)
                 $.ajax({
                  type: "POST",
                  url: '<?php echo base_url("Admin/updateagentcode")?>/'+user_id+"/"+agentcode,
                  cache:false,
                  data: {},
                  error: function() {
                      alert('Something is wrong');
                  },
             success: function(data) {
                 $('.agentcode'+user_id).val(fkf);
                      swal("Agent Code Updated Successfully","", "success");
                 
             } 
          });


        });
    });
</script>
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
<script>
      $('#btn_upload').click(function(){
    var fd = new FormData();
    if($('#file')[0].files.length>0){
    var ins = $('#file')[0].files.length;
    for (var x = 0; x < ins; x++) {
        console.log(x);
    fd.append("file[]", $('#file')[0].files[x]);
    }
    var company_id = $("#company_id").val();
    var year = $("#doc_year").val();
    var period = $("#doc_period").val();
    var doc_type = $("#doc_type").val();
    fd.append('company_id',company_id);
    fd.append('year',year);
    fd.append('period',period);
    fd.append('doc_type',doc_type);
    if(company_id==""){
        alert("Please! Select Company");
        
    }
    $.ajax({
      url: '<?=base_url("ashoms/admin/uploadfile")?>',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $("#loaderback").css("display", "block");
    },
    error:function(err){
      console.log(err);  
    },
    uploadProgress: function(event, position, total, percentComplete) {		
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				percent.html(percentVal);
				console.log(percentComplete+"%"); 
			},
      success: function(response){
          console.log(response);  
          
      }
    });
    }
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
 