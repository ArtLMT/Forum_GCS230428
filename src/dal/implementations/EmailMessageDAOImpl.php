<?php
namespace src\dal\implementations;

use src\dal\BaseDAO;
use src\dal\interfaces\EmailMessageDAO;
use src\models\EmailMessage;
use config\Database;

class EmailMessageDAOImpl extends BaseDAO implements EmailMessageDAO {
    public function __construct() 
    {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    public function sendMessage(
        $title,
        $content,
        $userId
    ) {
        $query = "INSERT INTO emails (title, content, user_id)
                VALUES (:title, :content, :user_id)";
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $userId
        ];
        $this->executeQuery($query, $params);
    }

    public function getAllMessage() 
    {
        $query = "SELECT e.email_id, e.user_id, e.title, e.content, e.create_date, u.image_path AS avatar , u.username AS username
                FROM emails e
                INNER JOIN users u ON e.user_id = u.user_id
                ORDER BY e.create_date DESC";
        $stmt = $this->executeQuery($query);

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $messages = [];
        foreach ($rows as $row) {
            $messages[] = $this->getMessage($row);
        }

        return $messages;
    }   

    public function getMessage($data) : EmailMessage
    {
        return new EmailMessage(
            $data['email_id'],
            $data['title'],
            $data['content'],
            $data['create_date'],
            $data['user_id'] ?? null,
            $data['avatar'] ?? null,
            $data['username'] ?? null
        );
    }

    public function deleteEmail($emailId)
    {
        $query = "DELETE FROM emails
                WHERE email_id = :email_id";
        $stmt = $this->executeQuery($query,[':email_id' => $emailId]);
    }

    public function getMessageById($emailId) 
    {
        $query = "SELECT * FROM emails 
                WHERE email_id = :email_id";
        $stmt = $this->executeQuery($query,[':email_id' => $emailId]);
        return $this->getMessage($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function updateMessage($emailId, $title, $content)
    {
        $query = "UPDATE emails
                SET title = :title,
                    content = :content
                WHERE email_id = :email_id";
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':email_id' => $emailId,
        ];
        $this->executeQuery($query,$params);
    }

    public function countMessages()
    {
        $query = "SELECT COUNT(*) AS total FROM emails";

        $stmt = $this->executeQuery($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function getEmailMessagePaginated($limit, $offset)
    {
        $query = "SELECT e.email_id, e.user_id, e.title, e.content, e.create_date, u.image_path AS avatar , u.username AS username
                FROM emails e
                INNER JOIN users u ON e.user_id = u.user_id
                ORDER BY e.create_date DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $emails = [];

        foreach ($datas as $data) {
            $emails[] = $this->getMessage($data);
        }        

        return $emails;
    }
}
?>