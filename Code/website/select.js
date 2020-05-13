$(function() {
	// bind change event to select
	$('#dynamic_select').change(function() {
		var url = $(this).val(); // get selected value
		$.redirect('admin.php', {
			page: url,
		});
	});
});
