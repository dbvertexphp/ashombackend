
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
  
  #<?=($forum->content_image=="")?"imagedic":"image_uploads_sec"?>{
    display:none;
  }  
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <section class="content-header">
      <h1>
       Edit Forums
      </h1>
       <div id="toast"></div>
   <ol style="float:left" class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Form</li>
      </ol>
</section>

<section class="content">
    <div class="box">
<div class="box-body">
<div class="row">
  <div class="col-md-6">
  <form action="<?=base_url()?>admin/saveforum" enctype='multipart/form-data' method="post">
    <input type="hidden" name="options" value='<?=json_encode($forum->options)?>'>
    <input type="hidden" name="forum_id" value="<?=$forum->id?>">
    <input type="hidden" name="forum_type" value="<?=$forum->forum_type?>">
    <div class="form-group">
    <label for="impcontent">Content</label>
    <input type="text" class="form-control" id="impcontent" name="content" aria-describedby="emailHelp" value="<?=$forum->content?>" required placeholder="Enter Forum Content">
  </div>
    <?php
      if(($forum->forum_type=="forum")){
    		if(($forum->content_image!="")){
    ?>
     <div class="form-group" id="imagedic">
   		 <label for="impcontentimg">Content - Image</label><br>
    		<img style="height:100px" id="impcontentimg" src="<?=$forum->content_image?>">
         <button type="button" id="removeimgbtn" class="btn btn-danger">Remove</button>
  	 </div>

    <?php }
      else{
    ?>
         <div class="form-group" id="image_uploads_sec">
       <input type="file" name="content_image">
     </div>  
    <?php
      }}
    else{
      ?>
    <div class="form-group">
   		 <label for="impg">Poll Options</label><br>
    		<input type="text" class="form-control" id="imppolloption1" name="option1" aria-describedby="emailHelp" value="<?=$forum->options->option1?>" required placeholder="Enter Option 1">
      <input type="text" class="form-control" id="imppolloption2" name="option2" aria-describedby="emailHelp" value="<?=$forum->options->option2?>" required placeholder="Enter Option 2">
      <input type="text" class="form-control" id="imppolloption3" name="option3" aria-describedby="emailHelp" value="<?=$forum->options->option3?>" required placeholder="Enter Option 3">
  		</div>
	<div class="form-group">
      <input type="number" name="validity" placeholder="Validity (in Days)" value="<?=$forum->validity?>" required>
    </div>  
    <?php
    }
    ?>
    <br>
    <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
  </div>
        </div>
    </div>
     </div>

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
  <!-- /.content-wrapper -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $(document).ready(function(){
 	$("#removeimgbtn").click(function(){
    	var forumId = <?=$forum->id?>;
    
     	$.ajax({
  				type: "GET",
  				url: "https://ashom.app/api/webservice/deleteforumImage/"+forumId,
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
                   $("#imagedic").remove();
                  $("image_uploads_sec").show();
                  $("#toast").text(data.message);
                  $("#toast").css("color", "green");
                  	setTimeout(function(){ $("#toast").hide(); }, 3000);
                }
			});
    })  
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
