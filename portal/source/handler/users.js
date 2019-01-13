$(document).ready(function () {
    let btnType = "";
    // For Pending, Shortlisted, Selected and Rejected
    let jobId = $('#jobId').val();
    console.log(jobId);
    let typeSelector = ".application_view ul li:nth-child(1)";
    let typeLinkSelector = ".application_view ul li";
    let type = $(typeSelector).attr("value");
    $(typeSelector).addClass("active");
    allUser(jobId, type);
    btnType = type;

    // Left Side Menu All Users list
    let selector = "#all-user-info li:nth-child(1)";
    let linkSelector = '#all-user-info li';
    let firstUser = $(selector).attr('id');
    let userId = $(linkSelector).attr('id');

    //user(firstUser, jobId);
    setTimeout( function(){ user(firstUser, jobId, btnType); }, 500);

    $('body').on('click', typeLinkSelector, function () {
        let type = $(this).attr("value");
        btnType = type;
        user(userId, jobId, type);
        allUser(jobId, type);
        $(typeLinkSelector).removeClass('active');
        $(this).addClass("active");
    });

    $('body').on('click', linkSelector, function () {
        let userId = $(this).attr('id');
        setTimeout( function(){ user(userId, jobId, btnType); }, 200);

        $(linkSelector).removeClass('actived');
        $(this).addClass("actived");
    });

    function user(userId, jobId, type) {
        $.ajax({
            url: "../source/helpers/user.php",
            method: "POST",
            data: {userId:userId,jobId:jobId, type:type},
            success: function (data) {
                $('#user-info').html(data);
            }
        });
    }

    function allUser(jobId, type) {
        $.ajax({
            url: "../source/helpers/allUsers.php",
            method: "POST",
            data: {jobId:jobId, type: type},
            success: function (data) {
                $('#all-user-info').html(data);
            }
        });
    }

});