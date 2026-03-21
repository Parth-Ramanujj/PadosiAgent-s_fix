function initContactForm() {
	var $form = jQuery("#contactpage");
	if (!$form.length) return;

	if (jQuery.fn.validate) {
		$form.validate({
			rules: {
				name: { required: true, minlength: 2 },
				email: { required: true, email: true },
				mobile: { required: true, digits: true, minlength: 10, maxlength: 10 },
				subject: { required: true, minlength: 5 },
				message: { required: true, minlength: 10 }
			},
			errorElement: "span",
			errorPlacement: function (e, t) {
				e.appendTo(t.parent());
			}
		});
	}
}

jQuery(document).on("submit", "#contactpage", function (e) {
	var $form = jQuery(this);
	e.preventDefault();

	if (jQuery.fn.validate && $form.data("validator") && !$form.valid()) {
		return false;
	}

	submitContactForm($form);
	return false;
});

function submitContactForm($form) {
	var payload = $form.serialize();
	var $btn = $form.find("#submit");
	var originalHtml = $btn.html();
	var $result = jQuery("#form_result");
	var submitUrl = $form.attr("action") || "/contact/submit";

	$btn.prop("disabled", true).addClass("disabled").html("Sending...");

	jQuery.ajax({
		url: submitUrl,
		type: "POST",
		data: payload,
		success: function (res) {
			var msg = res.message || "Thank you! Your message has been sent successfully.";
			
			// Show loading spinner first
			$result.stop(true, true)
				.html(`
					<div class="form-success-loader alert alert-success d-block text-center">
						<div class="spinner-border text-success mb-3" role="status">
							<span class="sr-only">Processing...</span>
						</div>
						<p class="mb-0">Processing your message...</p>
					</div>
				`)
				.show();

			jQuery("html, body").animate({
				scrollTop: $result.offset().top - 150
			}, 500);

			// After 1.5 seconds, show checkmark animation
			setTimeout(function() {
				$result.stop(true, true)
					.html(`
						<div class="form-success alert alert-success d-block text-center">
							<div class="success-checkmark mb-3">
								<i class="fas fa-check-circle" style="font-size: 60px; color: #28a745; animation: scaleIn 0.6s ease-in-out;"></i>
							</div>
							<h5 class="mb-2" style="color: #28a745; font-weight: 600;">Success!</h5>
							<p class="mb-0" style="font-size: 16px;">` + msg + `</p>
						</div>
					`)
					.show();

				jQuery("html, body").animate({
					scrollTop: $result.offset().top - 150
				}, 300);
			}, 1500);

			// Reset form after showing success
			setTimeout(function() {
				$form[0].reset();
			}, 2000);
		},
		error: function (xhr) {
			var msg = "Failed to send message. Please try again.";
			if (xhr.responseJSON && xhr.responseJSON.message) {
				msg = xhr.responseJSON.message;
			}

			var errorsHtml = "";
			if (xhr.responseJSON && xhr.responseJSON.errors) {
				errorsHtml += '<ul class="mb-0">';
				jQuery.each(xhr.responseJSON.errors, function (field, messages) {
					if (messages && messages.length) {
						jQuery.each(messages, function (_, text) {
							errorsHtml += "<li>" + text + "</li>";
						});
					}
				});
				errorsHtml += "</ul>";
			}

			var fullMsg = '<span class="form-error alert alert-danger d-block">' + msg + (errorsHtml ? "<br>" + errorsHtml : "") + "</span>";
			$result.stop(true, true)
				.html(fullMsg)
				.show();

			jQuery("html, body").animate({
				scrollTop: $result.offset().top - 150
			}, 500);
		},
		complete: function () {
			$btn.prop("disabled", false).removeClass("disabled").html(originalHtml);
		}
	});

	return false;
}

jQuery(document).ready(function () {
	initContactForm();
});

document.addEventListener("htmx:afterSwap", function (evt) {
	if (evt.detail.target.id === "app-content" || jQuery("#contactpage").length) {
		initContactForm();
	}
});
