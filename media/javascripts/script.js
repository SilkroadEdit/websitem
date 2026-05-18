$(document).ready(function () {
    $(document).ajaxStart(loading()).ajaxStop(loading('hide'));

    $('#login-form').submit(function () {
        var form = $(this);
        loading();
        $.post("reg_users.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("window.location = '/';", 500);
                        return true;
                    }
                } catch (e) {
                    alerta('Lütfen, özel karakter kullanmayın.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });

    $('#lostpw-form').submit(function () {
        var form = $(this);
        loading();
        $.post("reg_users.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        loading('hide');
                        return true;
                    }
                } catch (e) {
                    alerta('Lütfen, özel karakter kullanmayın.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });

    $('#register-form').submit(function () {
        var form = $(this);
        loading();
        $.post("reg_users.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        loading('hide');
                        return true;
                    }
                } catch (e) {
                    alerta('Lütfen, özel karakter kullanmayın.', 'error');
                }
                reloadCaptcha();
                loading('hide');
            })
            .fail(function () {
                alerta('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');
                reloadCaptcha();
                loading('hide');
            });
        return false;
    });

    $('#changepw-form').submit(function () {
        var form = $(this);
        loading();
        $.post("remo.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alerta('LÃ¼tfen, Ã¶zel karakter kullanmayÄ±n.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('ÃœzgÃ¼nÃ¼z, iÅŸleminiz gerÃ§ekleÅŸtirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });

    $('#changesecret-form').submit(function () {
        var form = $(this);
        loading();
        $.post("remo.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alerta('LÃ¼tfen, Ã¶zel karakter kullanmayÄ±n.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('ÃœzgÃ¼nÃ¼z, iÅŸleminiz gerÃ§ekleÅŸtirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });


    $('#savechar-form').submit(function () {
        var form = $(this);
        loading();
        $.post("remo.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alerta('LÃ¼tfen, Ã¶zel karakter kullanmayÄ±n.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('ÃœzgÃ¼nÃ¼z, iÅŸleminiz gerÃ§ekleÅŸtirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });

    $('#useepin-form').submit(function () {
        var form = $(this);
        loading();
        $.post("remo.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alerta('LÃ¼tfen, Ã¶zel karakter kullanmayÄ±n.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('ÃœzgÃ¼nÃ¼z, iÅŸleminiz gerÃ§ekleÅŸtirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });

    $('#buyitinfo').find('#buyit').click(function () {
        var form = $('#buyit-form');
        loading();
        $.post("marketajax.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("window.location = 'market.php';", 1500);
                        return true;
                    }
                } catch (e) {
                    alerta('Lütfen, özel karakter kullanmayın.', 'error');
                }
                loading('hide');
            })
            .fail(function () {
                alerta('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');
                loading('hide');
            });
        return false;
    });

    $('#buyit-form').submit(function () {
        $('#buyitinfo').find('#buyit').trigger('click');
        return false;
    });

    $('#maxicard-form').submit(function () {
        var form = $(this);
        loading();
        $.post("remo.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    alerta(json_obj.text, json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        loading('hide');
                        return true;
                    }
                } catch (e) {
                    alerta('LÃ¼tfen, Ã¶zel karakter kullanmayÄ±n.', 'error');
                }
                reloadCaptcha();
                loading('hide');
            })
            .fail(function () {
                alerta('ÃœzgÃ¼nÃ¼z, iÅŸleminiz gerÃ§ekleÅŸtirilemedi.', 'error');
                reloadCaptcha();
                loading('hide');
            });
        return false;
    });

    $('.bxslider').bxSlider({
        mode: 'fade',
        auto: true,
        infiniteLoop: true,
        useCSS: false,
        pager: false
    });
});

function loading(msg) {
    if (!msg) msg = '';
    if (msg == 'hide') {
        $.unblockUI();
    } else {
        $.blockUI({
            overlayCSS: {
                opacity: '0.8'
            },
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0px'
            },
            message: "<h1><div class='loading-spin'><div class='spin-img'></div><div class='fixed-img'></div>" + msg + "</h1>"
        });
    }
}

function elementLoading(element, msg) {
    if (!msg) msg = '';
    if (msg == 'hide') {
        $(element).unblock();
    } else {
        $(element).block({
            overlayCSS: {
                opacity: '0.7'
            },
            css: {
                backgroundColor: 'transparent',
                color: '#fff',
                border: '0px'
            },
            message: "<div class='loading-spin-2'><div class='spin-img'></div><div class='fixed-img'></div>" + msg
        });
    }
}

/* Funcion Alerta */
function alerta(msg, type) {
    if (type) alertify.log(msg, type);
    else alertify.log(msg);
}

alert = function (foo) {
    alertify.log(foo);
};

function reloadCaptcha() {
    $("#CaptchaImg").attr("src", "captcha.php?width=130&height=34&characters=6");
}

function serverTime() {
    if (!document.all && !document.getElementById) {
        return;
    }
    var Stunden = ServerTime.getHours();
    var Minuten = ServerTime.getMinutes();
    var Sekunden = ServerTime.getSeconds();
    ServerTime.setSeconds(Sekunden + 1);
    if (Stunden <= 9) {
        Stunden = "0" + Stunden;
    }

    if (Minuten <= 9) {
        Minuten = "0" + Minuten;
    }
    if (Sekunden <= 9) {
        Sekunden = "0" + Sekunden;
    }
    jQuery('#cur_time').text(Stunden.toString() + ':' + Minuten.toString() + ':' + Sekunden.toString());
}

function tTimer(iEndTimeStamp, iTimeStamp, sElement) {
    iTimeStamp = iTimeStamp - Math.round(+new Date() / 1000) - iEndTimeStamp;
    if (iTimeStamp < 0) {
        jQuery('#' + sElement).html('00:00:00');
        return false;
    }
    diffDay = iTimeStamp / (3600 * 24 );
    diffDay = diffDay.toString();
    diffDay = diffDay.split(".");
    diffHour = iTimeStamp / 3600 % 24;
    diffHour = diffHour.toString();
    diffHour = diffHour.split(".");
    diffMin = iTimeStamp / 60 % 60;
    diffMin = diffMin.toString();
    diffMin = diffMin.split(".");
    diffSek = iTimeStamp % 60;
    diffSek = diffSek.toString();
    diffSek = diffSek.split(".");
    if (diffDay[0] != 0) {
        jQuery('#' + sElement).html(diffDay[0] + ':' + checkLength(diffHour[0]) + ':' + checkLength(diffMin[0]) + ':' + checkLength(diffSek[0]));
        return true;
    } else {
        jQuery('#' + sElement).html(checkLength(diffHour[0]) + ':' + checkLength(diffMin[0]) + ':' + checkLength(diffSek[0]));
        return true;
    }
}

function checkLength(sString) {
    sString = sString.toString();
    if (sString.length == 1) {
        sString = '0' + sString;
    }
    return sString;
}