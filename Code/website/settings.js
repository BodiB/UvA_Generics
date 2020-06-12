$(document).ready(function() {

	// Add Class
	$('.edit').click(function() {
		$(this).addClass('editMode');
	});

	// Save data
	$(".edit").focusout(function() {
		$(this).removeClass("editMode");
		var id = this.id;
		var split_id = id.split("-");
		var field_name = split_id[0];
		var edit_id = split_id[1];
		var value = parseInt($(this).val());

		$.ajax({
			url: 'update_settings.php',
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

	});

	// Add Class
	$('.edit1').click(function() {
		$(this).addClass('editMode');
	});

	// Save data
	$(".edit1").focusout(function() {
		$(this).removeClass("editMode");
		var id = this.id;
		var split_id = id.split("-");
		var field_name = split_id[0];
		var edit_id = split_id[1];
		var value = ($(this).val());

		$.ajax({
			url: 'update_settings.php',
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

	});

	// Add Class
	$('.edit_scale').click(function() {
		$(this).addClass('editMode');
	});

	// Save data
	$(".edit_scale").focusout(function() {
		$(this).removeClass("editMode");
		var id = this.id;
		var split_id = id.split("-");
		var field_name = split_id[0];
		var edit_id = split_id[1];
		var value = parseInt($(this).val());
		var other_field = ((id.replace("min", "C")).replace("max", "min")).replace("C", "max");
		if ((((Math.abs(parseInt($("#" + other_field).val()) + parseInt(value)) + 1) % 2) == 0)) {
			$("#" + id).addClass("error");
			$("#" + other_field).addClass("error");
		} else {
			$("#" + id).removeClass("error");
			$("#" + other_field).removeClass("error");
			$.ajax({
				url: 'update_settings.php',
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
