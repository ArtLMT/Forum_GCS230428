<?php
namespace src\dal\implementations;

use src\dal\BaseDAO;
use src\dal\interfaces\PostDAO;
use src\models\Post;
use config\Database;

class PostDAOImpl extends BaseDAO implements PostDAO {
    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    public function createPost($title, $content, $userId, $moduleId, $imagePath = null) 
    {
        $query = "INSERT INTO posts (title, content, user_id, module_id, image_path) 
                VALUES (:title, :content, :user_id, :module_id, :image_path)";
        $params = [
            ':title'      => $title,
            ':content'    => $content,
            ':user_id'    => $userId,
            ':module_id'  => $moduleId,
            ':image_path' => $imagePath,
        ];
        $this->executeQuery($query, $params);
    }

    public function updatePost($postId, $title, $content, $moduleId, $imagePath = null) 
    {
        if ($imagePath === '') {
            // The user wants to remove the image
            $query = "UPDATE posts
                      SET title = :title,
                          content = :content,
                          module_id = :module_id,
                          image_path = NULL
                      WHERE post_id = :post_id";
            $params = [
                ':title' => $title,
                ':content' => $content,
                ':module_id' => $moduleId,
                ':post_id' => $postId,
            ];
        } elseif ($imagePath) {
            // The user uploaded a new image
            $query = "UPDATE posts
                SET title = :title,
                    content = :content,
                    module_id = :module_id,
                    image_path = :image_path
                WHERE post_id = :post_id";
            $params = [
                ':title' => $title,
                ':content' => $content,
                ':module_id' => $moduleId,
                ':image_path' => $imagePath,
                ':post_id' => $postId,
            ];
        } else {
            // The user didn't remove or replace the image
            $query = "UPDATE posts
                      SET title = :title,
                          content = :content,
                          module_id = :module_id
                      WHERE post_id = :post_id";
            $params = [
                ':title' => $title,
                ':content' => $content,
                ':module_id' => $moduleId,
                ':post_id' => $postId,
            ];
        }

        $this->executeQuery($query, $params); 
    }   

    public function getPostById($postId) : ?post
    {
        $query = "SELECT * FROM posts WHERE post_id = :post_id";
        $stmt = $this->executeQuery($query, [':post_id' => $postId]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC); // array
        return $data ? $this->mapToPost($data) : null; // return object
    }

    public function getPostByTitle($title) : ?post
    {
        $query = "SELECT * FROM posts WHERE title = :title";
        $stmt = $this->executeQuery($query, [':title' => $title]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC); // array
        return $data ? $this->mapToPost($data) : null; // return object
    }

    public function deletePost($postId) 
    {
        $query = "DELETE FROM posts WHERE post_id = :post_id";
        $stmt = $this->executeQuery($query, [':post_id' => $postId]);
    }

    public function getAllPosts() : array
    {
        $query = "SELECT * FROM posts";
        $stmt = $this->executeQuery($query);

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $posts = [];
        foreach ($rows as $row) {
            $posts[] = $this->mapToPost($row); // Converts database row to Post object
        }
    
        return $posts; // Returns an array of Post objects
    }

    private function mapToPost($data) : object 
    {
        $userDAO = new UserDAOImpl();
        $username = $userDAO->getUserById($data['user_id'])->getUsername();
         return new Post(
            $data['post_id'],        // postId
            $data['title'],          // title
            $data['content'],        // content
            0,                       // voteScore (default to 0)
            $data['user_id'],        // userId
            $data['module_id'],      // moduleId
            $data['create_date'],    // timestamp
            null,                    // updatedTimestamp (default to null)
            $data['image_path'] ?? null   // image
        );
    }
}
?>
