<?php
namespace Model;

class Category {

    public $id = null;
    public $name;
    public $parentID = 0;

    public function __construct($id = null) {
        
        if ($id) {
            $db = \DB::getInstance()->connect;

            $query = $db->prepare("SELECT id, name, parent_id FROM category WHERE id = ? LIMIT 1");
            $query->execute(array($id));
            $result = $query->fetch();

            $this->setName($result['name']);
            $this->setParentID($result['parent_id']);
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

    public function setParentID($parentID) {
        $this->parentID = $parentID;
    }

    public function getParentID() {
        return $this->parentID;
    }

    public function create() {
        $db = \DB::getInstance()->connect;
        $query = $db->prepare("INSERT INTO `category` (`name`, `parent_id`) VALUES (?, ?)");
        return $query->execute(array($this->name, $this->parentID));
    }

    public function delete() {
        if ($this->id) {
            $db = \DB::getInstance()->connect;
            try {
                $db->beginTransaction();

                $query = $db->prepare("DELETE FROM `category` WHERE (id = ?) OR (parent_id = ?)");
                $query->execute(array($this->id, $this->id));

                $query = $db->prepare("DELETE FROM `item` WHERE category_id = ?");
                $query->execute(array($this->id));

                $db->commit();

            } catch (\Exception $e) {
                $db->rollBack();
                dd_($e);
                return false;
            }

            return true;

        }
        return false;
    }

    public function update() {
        $db = \DB::getInstance()->connect;
        $query = $db->prepare("UPDATE `category` SET `name` = ?, `parent_id` = ? WHERE `id` = ?");
        return $query->execute(array($this->name, $this->parentID, $this->id));
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

        $query = $db->prepare("SELECT `c`.`id`, `c`.`name`, `c`.`parent_id`, `pc`.`name` as `parent_name` FROM `category` as `c` LEFT JOIN `category` as `pc` ON `c`.`parent_id` = `pc`.`id`");
        $query->execute();
        $result = $query->fetchAll();

        $temp = array();

        foreach ($result as $item) {

            if ($item['parent_id'] > 0) {
                $temp[$item['parent_id']]['childs'][$item['id']] = $item;
            } else {

                if (isset($temp[$item['id']]['childs'])) {
                    $temp[$item['id']] = array_merge($temp[$item['id']], $item);
                } else {
                    $temp[$item['id']] = $item;
                }

            }

        }

        return $temp;

    }

}

