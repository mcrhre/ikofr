<?php include_once('header.php'); ?>
<img src="<?php echo base_url().'assets/imgs/about.png'; ?>" class="mabout" onclick="ikofr_info();" />
<div class="jumbotron text-center" style="background-color: #202020; padding-top: 20px; padding-bottom: 20px;">
   <div class="container">
      <div class="row">
         <div class="col col-lg-12 col-sm-12">
            <img src="<?php echo base_url().'assets/imgs/logo.png'; ?>" class="mlogo2">
         </div>
      </div>
   </div>
</div>
<div class="span6 offset3">
	<div class="well mpanel" >
		<div class="row">
			<div id="textarea" style="border-radius: 20px">
				<p style="text-align: left !important;"><span style="font-size: 25px; color: #3697B0;">Read Message</span></p>
				<div class="row" style="margin:0">
					<?php if($attachment != ''){ ?>
						<div class="col-xs-6" align="left"  style="padding:0;">
							<button class="btn btn-primary btn-xs" type="button" id="download-file">Download attachment</button>
						</div>
					<?php } ?>
					<div <?php if($attachment != ''){ ?>class="col-xs-6"<?php } else{ ?>class="col-xs-12"<?php } ?> align="right" style="padding:0;"><small><?php echo $date ?></small></div>
				</div>
				<br />
				<textarea class="form-control" id="text-message" name="text-message" style="resize:none; height: 175px; border-radius: 20px"><?php echo $message ?></textarea>
				<br>
				<!--Buttons 1-->
				<span class="cancel1" style="float: right !important; margin-right: 10px;">
					<button class="btn btn-danger delete-link" type="button"  style="border-radius: 20px;" id="delete-link" >
						Delete &nbsp;<i class="fa fa-trash"></i>
					</button>
					&nbsp;
				</span>
				<!--Buttons 2-->
				<span class="cancel2" style=""><button class="btn btn-danger delete-link"type="button" style="border-radius: 20px;"><i class="fa fa-trash"></i></button></span>
				<br>
			</div>		 
			<table class="mtable" align="center">
				<tr>
				   <td align="center" style="padding-top: 40px;">
					  <a href="<?php echo base_url().'message'; ?>"><button class="btn btn-info" type="button">Home &nbsp;<i class="fa fa-home"></i></button></a>
					  &nbsp;
					  <a href="<?php echo base_url().'message/new_message'; ?>"><button class="btn btn-success" type="button">New Message &nbsp;<i class="fa fa-envelope"></i></button></a>
				   </td>
				</tr>
				<!--<tr>
				   <td align="center" style="padding-top: 60px;">  
					  <a href="#"><img src="./img/facebook.png" width="28px"></a> &nbsp;&nbsp;&nbsp; 
					  <a href="#"><img src="./img/twitter.png" width="28px"></a>  &nbsp;&nbsp;&nbsp; 
					  <a href="#"><img src="./img/mail.png" width="28px"></a>
				   </td>
               </tr>-->                   
			</table>
		</div>
	</div>
</div>
<br>
<?php include_once('popover.php');?>
<!-- Modal HTML -->
<div id="myModal4" class="modal fade bs-example-modal-sm" style="top: 35%;">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-body">
            <center>
               <span id="sure">
                  <h3>Are you sure?!</h3>
                  <br>
               </span>
               <button class="btn btn-danger"type="button" id="cancel-link" style="" data-dismiss="modal">No!</i></button>
               <button class="btn btn-success"type="button" id="confirm-link" style="">Yes!</i></button>
            </center>            
         </div>
      </div>
   </div>  
</div>
<div id="myModal3" class="modal fade bs-example-modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="result_delete"></h4>
				<h4 class="modal-title" style="color:#d43f3a" id="delete_erro"></h4>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">        
	$(".delete-link").click(function(){        
       swal({
			title: "",
			text: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			closeOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm){
			if (isConfirm) {
				confirm_link();
			}
		});
	});
	
	function confirm_link(){
		$.ajax({
			url: '<?php echo base_url(); ?>' + 'message/delete',
			type: 'POST',
			data: {'0':'0'},
			success: function(data){
				var data = $.parseJSON(data);
				
				if(data.error === 0){
					swal({ title: "", text: data.result, type: "error", showConfirmButton: false });
				}else{
					swal({ title: "", text: data.result, type: "success", showConfirmButton: false });
				}
			}
		});
		//remove warning back
		window.onbeforeunload = null;
		window.setTimeout(function(){window.location.replace("index.php"); }, 3500);                
	}
	function download_attachment(){
		//remove warning back
		window.onbeforeunload = null;
		
		window.location="<?php echo base_url().'message/download_attachment/'.$date.'/'.$attachment; ?>";
				window.setTimeout(function(){window.onbeforeunload = function() { return "Your work will be lost."; }; }, 400);  
		//add warning back
	}
	
	$("#download-file").click(function(){		
		$.ajax({
			url: "<?php echo base_url().'message/check_attachment/'.$date.'/'.$attachment; ?>",
			type: 'GET',
			success: function(data){
				var data = $.parseJSON(data);
				
				if(data.error == 0){
					download_attachment();
				}else{
					swal({ title: "", text: data.result, type: "error", showConfirmButton: true });
				}
			}
		});
	});
</script>
<script>
	tinymce.init({ 
		selector:'textarea', 
		elementpath: false,
		menubar: false,
		toolbar: false,
		readonly : 1,
		height : 250
	});
</script>
<script>
	//Warning that work will be lost if you return to your browser
	window.onbeforeunload = function() { return "Your work will be lost."; };
	//disable back button in browser
	/*history.pushState(null, null, document.title);
	window.addEventListener('popstate', function () {
		history.pushState(null, null, document.title);
	});*/
</script>
<?php include_once('footer.php'); ?>