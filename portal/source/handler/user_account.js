$(document).ready(function () {
    let linkSelector = $('.sidebar-links li.sidebar-link');

    $('#contact').css('display','none');
    $('#timezone').css('display','none');
    $('#password').css('display','none');

    $(linkSelector).click(function () {
        var selected = $(this).attr('value');

        $(linkSelector).removeClass('active');
        $(this).addClass("active");


        switch (selected) {
            case "basic":
                $('#'+selected).css('display','block');
                $('#contact,#timezone, #password').css('display','none');
                break;

            case "contact":
                $('#'+selected).css('display','block');
                $('#basic, #timezone, #password').css('display','none');
                break;

            case "timezone":
                $('#'+selected).css('display','block');
                $('#contact, #basic, #password').css('display','none');
                break;

            case "password":
                $('#'+selected).css('display','block');
                $('#contact, #timezone, #basic').css('display','none');
                break;
        }

       // $('#'+selected).css('display','block');

    });
});