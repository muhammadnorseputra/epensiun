$(function () {
	$(".tanggal").datepicker({
		format: "dd/mm/yyyy",
		autoclose: true,
		todayHighlight: true,
		todayBtn: "linked",
		clearBtn: true,
		keepEmptyValues: true,
	});
	$(".tanggal-waktu").datetimepicker({
		locale: "id",
		showClear: true,
		showTodayButton: true,
		icons: {
			time: "bi bi-clock",
			date: "bi bi-calendar",
			up: "bi bi-chevron-up",
			down: "bi bi-chevron-down",
			previous: "bi bi-chevron-left",
			next: "bi bi-chevron-right",
			today: "bi bi-calendar-check",
			clear: "bi bi-trash-fill",
			close: "bi bi-eraser-fill",
		},
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
		$("textarea#floatingTextarea")
			.attr("data-parsley-required", "true")
			.parsley();
	} else {
		$(".field-catatan").addClass("d-none");
		$("textarea#floatingTextarea")
			.val("")
			.removeAttr("data-parsley-required")
			.parsley();
	}

	if ($val === "TTD_SK") {
		$(".field-sk").removeClass("d-none");
		$("input[name='nomorsk']").attr("data-parsley-required", "true").parsley();
		$("input[name='tanggalsk']")
			.attr("data-parsley-required", "true")
			.parsley();

		$("input[name='tglmeninggal']")
			.attr("data-parsley-required", "true")
			.parsley();
		$("input[name='tmt_pensiun']")
			.attr("data-parsley-required", "true")
			.parsley();
		$("input[name='namakeluarga']")
			.attr("data-parsley-required", "true")
			.parsley();
		$("select[name='hubkeluarga']")
			.attr("data-parsley-required", "true")
			.parsley();
		$("input[name='tgl_lahir_penerima']")
			.attr("data-parsley-required", "true")
			.parsley();
		$("textarea[name='alamat_pensiun']")
			.attr("data-parsley-required", "true")
			.parsley();
	} else {
		$(".field-sk").addClass("d-none");
		$("input[name='nomorsk']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("input[name='tanggalsk']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("input[name='tglmeninggal']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("input[name='tmt_pensiun']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("input[name='namakeluarga']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("select[name='hubkeluarga']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("input[name='tgl_lahir_penerima']")
			.removeAttr("data-parsley-required")
			.parsley();
		$("textarea[name='alamat_pensiun']")
			.removeAttr("data-parsley-required")
			.parsley();
	}
}

function Approve(token) {
	$modalApprove.modal("show");
	let $container = $formApprove.find("#loadProfile");
	$container.html(loadEffect());
	$formApprove.find("input[name='token']").val(token);
	$.getJSON(
		`${_uri}/app/verifikasi/getprofileasn`,
		{ token: token },
		function (res) {
			if (res.status === true) {
				if (res.data.approve_at !== null) {
					$formApprove
						.find("input[name='tanggal_approve']")
						.val(formatDateTimeSQLToIndo(res.data.approve_at));
				}
				$formApprove.find("input[name='nip']").val(res.data.nip);

				let download = $("div#filesk");
				if(res.data.url_sk !== null) {
					download.removeClass('d-none')
					download.find("#filename").text(`/fileskpensiun/${res.data.nip}.pdf`);
					download.find("a#filename-link").attr('href', res.data.url_sk)
				} else {
					download.addClass('d-none');
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
								<div class="d-flex flex-wrap justify-content-start gap-2 align-items-center mt-2">
									<div class="badge bg-secondary px-3 py-2 rounded text-white">Jenis Usul : ${
										res.data.nama_jenis.nama
									}</div>
									<div class="badge bg-secondary px-3 py-2 rounded text-white">Keterangan : ${
										res.data.nama_jenis.keterangan
									}</div>
									<div class="badge bg-info px-3 py-2 rounded text-white">Tanggal SK : ${formatDateSQLToIndo(
										res.data.tanggal_sk
									)}</div>
									<div class="badge bg-info px-3 py-2 rounded text-white">Nomor SK : ${
										res.data.nomor_sk
									}</div>
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
				if (
					res.data.is_status === "SELESAI_TMS" ||
					res.data.is_status === "SELESAI_BTL"
				) {
					$formUbahStatus
						.find("textarea#floatingTextarea")
						.val(res.data.catatan);
						$formUbahStatus.find("select[name='status']").val(res.data.is_status);
				}

				if (
					res.data.is_status === "BKPSDM" ||
					res.data.is_status === "TTD_SK" ||
					res.data.is_status === "SELESAI"
				) {
					$formUbahStatus.find("input[name='nomorsk']").val(res.data.nomor_sk);
					$formUbahStatus.find("select[name='status']").val(res.data.is_status);

					if (res.data.tanggal_sk !== null) {
						$formUbahStatus
							.find("input[name='tanggalsk']")
							.datepicker("setDate", formatDateSQLToIndo(res.data.tanggal_sk));
					}

					if (res.data.tgl_meninggal !== null) {
						$formUbahStatus
							.find("input[name='tglmeninggal']")
							.datepicker(
								"setDate",
								formatDateSQLToIndo(res.data.tgl_meninggal)
							);
					}

					if (res.data.tmt_pensiun !== null) {
						$formUbahStatus
							.find("input[name='tmt_pensiun']")
							.datepicker("setDate", formatDateSQLToIndo(res.data.tmt_pensiun));
					}

					if (res.data.tgl_lahir_penerima !== null) {
						$formUbahStatus
							.find("input[name='tgl_lahir_penerima']")
							.datepicker(
								"setDate",
								formatDateSQLToIndo(res.data.tgl_lahir_penerima)
							);
					}

					$formUbahStatus
						.find("input[name='namakeluarga']")
						.val(res.data.nama_penerima);
					$formUbahStatus
						.find("select[name='hubkeluarga']")
						.val(res.data.hub_keluarga);
					$formUbahStatus
						.find("textarea[name='alamat_pensiun']")
						.val(res.data.alamat_pensiun);
					$formUbahStatus.find("textarea[name='note']").val(res.data.catatan);
				}

				if (res.data.nama_jenis.id === "6") {
					$("#tglmeninggal").removeClass("d-none");
					$("select[name='hubkeluarga'] option[value='YBS']").prop(
						"disabled",
						true
					);
				} else {
					$("#tglmeninggal").addClass("d-none");
					$("select[name='hubkeluarga'] option[value='YBS']").prop(
						"disabled",
						false
					);
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
								<div class="badge bg-secondary px-3 py-2 mt-1 rounded text-white">Keterangan : ${res.data.nama_jenis.keterangan}</div>
								<div class="badge bg-success px-3 py-2 mt-3 rounded text-white">Status : ${res.data.is_status}</div>
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
		title: "Arsipkan",
		content:
			"Apakah anda yakin akan mengarsipkan Usulan tersebut ? atau anda sudah menyerahkan SK kepada yang bersangkutan ?",
		type: "green",
		theme: "material",
		animation: "bottom",
		closeAnimation: "bottom",
		animateFromElement: false,
		animationSpeed: 200,
		buttons: {
			ok: {
				text: '<i class="bi bi-check-circle-fill me-2"></i> Ok',
				btnClass: "btn-success",
				action: function () {
					$.post(
						`${_uri}/app/verifikasi/arsipkan`,
						{ token: token },
						function (res) {
							if (res.status === true) {
								TabelVerifikasiPesiun.ajax.reload();
								iziToast.success({
									timeout: 3000,
									title: "Berhasil",
									position: "topCenter",
									message: res.message,
									transitionIn: 'fadeInDown',
									transitionOut: 'fadeOutUp',
									pauseOnHover: false,
									// onClosing: function(instance, toast, closedBy){
									// }
								});
								return false;
							}
							$.alert({
								title: "Warning !",
								type: "orange",
								theme: "material",
								content: res.message,
								typeAnimated: true,
								autoClose: "ok|5000",
							});
						},
						"json"
					);
				},
			},
			batal: {
				text: '<i class="bi bi-x-lg me-2"></i>Batal',
				btnClass: "btn-danger",
				action: function () {
					return;
				},
			},
		},
	});
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
		$url = _.attr("action"),
		$data = _.serialize();
	if (_.parsley().isValid()) {
		$.post(
			$url,
			$data,
			function (res) {
				if (res.status === true) {
					TabelVerifikasiPesiun.ajax.reload();
					iziToast.success({
						timeout: 3000,
						title: "Berhasil",
						position: "topCenter",
						message: res.message,
						transitionIn: "fadeInDown",
						transitionOut: "fadeOutUp",
						pauseOnHover: false,
						onOpening: function () {
							$modalUbahStatus.modal("hide");
						},
						onOpened: function () {
							TabelVerifikasiPesiun.ajax.reload();
						},
					});
					return false;
				}
				iziToast.warning({
					timeout: 3000,
					title: "Berhasil",
					position: "topCenter",
					message: res.message,
					transitionIn: "fadeInDown",
					transitionOut: "fadeOutUp",
					pauseOnHover: false,
				});
			},
			"json"
		);
	}
});

$formApprove.on("submit", function (e) {
	e.preventDefault();

	let _ = $(this),
		$url = _.attr("action"),
		$data = _.serialize();

	// state button cari
	let button = _.find("button[type='submit']");
	button
		.prop("disabled", true)
		.html(
			`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Approve`
		);

	if (!this.checkValidity()) {
		this.classList.add("was-validated");
		button
			.prop("disabled", false)
			.html(`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`);
		return false;
	}

	if (_.parsley().isValid()) {
		$.ajax({
			url: $url,
			type: "POST",
			dataType: "json",
			data: new FormData($(this)[0]), // The form with the file inputs.
			processData: false,
			contentType: false, // Using FormData, no need to process data.
			cache: false,
			success: function (data, status, xhr) {
				if (data.status === true) {
					button
						.prop("disabled", false)
						.html(`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`);
					iziToast.success({
						timeout: 3000,
						title: "Berhasil",
						position: "topCenter",
						message: data.message,
						transitionIn: 'fadeInDown',
						transitionOut: 'fadeOutUp',
						pauseOnHover: false,
						onOpening: function () {
							TabelVerifikasiPesiun.ajax.reload();
						},
						onOpened: function () {
							$modalApprove.modal("hide");
						},
					});
					return false;
				}
				$("#loadMessage")
					.html(`<div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
											${data.data.error}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>`);
				button
					.prop("disabled", false)
					.html(`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`);
			},
			error: function (xhr, status, error) {
				iziToast.error({
					timeout: 4000,
					title: "Berhasil",
					position: "topCenter",
					message: `${status} ${error}`,
					transitionIn: 'fadeInDown',
					transitionOut: 'fadeOutUp',
					pauseOnHover: true,
				});
				button
					.prop("disabled", false)
					.html(`<i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve`);
			},
		});
	}
});
