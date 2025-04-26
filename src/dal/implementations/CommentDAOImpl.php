<?php
namespace src\dal\implementations;

use src\dal\BaseDAO;
use src\dal\interfaces\CommentDAO;
use src\models\Comment;
use config\Database;

class CommentDAOImpl extends BaseDAO {

    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    public function mapToComment($data)
    {
        return new Comment(
            $data['comment_id'],
            $data['content'],
            $data['user_id'],
            $data['username'] ?? null,
            $data['image_path'] ?? null,
            $data['post_id'],
            $data['create_date']
        );
    }

    // public function createComment($postId, $userId, $content)
    // {
    //     $query = "INSERT INTO comments(post_id, user_id, content)
    //             VALUES (:post_id, :user_id, :content)";
    //     $params = [
    //         ':post_id' => $postId,
    //         ':user_id' => $userId,
    //         ':content' => $content
    //     ];
    // }

    public function createComment($content, $userId, $postId) {
        $query = "INSERT INTO comments (content, user_id, post_id)
                VALUES (:content, :user_id, :post_id)";
        $params = [
            ':content' => $content,
            ':user_id' => $userId,
            ':post_id' => $postId
        ];
        $this->executeQuery($query, $params);
    }

    public function updateComment($commentId, $content) {
        $query = "UPDATE comments
                SET content = :content
                WHERE comment_id = :comment_id";
        $params = [
            ':content' => $content,
            ':comment_id' => $commentId
        ];
        $this->executeQuery($query, $params);
    }

    public function getCommentById($commentId) {
        $query = " SELECT comment_id, content, user_id,post_id, create_date
                FROM comments
                WHERE comment_id = :comment_id";
        $stmt = $this->executeQuery($query, [':comment_id' => $commentId]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC); // array
        return $data ? $this->mapToComment($data) : null; // return object
    }

    public function getCommentsByPostId($postId) {
        $query = "SELECT c.comment_id, c.content, c.user_id, c.post_id, c.create_date, 
                u.username, u.image_path
                FROM comments c
                INNER JOIN users u ON c.user_id = u.user_id
                WHERE post_id = :post_id";
        $stmt = $this->executeQuery($query, ['post_id' => $postId]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $posts = [];
        foreach($rows as $row) {
            $posts[] = $this->mapToComment($row);
        }
        return $posts;
    }

    public function deleteComment($commentId) {

    }

    public function getAllComments() {

    }
}