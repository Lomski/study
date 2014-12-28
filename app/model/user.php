<?php
namespace Model;

class User {

    public $id = null;
    public $login;
    public $password;
    public $contacts;

    public function __construct($id = null) {
        
        if ($id) {
            $db = \DB::getInstance()->connect;

            $query = $db->prepare("SELECT id, login, contacts FROM user WHERE id = ? LIMIT 1");
            $query->execute(array($id));
            $result = $query->fetch();

            $this->setLogin($result['login']);
            $this->setContacts($result['contacts']);
            $this->setID($result['id']);
        }

        return $this;
    }

    public function getUserByLogin($login) {

        if ($login) {
            $db = \DB::getInstance()->connect;

            $query = $db->prepare("SELECT id, login, contacts FROM user WHERE login = ? LIMIT 1");
            $query->execute(array($login));
            $result = $query->fetch();

            $this->setLogin($result['login']);
            $this->setContacts($result['contacts']);
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

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setContacts($contacts) {
        $this->contacts = $contacts;
    }

    public function getContacts() {
        return $this->contacts;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function create() {
        $db = \DB::getInstance()->connect;

        $query = $db->prepare("SELECT id FROM user WHERE login = ?");
        $query->execute(array($this->login));
        $result = $query->fetchAll();

        unset($_SESSION['register']['errors']);

        if (count($result) > 0) {
            $_SESSION['register']['errors'][] = 'Такой пользователь уже существует';
        } else {

            $query = $db->prepare("INSERT INTO `user` (`login`, `password`, `contacts`) VALUES (?, ?, ?)");

            if ($query->execute(array($this->login, md5($this->password), $this->contacts))) {
                $_SESSION['register']['ok'] = true;
            }

        }
    }

    public function update() {

    }

    public function save() {

        if ($this->id === null) {
            $this->create();
        } else {
            $this->update();
        }

    }

}

