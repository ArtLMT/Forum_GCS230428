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
        $query = "SELECT * FROM emails";
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
            $data['user_id']
        );
    }

    public function deleteEmail($emailId)
    {
        $query = "DELETE FROM emails WHERE email_id = :email_id";
        $stmt = $this->executeQuery($query,[':email_id' => $emailId]);
    }

    public function getMessageById($emailId) 
    {
        $query = "SELECT * FROM emails WHERE email_id = :email_id";
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
}
?>