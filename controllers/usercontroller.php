<?php
require_once "models/usermodel.php";

class UserController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    public function index() {
        $users = $this->userModel->getAllUsers();
        require_once "views/userlist.php";
        require_once "views/userindex.php";
    }
    
    public function detail($id) {
        $user = $this->userModel->getUserById($id);
        echo json_encode($user);
    }
    
    public function search() {
        if(isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $users = $this->userModel->searchUsers($keyword);
            echo json_encode($users);
        }
    }
}
?>