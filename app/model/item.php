<?php
namespace Model;

class Item {

    public $id = null;
    public $name;
    public $description = '';
    public $categoryID = 0;
    public $price;
    public $available = 1;
    public $image = '';

    public function __construct($id = null) {



        if ($id) {
            $db = \DB::getInstance()->connect;



            $query = $db->prepare("SELECT `id`, `name`, `price`, `category_id`, `available`, `description`, `image` FROM `item` WHERE id = ? LIMIT 1");


            $query->execute(array($id));

            $result = $query->fetch();


            $this->setName($result['name']);
            $this->setPrice($result['price']);
            $this->setCategoryID($result['category_id']);
            $this->setAvailable($result['available']);
            $this->setDescription($result['description']);
            $this->setImage($result['image']);
            $this->setID($result['id']);
        }

        return $this;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getID() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setCategoryID($categoryID) {
        $this->categoryID = $categoryID;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }

    public function setAvailable($available) {
        $this->available = $available;
    }

    public function getAvailable() {
        return $this->available;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public function create() {
        $db = \DB::getInstance()->connect;
        $query = $db->prepare("INSERT INTO `item` (`name`, `price`, `category_id`, `available`, `description`, `image`) VALUES (?, ?, ?, ?, ?, ?)");
        return $query->execute(array($this->name, $this->price, $this->categoryID, $this->available, $this->description, $this->image));
    }

    public function delete() {
        if ($this->id) {
            $db = \DB::getInstance()->connect;
            $query = $db->prepare("DELETE FROM `item` WHERE id = ?");
            $result = $query->execute(array($this->id));
            if ($result) {
                $filename = PUBLIC_PATH . substr($this->image, 1);
                if (file_exists($filename)) {
                    unlink($filename);
                }
                return true;
            }
        }
        return false;
    }

    public function update() {
        $db = \DB::getInstance()->connect;

        $query = $db->prepare("UPDATE `item` SET `name` = ?, `price` = ?, `category_id` = ?, `available` = ?, `description` = ?, `image` = ? WHERE `id` = ?");
        return $query->execute(array($this->name, $this->price, $this->categoryID, $this->available, $this->description, $this->image, $this->id));
    }

    public function save() {

        if ($this->id === null) {
            $this->create();
        } else {
            $this->update();
        }

    }

    public function getAll() {
        $db = \DB::getInstance()->connect;

        $query = $db->prepare(
            "SELECT
                `i`.`id` ,
                `i`.`name` ,
                `i`.`price` ,
                `i`.`category_id` ,
                `i`.`available` ,
                `i`.`description` ,
                `i`.`image` ,
                `c`.`parent_id`,
                `c`.`id` AS  `category_id`,
                `c`.`name` AS  `category_name`,
                `c2`.`name` AS `category_parent_name`
            FROM  `item` AS  `i`
            LEFT JOIN `category` AS  `c` ON  `i`.`category_id` =  `c`.`id`
            LEFT JOIN `category` AS  `c2` ON  `c`.`parent_id` =  `c2`.`id`");

        $query->execute();
        $result = $query->fetchAll();

        return $result;
    }

}

