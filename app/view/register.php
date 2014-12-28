<html>
    <head>
        <link href="/assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

        <? if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) { ?>
            <div>Привет, <?=$_SESSION['user']['data']['login']?></div>
        <? } else { ?>

            <? if (isset($_SESSION['register']) && isset($_SESSION['register']['ok']) && $_SESSION['register']['ok'] == true) { ?>
                <div>Спасибо за регистрацию</div>
            <? } else { ?>

                <? if (isset($_SESSION['register']) && isset($_SESSION['register']['errors'])) { ?>
                    <? foreach ($_SESSION['register']['errors'] as $error) { ?>
                        <div><?=$error?></div>
                    <? } ?>
                <? } ?>

                <div class="container">
                    <form role="form" method="post" action="/register/">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input name="login" type="text" class="form-control" id="login" placeholder="Login">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm password</label>
                            <input name="confirm_password" type="password" class="form-control" id="password" placeholder="Confirm password">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm password</label>
                            <textarea name="contacts" class="form-control" id="password" placeholder="Contacts"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>

            <? } ?>

        <? } ?>

        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>