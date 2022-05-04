/**
 * Plugin para inserção de mensagens
 * 
 * Dependências:
 ** jQuery e jQuery-ui(effects)
 * 
 */
(function ($) {
    let alertModel = null;
    let alertHandler = null;
    let timer = 7500;

    $.fn.errorMessage = function (message) {
        message = toObj(message);
        let full = {};

        $.extend(full, message, {
            "style": "alert-danger",
        });

        $(this).addMessage(full);
    }

    $.fn.warningMessage = function (message) {
        message = toObj(message);
        let full = {};

        $.extend(full, message, {
            "style": "alert-warning",
        });

        $(this).addMessage(full);
    }

    $.fn.infoMessage = function (message) {
        message = toObj(message);
        let full = {};

        $.extend(full, message, {
            "style": "alert-info",
        });

        $(this).addMessage(full);
    }

    $.fn.successMessage = function (message) {
        message = toObj(message);
        let full = {};

        $.extend(full, message, {
            "style": "alert-success",
        });

        $(this).addMessage(full);
    }

    $.fn.addMessage = function (message) {
        let messageContainer = $(this);
        alertModel = $(`<div class="alert alert-dismissible">
            <div class="alert-heading"></div>
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
            <div class="alert-body"></div>
        <div>`);

        timer = message.type == "floating" ? (message.time ? message.time * 1000 : 7500) : 0;
        alertModel.addClass(message.style);

        alertModel.addClass(`alert-${message.type}`);

        if (message.title)
            alertModel.find(".alert-heading").html(message.title);
        else
            alertModel.find(".alert-heading").remove();

        alertModel.find(".alert-body").text(message.message);

        messageContainer.html(alertModel);

        alertModel.showMessage();
    };

    $.fn.showMessage = function () {
        if (!alertModel) alertModel = $(this);

        alertModel.show("blind", "fast", function () {
            alertModel.effect("bounce", "fast");
        });

        clearAlertHandler();

        if (alertModel.hasClass("alert-floating")) {
            alertHandler = setTimeout(function () {
                hideMessage(alertModel);
            }, timer);
        }

        alertModel.find(".jsBtnClose").on("click", function (e) {
            e.preventDefault();
            hideMessage(alertModel);
        });
    };

    function hideMessage(alert) {
        clearAlertHandler();

        if (alert.hasClass("alert-floating")) {
            alert.effect("bounce", "slow", function () {
                $(this).hide("blind", "fast", function () {
                    $(this).remove();
                });
            });
        } else {
            alert.hide("blind", "fast", function () {
                $(this).remove();
            });
        }
    }

    function clearAlertHandler() {
        if (alertHandler)
            clearTimeout(alertHandler);
    }

    function toObj(param) {
        if (typeof param === "object") {
            return param;
        } else {
            return {
                "title": null,
                "message": param,
                "type": "fixed",
            };
        }
    }
}(jQuery));