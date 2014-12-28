<?php
class Auth
{

    public static function login($login, $password)
    {
        $db = DB::getInstance()->connect;
        $password_hash = md5($password);

        try {
            $query = $db->prepare("SELECT `u`.*, `r`.`label` as `role` FROM `user` as `u` LEFT JOIN `users_roles` as `ur` ON `u`.`id` = `ur`.`user_id` LEFT JOIN `roles` as `r` ON `ur`.`role_id` = `r`.`id` WHERE `login` = ? AND `password` = ?");
            $query->execute(array($login, $password_hash));
            $responce = $query->fetchAll();

            if (count($responce) == 0) {
                throw new \Exception('Ошибка авторизации, неверный логин или пароль');
            } else {
                $result = $responce[0];
            }

        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    public static function check() {
        return (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) ? true : false;
    }

    public static function hasRole($role) {
        if (Auth::check()) {
            return ($_SESSION['user']['data']['role'] == $role) ? true : false;
        } else {
            return false;
        }
    }

    public static function logout() {
        session_destroy();
        header('Location: /');
    }

} 