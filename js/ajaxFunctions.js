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
    var callbackFucntion = "sendWithAction({'userId':"+user.id+",'roomId':"+user.roomId+"},'toRoom','roomFront.php',userToRoom)";

    $('#member_'+user.id).remove();
    $('#users').append('<li id="user_'+user.id+'">' +
        '<div class="collapsible-header blue-grey darken-1 white-text">' + user.name +
        '<i onclick="'+callbackFucntion+'" class="close material-icons right user_i_'+user.id+'">trending_flat</i></div>' +
        '<div  class="collapsible-body"><p>'+user.description+'</div></li>');
    countMembersBlock.html('Members: '+ countMembers);

}
//колбек функция для добавления человека в комнату
function userToRoom(response){
    var countMembersBlock = $('#countMembers');
    var user = JSON.parse(response);
    var countMembers = +(countMembersBlock.html().substr(9));
    countMembers+=1;
    var callbackFunction = "sendWithAction({'id':"+user.id+"},'fromRoom','roomFront.php',userFromRoom)";

    $('#user_'+user.id).remove();
    $('#members').append('<li id="member_'+user.id+'">' +
        '<div class="collapsible-header white black-text">' + user.name +
        '<i onclick="'+callbackFunction+'" class="close material-icons right member_i_'+user.id+'">close</i></div>' +
        '<div  class="collapsible-body"><p>'+user.description+'</div></li>');
    countMembersBlock.html('Members: '+ countMembers);
}

function delRoom(response){
    var manager = JSON.parse(response);
    if(response!='fail') location.href='http://officelighting.com/managerFront.php?managerId='+manager.managerId;
    else Materialize.toast('Error! Unable to delete!', 3000, 'rounded');
}