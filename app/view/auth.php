<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <? if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) { ?>
            <div>Привет, <?=$_SESSION['user']['data']['login']?></div>
        <? } else { ?>

            <? if (isset($_SESSION['login']) && isset($_SESSION['login']['error'])) { ?>
                <div>
                    <div><?=$_SESSION['login']['error']?></div>
                </div>
            <? } ?>

            <div class="container">
                <form role="form" method="post" action="/auth/login/">
                    <div class="form-group">
                        <label for="login">Email address</label>
                        <input name="login" type="text" class="form-control" id="login" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        <? } ?>
        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>