$(document).ready(function () {
    // No. of questions
    let num = $('#nquestions').val();

    /*************************************
     JQUERY FORM VALIDATION
     *************************************/
    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight: function (element) {
            $(element)
                .closest('.form-group')
                .addClass('has-error')
        },
        unhighlight: function (element) {
            $(element)
                .closest('.form-group')
                .removeClass('has-error')
        }

    });

    //let count = 0;
    $('#cancel_fields').css("display", "block");

    if (num.length < 1) {
        $('#message').html("<div class='alert alert-danger'>Please enter an number</div>");
        $('#save').css("display", "none");
    } else {
        $('#message').html("");
        $('#save').css("display", "block");
    }
    if (num.length > 2) {
        $('#message').html("<div class='alert alert-danger'>Only two digit allow.</div>");
    } else {
        // Dynamic Questions fields added depending on num.
        for (var count = 1; count <= num; count++) {
            var html_code = "<div class='col-sm-12 ques_form_fields'><div class='widget" + count + "'>";
            html_code += "<div class='widget-heading'>";
            html_code += "<h3 class='widget-title'>Question No. " + count + "</h3></div><br>";

            html_code += '<div class="col-sm-12"><div class="form-group">';
            html_code += '<label for="question' + count + '"><b>Question</b></label>';
            html_code += '<input id="question' + count + '" type="text" name="question[]" placeholder=" Question " data-rule-required="true" data-rule-rangelength="[1,1000]" data-rule-text="true" class="form-control question"></div></div>';

            html_code += '<div class="col-sm-12"><div class="form-group">';
            html_code += '<label for=""><input type="checkbox" id="chkimg' + count + '">    <b>Question Image</b></label>';
            html_code += '<input type="file" id="qimg' + count + '" name="qimg[]" data-rule-required="false" class="form-control qimg" style="display:none"></div></div>';

            html_code += '<div class="col-sm-6"><div class="input-group form-group">';
            html_code += '<span class="input-group-addon">A</span>';
            html_code += '<input id="opt1' + count + '" type="text" name="opt1[]" placeholder=" Option 1 " data-rule-required="true" data-rule-rangelength="[1,100]" data-rule-text="true" class="form-control opt1"></div></div>';

            html_code += '<div class="col-sm-6"><div class="input-group form-group">';
            html_code += '<span class="input-group-addon">B</span>';
            html_code += '<input id="opt2' + count + '" type="text" name="opt2[]" placeholder=" Option 2 " data-rule-required="true" data-rule-rangelength="[1,100]" data-rule-text="true" class="form-control opt2"></div></div>';

            html_code += '<div class="col-sm-6"><div class="input-group form-group">';
            html_code += '<span class="input-group-addon">C</span>';
            html_code += '<input id="opt3' + count + '" type="text" name="opt3[]" placeholder=" Option 3 " data-rule-required="true" data-rule-rangelength="[1,100]" data-rule-text="true" class="form-control opt3"></div></div>';

            html_code += '<div class="col-sm-6"><div class="input-group form-group">';
            html_code += '<span class="input-group-addon">D</span>';
            html_code += '<input id="opt4' + count + '" type="text" name="opt4[]" placeholder=" Option 4 " data-rule-required="true" data-rule-rangelength="[1,100]" data-rule-text="true" class="form-control opt4"></div></div>';

            html_code += '<div class="col-sm-12 form-group">';
            html_code += '<div class="form-check">';
            html_code += '<b>Choose Correct Answer: </b>&nbsp;&nbsp;&nbsp;<label class="form-check-label"><b>A</b>&nbsp;</label>';
            html_code += '<input id="correct_ans1' + count + '" type="checkbox" name="correct_ans[]" placeholder=" Correct Answer " data-rule-required="true" data-rule-text="true" class="form-check-input correct_ans" value="A">';
            html_code += '<label class="form-check-label">&nbsp;&nbsp;&nbsp;&nbsp;<b>B</b>&nbsp;</label>';
            html_code += '<input id="correct_ans2' + count + '" type="checkbox" name="correct_ans[]" placeholder=" Correct Answer " data-rule-required="true" data-rule-text="true" class="form-check-input correct_ans" value="B">';
            html_code += '<label class="form-check-label">&nbsp;&nbsp;&nbsp;&nbsp;<b>C</b>&nbsp;</label>';
            html_code += '<input id="correct_ans3' + count + '" type="checkbox" name="correct_ans[]" placeholder=" Correct Answer " data-rule-required="true" data-rule-text="true" class="form-check-input correct_ans" value="C">';
            html_code += '<label class="form-check-label">&nbsp;&nbsp;&nbsp;&nbsp;<b>D</b>&nbsp;</label>';
            html_code += '<input id="correct_ans4' + count + '" type="checkbox" name="correct_ans[]" placeholder=" Correct Answer " data-rule-required="true" data-rule-text="true" class="form-check-input correct_ans" value="D">';
            html_code += '</div></div>';

            html_code += '<div class="col-sm-12"><div class="form-group">';
            html_code += '<label><b>Explain</b>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="explain[]" value="Y" class="explain' + count + '">&nbsp; Yes &nbsp;&nbsp;<input type="checkbox" name="explain[]" value="N" class="explain' + count + '" checked>&nbsp; No</label>';
            html_code += '</div></div>';

            html_code += '<div class="col-sm-12"><div class="form-group">';
            html_code += '<label for="solution' + count + '"><input type="checkbox" id="chkAns' + count + '"> <b>Solution</b></label>';
            html_code += '<textarea id="solution' + count + '" type="text" name="solution[]" data-rule-required="false" placeholder="Solution..." class="form-control solution" style="display:none"></textarea></div></div>';

            html_code += "<input type='hidden' id='date" + count + "' name='date[]' value='<?php echo $date;?>' class='date'>";

            $('#form_fields').append(html_code);
        }
    }

    /*************************************
     CANCEL BUTTON
     *************************************/

    $('#cancel_fields').click(function () {
        let num = $('#nquestions').val();

        swal({
            title: "Are you sure?",
            text: "Once cancel, you have to create test once again!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                });
                $('#save').css("display", "none");
                $('#cancel_fields').css("display", "none");
                $('#previous_data').css("display", "none");
                $('#form_fields').remove();

                $('#nquestions').val('');
                setTimeout(function () {
                    window.location.href = "create_test.php";
                }, 2000);
            } else {
                swal("Fill Questions!");
            }
        });
    });

    /*************************************
     FORM SUBMITION
     *************************************/

    $('#question_form').validate();

    $('#question_form').submit(function (event) {
        event.preventDefault();
        let total = $('#nquestions').val();

        for (var i = 1; i < total + 1; i++) {
            if ($('#question' + i).val() === '') {
                $('#message').html('<div class="alert alert-danger">All Questions are required.</div>');
                $('#question' + i).focus();
                $('#question' + i).css('border-color', '#E5343D');
            }
            if ($('#opt1' + i).val() === '') {
                $('#opt1' + i).focus();
                $('#opt1' + i).css('border-color', '#E5343D');
            }
            if ($('#opt2' + i).val() === '') {
                $('#opt2' + i).focus();
                $('#opt2' + i).css('border-color', '#E5343D');
            }
            if ($('#opt3' + i).val() === '') {
                $('#opt3' + i).focus();
                $('#opt3' + i).css('border-color', '#E5343D');
            }
            if ($('#opt4' + i).val() === '') {
                $('#opt4' + i).focus();
                $('#opt4' + i).css('border-color', '#E5343D');
            }
        }


        $.ajax({
            url: "../helpers/insert_questions.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                if (data === 'ok') {
                    $('#message').html('<div class="alert alert-success">Questions Created successfully.</div>');
                    $('#save').css("display", "none");
                    $('#cancel_fields').css("display", "none");
                    $('#previous_data').css("display", "none");

                    for (var i = 1; i <= num; i++) {
                        $('.widget' + i).remove();
                    }

                    $('#form_fields').remove();

                    let test_id = $('#test_id').val();
                    let no_of_ques = $('#nquestions').val();

                    swal({
                        title: "All Questions Created.",
                        text: "Please, Map All questions to its Actual module!",
                        icon: "success",
                        buttons: true,
                        dangerMode: false,
                        showCancelButton: false,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "../../mapping.php",
                                method: "POST",
                                data: {test_id: test_id, no_of_ques: no_of_ques},
                                success: function (data) {
                                    if (data === 'ok') {
                                        $('#message').html('<div class="alert alert-success">Invite candidate for this test.</div>');
                                        $('#share').css('display', 'block');
                                    } else {
                                        $('#message').html('<div class="alert alert-warning">Something Wrong.</div>');
                                    }
                                }
                            });
                            swal("Poof! Done!", {
                                icon: "success",
                            });
                        } else {
                            $.ajax({
                                url: "../../mapping.php",
                                method: "POST",
                                data: {test_id: test_id, no_of_ques: no_of_ques},
                                success: function (data) {
                                    if (data === 'ok') {
                                        $('#message').html('<div class="alert alert-success">Invite candidate for this test.</div>');
                                        $('#share').css('display', 'block');
                                    } else {
                                        $('#message').html('<div class="alert alert-warning">Something Wrong.</div>');
                                    }
                                }
                            });
                            swal("Poof! Done!", {
                                icon: "success",
                            });
                        }
                    });
                } else if (data === 'fail') {
                    $('#message').html('<div class="alert alert-danger">All Fields are Required!</div>');
                }
            }
        });
    });

    let total = $('#nquestions').val();

    // Check
    $('input[type=checkbox]').click(function () {
        for (var i = 1; i < total + 1; i++) {
            if ($('#chkimg' + i).prop("checked") === true) {
                $('#qimg' + i).css('display', 'block');
            }
            else if ($('#chkimg' + i).prop("checked") === false) {
                $('#qimg' + i).css('display', 'none');
            }
            if ($('#chkAns' + i).prop("checked") === true) {
                $('#solution' + i).css('display', 'block');
            }
            else if ($('#chkAns' + i).prop("checked") === false) {
                $('#solution' + i).css('display', 'none');
            }
        }
    });

    // Check check box is checked or not
    $('input[type="checkbox"]').on('change', function () {
        $(this).siblings('input[type="checkbox"]').prop('checked', false);
    });

});