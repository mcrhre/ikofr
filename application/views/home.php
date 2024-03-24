<?php include_once('header.php'); ?>
<img src="<?php echo base_url().'assets/imgs/about.png'; ?>" class="mabout" onclick="ikofr_info();" />
<div class="jumbotron text-center" style="background-color: #202020; padding-top: 80px;">
    <div class="container">
        <div class="row">
            <div class="col col-lg-12 col-sm-12">
                <img src="<?php echo base_url().'assets/imgs/logo.png'; ?>" class="mlogo">
            </div>
        </div>
    </div>
</div>
<div class="span6 offset3">
    <div class="well mpanel">
        <div class="row">
            <table class="mtable" align="center">
                <tr>
                    <td align="center">
                        <div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-success" id="eye" type="button" style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;height: 34px;padding-right: 15px;">
									<i class="fa fa-eye-slash" aria-hidden="true" id="eye-password"></i>
								</button>
                     		</span>
                           <input type="password" class="form-control mform" id="password" maxlength="10" placeholder="Password" value="">
                           <span class="input-group-btn">
                     			<button class="btn btn-info" id="search" type="button" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;height: 34px;padding-right: 15px;">
									<i class="fa fa-search"></i>
								</button>
                     		</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-top: 40px;">
                        <a href="<?php echo base_url().'message/new_message'; ?>">
                            <button class="btn btn-success" type="button">New Message &nbsp;<i class="fa fa-envelope"></i></button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<br>
<script type="text/javascript">
   $(function(){

     $('#password').keypress(function (e) {
        if (e.which == 13) {
          $('#search').click();
          return false;
        }
      });
		$("#search").click(function(){

			password_form = $.trim($("#password").val());

			if (password_form != ''){
				swal({
					title: "",
					text: "Searching Message",
					imageUrl: "<?php echo base_url().'assets/imgs/loading.gif'; ?>",
					showConfirmButton: false
				});
				$.ajax({
					url: '<?php echo base_url(); ?>' + 'message/search',
					type: 'POST',
					data: {password: password_form},
					datatype: 'json',
					success: function(data){
						var data = $.parseJSON(data);
						if(data.error == 0){
							window.location.replace('<?php echo base_url(); ?>' + 'message/open/');
						}else{
							swal("", data.result, "error");
						}
					}
				});
			}
		});		
		$("#eye").click(function(){
			$('#eye-password').toggleClass('fa-eye-slash');
			$('#eye-password').toggleClass('fa-eye');
			password_toggle('#password');		});
   });
</script>
<?php include_once('popover.php'); ?>
<?php include_once('footer.php'); ?>
