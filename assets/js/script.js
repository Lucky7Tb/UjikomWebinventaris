const SideNav = document.querySelectorAll(".sidenav");

const DropDown = document.querySelectorAll(".dropdown-trigger");

const Options = {
	hover: true,
	alignment: "left",
	coverTrigger: false
};
const Select = document.querySelectorAll("select");

const Modals = document.querySelectorAll(".modal");

const loading = document.getElementById("preloader");

M.Sidenav.init(SideNav);

M.Modal.init(Modals);

M.Dropdown.init(DropDown, Options);

M.FormSelect.init(Select);

window.addEventListener("load", function() {
	loading.style.display = "none";
});

$(document).ready(function() {
	$(".btn-submit").click(function() {
		const url = $(".form").attr("action");
		const data = $(".form").serialize();
		$("#loader").show();
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			dataType: "json",
			success: function(response) {
				if (response.status == "failed") {
					M.toast({
						html: response.message,
						classes: "white-text red lighten-1 z-depth-3"
					});
					$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					$("#loader").hide();
				} else if (response.status == "success") {
					M.toast({
						html: response.message,
						classes: "white-text green lighten-1 z-depth-3"
					});
					$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					$("#itemname").val("");
					$("#itemammount").val("");
					$("#datatable").load("http://localhost/latujikomci/admin/table");
					$("#loader").hide();
				}
				console.log(response.message);
			}
		});
	});

	//Ajaxload content
	// $("#test").click(function(e) {
	// 	e.preventDefault();
	// 	$("#content").load("http://localhost/latujikomci/admin/test");
	// 	loading.style.display = "none";
	// });
});
