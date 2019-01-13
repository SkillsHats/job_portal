$(document).ready(function () {

    $("#desc").keyup(function () {
        $("#desc_error").css('display', 'none');
    });
    $("#highlights").keyup(function () {
        $("#highlights_error").css('display', 'none');
    });
    $("#overview").keyup(function () {
        $("#overview_error").css('display', 'none');
    });
    $("#outcomes").keyup(function () {
        $("#outcome_error").css('display', 'none');
    });
    $("#fees").keyup(function () {
        $("#fees_error").css('display', 'none');
    });
    $("#location").keyup(function () {
        $("#location_error").css('display', 'none');
    });
    $("#date").keyup(function () {
        $("#date_error").css('display', 'none');
    });
    $("#time").keyup(function () {
        $("#time_error").css('display', 'none');
    });

    $("input[type='submit']").click(function(e) {
        let $fileUpload = $("input[type='file']");
        let title       = $("#title").val();
        let slug        = $("#slug").val();
        let description = $("#desc").val();
        let highlights  = $("#highlights").val();
        let overview    = $("#overview").val();
        let outcomes    = $("#outcomes").val();
        let fees        = $("#fees").val();
        let location    = $("#location").val();
        let date        = $("#date").val();
        let time        = $("#time").val();
        let about       = $("#about").val();
        let topics      = $("#topics").val();

        if (checkEmpty(title)) {
            $("#title_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(slug)) {
            $("#slug_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(description)) {
            $("#desc_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(fees)) {
            $("#fees_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(location)) {
            $("#location_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(date)) {
            $("#date_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(time)) {
            $("#time_error").css('display', 'block');
            e.preventDefault();
        }
        if (parseInt($fileUpload.get(0).files.length) < 1) {
            $("#img_error").css('display', 'block').text("Select images");
            e.preventDefault();
        }
        if (checkEmpty(highlights)) {
            $("#highlights_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(about)) {
            $("#about_error").css('display', 'block');
            e.preventDefault();
        }
        if (checkEmpty(topics)) {
            $("#topics_error").css('display', 'block');
            e.preventDefault();
        }
    });

    function checkEmpty(text) {
        return text.trim() === "";
    }
});