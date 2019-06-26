$(document).ready(function() {
	const FlashData = $(".flash-data").data("flashdata");
	const FlashDataSuccess = $(".flash-data-success").data("flashdatasuccess");

	if (FlashData) {
		Swal.fire({
			type: 'error',
			title: 'Error',
			text: FlashData
		});
	}

	if (FlashDataSuccess) {
		Swal.fire({
			type: 'success',
			title: 'Success',
			text: FlashDataSuccess
		}).getConfirmButton();
	
	}
});
