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
		var value = $(this).text();

		$.ajax({
			url: 'update.php',
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

	$(".image_edit").change(function() {
		var id = this.id;
		var split_id = id.split("-");
		var field_name = split_id[0];
		var edit_id = split_id[1];
		var value = $(this).find(":selected").text();

		$.ajax({
			url: 'update.php',
			type: 'post',
			data: {
				field: field_name,
				value: 'img/' + value + '.PNG',
				id: edit_id
			},
			success: function(response) {
				console.log('Save successfully');
				location.reload();
			}
		});
	});

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
		} else {
			$("#" + id).removeClass("error");
			$("#" + other_field).removeClass("error");
			$.ajax({
				url: 'update.php',
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
