

  <!-- Left side column. contains the logo and sidebar -->
 <?php include('header.php');?>
  <?php include('sidebar.php');?>
<style>
 #toast{
  position: fixed;
    z-index: 10;
    background: white;
    bottom: 33px;
    left: 50%;
    font-size: 19px;
    border: 1px solid;
    padding: 12px 39px;
    border-radius: 19px;
    color: green;
   display:none;
}
  td{
line-break: anywhere;
  }

  #uploaddiv{
    border: 1px solid black;
    display: flex;
    width: 169px;
    flex-flow: column;
    position: absolute;
    float: right;
    right: 199px;
    margin-top: -38px;
    /* width: 228px; */
    margin-right: 332px;
  }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php
if($this->session->flashdata('success') != ''){
    echo '<div class="alert alert-success" role="alert">'.show_flash('success').'</div>';
}
    if($this->session->flashdata('error') != ''){
    echo '<div class="alert alert-danger" role="alert">'.show_flash('error').'</div>';
}

?>
     <section class="content-header">
      <h1>
        Financial News (Caliber)
      </h1>
   <ol style="float:left" class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Access Users</li>
      </ol>
</section>
<div id="toast"></div>
    <div class="form-group" id="uploaddiv">
      <form action="/admin/uploadnewsdata" enctype='multipart/form-data' method="POST">
    	<input type="file" name="newsdata">
      	<button type="submit" class="btn btn-primary">Uploads</button>
      </form>
    </div>
    <button id="resetallbtn" class="btn btn-danger" style="position: absolute; right: 199px; margin-top: -28px; width: 228px; margin-right: 92px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Reset Financial News</button>
    <button id="deleteallbtn" class="btn btn-danger" style="position: absolute; right: 199px; margin-top: -28px;">Delete All</button>
<section class="content">
    <div class="box">
<div class="box-body">
  <table id="example2" class="table table-bordered table-striped" style="width:100%">
                <thead>
                <tr>
                  <th></th>
                  <th>Sr.</th>
                  <th>Created</th>
                  <th>Title</th>
                  <th>Image URL</th>
                  <th>source</th>>
                  <th>Link</th>
                  <th>Comapnies</th>
                  <th>Countries</th>
                  
                  <th>Action</th>
                </tr>
                </thead>
        <tbody>


        </tbody>

            </table>
        </div>
    </div>
     </div>


<script>

    $('#example3').DataTable();
    var table = $('#example2').DataTable({
          'processing': true,
           'serverSide': true,
      		"autoWidth": true,
           'serverMethod': 'post',
           'ajax': {
             'url':'https://ashom.app/api/webservice/findancialload'
           },
           'columns': [

             { data: 'checkbox' },
             { data: 'sr_no' },
             { data: 'date' },
             { data: 'title' },
               { data: 'image_url' },
                { data: 'source' },
                { data: 'link' },
             { data: 'companies' },
             { data: 'countries' },
             { data: 'laste' },
          ]
    })

</script>
  <!-- /.content-wrapper -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
 <script>
   $(document).ready(function(){
   $(document).on("click", "#deleteallbtn", function(){

     var newsIDss = $('.deleteallcheck:checkbox:checked').map(function() {
    return this.value;
		}).get();
     if(newsIDss.length==0){
       alert("Please! select atleast one forum");
       return false;
     }

     if (!confirm('Are you really want to delete Financial News ?'))
         return false;
     var NewsIDs = newsIDss.join(",");

     	$.ajax({
  				type: "POST",
  				url: "https://ashom.app/api/webservice/deleteallnews",
 				data: {"NewsIDs":NewsIDs },
          		beforeSend: function() {
        			 $("#toast").text("Deleting");
                  $("#toast").css("color", "blue");
                  	$("#toast").show();
    			},
          		error: function(err){
                  console.log(err);
                	 $("#toast").text("Error : "+JSON.stringify(err.responseJSON));
                  $("#toast").css("color", "red");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                },
  				success: function(data){
                  table.ajax.reload();
                  $('.deleteallcheck:checkbox:checked').map(function() {
    					return $("#trxt"+(this.value)).remove();
                  }).get();
                  $("#toast").text("Deleted");
                  $("#toast").css("color", "green");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                }
			});
   		});

 $(document).on("click", ".deletenewsbtn", function(){
     if (!confirm('Are you really want to delete this News ?'))
         return false;
     var newsid = $(this).data("newsid");
     $("#trxt"+newsid).remove();
     	$.ajax({
  				type: "GET",
  				url: "https://ashom.app/admin/deletenews/"+newsid,
 				data: {},
          		beforeSend: function() {
        			 $("#toast").text("Deleting");
                  $("#toast").css("color", "blue");
                  	$("#toast").show();
    			},
          		error: function(err){
                  console.log(err);
                	 $("#toast").text("Error : "+JSON.stringify(err.responseJSON));
                  $("#toast").css("color", "red");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                },
  				success: function(data){
                  table.ajax.reload();
                  $("#toast").text("Deleted");
                  $("#toast").css("color", "green");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                }
			});
   		});

   $(document).on("click", "#resetallbtn", function(){
     if (!confirm('Are you really want to delete All News ?'))
         return false;

     	$.ajax({
  				type: "GET",
  				url: "https://ashom.app/admin/clearallnews",
 				data: {},
          		beforeSend: function() {
        			 $("#toast").text("Deleting");
                     $("#toast").css("color", "blue");
                  	 $("#toast").show();
    			},
          		error: function(err){
                     console.log(err);
                	 $("#toast").text("Error : "+JSON.stringify(err.responseJSON));
                  	 $("#toast").css("color", "red");
                  	 setTimeout(function(){ $("#toast").hide(); }, 3000);
                },
  				success: function(data){
                  table.ajax.reload();
                  	$("#toast").text("Deleted");
                  	$("#toast").css("color", "green");
                  	location.reload();
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                }
			});
   		});
   });
    </script>

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
<?php include('footer.php');?>
