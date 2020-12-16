$('#customFile').on('change',function(){
	//get the file name
	var fileName = $(this).val();
	//replace the "Choose a file" label
	$(this).next('.custom-file-label').html(fileName);
})

// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});

/*Tooltip*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
