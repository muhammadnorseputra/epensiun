$(function () {
	$(".tanggal").datepicker({
		format: "dd/mm/yyyy",
		todayBtn: "linked",
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
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
						return false;
					}
					alert(res.message);
					button
						.prop("disabled", false)
						.html(
							`<i class="bi bi-send-check-fill me-2"></i>Simpan & Lanjutkan`
						);
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
					<div class="alert alert-success d-flex align-items-center" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
						<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
						</svg>
						<div>
						${res.message}
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<img src="${res.data.picture}" alt="${res.data.nama}" width="140">
						</div>
						<div class="col-md-10">
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
			alert("Nomor Induk Pegawai Tidak Boleh Kosong !");
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
			alert("Nomor Induk Pegawai Tidak Ditemukan !");
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
					return false;
				}
				alert(res.message);
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
		const msg = "Apakah anda yakin mengirim usulan tersebut ?";
		if (confirm(msg)) {
			$.post(
				$url,
				$data,
				function (res) {
					if (res.status === true) {
						setTimeout(() => {
							window.location.href = res.rediract;
						}, 3000);
						return false;
					}
					alert(res.message);
					button
						.prop("disabled", false)
						.html(`<i class="bi bi-send-check-fill me-2"></i> Kirim Usulan`);
				},
				"json"
			);
			return false;
		}

		button
			.prop("disabled", false)
			.html(`<i class="bi bi-send-check-fill me-2"></i> Kirim Usulan`);
	});
});
