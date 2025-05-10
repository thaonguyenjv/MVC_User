<?php
require_once "controllers/usercontroller.php";

$controller = new UserController();

// Phân tích tham số URL để xác định action
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    switch ($action) {
        case 'detail':
            if (isset($_GET['id'])) {
                $controller->detail($_GET['id']);
            }
            break;
        case 'search':
            $controller->search();
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
?>