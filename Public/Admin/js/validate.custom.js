
$.validator.setDefaults({
    highlight: function (e) {
        $(e).closest("td").removeClass("has-success").addClass("has-error")
    }, success: function (e) {
        e.closest("td").removeClass("has-error").addClass("has-success")
    }, errorElement: "span", errorPlacement: function (e, r) {
        e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
    }, errorClass: "error", validClass: "error"

});
