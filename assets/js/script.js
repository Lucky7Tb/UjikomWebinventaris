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
				$("#itemname").val("");
				$("#itemammount").val("");
				M.toast({
					html: "Data Berhasil Di Tambahkan"
				});
				$("input[name=CSRFTOKENFQRPLN]").val(response.token);
				$("#loader").hide();
				$("#datatable").load("http://localhost/latujikomci/admin/table");
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
