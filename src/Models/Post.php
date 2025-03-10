<?php
// require_once __DIR__ . "/Database.php";

// class Post {
//     private $pdo;

//     public function __construct() {
//         $this->conn = Database::getInstance()->getConnection();
//     }

//     public function createPost($userId, $moduleId, $title, $content) {
//         $sql = "INSERT INTO Posts (user_id, module_id, title, content) VALUES (:user_id, :module_id, :title, :content)";
//         $stmt = $this->conn->prepare($sql);
//         return $stmt->execute([
//             'user_id' => $userId, 
//             'module_id' => $moduleId, 
//             'title' => $title, 
//             'content' => $content
//         ]);
//     }

//     public function getAllPosts() {
//         $sql = "SELECT * FROM Posts ORDER BY create_date DESC";
//         $stmt = $this->conn->query($sql);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

//     public function getPostById($postId) {
//         $sql = "SELECT * FROM Posts WHERE post_id = :post_id";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute(['post_id' => $postId]);
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }
// }

try {
    include '../Database/dataBaseConnection.php';

    $sql = 'SELECT post_id, title, content, create_date FROM posts';

    $posts = $pdo->query($sql);
    $title = 'Post list';

    ob_start();
    include '../Views/postList.html.php';
    $output = ob_get_clean();
} catch (PDOExepction $e) {
    $title = 'An error has occured';
    $output = 'Database Eror: ' . $e->getMessage();

}

include '../Views/layout.html.php';
?>
