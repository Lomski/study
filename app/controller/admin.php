<?php
class AdminController {

    public function getIndex () {

        if (Auth::check() && Auth::hasRole('admin')) {
            include VIEW_PATH . 'admin.php';
        } elseif (Auth::check() && !Auth::hasRole('admin')) {
            header('Location: /');
        } else {
            include VIEW_PATH . 'auth.php';
        }
    }

    public function getItems() {
        if (Auth::hasRole('admin')) {
            $item = new \Model\Item();
            $items = $item->getAll();
            include VIEW_PATH . 'admin.items.php';

        } else {
            header('Location: /');
        }
    }

    public function getCategories() {
        if (Auth::hasRole('admin')) {
            $category = new \Model\Category();
            $categories = $category->getAll();
            include VIEW_PATH . 'admin.categories.php';
        } else {
            header('Location: /');
        }
    }

    public function getUpdateItem() {
        if (Auth::hasRole('admin')) {

            $item_id = $_GET['id'];
            $item = new \Model\Item($item_id);

            $category = new \Model\Category();
            $categories = $category->getAll();

            include VIEW_PATH . 'items.update.php';

        } else {
            header('Location: /');
        }
    }

    public function getUpdateCategory() {
        if (Auth::hasRole('admin')) {
            $category_id = $_GET['id'];
            $category = new \Model\Category($category_id);
            $categories = $category->getAll();


            include VIEW_PATH . 'category.update.php';

        } else {
            header('Location: /');
        }
    }

    public function postUpdateItem() {
        if (Auth::hasRole('admin')) {

            $item_id = $_POST['id'];

            $webName = '';

            $item = new \Model\Item($item_id);

            if ($_FILES['image']['error'] == 0) {

                $imagine = new Imagine\Gd\Imagine();

                $dirUploads = realpath(
                    __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public'
                );

                $destDir = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'items' . DIRECTORY_SEPARATOR;

                if (!is_dir($dirUploads . $destDir)) {
                    if (!mkdir($dirUploads . $destDir, 0, true)) {
                        throw new Exception('Не удалось создать папку ' . $dirUploads . $destDir);
                    }
                }

                $filename = md5(microtime());
                $webName = $destDir . $filename . '.jpg';
                $imagine->open($_FILES['image']['tmp_name'])->save($dirUploads . $webName);

                $item->setImage($webName);

            }

            $available = isset($_POST['available']) ? true : false;

            $item->setName($_POST['name']);
            $item->setDescription($_POST['description']);
            $item->setPrice($_POST['price']);
            $item->setAvailable($available);
            $item->setCategoryID($_POST['category']);

            $item->save();

            header('Location: /admin/items/');
        } else {
            header('Location: /');
        }
    }

    public function postUpdateCategory() {
        if (Auth::hasRole('admin')) {

            $category_id = $_POST['id'];

            $category = new \Model\Category($category_id);

            $category->setName($_POST['name']);
            $category->setParentID($_POST['parent_id']);

            $category->save();

            header('Location: /admin/categories/');
        } else {
            header('Location: /');
        }
    }

    public function getDeleteItem() {
        if (Auth::hasRole('admin')) {

            $item_id = (int) $_GET['id'];

            $item = new \Model\Item($item_id);

            if($item->delete()) {
                header('Location: /admin/items/');
            } else {
                throw new Exception('Can\'t delete item!');
            }

        } else {
            header('Location: /');
        }
    }

    public function getDeleteCategory() {
        if (Auth::hasRole('admin')) {

            $category_id = (int) $_GET['id'];

            $category = new \Model\Category($category_id);

            if($category->delete()) {
                header('Location: /admin/categories/');
            } else {
                throw new Exception('Can\'t delete category!');
            }

        } else {
            header('Location: /');
        }
    }

    public function getAddItem () {
        if (Auth::hasRole('admin')) {
            $category = new \Model\Category();
            $categories = $category->getAll();
            include VIEW_PATH . 'items.add.php';
        } else {
            header('Location: /');
        }
    }

    public function getAddCategory () {
        if (Auth::hasRole('admin')) {
            $category = new \Model\Category();
            $categories = $category->getAll();
            include VIEW_PATH . 'category.add.php';
        } else {
            header('Location: /');
        }
    }

    public function postAddCategory () {
        if (Auth::hasRole('admin')) {
            $category = new \Model\Category();
            $category->setName($_POST['name']);
            $category->setParentID($_POST['parent_id']);
            $category->save();
            header('Location: /admin/categories/');
        } else {
            header('Location: /');
        }
    }

    public function postAddItem () {
        if (Auth::hasRole('admin')) {
            $webName = '';

            if ($_FILES['image']['error'] == 0) {

                $imagine = new Imagine\Gd\Imagine();

                $dirUploads = realpath(
                    __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public'
                );

                $destDir = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'items' . DIRECTORY_SEPARATOR;

                if (!is_dir($dirUploads . $destDir)) {
                    if (!mkdir($dirUploads . $destDir, 0, true)) {
                        throw new Exception('Не удалось создать папку ' . $dirUploads . $destDir);
                    }
                }

                $filename = md5(microtime());
                $webName = $destDir . $filename . '.jpg';
                $imagine->open($_FILES['image']['tmp_name'])->save($dirUploads . $webName);
            }

            $item = new \Model\Item();

            $available = isset($_POST['available']) ? true : false;

            $item->setName($_POST['name']);
            $item->setDescription($_POST['description']);
            $item->setPrice($_POST['price']);
            $item->setAvailable($available);
            $item->setCategoryID($_POST['category']);
            $item->setImage($webName);

            $item->save();


            header('Location: /admin/items/');
        } else {
            header('Location: /');
        }
    }


}