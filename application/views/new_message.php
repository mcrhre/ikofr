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
   <div class="well mpanel">
      <div class="row">
         <div id="textarea" style="border-radius: 20px">
            <p style="text-align: left !important;"><span style="font-size: 25px; color: #3697B0;">New Message</span></p>
				<div class="row" style="margin:0;">
					<div class="col-md-6 col-sm-6 col-xs-7" style="padding:0;">
						<div align="left">
							<button id="fileSelector" class="btn btn-success btn-xs">Add Attachment <i class="fa fa-folder"></i></button>
						</div>
						<input type="file" name="file-message" id="file-message" class="hidden" size="20" accept=".jpg,.png,.jpeg,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf,.csv,.zip,.rar" />
						<div align="left" id="btns" class="hidden" style="display:table;">
							<button class="btn btn-primary btn-xs" type="button" id="selectedFiles"></button>
							<button class="btn btn-danger btn-xs" type="button" id="clearFiles" style="margin-left:4px;">Clear <i class="fa fa-trash-o"></i></button>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-5" style="padding:0;">
						<p style="text-align: right;"><small><?php echo date('d F Y'); ?></small></p>
					</div>
				</div>
            <textarea class="form-control" id="text-message" name="text-message" style="resize:none; height: 175px; border-radius: 20px"></textarea>
            <br>
            <!--Buttons 1-->
            <span class="send1" style="float: right !important;">
               <button class="btn btn-info save-link" type="button" style="border-radius: 20px;" id="save-link" data-toggle="modal" data-controls-modal="your_div_id" data-backdrop="static" data-keyboard="false">
                  Send Message &nbsp;
                  <i class="fa fa-envelope"></i>
               </button>&nbsp;
            </span>
            <span class="cancel1" style="float: right !important; margin-right: 10px;">
            	<a href="<?php echo base_url().'message'; ?>">
            		<button class="btn btn-danger" type="button"  style="border-radius: 20px;">
            			Cancel &nbsp;
            			<i class="fa fa-ban"></i>
            		</button>
            	</a>&nbsp;
            </span>
            <!--Buttons 2-->
				<a href="<?php echo base_url().'message'; ?>">
					<span class="cancel2" style=""><button class="btn btn-danger"type="button" style="border-radius: 20px;"><i class="fa fa-ban"></i></button></span>
				</a>
					<span class="send2" style=""><button class="btn btn-info save-link" type="button" style="border-radius: 20px;"><i class="fa fa-envelope"></i></button></span>
            <br>
         </div>
         <table class="mtable" align="center">
            <!--<tr>
               <td align="center" style="padding-top: 100px;"> 
                  <a href="#"><img src="./img/facebook.png" width="28px"></a> &nbsp;&nbsp;&nbsp; 
                  <a href="#"><img src="./img/twitter.png" width="28px"></a>  &nbsp;&nbsp;&nbsp; 
                  <a href="#"><img src="./img/mail.png" width="28px"></a>
               </td> 
               </tr>-->                
         </table>
         <br>
			<div align="center">
				<div class="">
						<div class="g-recaptcha" data-sitekey="6LemySITAAAAAHclyWzIRawumTegNpVZBYk1D11l" data-theme="dark"></div>
				</div>
			</div>
      </div>

   </div>
</div>

