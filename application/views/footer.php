		<script type="text/javascript">
			 $(function() {
				  $('[data-toggle=popover]').popover({
				      trigger: 'focus',
				      html: true,
				      title: 'Toolbox'
				  });
			 });
			 function ikofr_info(){
				swal({
					title: "About iKofr",
					text: "<div style='font-size: 12px;'>iKofr is a free service for sending messages anonymously and quietly.<br /><br />"+
					"<ul style='text-align:left'><li>All the messages are encrypted.</li><br /><li>After <b>3 days</b> the message is completly deleted from our servers.</li><br />"+
					"<li>You can only open a message <b>3 times</b>, after that the message will be completly deleted.</li><br />"+
					"<li>You can send files up to <b>5 MB<b/>"+
					"</ul></div>",
					html: true
				});
			 }
		</script>
		<!-- Piwik -->
		<script type="text/javascript">
			/*
		  var _paq = _paq || [];
		  _paq.push(['trackPageView']);
		  _paq.push(['enableLinkTracking']);
		  (function() {
			var u="//cluster-piwik.locaweb.com.br/";
			_paq.push(['setTrackerUrl', u+'piwik.php']);
			_paq.push(['setSiteId', 11643]);
			var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
			g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
		  })();*/
		</script>
		<!-- End Piwik Code -->
	</body>

</html>
