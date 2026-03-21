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
			$result.stop(true, true)
				.html('<span class="form-success alert alert-success d-block">' + msg + "</span>")
				.show();

			jQuery("html, body").animate({
				scrollTop: $result.offset().top - 150
			}, 500);

			$form[0].reset();
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
