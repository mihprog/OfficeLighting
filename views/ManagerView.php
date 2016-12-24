<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager page</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/css/materialize.css">
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<header>
    <div id="header" class="container">
        <a class="modal-trigger indexButton" href="#modalAuth"><i class="material-icons">vpn_key</i></a>
    </div>
</header>
<nav id="menu" class="indigo darken-2">
</nav>
<!--выезжающая менюшка с данными и их редактированием-->
<ul id="slide-out" class="side-nav">
    <li><div class="userView">
        <span class="black-text" id="span_name">Name: <?php echo $managerData['name']?></span>
        <br>
        <span class="black-text">Email: <?php echo $managerData['email']?></span>
        <br>
        <span class="black-text" id="span_tel">Telephone: <?php echo $managerData['telephone']?></span>
    </div></li>
    <li><div class="divider"></div></li>
    <li><a class="waves-effect modal-trigger" href="#modalEdit">Change info</a></li>
    <li><a class="waves-effect modal-trigger" href="#modalPassword">Change password</a></li>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

<div id="UserContent" class="container">
    <!--модальное окно для выхода-->
    <div id="modalAuth" class="modal col s12 m3 blue-grey darken-1">
        <div class="modal-content center">
            <div id="fields" class="col">
                <h4>Are you really want to log out?</h4>
            </div>
            <div id="buttons" class="col">
                <a href="../logout.php" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">Yes</a>
                <a href="#" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">No</a>
            </div>
        </div>
    </div>
    <!--модальное окно для редактирования данных-->
    <div id="modalEdit" class="modal col s12 m3 blue-grey darken-1">
        <div class="modal-content center">
            <div id="fieldsEdit" class="col">
                <h4>Editing your data</h4>
                <form class="col s12 m6">
                    <input id="edt_name" type="text" class="validate" placeholder="Name" value="<?php echo $managerData['name']?>">
                    <input id="edt_telephone" type="text" class="validate" placeholder="Telephone" value="<?php echo $managerData['telephone']?>">
                </form>
            </div>
            <div id="buttonsEdit" class="col">
                <a onclick="editManager($('#edt_name').val(),$('#edt_telephone').val())" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">Edit</a>
                <a href="#!" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">
                    Close
                </a>
            </div>
        </div>
    </div>
    <!--модальное окно для редактирования пароля-->
    <div id="modalPassword" class="modal col s12 m3 blue-grey darken-1">
        <div class="modal-content center">
            <div id="fieldsPassword" class="col">
                <h4>Editing your password</h4>
                <form class="col s12 m6">
                    <input id="edt_psw" type="password" class="validate" placeholder="Password">
                    <input id="rpt_psw" type="password" class="validate" placeholder="Repeat password">
                </form>
            </div>
            <div id="buttonsPassword" class="col">
                <a onclick="register(['edt_psw','rpt_psw'],'edit.php?action=password')" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">Edit</a>
                <a href="" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">
                    Close
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!--карточка с данными менеджера-->
        <div class="card blue-grey darken-1 left-align col s12 m4">
            <div class="card-content white-text">
                <h5 id="name">Hello <?php echo $managerData['name']?>!</h5>
                <br>
                <span id="email">Your email: <?php echo $managerData['email']?></span>
                <br>
                <span id="telephone">Your telephone: <?php echo $managerData['telephone']?></span>
                <br>
                <a data-activates="slide-out" class="button-collapse btn-floating btn-large red">
                    <i class="small indigo darken-2 material-icons">mode_edit</i>
                </a>
            </div>
        </div>
            <div class="col s12 m8">
                <ul class="tabs indigo darken-2">
                    <li class="tab col s3"><a class="active white-text" href="#messages">Messages</a></li>
                    <li class="tab col s3"><a class="white-text" href="#rooms">Rooms</a></li>
                </ul>
                <!--все неотвеченные сообщения-->
                <div id="messages" class="col s12">
                    <ul class="collapsible" data-collapsible="accordion">
                        <?php foreach($messages as $message):?>
                        <li>
                            <div id="message<?php echo $message['id']?>" class="collapsible-header blue-grey darken-1 white-text"><?php echo $message['person']?>
                                <i onclick="removeMessage(<?php echo $message['id']?>)" class="close material-icons right">close
                                </i>
                            </div>
                            <div id="body<?php echo $message['id']?>" class="collapsible-body"><p><?php echo $message['message']?></p></div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <!--все обслуживаемые комнаты-->
                <div id="rooms" class="col s12">
                    <div class="collection">
                        <?php foreach($rooms as $room):?>
                        <a href="http://officelighting.com/room/<?php echo $room['id']?>" class="collection-item blue-grey darken-1 white-text"><span class="badge white-text"><?php echo $room['numPersons']?></span><?php echo $room['name']?></a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="fixed bottom">
    <div id="footer">
        <span>&copy;Mikhail Kravets</span>
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery-json-master/src/jquery.json.js"></script>
        <script type="text/javascript" src="/js/materialize.js"></script>
        <script type="text/javascript" src="/js/initialization.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script type="text/javascript" src="/js/ajaxFunctions.js"></script>
    </div>
</footer>
</body>
</html>