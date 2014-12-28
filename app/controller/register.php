<?php
use Model\User;

class RegisterController {

    public function getIndex() {
        include VIEW_PATH . 'register.php';
        unset($_SESSION['register']);
    }

    public function postIndex() {

        $login = $_POST['login'];
        $password = $_POST['password'];
        $password_confirm = $_POST['confirm_password'];
        $contacts = $_POST['contacts'];

        if (!empty($login) && !empty($password) && !empty($password_confirm) && $password == $password_confirm) {

            $user = new User;

            $user->setLogin($login);
            $user->setPassword($password);
            $user->setContacts($contacts);

            $user->save();

        }

        header('Location: /register/');

    }
}
