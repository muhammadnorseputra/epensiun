$(window).on("load", function() {
	getJumlahUsulByStatus();
})

var TabelUsulPesiun = $("#table-inbox").DataTable({
	processing: true,
	serverSide: true,
	paging: true,
	ordering: true,
	info: true,
	searching: true,
	deferRender: true,
	stateSave: true,
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

function loadEffect(isLoading = true) {
	return `<span class="placeholder col-12 rounded"></span>`;
}

function refresh () {
	TabelUsulPesiun.ajax.reload();
	getJumlahUsulByStatus();
}

function DetailNotApprove(token) {
	$.confirm({
		title: 'Catatan',
		type: 'orange',
		lazyOpen: false,
		theme: 'material',
		content: `url:${_uri}/app/inbox/catatan?token=${token}`,
		contentLoaded: function(data, status, xhr){
			// data is already set in content
			this.setContentAppend(data.catatan);
		},
		buttons: {
			ok: function() {
				
			}
		}
	});
}

function getJumlahUsulByStatus() {
	// GET ATTERIBUTE
	let jumlah_pengantar = $("h1#jumlah_pengantar"),
	jumlah_usul = $("h1#jumlah_usul"),
	jumlah_verify = $("h1#jumlah_verify"),
	jumlah_ttd = $("h1#jumlah_ttd");

	jumlah_pengantar.html(loadEffect)
	jumlah_usul.html(loadEffect)
	jumlah_verify.html(loadEffect)
	jumlah_ttd.html(loadEffect)
	$.getJSON(`${_uri}/app/inbox/getJumlahUsulByStatus`, function(res){
		
		// PARSE KE HTML
		jumlah_pengantar.text(res.jumlah_pengantar)
		jumlah_usul.text(res.jumlah_usul)
		jumlah_verify.text(res.jumlah_verify)
		jumlah_ttd.text(res.jumlah_ttd)
	});
}

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
								refresh()
							}
						},
						"json"
					);
				}
			},
			batal: {
				text: '<i class="bi bi-x-lg me-2"></i> Batal',
				action: function() {
					refresh()
				}
			},
		}
	});
}
