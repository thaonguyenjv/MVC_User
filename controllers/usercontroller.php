<?php
require_once "models/usermodel.php";

class UserController {
    private $userModel; // Thuộc tính private lưu đối tượng model
    
    // Constructor: Khởi tạo model
    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    // Phương thức hiển thị trang chính
    public function index() {
        $users = $this->userModel->getAllUsers();
        require_once "views/userlist.php";
        require_once "views/userindex.php";
    }
    
     // Phương thức lấy chi tiết người dùng (trả về JSON)
    public function detail($id) {
        $user = $this->userModel->getUserById($id);
        echo json_encode($user); // Trả về dữ liệu dạng JSON
    }
    
     // Phương thức tìm kiếm (trả về JSON)
    public function search() {
        if(isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $users = $this->userModel->searchUsers($keyword);
            echo json_encode($users);
        }
    }
}
?>