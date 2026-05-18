function appendAlertBox(selector, type, message) {
    $(selector).prepend('<center><div id="alertBox" class="alert alert-' + type + '"><img src="assets/img/error.png" alt="" height="30" width="30">&nbsp;&nbsp;' + message + '</div></center>')
}

function removeAlertBox(selector) {
    $(selector).find('#alertBox').remove();
}

function appendFormErrors(selector, data) {
    $.each(data, function (index, value) {
        var group = $(selector).find('#group-' + index);

        group.addClass('has-error');
        group.find('input, select, textarea:not(:parent.sceditor-container textarea)').after('<span class="help-block"><strong>' + value[0] + '</strong></span>');
    });
}

function removeFormErrors(selector) {
    $(selector).find('.has-error').removeClass('has-error');
    $(selector).find('.help-block').remove();
}

function overOverLayer() {
    overOverLayerClose();
    $('body').append('<div id="ovd-overlay" class="ovd-overlay ovd-overlay-fixed"></div>')
        .append('<div id="ovd-loading"><div></div></div>');
}

function overOverLayerClose() {
    $('#ovd-loading, #ovd-overlay').remove();
}