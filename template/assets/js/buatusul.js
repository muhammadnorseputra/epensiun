$(function () {
	$(".tanggal").datepicker({
		format: "dd-mm-yyyy",
		todayBtn: true,
		calendarWeeks: true,
		autoclose: true,
		todayHighlight: true,
	});

	let $formStep1 = $("form#FormPengantar"),
		$formCariNip = $("form#FormCariNip");
	$formStep1.on("submit", function (e) {
		e.preventDefault();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize();
		if (_.parsley().isValid()) {
			$.post(
				$url,
				$data,
				function (res) {
					if (res.status === true) {
						return (window.location.href = res.redirect);
					}
					alert(res.message);
				},
				"json"
			);
		}
	});

	$formCariNip.on("submit", function (e) {
		e.preventDefault();
		let _ = $(this),
			$url = _.attr("action"),
			$data = _.serialize(),
            $container = $("#loadProfile");
        // state button cari
        let button = _.find("button[type='submit']");
        button.prop("disabled", true).html(`<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Cari`);
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
            $.post($url, $data, function (res, status) {
                console.log(res);
                button.prop("disabled", false).html(`<i class="bi bi-search me-2"></i>Cari`);
                if(res.status === true) {
                    $container.html(`
                        <img src="${res.data.picture}" alt="${res.data.nama}" width="120">
                    `)
                    return false;
                }

                $container.html(`${res.message}`)
            }, "json");
	});
});
