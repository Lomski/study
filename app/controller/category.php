<?php
class CategoryController {

    public function getIndex () {

        $category = new \Model\Category();

        $categories = $category->getAll();

        $item = new \Model\Item();

        $items = $item->getAll();

        include VIEW_PATH . 'category.php';
    }

    public function postAdd()
    {
        $result = Auth::login($_POST['login'], $_POST['password']);

        if ($result instanceof \Exception) {
            $_SESSION['login']['error'] = $result->getMessage();
            header('Location: /auth/login/');
        } else {
            $_SESSION['user']['data'] = $result;
            $_SESSION['is_auth'] = true;
            header('Location: /');
        }

    }

    public function getLogout () {
        Auth::logout();
    }

} 