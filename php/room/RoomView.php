<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="shortcut icon" href="img/favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/bulb.css" rel="stylesheet">
</head>
<body>
<input type="hidden" id="roomId" value="<?php echo $roomInfo['roomId'];?>">
<header>
    <div id="header" class="container">
        <a class="modal-trigger indexButton" href="#modalAuth"><i class="material-icons">vpn_key</i></a>
    </div>
</header>
<nav id="menu" class="indigo darken-2">
</nav>

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
                    <input id="edt_name" type="text" class="validate" placeholder="Name" value="<?php echo $roomInfo['roomName']?>">
                </form>
            </div>
            <div id="buttonsEdit" class="col">
                <a onclick="sendWithAction({'name':$('#edt_name').val()},'edit_room_name','roomFront.php',roomNameEdit);" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">Edit</a>
                <a href="#!" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">
                    Close
                </a>
            </div>
        </div>
    </div>
    <!--модальное окно для удаления комнаты-->
    <div id="modalDelete" class="modal col s12 m3 blue-grey darken-1">
        <div class="modal-content center">
            <div id="fieldsEdit" class="col">
                <h4>Delete room?</h4>
            </div>
            <div id="" class="col">
                <a onclick="sendWithAction({'id':<?php echo $roomInfo['roomId']?>},'delRoom','roomFront.php',delRoom)" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">Delete</a>
                <a href="#!" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">
                    Close
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <!--карточка с данными комнаты-->
        <div class="card blue-grey darken-1 left-align col s12 m4">
            <div class="card-content white-text">
                <h5><a class="white-text" href="managerFront.php?mId=<?php echo $roomInfo['managerId']?>"><i class="fa fa-long-arrow-left fa-3x" title="Back"></i></a></h5>
                <h5 id="roomName">Room <?php echo $roomInfo['roomName']?></h5>
                <br>
                <span id="countMembers">Members: <?php echo $roomInfo['membCount']?></span>
                <br>
                <span id="countMessages">Messages: <?php echo $roomInfo['messCount']?></span>
                <br>
                <a title="edit room" class="btn-floating btn-large red modal-trigger" href="#modalEdit"">
                    <i class="small indigo darken-2 material-icons">mode_edit</i>
                </a>
                <a title="delete room" class="btn-floating btn-large red modal-trigger right" href="#modalDelete"">
                <i class="small indigo darken-2 material-icons">delete</i>
                </a>
            </div>
        </div>
        <div class="col s12 m8">
            <ul class="tabs indigo darken-2">
                <li class="tab col s3"><a class="active white-text" href="#members">Members</a></li>
                <li class="tab col s3"><a class="white-text" href="#lighting">Lighting</a></li>
            </ul>
            <!--сотрудники-->
            <div class="col s12">
                <div class="col s12 m6 people">
                    <ul class="collapsible" data-collapsible="accordion" id="users">
                        <?php foreach($people as $freeUser):?>
                        <li id="user_<?php echo $freeUser['id'];?>">
                            <div class="collapsible-header blue-grey darken-1 white-text"><?php echo $freeUser['name'];?>
                                <i onclick="sendWithAction({'userId':<?php echo $freeUser['id'];?>,'roomId':<?php echo $roomInfo['roomId']?>},'toRoom','roomFront.php',userToRoom)" class="close material-icons right">trending_flat</i>
                            </div>
                            <div  class="collapsible-body"><p><?php echo $freeUser['description'];?></p></div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="col s12 m6 people">
                    <div class="card blue-grey darken-1">
                        <div class="card-content">
                            <h5 class="white-text center">In the room</h5>
                            <ul class="collapsible" data-collapsible="accordion" id="members">
                                <?php foreach($roomMembers as $user):?>
                                <li id="member_<?php echo $user['id'];?>">
                                    <div  class="collapsible-header white black-text"><?php echo $user['name'];?>
                                        <i onclick="sendWithAction({'id':<?php echo $user['id'];?>},'fromRoom','roomFront.php',userFromRoom)" class="close material-icons right">close</i>
                                    </div>
                                    <div  class="collapsible-body"><p><?php echo $user['description'];?></p></div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--освещение в комнате-->
            <div id="lighting" class="col s12">
                <div class="card blue-grey darken-1 left-align col s12 ">
                    <div class="card-content white-text">
                        <div href="" class="cube-switch">
                            <span class="switch">
                                <span class="switch-state off">Off</span>
                                <span class="switch-state on">On</span>
                            </span>
                        </div>
                        <div id="light-bulb" class="off ui-draggable" ><div id="light-bulb2" style="opacity: 0; "></div></div>
                        <br>
                        <form action="#">
                            <p class="range-field">
                                <input class="indigo darken-2" type="range" id="lightColor" min="100" max="255"/>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer class="fixed bottom">
    <div id="footer">
        <span>&copy;Mikhail Kravets</span>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-json-master/src/jquery.json.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/initialization.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/ajaxFunctions.js"></script>

        <script>
            var lightColor = <?php echo $roomInfo['light']?>;
            $(document).ready(function(){
                $('#lightColor').val(lightColor);
            });
        </script>
    </div>
</footer>
</body>
</html>