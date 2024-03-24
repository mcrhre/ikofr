<!--Pop Over-->
<div align="center" style="color: white; opacity: 0.8; font-size: 12px; margin-top: 50px; margin-bottom: 40px">
   2016 © &nbsp;<strong>iKofr</strong>
</div>
<!--Programmer: Moacir Henrique-->
<script type="text/javascript">
   function centerModal() {
     $(this).css('display', 'block');
     var $dialog = $(this).find(".modal-dialog");
     var offset = ($(window).height() - $dialog.height()) / 2;
     // Center modal vertically in window
     $dialog.css("margin-top", offset);
   }
   
   $('.modal').on('show.bs.modal', centerModal);
   $(window).on("resize", function () {
     $('.modal:visible').each(centerModal);
   });
</script>
<script type="text/javascript">
   function centerModal() {
     $(this).css('display', 'block');
     var $dialog2 = $(this).find(".modal-dialog");
     var offset = ($(window).height() - $dialog2.height()) / 2;
     // Center modal vertically in window
     $dialog.css("margin-top", offset);
   }
   
   $('.modal2').on('show.bs.modal', centerModal);
   $(window).on("resize", function () {
     $('.modal2:visible').each(centerModal);
   });
</script>
