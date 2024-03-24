var TabelArsip = $("#table-arsip").DataTable({
	processing: true,
	serverSide: true,
	paging: true,
	ordering: true,
	info: true,
	searching: true,
	deferRender: true,
	pagingType: "full_numbers",
    stateSave: true,
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
		url: `${_uri}/app/arsip/ajax`,
		type: "POST",
	},
	columnDefs: [
		{
			targets: [0, 1, 2, 3, 4],
			orderable: false,
			className: "text-left",
		}
	],
	language: {
		lengthMenu: "_MENU_ Data per halaman",
		zeroRecords: "Belum Ada Usulan Pensiun",
		info: "Showing page _PAGE_ of _PAGES_",
		infoEmpty: "Belum Ada Usulan Pensiun",
		infoFiltered: "(filtered from _MAX_ total records)",
		search: "Masukan NIP/Nama",
		paginate: {
			previous: `<i class="bi bi-arrow-bar-left"></i>`,
			next: `<i class="bi bi-arrow-bar-right"></i>`,
		},
		emptyTable: "No matching records found, please filter this data",
	},
});

function UnArsip(token) {
	iziToast.question({
		timeout: 20000,
		close: false,
		theme: 'light',
		color: 'green',
		overlay: true,
		icon: 'bi bi-archive',
		displayMode: 'once',
		id: 'question',
		zindex: 999,
		title: 'Unarsip',
		message: 'Mengembalikan ke inbox bkpsdm atau verifikasi usul',
		position: 'center',
		buttons: [
			['<button><b>OKE</b></button>', function (instance, toast) {
	 
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
				$.post(`${_uri}/app/arsip/unarchive`, {token: token}, function(res) {
					TabelArsip.ajax.reload();
					iziToast.success({
						timeout: 3000,
						title: "Berhasil",
						position: "topCenter",
						icon: 'bi bi-check-circle-fill',
						message: res.message,
						transitionIn: 'fadeInDown',
						transitionOut: 'fadeOutUp',
						pauseOnHover: false,
						// onClosing: function(instance, toast, closedBy){
						// }
					});
				}, 'json');
	 
			}, true],
			['<button>BATAL</button>', function (instance, toast) {
	 
				instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
	 
			}],
		]
	});
}