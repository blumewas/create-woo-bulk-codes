const generateCodes = (event) => {
    event.preventDefault();

    jQuery.ajax({
        type: 'POST',
        url: wp_vars.ajaxurl,
        data: {
            action: 'create_bulk_codes',
            nonce: wp_vars.nonce,
            title: jQuery('#title').val(),
            amount: jQuery('#amount').val(),
            product_category: jQuery('#product_category').val(),
            emails: jQuery('#emails').val(),
        },
        success: function (data, textStatus, XMLHttpRequest) {
            jQuery('#cbc-success-message').html(`<p>${data.message}</p>`);
            jQuery('#cbc-success-message').show();

            jQuery('#cbc-error-message').hide();

            jQuery('#title').val('');
            jQuery('#amount').val('');
            jQuery('#product_category').val('');
            jQuery('#emails').val('');

            $('#generate-codes').prop("disabled",false);
        },
        error: function (response, textStatus, errorThrown) {
            const errors = response?.responseJSON?.errors ?? [];
            const message = response?.responseJSON?.message ?? '';

            jQuery('#cbc-success-message').hide();
            jQuery('#cbc-error-message').html(`<p>${message}</p>`);

            if (errors) {
                jQuery('#cbc-error-message').append('<ul></ul>');
                errors.forEach((error) => {
                    jQuery('#cbc-error-message ul').append(`<li>${error}</li>`);
                });
            }

            jQuery('#cbc-error-message').show();
            $('#generate-codes').prop("disabled",false);
        }
    });
};

jQuery(document).ready(function ($) {
    $('#generate-codes').on('click', generateCodes);

    $('#generate-codes').prop("disabled",true);
});
