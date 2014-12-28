<?php
class Session implements SessionHandlerInterface {
    public function open($save_path, $session_id) {
        return true;
    }
    public function close() {
        return true;
    }
    public function read($session_id) {
        $db = DB::getInstance()->connect;
        $sql = "SELECT * FROM sessions WHERE session_id = '{$session_id}'";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetch();

        return $result['data'];
    }
    public function write($session_id, $data) {
        $db = DB::getInstance()->connect;

        $sql = "SELECT * FROM sessions WHERE session_id = '{$session_id}'";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        if (count($result) > 0) {
            $sql = "UPDATE sessions SET data = '{$data}' WHERE session_id ='{$session_id}'";
        } else {
            $sql = "INSERT INTO sessions(session_id, data) VALUES ('{$session_id}', '{$data}')";
        }

        $query = $db->prepare($sql);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function destroy($session_id) {
        $db = DB::getInstance()->connect;
        $sql = "DELETE FROM sessions WHERE session_id = '{$session_id}'";
        $query = $db->prepare($sql);
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function gc($maxlifetime) {

    }

    /*public function create_sid() {

    }*/
}