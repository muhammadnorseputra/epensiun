$(function() {
	$(".tanggal").datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true,
		todayHighlight: true,
		todayBtn: "linked"

	});
	$(".tanggal-waktu").datetimepicker({
		locale: 'id',
		showClear: true,
		showTodayButton: true,
		icons: {
			time: 'bi bi-clock',
            date: 'bi bi-calendar',
            up: 'bi bi-chevron-up',
            down: 'bi bi-chevron-down',
            previous: 'bi bi-chevron-left',
            next: 'bi bi-chevron-right',
            today: 'bi bi-calendar-check',
            clear: 'bi bi-trash-fill',
            close: 'bi bi-eraser-fill'
		}
	});
});

var TabelVerifikasiPesiun = $("#table-verifikasi").DataTable({
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
		url: `${_uri}/app/verifikasi/ajax`,
		type: "POST",
	},
	columnDefs: [
		{
			targets: [0, 1, 2, 3, 4, 5, 6, 7],
			orderable: false,
			className: "text-left",
		},
		// {
		// 	targets: [6],
		// 	orderable: false,
		// 	className: "text-center",
		// },
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

let $modalUbahStatus = $("#modalUbahStatusUsul"),
	$modalApprove = $("#modalApprove"),
	$formUbahStatus = $("form#FormUbahStatus"),
	$formApprove = $("form#FormApprove");

$modalUbahStatus.on("hidden.bs.modal", (event) => {
	$formUbahStatus[0].reset();
	changeStatus("");
});

$modalApprove.on("hidden.bs.modal", (event) => {
	$formApprove[0].reset();
});

function loadEffect(isLoading = true) {
	return `<div class="d-flex justify-content-start gap-5">
				<div class="placeholder avatar avatar-lg col-12 rounded-circle"></div>
				<div class="w-100">
					<span class="placeholder mb-2 col-6"></span>
					<span class="placeholder mb-2 w-100"></span>
					<span class="placeholder mb-4" style="width: 35%;"></span>
				</div>
			</div>`;
}

function changeStatus($val) {
	if ($val === "SELESAI_TMS" || $val === "SELESAI_BTL") {
		$(".field-catatan").removeClass("d-none");
		$("textarea[name='catatan']").attr('data-parsley-required', 'true').parsley();
	} else {
		$(".field-catatan").addClass("d-none");
		$("textarea[name='catatan']").val("").removeAttr('data-parsley-required').parsley();
	}

	if ($val === "TTD_SK") {
		$(".field-sk").removeClass("d-none");
		$("input[name='nomorsk']").attr('data-parsley-required', 'true').parsley();
		$("input[name='tanggalsk']").attr('data-parsley-required', 'true').parsley();
	} else {
		$(".field-sk").addClass("d-none");
		$("input[name='nomorsk']").val("").removeAttr('data-parsley-required').parsley();
		$("input[name='tanggalsk']").val("").removeAttr('data-parsley-required').parsley();
	}
}

function Approve(token) {
	$modalApprove.modal('show');
	let $container = $formApprove.find("#loadProfile");
	$container.html(loadEffect());
	$formApprove.find("input[name='token']").val(token);
	$.getJSON(
		`${_uri}/app/verifikasi/getprofileasn`,
		{ token: token },
		function (res) {
			if (res.status === true) {
				if(res.data.approve_at !== null) {
					$formApprove.find("input[name='tanggal_approve']").val(formatDateTimeSQLToIndo(res.data.approve_at));
				}
				$formApprove.find("input[name='nip']").val(res.data.nip);
				setTimeout(() => {
					$container.html(`
					<div class="d-flex align-items-start gap-2 mb-2 pb-3">
						<div>
							<div class="avatar avatar-lg">
								<img src="${res.data.url_photo}" alt="${res.data.nama}" class="rounded-circle"/>
							</div>
						</div>
						<div class="ms-3 lh-1">
							<h5 class="mb-1">
								<strong>${res.data.nip}</strong> <br>
								${res.data.nama} <br>
								<div class="text-secondary">${res.data.nama_unit_kerja}</div>
								<div class="d-flex flex-wrap justify-content-start gap-2 align-items-center mt-2">
									<div class="badge bg-secondary px-3 py-2 rounded text-white">Jenis Usul : ${res.data.nama_jenis.nama}</div>
									<div class="badge bg-info px-3 py-2 rounded text-white">Tanggal SK : ${formatDateSQLToIndo(res.data.tanggal_sk)}</div>
									<div class="badge bg-info px-3 py-2 rounded text-white">Nomor SK : ${res.data.nomor_sk}</div>
								</div>
							</h5>
						</div>
					</div>
					`);
				}, 1000);
			}
		}
	);
}

function UbahStatus(token) {
	$modalUbahStatus.modal("show");
	let $container = $formUbahStatus.find("#loadProfile");
	$container.html(loadEffect());
	$formUbahStatus.find("input[name='token']").val(token);
	$.getJSON(
		`${_uri}/app/verifikasi/getprofileasn`,
		{ token: token },
		function (res) {
			if (res.status === true) {
				// Cek is_status
				changeStatus(res.data.is_status);
				if (res.data.is_status === "SELESAI_TMS" || res.data.is_status === "SELESAI_BTL") {
					$formUbahStatus.find("textarea[name='catatan']").val(res.data.catatan);
					$formUbahStatus.find("select[name='status']").val(res.data.is_status);
				}

				if (res.data.is_status === "BKPSDM" || res.data.is_status === "TTD_SK"  || res.data.is_status === "SELESAI") {
					$formUbahStatus.find("input[name='nomorsk']").val(res.data.nomor_sk);
					if(res.data.tanggal_sk !== null) {
						$formUbahStatus.find("input[name='tanggalsk']").val(formatDateSQLToIndo(res.data.tanggal_sk));
					}
				}
				setTimeout(() => {
					$container.html(`
					<div class="d-flex align-items-start gap-2 mb-2 pb-3">
						<div>
							<div class="avatar avatar-lg">
								<img src="${res.data.url_photo}" alt="${res.data.nama}" class="rounded-circle"/>
							</div>
						</div>
						<div class="ms-3 lh-1">
							<h5 class="mb-1">
								<strong>${res.data.nip}</strong> <br>
								${res.data.nama} <br>
								<div class="text-secondary">${res.data.nama_unit_kerja}</div>
								<div class="badge bg-secondary px-3 py-2 mt-3 rounded text-white">Jenis Usul : ${res.data.nama_jenis.nama}</div>
								<div class="badge bg-secondary px-3 py-2 mt-3 rounded text-white">Status : ${res.data.is_status}</div>
							</h5>
						</div>
					</div>
					`);
				}, 1000);
			}
		}
	);
}

function Arsip(token) {
	$.confirm({
		title: 'Arsipkan',
		content: 'Apakah anda sudah menyerahkan SK kepada yang bersangkutan ?',
		type: 'green',
		theme: 'material',
		buttons: {
			sudah: function () {
				$.post(`${_uri}/app/verifikasi/arsipkan`, {token: token}, function(res) {
					if(res.status === true) {
						TabelVerifikasiPesiun.ajax.reload();
						return false;
					}
					$.alert({
						title: "Warning !",
						type: 'orange',
						theme: 'material',
						content: res.message,
						typeAnimated: true,
						autoClose: 'ok|5000'
					});
				}, 'json')
			},
			belum: function () {
				return;
			},
		}
	})
}
$formUbahStatus.find("select[name='status']").on("change", function () {
	let _ = $(this),
		$val = _.val();
	changeStatus($val);
});

$formUbahStatus.on("submit", function (e) {
	e.preventDefault();
	e.stopPropagation();
	let _ = $(this),
		$url = _.attr('action'),
		$data = _.serialize();
	if (_.parsley().isValid()) {
		$.post($url, $data, function(res) {
			if(res.status === true) {
				TabelVerifikasiPesiun.ajax.reload();
				$modalUbahStatus.modal("hide");
				return false;
			}
			alert(res.message)
		},'json')
	}
});

$formApprove.on("submit", function(e) {
	e.preventDefault();
	
	let _ = $(this),
	$url = _.attr('action'),
	$data = _.serialize();

	// state button cari
	let button = _.find("button[type='submit']");
	button
		.prop("disabled", true)
		.html(
			`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Approve`
		);

	if (!this.checkValidity()) {
		this.classList.add('was-validated');
		button
				.prop("disabled", false)
				.html(
					`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`
				);
		return false;
	}

	if (_.parsley().isValid()) {
		$.ajax({
			url: $url, 
			type: 'POST',
			dataType: 'json',
			data: new FormData($(this)[0]), // The form with the file inputs.
			processData: false,
			contentType: false,                    // Using FormData, no need to process data.
			cache: false,
			success: function(data, status, xhr) {
                if(data.status === true) {
					TabelVerifikasiPesiun.ajax.reload();
					$modalApprove.modal("hide");
					button
					.prop("disabled", false)
					.html(
						`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`
					);
					return false;
				}
				$("#loadMessage").html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
											${data.data.error}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>`);
				button
				.prop("disabled", false)
				.html(
					`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`
				);
            },
            error: function(xhr, status, error) {
                console.log(status);
				button
				.prop("disabled", false)
				.html(
					`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`
				);
            }
		  })
	}
})
