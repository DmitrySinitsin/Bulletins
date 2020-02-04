$("#tb").on('click', function ()
{
    if ($('#testfield').is(':hidden'))
    {
        $("#testfield").show();
        $("#tb").html('Скрыть');
    } else
    {
        $("#testfield").hide();
        $("#tb").html('Показать');
    }
});

$(".infobutton").on('click', function ()
{
    var r = $(this).data('id');
    $.ajax({
        type: "POST",
        url: "getinfo",
        data: {id: r},
        success: function (res)
        {
            $("[data-id='" + r + "'].infofield").val(res);
        },
        error: function ()
        {
            alert("error!");
        }
    });
    $("[data-id='" + r + "'].info").show();
});

$(".avabutton").on('click', function ()
{
    currPhotoId = $(this).data('id');
    currBullId = $(this).attr('bull');
    $.ajax({
        type: 'POST',
        url: 'setavatar',
        data: {PhotoId: currPhotoId, BullId: currBullId},
        success: function (res)
        {
            alert(res);
        },
        error: function ()
        {
            alert('error!')
        }
    });
});

$(".infosave").on('click', function ()
{
    var r = $(this).data('id');
    var info_ = $("[data-id='" + r + "'].infofield").val();
    $.ajax({
        type: "POST",
        url: "setinfo",
        data: {id: r, info: info_},
        success: function (res)
        {
            //alert(res)
        },
        error: function ()
        {
            alert("error!");
        }
    });
    location.reload();

});

$('.deletebutton').on('click', function ()
{
    var r = $(this).data('id');
    var del = confirm("Вы действительно хотите удалить это изображение?")
    if (del == true)
    {
        $.ajax({
            type: "POST",
            url: "setdelete",
            data: {id: r},
            success: function (res)
            {
                alert(res)
            },
            error: function ()
            {
                alert("error!");
            }
        });
        location.reload();
    } else
    {
        alert('Удаление отменено');
    }
}
);

$('.priceselect').ready(function () {
    
    //$("[data-id='1'].priceblock").show();
    for (let i=1; i<4; i++)
    {
        if ($("[data-id='"+i+"'].priceselect").hasClass('active'))
            $("[data-id='"+i+"'].priceblock").show();
    }
});

$('.priceselect').on('click', function () {
    $('.priceselect').removeClass('active');
    $(this).addClass('active');
    var id_ = $(this).data('id');
    $('.priceblock').hide();
    $("[data-id='" + id_ + "'].priceblock").show();
});