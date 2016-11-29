//адаптивность модального окна
$(document).ready(function()
{
    $('.cube-switch .switch').click(function() {
        if ($('.cube-switch').hasClass('active')) {
            $('.cube-switch').removeClass('active');
            $('#light-bulb2').css({'opacity': '0'});
        } else {
            $('.cube-switch').addClass('active');
            $('#light-bulb2').css({'opacity': '0.8'});
        }
    });
    $('.value').bind('DOMSubtreeModified',function(){
        $('#light-bulb2').css('background', 'rgb(255,255,'+1*$('.value').html()+')');
        console.log($('.value').html());
    });

    var w = $(document).width();
    var h = $(document).height();
    if(w<400||h<500)
    {
        $('#modalAuth').addClass('mobile');
        $('#modalPassword').addClass('mobile');
        $('#modalEdit').addClass('mobile');
        $('footer').addClass('mobile');
        $('#in_UserContent').addClass('mobile');
    }
        else if(w<500&&h>600)
    {
        $('footer').removeClass('mobile');
        $('#modalAuth').addClass('mobile');
        $('#in_UserContent').addClass('mobile')
    }
    else
    {
        $('#modalAuth').removeClass('mobile');
        $('#modalEdit').removeClass('mobile');
        $('#modalPassword').removeClass('mobile');
        $('footer').removeClass('mobile');
        $('#in_UserContent').removeClass('mobile')
    }
});

//функция для валидации полей ввода
//получает id и тип поля
//возвращает bool и помечает невалидные поля
function validation(id,type) {
    var input = $('#'+id);
    switch (type){
        case 'name':
            var r = /^[а-яА-ЯёЁa-zA-Z0-9 ]{1,30}$/i;
            if (!r.test(input.val())) {
                Materialize.toast('Your name should contain 1-30 characters!', 3000, 'rounded');
                input.css('border-color','red');
                return false;
            }
            else
            {
                input.css('border-color','green');
                return true;
            }
        break;
        case 'email':

            var r = /^[a-z]+([a-z]|[0-9]|_|\.)*@[a-z]+\.[a-z]+$/i;
            if (!r.test(input.val())) {
                Materialize.toast('Your email is invalid!', 3000, 'rounded');
                input.css('border-color','red');
                return false;
            }
            else
            {
                if(input.val().length>50)
                {
                    Materialize.toast('Your email length should be between 7 and 50 characters!', 3000, 'rounded');
                    input.css('border-color','red');
                    return false;
                }
                else {
                    input.css('border-color', 'green');
                    return true;
                }
            }
        break;
        case 'telephone':
        {
            var r = /^[0-9]{10,12}$/;
            if (!r.test(input.val())) {
                Materialize.toast('Your telephone should contain 10-12 numbers!', 3000, 'rounded');
                input.css('border-color','red');
                return false;
            }
            else
            {
                input.css('border-color','green');
                return true;
            }
        }break;
        case 'password':
        {
            var r = /^[a-zA-Z0-9]{3,30}$/;
            if (!r.test(input.val())) {
                Materialize.toast('Your password should contain 3-30 characters!', 3000, 'rounded');
                input.css('border-color','red');
                return false;
            }
            else
            {
                input.css('border-color','green');
                return true;
            }
        }break;
        case 'passwd':
        {
            var r = /^[a-zA-Z0-9]{3,30}$/;
            if (!r.test(input.val())) {
                if($('#edt_passwd').val()===''&&$('#rpt_passwd').val()==='')
                {
                    return true;
                }
                Materialize.toast('Your password should contain 3-30 characters!', 3000, 'rounded');
                input.css('border-color','red');
                return false;
            }
            else
            {
                if($('#edt_passwd').val()==$('#rpt_passwd').val()) {
                    input.css('border-color', 'green');
                    return true;
                }
                return false;
            }
        }break;
        case 'role':
        {
            return true;
        }break;
    }
}


//функция для отправки данных регистрации на сервер
// с предварительной проверкой валидности
//возвращает false если данные не валидные или же отрабатывает ajax
function register(arrId,serverFile)
{
    //проверяем валидность всех полей
    var c = 0;
    for(var i =0;i<arrId.length;i++)
    {
        var id = arrId[i];
        var type = arrId[i].substr(4);
        if(!validation(id,type)){
            c+=1;
        }
    }
    //в случае валидности - отправляем json на сервер
    if(c===0)
    {
        var prejson = {};
        for(var j =0;j<arrId.length;j++)
        {
            var id = arrId[j];
            prejson[id]=$('#'+id).val();
        }
        var res = JSON.stringify(prejson);

        $.ajax({
            url: 'php/'+serverFile,
            type: "POST",
            data:'regData='+res,
            success: successFunction
        });

    }
    else {
        //alert('something');
        return false;}
}
//функция успешной отправки ajax
function successFunction(data) {
    switch (data)
    {
        case 'fail':
            Materialize.toast('<img src="img/gandalf1.jpg">', 3000, 'rounded');
            break;
        case 'invalidData':
            Materialize.toast('Invalid data!', 3000, 'rounded');
            break;
        case 'emailInUse':
            Materialize.toast('Your email is already in use!', 3000, 'rounded');
            break;
        case 'status':
            Materialize.toast('Please, confirm your registration!', 3000, 'rounded');
            break;
        case 'complete':
            Materialize.toast('Registration completed!', 3000, 'rounded');
            Materialize.toast('Check your email to confirm the registration.', 3000, 'rounded');
            break;
        case 'EditComplete':
            Materialize.toast('Edit completed!', 3000, 'rounded');
            getUserData();
            break;
        default:
            //window.location = data;
            alert(data);
    }
}
//при помощи ajax получаем данные о пользователе
function getUserData()
{
    $.ajax({
        url: 'php/getData.php',
        type: "POST",
        success: putData
    });
}
//в случае успешного запроса - заносим данные о юзере в инпуты
function putData(data)
{
    //alert(data);
    data = JSON.parse(data);
    alert(data.email);
}
