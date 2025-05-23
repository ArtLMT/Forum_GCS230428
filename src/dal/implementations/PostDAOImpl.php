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

    private function mapToPost($data) : object 
    {
        return new Post(
            $data['post_id'],        // postId
            $data['title'],          // title
            $data['content'],        // content
            0,                       // voteScore (default to 0)
            $data['user_id'],        // userId
            $data['module_id'],      // moduleId
            $data['create_date'],    // timestamp
            $data['username'],       // username
            $data['module_name'],    // moduleName
            $data['image_path'] ?? null,   // image
            $data['avatar'] ?? null
        );
    }

    private function mapToPosts($datas)
    {
        $posts = [];
        foreach ($datas as $data) {
            $posts[] = $this->mapToPost($data);
        }
        return $posts;
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
            ':post_id' => $postId,
            ':image_path' => $imagePath
        ];
    
        $this->executeQuery($query, $params);
    }
    

    public function getPostById($postId) : ?post
    {
            $query = " SELECT p.post_id, p.title, p.content, p.user_id, p.module_id, p.create_date, p.image_path, 
                    u.image_path AS avatar, u.username AS username, m.module_name AS module_name 
                    FROM posts p
                    INNER JOIN users u ON p.user_id = u.user_id
                    INNER JOIN modules m ON p.module_id = m.module_id
                    WHERE p.post_id = :post_id
                    ORDER BY p.create_date DESC";

        $stmt = $this->executeQuery($query, [':post_id' => $postId]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC); // array
        return $data ? $this->mapToPost($data) : null; // return object
    }

    public function getPostByTitle($title) : ?post
    {
        $query = "SELECT p.post_id, p.title, p.content, p.user_id, p.module_id, p.create_date, p.image_path, 
                u.image_path AS avatar, u.username AS username, m.module_name AS module_name
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN modules m ON p.module_id = m.module_id
                WHERE p.title = :title
                ORDER BY p.create_date DESC";
        $stmt = $this->executeQuery($query, [':title' => $title]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC); // array
        return $data ? $this->mapToPost($data) : null; // return object
    }

    public function getPostByUserId($userId) 
    {
        $query = "SELECT p.post_id, p.title, p.content, p.user_id, p.module_id, p.create_date, p.image_path, u.image_path AS avatar, u.username AS username, m.module_name AS module_name
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN modules m ON p.module_id = m.module_id
                WHERE u.user_id = :user_id
                ORDER BY p.create_date DESC";
        $stmt = $this->executeQuery($query, ['user_id' => $userId]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $posts = [];
        foreach($rows as $row) {
            $posts[] = $this->mapToPost($row);
        }
        return $posts;
    }

    public function countPostByUser($userId) : int
    {
        $query = "SELECT COUNT(*) AS post_count
                FROM posts
                WHERE user_id = :user_id";
        $stmt = $this->executeQuery($query, [':user_id' => $userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['post_count'];
    }

    public function getPostsByModuleId($moduleId)
    {
        $query = " SELECT p.post_id, p.title, p.content, p.user_id, p.module_id, p.create_date, p.image_path, u.image_path AS avatar, u.username AS username, m.module_name AS module_name 
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN modules m ON p.module_id = m.module_id
                WHERE m.module_id = :module_id
                ORDER BY p.create_date DESC";

        $stmt = $this->executeQuery($query, [':module_id' => $moduleId]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC); // fetch ALL rows
        return !empty($rows) ? $this->mapToPosts($rows) : [];
        
    }

    public function getAllPosts() : array
    {
        // $query = "SELECT * FROM posts";
        $query = "SELECT p.post_id, p.title, p.content, p.user_id, p.module_id, p.create_date, p.image_path, u.image_path AS avatar, u.username AS username, m.module_name AS module_name
                    FROM posts p
                    INNER JOIN users u ON p.user_id = u.user_id
                    INNER JOIN modules m ON p.module_id = m.module_id
                    ORDER BY p.create_date DESC";
        $stmt = $this->executeQuery($query);

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $posts = [];
        foreach ($rows as $row) {
            $posts[] = $this->mapToPost($row); // Converts database row to Post object
        }
    
        return $posts; // Returns an array of Post objects
    }

    public function deletePost($postId) 
    {
        $query = "DELETE FROM posts WHERE post_id = :post_id";
        $stmt = $this->executeQuery($query, [':post_id' => $postId]);
    }

    public function getTotalPost()
    {
        $query = "SELECT COUNT(post_id) AS total FROM posts";
        $stmt = $this->executeQuery($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function getPostsPaginated($limit, $offset): array
    {
        $query = "SELECT p.post_id, p.title, p.content, p.user_id, p.module_id, p.create_date, p.image_path, u.image_path AS avatar, u.username AS username, m.module_name AS module_name
                    FROM posts p
                    INNER JOIN users u ON p.user_id = u.user_id
                    INNER JOIN modules m ON p.module_id = m.module_id
                    ORDER BY p.create_date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $this->mapToPosts($rows);
    }
}
?>
