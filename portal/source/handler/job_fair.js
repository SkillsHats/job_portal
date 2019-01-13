$(document).ready(function () {

    $("#description").keyup(function () {
        $("#desc_error").css('display', 'none');
    });
    $("#industries").keyup(function () {
        $("#industries_error").css('display', 'none');
    });
    $("#fees").keyup(function () {
        $("#fees_error").css('display', 'none');
    });
    $("#location").keyup(function () {
        $("#location_error").css('display', 'none');
    });
    $("#start_date").keyup(function () {
        $("#start_date_error").css('display', 'none');
    });
    $("#start_time").keyup(function () {
        $("#start_time_error").css('display', 'none');
    });
    $("#end_date").keyup(function () {
        $("#end_date_error").css('display', 'none');
    });
    $("#end_time").keyup(function () {
        $("#end_time_error").css('display', 'none');
    });

    $("input[type='submit']").click(function(e) {
        let $fileUpload = $("input[type='file']");
        let title       = $("#title").val();
        let description = $("#description").val();
        let industries  = $("#industries").val();
        let fees        = $("#fees").val();
        let location    = $("#location").val();
        let startdate   = $("#start_date").val();
        let starttime   = $("#start_time").val();
        let enddate     = $("#end_date").val();
        let endtime     = $("#end_time").val();

        if (checkEmpty(title)) {
            $("#title_error").css('display', 'block');
            $('#title').focus();
            e.preventDefault();
        }
        if (checkEmpty(industries)) {
            $("#industries_error").css('display', 'block');
            $('#industries').focus();
            e.preventDefault();
        }
        if (checkEmpty(description)) {
            $("#desc_error").css('display', 'block');
            $('#description').focus();
            e.preventDefault();
        }
        if (checkEmpty(fees)) {
            $("#fees_error").css('display', 'block');
            $('#fees').focus();
            e.preventDefault();
        }
        if (checkEmpty(location)) {
            $("#location_error").css('display', 'block');
            $('#location').focus();
            e.preventDefault();
        }
        if (checkEmpty(startdate)) {
            $("#start_date_error").css('display', 'block');
            $('#start_date').focus();
            e.preventDefault();
        }
        if (checkEmpty(starttime)) {
            $("#start_time_error").css('display', 'block');
            $('#start_time').focus();
            e.preventDefault();
        }
        if (checkEmpty(enddate)) {
            $("#end_date_error").css('display', 'block');
            $('#end_date').focus();
            e.preventDefault();
        }
        if (checkEmpty(endtime)) {
            $("#end_time_error").css('display', 'block');
            $('#end_time').focus();
            e.preventDefault();
        }
        if (parseInt($fileUpload.get(0).files.length) < 1) {
            $("#img_error").css('display', 'block').text("Select images");
            $($fileUpload).focus();
            e.preventDefault();
        }

    });

    function checkEmpty(text) {
        if (empty(text.trim())) {
            return true;
        } else {
            return false;
        }
    }
});