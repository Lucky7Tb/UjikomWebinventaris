$(document).ready(function() {
	const FlashData = $(".flash-data").data("flashdata");
	const FlashDataSuccess = $(".flash-data-success").data("flashdatasuccess");

	if (FlashData) {
		swal({
			title: "Error",
			icon: "error",
			text: FlashData
		});
	}

	if (FlashDataSuccess) {
		swal({
			title: "Success",
			icon: "success",
			text: FlashDataSuccess
		});
	}
});
