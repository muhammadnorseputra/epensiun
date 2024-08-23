$(function () {
	$(".tanggal").datepicker({
		format: "dd/mm/yyyy",
		todayBtn: "linked",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
	});

	$("[maxlength]").maxlength({
		alwaysShow: true,
		threshold: 30,
		warningClass: "badge bg-success rounded-sm mt-2",
		limitReachedClass: "badge bg-danger rounded-sm mt-2",
		placement: 'bottom-right-inside',
		// preText: '<i class="bi bi-arrow-up-right-circle-fill text-white me-1"></i>',
		postText: '<i class="bi bi-check-circle-fill text-white ms-1"></i>',
	});

	let $formStep1 = $("form#FormPengantar"),
		$formCariNip = $("form#FormCariNip"),
		$formSaveASN = $("#FormSaveAsn"),
		$formKirimUsul = $("#FormKirimUsulan");

	$formStep1.on("submit", function (e) {
		e.preventDefault();
		e.stopPropagation();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize();

		// state button cari
		let button = _.find("button[type='submit']");

		button
			.prop("disabled", true)
			.html(
				`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Simpan & Lanjutkan`
			);
		if (_.parsley().isValid()) {
			$.post(
				$url,
				$data,
				function (res) {
					if (res.status === true) {
						setTimeout(() => {
							window.location.href = res.redirect;
						}, 3000);
						iziToast.success({
							timeout: 3000,
							title: "Berhasil",
							position: "topCenter",
							message: res.message,
							transitionIn: "fadeInDown",
							transitionOut: "fadeOutUp",
							pauseOnHover: false,
						});
						return false;
					}
					$.alert({
						title: "Galat!",
						type: "red",
						theme: "material",
						content: res.message,
						typeAnimated: true,
						autoClose: "ok|5000",
						draggable: true,
						onClose: function () {
							button
								.prop("disabled", false)
								.html(
									`<i class="bi bi-send-check-fill me-2"></i>Simpan & Lanjutkan`
								);
						},
					});
				},
				"json"
			);
		}
	});

	function loadProfile($url, $data, $container, button) {
		// state container
		$container.html(`
        <div class="d-flex justify-content-start">
            <div class="w-100">
                <span class="placeholder mb-2 col-6"></span>
                <span class="placeholder mb-2 w-75"></span>
                <span class="placeholder mb-2" style="width: 25%;"></span>
                <span class="placeholder mb-2" style="width: 90%;"></span>
            </div>
        </div>
        `);

		$.post(
			$url,
			$data,
			function (res, status) {
				button
					.prop("disabled", false)
					.html(`<i class="bi bi-search me-2"></i>Cari`);
				if (res.status === true) {
					$formSaveASN.find("input[name='nip']").val(res.data.nip);
					$formSaveASN.find("input[name='nama']").val(res.data.nama);
					$formSaveASN
						.find("input[name='gelar_depan']")
						.val(res.data.gelar_depan);
					$formSaveASN
						.find("input[name='gelar_belakang']")
						.val(res.data.gelar_belakang);
					$formSaveASN
						.find("input[name='id_unit_kerja']")
						.val(res.data.fid_unit_kerja);
					$formSaveASN
						.find("input[name='nama_golru']")
						.val(res.data.nama_golru);
					$formSaveASN
						.find("input[name='nama_jabatan']")
						.val(res.data.nama_jabatan);
					$formSaveASN
						.find("input[name='nama_pangkat']")
						.val(res.data.nama_pangkat);
					$formSaveASN
						.find("input[name='nama_unit_kerja']")
						.val(res.data.nama_unit_kerja);
					$formSaveASN.find("input[name='alamat']").val(res.data.alamat);
					$formSaveASN.find("input[name='tgl_lahir']").val(res.data.tgl_lahir);
					$formSaveASN.find("input[name='tmp_lahir']").val(res.data.tmp_lahir);
					$formSaveASN
						.find("input[name='usia_pensiun']")
						.val(res.data.usia_pensiun);
					$formSaveASN.find("input[name='url_photo']").val(res.data.picture);
					$container.html(`
					<!-- Success alert -->
					<div class="alert alert-success d-flex flex-column flex-lg-row justify-content-start align-items-start gap-3" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
						<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
						</svg>
						<div>
						${res.message}
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-2 text-center">
							<img src="${res.data.picture}" alt="${
						res.data.nama
					}" class="p-3 border bg-light" width="140">
						</div>
						<div class="col-12 col-lg-10">
							<ul class="row row-cols-1 row-cols-sm-2 list-unstyled">
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">NIP</div>
									<div>${res.data.nip}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">NAMA</div>
									<div>${res.data.nama}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">GELAR DEPAN</div>
									<div>${res.data.gelar_depan ? res.data.gelar_depan : "-"}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">GELAR BELAKANG</div>
									<div>${res.data.gelar_belakang ? res.data.gelar_belakang : "-"}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">PANGKAT</div>
									<div> ${res.data.nama_pangkat} (${res.data.nama_golru})</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">JABATAN</div>
									<div>${res.data.nama_jabatan}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold col-12 lh-1">UNIT KERJA</div>
									<div>${res.data.nama_unit_kerja}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold col-12 lh-1">USIA PENSIUN</div>
									<div>${res.data.usia_pensiun}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">TEMPAT TANGGAL LAHIR</div>
									<div>${res.data.tmp_lahir}, ${res.data.tgl_lahir}</div>
								</li>
								<li class="pb-3 ps-0 mb-3 border-bottom">
									<div class="fs-sm fw-bold lh-1">ALAMAT</div>
									<div>${res.data.alamat}</div>
								</li>
							</ul>
						</div>
					</div>
                    `);
					return false;
				}

				$container.html(
					`<i class="bi bi-exclamation-circle-fill me-2"></i> ${res.message}`
				);
			},
			"json"
		);
	}
	$formCariNip.on("submit", function (e) {
		e.preventDefault();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize(),
			$container = $("#loadProfile");
		if (_.find('input[name="nip"]').val() === "") {
			$.alert({
				title: "Warning !",
				type: "orange",
				theme: "material",
				content: `Nomor Induk Pegawai Tidak Boleh Kosong !`,
				typeAnimated: true,
				autoClose: "ok|5000",
			});
			return false;
		}
		// state button cari
		let button = _.find("button[type='submit']");
		button
			.prop("disabled", true)
			.html(
				`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Cari`
			);
		loadProfile($url, $data, $container, button);
	});

	let getNIP = urlParams.get("nip");
	if (getNIP) {
		let $container = $("#loadProfile"),
			button = $formCariNip.find("button[type='submit']");
		button
			.prop("disabled", true)
			.html(
				`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Cari`
			);
		loadProfile(
			`${_uri}/app/pensiun/carinip`,
			{ nip: getNIP },
			$container,
			button
		);
	}

	$formSaveASN.on("submit", function (e) {
		e.preventDefault();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize();
		if (_.find('input[name="nip"]').val() === "") {
			$.alert({
				title: "Warning !",
				type: "orange",
				theme: "material",
				content: `Nomor Induk Pegawai Tidak Ditemukan !`,
				typeAnimated: true,
				autoClose: "ok|5000",
			});
			return false;
		}
		// state button cari
		let button = _.find("button[type='submit']");
		button
			.prop("disabled", true)
			.html(
				`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Simpan & Lanjutkan`
			);
		$.post(
			$url,
			$data,
			function (res) {
				if (res.status === true) {
					setTimeout(() => {
						window.location.href = res.rediract;
					}, 3000);
					iziToast.success({
						timeout: 3000,
						title: "Berhasil",
						position: "topCenter",
						message: `Data ASN Telah Disimpan`,
						transitionIn: "fadeInDown",
						transitionOut: "fadeOutUp",
						pauseOnHover: false,
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
				button
					.prop("disabled", false)
					.html(`<i class="bi bi-send-check-fill me-2"></i>Simpan & Lanjutkan`);
			},
			"json"
		);
	});

	$formKirimUsul.on("submit", function (e) {
		e.preventDefault();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize();

		if (!this.checkValidity()) {
			this.classList.add("was-validated");
			return false;
		}
		// state button cari
		let button = _.find("button[type='submit']");
		button
			.prop("disabled", true)
			.html(
				`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Kirim Usulan`
			);
		$.confirm({
			title: "Yakin ?",
			content:
				"Apakah anda yakin mengirim usulan tersebut dan berkas sudah lengkap sesuai ketentuan ?",
			type: "green",
			theme: "supervan",
			buttons: {
				Kirim: {
					action: function () {
						$.post(
							$url,
							$data,
							function (res) {
								if (res.status === true) {
									setTimeout(() => {
										window.location.href = res.rediract;
									}, 3000);
									iziToast.success({
										timeout: 3000,
										title: "Berhasil",
										position: "topCenter",
										message: `Data usulan pensiun telah disimpan`,
										transitionIn: "fadeInDown",
										transitionOut: "fadeOutUp",
										pauseOnHover: false,
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
									onClose: function () {
										button
											.prop("disabled", false)
											.html(
												`<i class="bi bi-send-check-fill me-2"></i> Kirim Usulan`
											);
									},
								});
							},
							"json"
						);
					},
				},
				Batal: function () {
					button
						.prop("disabled", false)
						.html(`<i class="bi bi-send-check-fill me-2"></i> Kirim Usulan`);
				},
			},
		});
	});
});

function loadEffect(isLoading = true) {
	return `<div class="d-flex flex-column justify-content-start gap-5 pt-4">
				<div class="w-100">
					<span class="placeholder mb-2 col-8 h-50"></span>
					<hr>
					<span class="placeholder mb-2 col-6"></span>
					<span class="placeholder mb-2 w-100"></span>
					<span class="placeholder mb-4" style="width: 95%;"></span>
					<span class="placeholder mb-2 col-6"></span>
					<span class="placeholder mb-2 w-100"></span>
				</div>
			</div>`;
}

function loadSyarat(id, target) {
	target.html(loadEffect());
	$.get(
		`${_uri}/app/pensiun/syarat`,
		{ id: id },
		function (res) {
			setTimeout(() => {
				target.html(res);
			}, 1000);
		},
		"html"
	);
}

// auto req persyratan step 3
let idSyarat = urlParams.get("jenis");
loadSyarat(idSyarat, $("#loadSyaratPensiun"));

// get persyratan step 1
let $modalSyarat = $("#modalSyarat");
function SyaratPensiun(id) {
	$modalSyarat.modal("show");
	let content = $modalSyarat.find(".modal-body");
	loadSyarat(id, content);
}

function DetailNotApprove(token) {
	$.confirm({
		title: "Catatan",
		type: "orange",
		lazyOpen: false,
		theme: "material",
		content: `url:${_uri}/app/inbox/catatan?token=${token}`,
		contentLoaded: function (data, status, xhr) {
			// data is already set in content
			this.setContentAppend(data.catatan);
		},
		buttons: {
			ok: function () {},
		},
	});
}

function CetakUsul(token) {
	$.confirm({
		title: 'Cetak Usul',
		content: 'Apakah data usulan sudah benar ?',
		type: 'orange',
		theme: 'material',
		buttons: {
			ya: {
				text: '<i class="bi bi-printer me-2"></i> Cetak',
				btnClass: 'btn-lg btn-info',
				action: function () {
					$.post(
						`${_uri}/app/inbox/cetakusul`,
						{ token: token },
						function (res) {
							iziToast.success({
								timeout: 1000,
								title: 'Berhasil',
								position: 'topCenter',
								message: 'Usulan telah dicetak',
								transitionOut: 'fadeOutDown',
								pauseOnHover: false,
								onClosed: () => {
									window.location.reload();
								}
							});
							if (res.status === true) {
								window.location.href = res.url;
							}

						},
						"json"
					);
				}
			},
			batal: {
				text: '<i class="bi bi-x-lg me-2"></i> Batal',
				action: function() {
					// return false;
				}
			},
		}
	});
}

function Hapus(token) {
	$.confirm({
		title: 'Hapus ?',
		content: 'Apakah anda yakin akan menghapus usulan ini ?',
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
								window.location.href = `${_uri}/app/inbox/usul`;
							}
						},
						"json"
					);
				}
			},
			batal: {
				text: '<i class="bi bi-x-lg me-2"></i> Batal',
				action: function() {
					// return false;
				}
			},
		}
	});
}