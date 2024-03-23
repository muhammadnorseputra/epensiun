var TabelUsulPesiun = $("#table-inbox").DataTable({
	processing: true,
	serverSide: true,
	paging: true,
	ordering: true,
	info: true,
	searching: true,
	deferRender: true,
	pagingType: "full_numbers",
	responsive: true,
	datatype: "json",
	// "scrollY": "800px",
	scrollCollapse: true,
	lengthMenu: [
		[10, 25, 50, -1],
		[10, 25, 50, "All"],
	],
	order: [],
	ajax: {
		url: `${_uri}/app/inbox/ajax`,
		type: "POST",
	},
	columnDefs: [
		{
			targets: [0, 1, 2, 3, 4, 5],
			orderable: false,
			className: "text-left",
		},
	],
	language: {
		lengthMenu: "_MENU_ Data per halaman",
		info: "Showing page _PAGE_ of _PAGES_",
		infoFiltered: "(filtered from _MAX_ total records)",
		search: "Masukan NIP/Nama",
		paginate: {
			previous: `<i class="bi bi-arrow-bar-left"></i>`,
			next: `<i class="bi bi-arrow-bar-right"></i>`,
		},
		emptyTable: "No matching records found, please filter this data",
	},
});

function Hapus(token) {
	$.confirm({
		title: 'Hapus ?',
		content: 'Apakah anda yakin akan menghapus usulan tersebut ?',
		type: 'orange',
		theme: 'material',
		buttons: {
			hapus: {
				text: '<i class="bi bi-trash me-2"></i> Hapus',
				btnClass: 'btn-lg btn-danger',
				action: function () {
					$.post(
						`${_uri}/app/inbox/hapus`,
						{ token: token },
						function (res) {
							if (res.status === true) {
								iziToast.success({
									timeout: 2000,
									title: 'Berhasil',
									position: 'topCenter',
									message: 'Usulan telah dihapus',
									transitionOut: 'fadeOutDown',
									pauseOnHover: false,
								});
								TabelUsulPesiun.ajax.reload();
							}
						},
						"json"
					);
				}
			},
			batal: {
				text: '<i class="bi bi-x-lg me-2"></i> Batal',
				action: function() {
					TabelUsulPesiun.ajax.reload();
				}
			},
		}
	});
}
