$(document).ready(function () {

    function convertToSlug(Text) {
        return Text
            .toLowerCase()
            .replace(/[^\w ]+/g,'')
            .replace(/ +/g,'-');
    }

    if ($("#name").val() != ""){
        $('#slug').val(convertToSlug($(this).val()));
    }

    $("#name").keyup(function () {
        $("#name_error").css('display', 'none');
        $('#slug').val(convertToSlug($(this).val()));
    });

    $("#name").keyup(function () {
        $("#name_error").css('display', 'none');
    });
    $("#slug").keyup(function () {
        $("#slug_error").css('display', 'none');
    });

    $("input[type='submit']").click(function(e){
        if($("#name").val() === ""){
            $("#name_error").css('display', 'block');
            e.preventDefault();
        }
        if($("#slug").val() === ""){
            $("#slug_error").css('display', 'block');
            e.preventDefault();
        }

        // let name = $("#name").val();
        //
        // $.ajax({
        //     url:"source/helpers/course/check_modules.php",
        //     method:"POST",
        //     data:{name:name},
        //     success:function (data) {
        //         if (data === "1") {
        //             e.preventDefault();
        //         }
        //         // $("#name_error").text(data);
        //         console.log(data);
        //     }
        // });

    });
});