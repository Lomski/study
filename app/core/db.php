<?php
class DB {

    private static $instance = null;
    public $connect;

    private function __construct() {
        $conf = Config::load('db');
        $dns = "{$conf['engine']}:dbname={$conf['database']};host={$conf['host']};charset=utf8";
        $this->connect = new \PDO($dns, $conf['user'], $conf['password']);
        return $this;
    }

    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}