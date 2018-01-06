$(document).ready(function(){
   $.widget.bridge('uibutton', $.ui.button);
   $('#forgotForm').hide();
   $('#login-form').on('click', function(){
       $('#forgotForm').slideUp("slow");
       $('#loginForm').slideDown("slow"); 
   });
   $("#forgot-form").on('click', function(){
       $('#loginForm').slideUp("slow");           
       $('#forgotForm').slideDown("slow");
   });
	if($('.popup-modal').length){
    $('.popup-modal').magnificPopup({
        type: 'inline',
        preloader: false,
        modal: true
    });
	}
    $(document).on('click', '.popup-modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });   
    $('#datepicker,.fa-calendar').datepicker({
        autoclose: true
    });
	if($('#example1').length)
    $("#example1").DataTable();
	if($('#example2').length)
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });    
});