<br>
<?php include_once('popover.php'); ?>
<!-- Modal HTML -->
<div id="myModal4" class="modal fade bs-example-modal-sm">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" style="text-align: center">Save your password</h4>
         </div>
         <div class="modal-body">
            <div class="input-group">
               <span class="input-group-addon radius20"><i class="fa fa-lock" aria-hidden="true"></i></span>                                    
               <input id="password" class="form-control mform2 radius20 mformpass" name="password" value="" maxlength="8" placeholder="" style="height: 40px; font-size: 20px; text-align: center; " type="text" readonly="readonly">                     
					<span class="input-group-addon radius20 btn-default" style="cursor: pointer;" id="clipboard">
							<i class="fa fa-clipboard" aria-hidden="true"></i>
					</span> 
				</div>
         </div>
         <div class="modal-footer" align="center">
            <center>
               <div id="count-div">Wait for <span id="count">10</span></div>
               <a href="<?php echo base_url().'message'; ?>" class="a-inherit"><input type="button" class="btn btn-success" id="back-link" value="BACK TO HOME PAGE"></a> 
            </center>
				<br>
            <center>
               <span style="color: #567655" id="message-alert">
               <p><b>Message sent!</b> It can be openned 3 times. After that it'll be deleted</p>
               </span> 
            </center>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(function(){
   
		function startTimer(){
			var counter = 10;
			setInterval(function() {
				counter--;
				if (counter >= 0) {
					 span = document.getElementById("count");
					 span.innerHTML = counter;
				}
				if (counter === 0) {
		
					$('#count-div').fadeOut(300);
					$('#back-link').delay(300).fadeIn(600); 
				}
			}, 1000);
		}
		
		$('#file-message').change(function (event) {
			var file = $(this).val().replace(/C:\\fakepath\\/i, '');
			var extension = '';
			if(file.length > 10){
				var file = file.substring(0, 10) + '...';
				var extension = $(this).val().replace(/C:\\fakepath\\/i, '').split('.').pop();
			}
			$('#selectedFiles').html(file + extension);
			$('#fileSelector').hide();
			$('#btns').removeClass('hidden');
		});
		
		$("#clearFiles").click(function(){
			$('#fileSelector').show();
			$('#btns').addClass('hidden');
			$('input[name=file-message]').val('');
			
		});
		
		$("#fileSelector").click(function(){
			$('input[name=file-message]').click();
		});
		
		$(".save-link").click(function(){
			
			msg_form = tinyMCE.get('text-message').getContent();
			file_form = $('#file-message')[0].value;
			
			if(msg_form != ''|| file_form != ''){
			
				form = new FormData();
				
				$.each($('#file-message')[0].files, function(i, file) {
					form.append('file', file);
				});
				
				form.append('message', msg_form);
				form.append('recaptcha', grecaptcha.getResponse());
				
				swal({
						title: "",
						text: "Sending Message", 
						imageUrl: "<?php echo base_url().'assets/imgs/loading.gif'; ?>",
						showConfirmButton: false
					});
				
				$.ajax({
					url: '<?php echo base_url(); ?>' + 'message/save',
					type: 'POST',
					data: form,
					cache: false,
					processData: false,
					contentType: false,
					success: function(data){
						var data = $.parseJSON(data);
						
						if(data.error == 0){
							
							startTimer();
				
							$('#message-alert').fadeIn(500);
							$('#message-alert').fadeOut(500);
							$('#message-alert').fadeIn(500);
							$('#message-alert').fadeOut(500);
							$('#message-alert').fadeIn(500);
							$('#message-alert').fadeOut(500);
							$('#message-alert').fadeIn(500);
							
							$("#password").val(data.result); 
							$('#myModal4').modal('show');
							swal({title:"",text:"",timer:0,showConfirmButton:0});
							
						}else{
							$('h4#message_error').text(data.result); 
							swal("", data.result, "error");
							$('iframe[name=undefined]').css('border','1px solid red');
							$('iframe[name=undefined]').css('border-radius','4px');
							window.scrollTo(0,document.body.scrollHeight);
						}
					}
				});
			}
			
        
		});
		
		$("#clipboard").click(function(){
		  $("#password").select();
		  document.execCommand("copy");
		  swal('','Password copied!');
		});
		
		$('input#back-link').click(function(){
			//remove warning back
			window.onbeforeunload = null;
		});
		
   });
</script>
<script>
	tinymce.init({ 
		selector:'textarea', 
		elementpath: false,
		menubar: false,
		height : 250
	});
</script>
<script>
	//Warning that work will be lost if you return to your browser
	window.onbeforeunload = function() { return "Your work will be lost."; };
</script>
<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
<?php include_once('footer.php'); ?>