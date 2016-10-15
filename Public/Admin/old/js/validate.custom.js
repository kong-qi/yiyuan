
$.validator.setDefaults({
    highlight: function (e) {
        $(e).closest("td").removeClass("has-success").addClass("has-error")
    }, success: function (e) {
        e.closest("td").removeClass("has-error").addClass("has-success")
    }, errorElement: "span", errorPlacement: function (e, r) {
        e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
    }, errorClass: "error", validClass: "error"

});
$().ready(function() {
    // validate the comment form when it is submitted
    var e = "<i class='fa fa-times-circle'></i> ";

    // validate signup form on keyup and submit
    $("#signupForm").validate({
        rules: {
            firstname: "required",
            site_name:"required"

        },
        messages: {
            firstname:e + "青输入文字",

        }
    });
});
