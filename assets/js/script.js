const SideNav = document.querySelectorAll(".sidenav");
console.log(window.location.href.substr(window.location.href.lastIndexOf('/') + 1));
const DropDown = document.querySelectorAll(".dropdown-trigger");

const Options = {
	hover: true,
	alignment: "right",
	coverTrigger: false
};

const Collaps = document.querySelectorAll('.collapsible');
const Select = document.querySelectorAll("select");

const Modals = document.querySelectorAll(".modal");

const loading = document.getElementById("preloader");

M.Sidenav.init(SideNav);

M.Modal.init(Modals);

M.FormSelect.init(Select);

M.Collapsible.init(Collaps);

M.Dropdown.init(DropDown, Options);

window.addEventListener("load", function() {
	loading.style.display = "none";
});

$(document).ready(function() {
	let FlashData = $(".flash").data("flashdata");
	if (FlashData) {
		Swal.fire({
			type: "success",
			title: "Success",
			text: FlashData
		});
	}

	$(".btn-add").click(function() {
		$(".form").attr("action", "http://localhost/latujikomci/admin/add_data");
		$("#title").html("Tambah Data");
		$(".btn-submit").html("Submit");
		$("#itemname").val("");
		$("#itemammount").val("");
	});

	$(".btn-submit").click(function() {
		let url = $(".form").attr("action");
		let data = $(".form").serialize();
		let id = {id : window.location.href.substr(window.location.href.lastIndexOf('/') + 1)};
		$("#loader").show();
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			dataType: "json",
			success: function(response) {
				if (response.status == "failed") {
					$.each(response.message, function(index, value) {
						if (value) {
							M.toast({
								html: value,
								classes: "white-text red lighten-1 z-depth-3"
							});
						}
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
					$("#loader").hide();
					$("#datatable").load("http://localhost/latujikomci/admin/load_table?id="+id.id);
					$.get("http://localhost/latujikomci/admin/pagination", id,
						function (data) {
							console.log(data);
							$(".right-align").html(data);
						},
						'html'
					);
					// $(".right-align").load("http://localhost/latujikomci/admin/pagination?id="+id.id);
				} else if (response.status == "updated") {
					M.toast({
						html: response.message,
						classes: "white-text green lighten-1 z-depth-3"
					});
					$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					$("#datatable").load("http://localhost/latujikomci/admin/load_table");
					$("#loader").hide();
				}
			}
		});
	});

	$("#datatable").on("click", ".btn-update", function(e) {
		e.preventDefault();
		$(".form").attr("action", $(this).attr("href"));
		$(".btn-submit").html("Update");
		$("#title").html("Update Data");
		let csrf = $("input[name=CSRFTOKENFQRPLN]").val();
		$.ajax({
			type: "POST",
			url: "http://localhost/latujikomci/admin/get_data",
			data: {
				id: $(this).data("id"),
				CSRFTOKENFQRPLN: csrf
			},
			dataType: "json",
			success: function(response) {
				$("input[name=CSRFTOKENFQRPLN]").val(response.token);
				$("#itemid").val(response.item[0].id_detail_barang);
				$("#itemname").val(response.item[0].nama_barang);
				$("#itemammount").val(response.item[0].jumlah_barang);
				$("#conditions").val(response.item[0].kondisi_barang);
				$("#room").val(response.item[0].id_ruang);
				$("#type").val(response.item[0].id_jenis);
				M.FormSelect.init(Select);
			}
		});
	});

	$("#datatable").on("click", ".btn-delete", function(e) {
		e.preventDefault();
		Swal.fire({
			title: "Yakin ingin menghapusnya?",
			text: "Data akan di hapus secara permanent",
			type: "warning",
			confirmButtonColor: "#1e88e5",
			cancelButtonColor: "#d33",
			showCancelButton: true,
			confirmButtonText: "Delete",
			preConfirm: () => {
				$.ajax({
					type: "POST",
					url: $(this).attr("href"),
					data: {
						id: $(this).data("id"),
						CSRFTOKENFQRPLN: $("input[name=CSRFTOKENFQRPLN]").val()
					},
					dataType: "json",
					success: function(response) {
						$("#datatable").load("http://localhost/latujikomci/admin/load_table");
						$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					}
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		}).then(result => {
			if (result.value) {
				Swal.fire({
					title: "Berhasil",
					text: "Data berhasil di hapus",
					type: "success"
				});
			}
		});
	});
});

//Ajaxload content
// $("#test").click(function(e) {
// 	e.preventDefault();
// 	$("#content").load("http://localhost/latujikomci/admin/test");
// 	loading.style.display = "none";
// });
