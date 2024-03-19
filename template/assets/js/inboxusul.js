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
		zeroRecords: "Belum Ada Usulan Pensiun",
		info: "Showing page _PAGE_ of _PAGES_",
		infoEmpty: "Belum Ada Usulan Pensiun",
		infoFiltered: "(filtered from _MAX_ total records)",
		search: "Masukan NIP/Nama",
		paginate: {
			previous: `<i class="fa fa-long-arrow-left"></i>`,
			next: `<i class="fa fa-long-arrow-right"></i>`,
		},
		emptyTable: "No matching records found, please filter this data",
	},
});

function Hapus(token) {
	let msg = "Apakah anda yakin akan menghapus usulan tersebut ?";
	if (confirm(msg)) {
		$.post(
			`${_uri}/app/inbox/hapus`,
			{ token: token },
			function (res) {
				if (res.status === true) {
					TabelUsulPesiun.ajax.reload();
				}
			},
			"json"
		);
		return false;
	}
}
