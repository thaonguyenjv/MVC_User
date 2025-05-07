<?php
class UserModel {
    private $link;
    
    public function __construct() {
        require_once "modules/db_module.php";
        taoKetNoi($this->link);
    }
    
    public function __destruct() {
        giaiPhongBoNho($this->link, null);
    }
    
    public function getAllUsers() {
        $query = "SELECT * FROM users ORDER BY id";
        $result = chayTruyVanTraVeDL($this->link, $query);
        return layDuLieu($result);
    }
    
    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = chayTruyVanTraVeDL($this->link, $query);
        $data = layDuLieu($result);
        return count($data) > 0 ? $data[0] : null;
    }
    
    public function searchUsers($keyword) {
        $query = "SELECT * FROM users WHERE username LIKE '%$keyword%' OR url LIKE '%$keyword%' ORDER BY id";
        $result = chayTruyVanTraVeDL($this->link, $query);
        return layDuLieu($result);
    }
}
?>