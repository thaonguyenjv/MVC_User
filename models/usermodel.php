<?php
class UserModel {
    private $link; // Đóng gói biến thành viên private để lưu kết nối CSDL
    
    // Constructor: Được gọi khi khởi tạo đối tượng
    public function __construct() {
        require_once "modules/db_module.php";
        taoKetNoi($this->link); // Tạo kết nối đến CSDL
    }
    
    // Destructor: Được gọi khi đối tượng bị hủy
    public function __destruct() {
        giaiPhongBoNho($this->link, null); // Giải phóng kết nối CSDL
    }
    
    // Phương thức lấy tất cả người dùng
    public function getAllUsers() {
        $query = "SELECT * FROM users ORDER BY id";
        $result = chayTruyVanTraVeDL($this->link, $query);
        return layDuLieu($result);
    }
    
    // Phương thức lấy thông tin người dùng theo ID
    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = chayTruyVanTraVeDL($this->link, $query);
        $data = layDuLieu($result);
        return count($data) > 0 ? $data[0] : null;
    }
    
    // Phương thức tìm kiếm người dùng
    public function searchUsers($keyword) {
        $query = "SELECT * FROM users WHERE username LIKE '%$keyword%' OR url LIKE '%$keyword%' ORDER BY id";
        $result = chayTruyVanTraVeDL($this->link, $query);
        return layDuLieu($result);
    }
}
?>