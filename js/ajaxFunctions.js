$(document).ready(function(){
    //лампочка
    $('.cube-switch .switch').click(function() {
        if ($('.cube-switch').hasClass('active')) {
            $('.cube-switch').removeClass('active');
            $('#light-bulb2').css({'opacity': '0'});
        } else {
            $('.cube-switch').addClass('active');
            $('#light-bulb2').css({'opacity': '0.8'});
        }
    });
    //логирование изменения цветовой температуры
    $('.value').bind('DOMSubtreeModified',function(){
        $('#light-bulb2').css('background', 'rgb(255,255,'+1*$('.value').html()+')');
        this.click(console.log($('.value').html()));
    });
});
//функция для отправки данных по урлу
function sendWithAction(data,action,url,callback){
    var res = JSON.stringify(data);
    $.ajax({
        url: url+'?action='+action,
        type: "POST",
        data:'data='+res,
        success: callback
    });
}

//колбек для изменения названия комнаты
function roomNameEdit(response) {
    if (response == 'fail') {
        Materialize.toast('Error! Unable to change!', 3000, 'rounded');
    }
    else {
        $('#edt_name').val(response);
        $('#roomName').html(response);
    }
}

//колбек функция для удаления человека из комнаты
function userFromRoom(response){
    var countMembersBlock = $('#countMembers');
    var user = JSON.parse(response);
    var countMembers = +(countMembersBlock.html().substr(9));
    countMembers-=1;
    $('#member_'+user.id).remove();
    $('#users').append('<li id="user_'+user.id+'">' +
        '<div class="collapsible-header blue-grey darken-1 white-text">' + user.name +
        '<i onclick="" class="close material-icons right">trending_flat</i></div>' +
        '<div  class="collapsible-body"><p>'+user.description+'</div></li>');
    countMembersBlock.html('Members: '+ countMembers);
}