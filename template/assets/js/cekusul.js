$(function () {
	let $form = $("form#FormCekUsul"),
		$container = $("#loadDataAsn");

	function loadEffect(isLoading = true) {
		if (isLoading) {
			return `<div class="spinner-border text-success" style="width: 2rem; height: 2rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
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
            $container.html(`<i class="bi bi-x-circle-fill text-danger me-2"></i>Masukan Nomor Induk Pegawai !`);
			return false;
		}
		setTimeout(() => {
			loadData($url, $data);
		}, 2000)
	});
});
