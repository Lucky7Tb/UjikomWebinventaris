const SideNav = document.querySelectorAll(".sidenav");

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
	$('.update_room').hide();
	$('.btn-cancel').hide();
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
					$("#datatable").load("http://localhost/latujikomci/admin/load_table");
					$(".right-align").load("http://localhost/latujikomci/admin/pagination");
				} else if (response.status == "updated") {
					M.toast({
						html: response.message,
						classes: "white-text green lighten-1 z-depth-3"
					});
					$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					$("#datatable").load("http://localhost/latujikomci/admin/load_table");
					$(".right-align").load("http://localhost/latujikomci/admin/pagination");
					$("#loader").hide();
				}
			}
		});
	});

	$(".btn-add_room").click(function (e) { 
		e.preventDefault();
		$("#room_form").attr("action", "http://localhost/latujikomci/admin/add_room");
		let url = $("#room_form").attr('action');
		let data = $("#room_form").serialize();
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			dataType: "json",
			success: function (response) {
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
				} else if (response.status == "success") {
					M.toast({
						html: response.message,
						classes: "white-text green lighten-1 z-depth-3"
					});
					$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					$("#room_name").val("");
					$("#room_desc").val("");
					$("#room_data").load("http://localhost/latujikomci/admin/load_room_table");
					$(".room_pagination").load("http://localhost/latujikomci/admin/room_pagination");
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

	$("#room_data").on('click', '.btn-update_room' ,function (e) { 
		e.preventDefault();
		$("#room_form").attr("action", "http://localhost/latujikomci/admin/update_room");
		let csrf = $("input[name=CSRFTOKENFQRPLN]").val();
		$('.btn-add_room').hide();
		$('.update_room').show();
		$('.btn-cancel').show();
		$.ajax({
			type: "POST",
			url: "http://localhost/latujikomci/admin/get_room",
			data: {
				id : $(this).data('id'),
				CSRFTOKENFQRPLN : csrf
			},
			dataType: "json",
			success: function (response) {
				$('#room_name').val(response.room[0].nama_ruang);
				$('#room_desc').val(response.room[0].keterangan);
				$('#room_id').val(response.room[0].id_ruang);
				$("input[name=CSRFTOKENFQRPLN]").val(response.token);
			}
		});
	});

	$(".update_room").click(function (e) { 
		e.preventDefault();
		let url = $("#room_form").attr('action');
		let data = $("#room_form").serialize();
		$.ajax({
			type: "POST",
			url: url,
			data: data,
			dataType: "json",
			success: function (response) {
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
				} else if (response.status == "updated") {
					M.toast({
						html: response.message,
						classes: "white-text green lighten-1 z-depth-3"
					});
					$("input[name=CSRFTOKENFQRPLN]").val(response.token);
					$("#room_name").val("");
					$("#room_desc").val("");
					$("#room_data").load("http://localhost/latujikomci/admin/load_room_table");
					$(".room_pagination").load("http://localhost/latujikomci/admin/room_pagination");
					$('.btn-add_room').show();
					$('.update_room').hide();
				}	
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
						$(".right-align").load("http://localhost/latujikomci/admin/pagination");
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

	$("#room_data").on("click", ".btn-delete_room", function(e) {
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
						$("#room_data").load("http://localhost/latujikomci/admin/load_room_table");
						$(".room_pagination").load("http://localhost/latujikomci/admin/room_pagination");
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

	$('.btn-cancel').click(function () { 
		$('.btn-add_room').show();
		$('.update_room').hide();
		$('#room_name').val('');
		$('#room_desc').val('');
		$(this).hide();
	});
	
	$("#search").on('keyup',function () {
		let data = $(this).val();
		let urisegment = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
		$(".image").show();
		if(data === ''){
			$(".image").hide();
			$("#datatable").load(`http://localhost/latujikomci/admin/load_table?uri=${urisegment}`);
		}else{
			$("#datatable").load(`http://localhost/latujikomci/admin/search_data?keyword=${data}`, function(){
				$(".image").hide();
			});
		}
	});

});

//Ajaxload content
// $("#test").click(function(e) {
// 	e.preventDefault();
// 	$("#content").load("http://localhost/latujikomci/admin/test");
// 	loading.style.display = "none";
// });
