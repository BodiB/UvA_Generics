$(document).ready(function() {

	$(".num_edit").focusout(function() {
		$(this).removeClass("editMode");
		var id = this.id;
		var split_id = id.split("-");
		var field_name = split_id[0];
		var edit_id = split_id[1];
		var value = parseInt($(this).val());
		var other_field = ((id.replace("A", "C")).replace("B", "A")).replace("C", "B");
		if ((parseInt($("#" + other_field).val()) + parseInt(value)) > 100) {
			$("#" + id).addClass("error");
			$("#" + other_field).addClass("error");
			var x = document.getElementById("snackbar");
			// Add the "show" class to DIV
			x.className = "show";

			// After 3 seconds, remove the show class from DIV
			setTimeout(function() {
				x.className = x.className.replace("show", "");
			}, 3000);
		} else {
			$("#" + id).removeClass("error");
			$("#" + other_field).removeClass("error");
			$.ajax({
				url: 'update_features.php',
				type: 'post',
				data: {
					field: field_name,
					value: value,
					id: edit_id
				},
				success: function(response) {
					console.log('Save successfully');
				}
			});
		}

	});
});
