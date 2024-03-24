<!--Created by Moacir Henrique-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <!--Special Characters-->
      <meta charset="utf-8">
      <!--Mobile Meta-->
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
      <!--META Info-->
      <meta name="title" content="iKofr">
      <meta name="description" content="iKofr is a free service for sending messages anonymously and quietly.">
	  <meta name="keywords" content="ikofr, send anonymous text message, anonymous message, encrypted messaging, encrypted message, 3 days, 3 times, free service">
      <!-- Bootstrap Core CSS -->
      <link href="<?php echo base_url().'assets/css/bootstrap.css'; ?>" rel="stylesheet">
      <link href="<?php echo base_url().'assets/css/sweetalert.css'; ?>" rel="stylesheet">
      <link href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>" rel="stylesheet">
      <!--Apple Tags-->
      <meta name="apple-mobile-web-app-capable" content="yes">
      <!--Só para iOS, aplicativo html5. https://goo.gl/FcXOja-->
      <link rel="apple-touch-icon" href="<?php echo base_url().'assets/imgs/custom_icon.png'; ?>">
      <link rel="apple-touch-icon" href="<?php echo base_url().'assets/imgs/iphone-icon.png'; ?>">
      <!--<link rel="apple-touch-icon-precomposed" href="imgs/icon">-->
      <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url().'assets/imgs/touch-icon-ipad.png'; ?>">
      <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url().'assets/imgs/touch-icon-iphone-retina.png'; ?>">
      <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url().'assets/imgs/touch-icon-ipad-retina.png'; ?>">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-status-bar-style" content="white">
      <link rel="apple-touch-startup-image" href="<?php echo base_url().'assets/imgs/startup.png'; ?>">
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
      <script type="text/javascript">
         if(("standalone" in window.navigator) && window.navigator.standalone){         
            var noddy, remotes = false;
            document.addEventListener('click', function(event) {         
               noddy = event.target;         
               while(noddy.nodeName !== "A" && noddy.nodeName !== "HTML") {
                  noddy = noddy.parentNode;
               }         
               if('href' in noddy && noddy.href.indexOf('http') !== -1 && (noddy.href.indexOf(document.location.host) !== -1 || remotes)) {
                  event.preventDefault();
                  document.location.href = noddy.href;
               }         
            },false);
         }
      </script>
      <script src="https://cdn.tiny.cloud/1/kfe827c54vrkxuw8jx9vurlsph3s0ktxjku729nwmugr9otg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <!-- Latest compiled JavaScript -->
      <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="<?php echo base_url().'assets/js/sweetalert.min.js'; ?>"></script>
      <script src="<?php echo base_url().'assets/js/ikofr.js?version=3'; ?>"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript">
         $(document).ready(function(){
             $('[data-toggle="popover"]').popover({
                 placement : 'top'
             });
         });
      </script>
      <!--Responsive Elements-->
      <link href="<?php echo base_url().'assets/css/responsive.css'; ?>" rel="stylesheet">
      <!--Favicon-->
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'assets/imgs/favicon.ico'; ?>">
      <link rel="shortcut icon" type="image/png" href="<?php echo base_url().'assets/imgs/favicon.png'; ?>">
      <!--Font Awesome-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <!--Title of the page-->
      <title>iKofr</title>
   </head>
   <body>