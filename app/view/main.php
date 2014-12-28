<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>


        <? if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) { ?>
            <div>Привет, <?=$_SESSION['user']['data']['login']?></div>
            <? if (Auth::hasRole('admin')) { ?>
                <div><a href="/admin/">Админка</a></div>
            <? } ?>
            <div><a href="/auth/logout/">Выйти</a></div>
        <? } else { ?>
            <div><a href="/auth/login/">Вход</a></div>
        <? } ?>

        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>