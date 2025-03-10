<?php
// require_once __DIR__ . "/Database.php";

// class Comment {
//     private $pdo;

//     public function __construct() {
//         $this->conn = Database::getInstance()->getConnection();
//     }

//     public function createComment($userId, $postId, $parentCommentId, $content) {
//         $sql = "INSERT INTO Comments (user_id, post_id, parent_comment_id, content) VALUES (:user_id, :post_id, :parent_comment_id, :content)";
//         $stmt = $this->conn->prepare($sql);
//         return $stmt->execute([
//             'user_id' => $userId, 
//             'post_id' => $postId, 
//             'parent_comment_id' => $parentCommentId, 
//             'content' => $content
//         ]);
//     }

//     public function getCommentsByPost($postId) {
//         $sql = "SELECT * FROM Comments WHERE post_id = :post_id ORDER BY create_date ASC";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute(['post_id' => $postId]);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }
// }
?>
