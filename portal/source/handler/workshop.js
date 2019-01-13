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

    $("#start_time").keyup(function () {
        $("#start_time_error").css('display', 'none');
    });

    $("#end_time").keyup(function () {
        $("#end_time_error").css('display', 'none');
    });

    $("input[type='submit']").click(function(e) {
        let $fileUpload = $("input[type='file']");
        let title       = $("#title").val();
        let description = $("#desc").val();
        let highlights  = $("#highlights").val();
        let overview    = $("#overview").val();
        let outcomes    = $("#outcomes").val();
        let fees        = $("#fees").val();
        let location    = $("#location").val();
        let date        = $("#date").val();
        let start_time  = $("#start_time").val();
        let end_time    = $("#end_time").val();

        if (checkEmpty(title)) {
            $("#title_error").css('display', 'block');
            $('#title').focus();
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

        if (checkEmpty(date)) {
            $("#date_error").css('display', 'block');
            $('#date').focus();
            e.preventDefault();
        }
        
        if (checkEmpty(start_time)) {
            $("#start_time_error").css('display', 'block');
            $('#start_time').focus();
            e.preventDefault();
        }
        if (checkEmpty(end_time)) {
            $("#end_time_error").css('display', 'block');
            $('#end_time').focus();
            e.preventDefault();
        }
        if (parseInt($fileUpload.get(0).files.length) < 1) {
            $("#img_error").css('display', 'block').text("Select images");
            $($fileUpload).focus();
            e.preventDefault();
        }
        if (checkEmpty(highlights)) {
            $("#highlights_error").css('display', 'block');
            $('#highlights').focus();
            e.preventDefault();
        }
        if (checkEmpty(overview)) {
            $("#overview_error").css('display', 'block');
            $('#overview').focus();
            e.preventDefault();
        }
        if (checkEmpty(outcomes)) {
            $("#outcome_error").css('display', 'block');
            $('#outcomes').focus();
            e.preventDefault();
        }
    });

    function checkEmpty(text) {
        return text.trim() === "";
    }


    let count = 0;
    $(document).on('click', '.add', function(){
        var html = '';
        if (count === 4) {
            html += '<tr>';
            html += '<td bgcolor="#FFA148" colspan="4" style="text-align: center; color: #fff;"><strong>Hands on #1</strong></td>';
            html += '</tr>';
            html += '<tr>';
            html += '<td width="15%"><input type="time" name="timing[]" class="form-control timing" /></td>';
            html += '<td width="60%"><input type="text" name="what_will[]" class="form-control what_will" /></td>';
            html += '<td width="20%"><input type="text" name="instructor[]" class="form-control instructor"></td>';
            html += '<td  width="5%"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
        } else {
            if (count === 8) {
                html += '<tr>';
                html += '<td bgcolor="#FFA148" colspan="4" style="text-align: center; color: #fff;"><strong>Hands on #2</strong></td>';
                html += '</tr>';
                html += '<tr>';
                html += '<td width="15%"><input type="time" name="timing[]" class="form-control timing" /></td>';
                html += '<td width="60%"><input type="text" name="what_will[]" class="form-control what_will" /></td>';
                html += '<td width="20%"><input type="text" name="instructor[]" class="form-control instructor"></td>';
                html += '<td width="5%"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            } else {
                if (count === 12) {
                    html += '<tr>';
                    html += '<td bgcolor="#FFA148" colspan="4" style="text-align: center; color: #fff;"><strong>Hands on #3</strong></td>';
                    html += '</tr>';
                    html += '<tr>';
                    html += '<td width="15%"><input type="time" name="timing[]" class="form-control timing" /></td>';
                    html += '<td width="60%"><input type="text" name="what_will[]" class="form-control what_will" /></td>';
                    html += '<td width="20%"><input type="text" name="instructor[]" class="form-control instructor"></td>';
                    html += '<td width="5%"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                }else {
                    html += '<tr>';
                    html += '<td width="15%"><input type="time" name="timing[]" class="form-control timing" /></td>';
                    html += '<td width="60%"><input type="text" name="what_will[]" class="form-control what_will" /></td>';
                    html += '<td width="20%"><input type="text" name="instructor[]" class="form-control instructor"></td>';
                    html += '<td width="5%"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                }
            }
        }
        $('#time_table').append(html);
        if (count === 15){
            $(this).prop('disabled',true);
        }
        count++;
    });

    $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

    $('#workshop_form').submit(function (e) {
        if (count === 0){
            e.preventDefault();
            $('#time_table_error').css('display','block');
        }
    });

});