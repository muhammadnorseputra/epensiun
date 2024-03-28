
$(document).ready(function () {
	var $containerMsg = $("#message");
	$("input[name='username']").focus();

	$.validate({
		form: "#f_login",
		lang: "en",
		showErrorDialogs: true,
		modules: "security, html5, sanitize",
		// modules: "security, html5, sanitize, toggleDisabled",
		// disabledFormFilter: 'form.toggle-disabled',
        validateOnEvent: true,
		onError: function ($form) {
			$containerMsg.html(`
			<div class="alert alert-danger shadow-sm mt-4" role="alert">
				<i class="bi bi-x-circle-fill me-2"></i> Auth access akun failed, please check form !
			</div>
			`);
			$('button[type="submit"]').prop("disabled", false).html(`Masuk`);
			
		},
		onSuccess: function ($form) {
			var _action = $form.attr("action");
			var _method = $form.attr("method");
			var _data = $form.serialize();
			$.ajax({
				url: _action,
				method: _method,
				data: _data,
				dataType: "json",
				beforeSend: function () {
					$('button[type="submit"]').prop("disabled", true).html(
						`<div class="d-flex justify-content-center align-items-center"><span class="mr-2"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span>Processing ...</span></div>`
					);
				},
				success: function(response) {
					console.log(response);
					if (response.status === true) {
						$containerMsg.html(`
						<div class="alert alert-success shadow-sm mt-4 d-flex justify-content-between align-items-center" role="alert">
							<div>
								<i class="bi bi-check-circle-fill me-2 text-success"></i> 
								${response.message} 
							</div>
							<span class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true"></span>
						</div>
						`);
						setTimeout(() => {
							window.location.replace(response.redirect);
						}, 2000)
						$form.get(0).reset();
						return false;
					}
					$containerMsg.html(`
					<div class="alert alert-danger shadow-sm mt-4" role="alert">
						<i class="bi bi-x-circle-fill text-danger me-2"></i>${response.message}
					</div>
					`);
					$('button[type="submit"]').prop("disabled", false).html(`Masuk`);
				},
				error: function(err) {
					$containerMsg.html(`
					<div class="alert alert-danger shadow-sm mt-4" role="alert">
						<i class="bi bi-bug-fill me-2"></i> ${err.status} (${err.statusText}
					</div>
					`);
					$('button[type="submit"]').prop("disabled", false).html(`Masuk`);
				},
			});
			return false; // Will stop the submission of the form
			// $form.removeClass('toggle-disabled');
		},
	});

	$(".toggle-password").click(function () {
        var passwordInput = $(".password-input");
        var icon = $(this);
        if (passwordInput.attr("type") == "password") {
            passwordInput.attr("type", "text");
            icon.removeClass("bi-eye-fill").addClass("bi-eye-slash-fill");
        } else {
            passwordInput.attr("type", "password");
            icon.removeClass("bi-eye-slash-fill").addClass("bi-eye-fill");
        }
    });
});