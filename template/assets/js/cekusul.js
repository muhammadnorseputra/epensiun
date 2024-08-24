$(function () {
	let $form = $("form#FormCekUsul"),
		$container = $("#loadDataAsn");

	function loadEffect(isLoading = true) {
		if (isLoading) {
			return `<div class="d-flex flex-column justify-content-start align-items-center">
						<div class="w-100">
							<span class="placeholder mb-2 w-25"></span>
							<span class="placeholder mb-2 w-50"></span>
							<span class="placeholder mb-2 w-75" style="height: 150px;"></span>
						</div>
						Mohon tunggu memuat data ...
					</div>`;
		}
	}

	function loadData($url, $data) {
		$.post(
			$url,
			$data,
			function (res) {
				$container.html(res);
			},
			"json"
		);
	}

	$form.on("submit", function (e) {
		e.preventDefault();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize();

		$container.html(loadEffect());

		if (_.find("input[name='nip']").val() === "") {
			$container.html(
				`<i class="bi bi-x-circle-fill text-danger me-2"></i>Masukan Nomor Induk Pegawai !`
			);
			return false;
		}
		setTimeout(() => {
			loadData($url, $data);
		}, 1000);
	});
});
