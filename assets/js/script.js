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
		const item = $("#itemname").val();
		const itemammount = $("#itemammount").val();
		const conditions = $("#conditions").val();
		const type = $("#type").val();
		const room = $("#room").val();
		const csrfval = $("#csrf").attr("value");
		$.ajax({
			type: "POST",
			url: url,
			data: {
				item: item,
				itemammount: itemammount,
				conditions: conditions,
				type: type,
				room: room,
				ZjJlNTY2OTc4ZTk0YzE4MmEzMzVjNzNlYzkxMjAzZDk: csrfval
			},
			dataType: "json",
			success: function() {
				document.location.href =
					"http://localhost/latujikomci/admin/index.html";
			}
		});
	});
});
