<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee page</title>
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

    <div class="row">
        <!--карточка с данными сотрудника-->
        <div class="card blue-grey darken-1 left-align col s12 m4">
            <div class="card-content white-text">
                <h5 id="name">Hello <?php echo $empData['name']?>!</h5>
                <br>
                <span id="email">Your email: <?php echo $empData['email']?></span>
                <br>
            </div>
        </div>
        <div class="messageCard card blue-grey darken-1 col s12 m4 offset-m1">
            <div class="card-content white-text center-align">
                <input id="message" type="text" placeholder="Your message">
                <br/>
                <a href="#" onclick="sendMessage(<?php echo $empData['id']?>);" class="logoutButton waves-effect waves-light btn modal-action modal-close indigo darken-2 white-text">
                    Send
                </a>
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