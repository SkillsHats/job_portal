$(document).ready(function(){

    let selector    = $('#search_user');
    let selectorID  = $('#search_id');
    let value;

    $(selector).keyup(function () {
        value = $(this).val();
        if (value.length > 0){
            $.ajax({
                url:"../source/helpers/filter_user.php",
                method:"POST",
                data:{name:value},
                success:function (data) {
                    $('#userData').html(data);
                }
            });
        }
    });

    $(selector).keydown(function () {
        $.ajax({
            url:"../source/helpers/filter_user.php",
            method:"POST",
            data:{default:"users"},
            success:function (data) {
                $('#userData').html(data);
            }
        });
    });

    $(selectorID).keyup(function () {
        value = $(this).val();
        if (value.length > 0){
            $.ajax({
                url:"../source/helpers/filter_user.php",
                method:"POST",
                data:{id:value},
                success:function (data) {
                    $('#userData').html(data);
                }
            });
        }
    });

    $(selectorID).keydown(function () {
        $.ajax({
            url:"../source/helpers/filter_user.php",
            method:"POST",
            data:{default:"users"},
            success:function (data) {
                $('#userData').html(data);
            }
        });
    })
});