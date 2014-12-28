<?php
use Model\User;
class AuthController {

    public function getLogin () {
        if (Auth::check()) {
            header('Location: /');
        } else {
            include VIEW_PATH . 'auth.php';
        }
    }

    public function postLogin()
    {
        $result = Auth::login($_POST['login'], $_POST['password']);

        if ($result instanceof \Exception) {
            $_SESSION['login']['error'] = $result->getMessage();
            header('Location: /auth/login/');
        } else {
            $_SESSION['user']['data'] = $result;
            $_SESSION['is_auth'] = true;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }

    public function getLogout () {
        Auth::logout();
    }

} 