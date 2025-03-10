<?php
// class Module {
//     private $pdo;

//     public function __construct($pdo) {
//         $this->pdo = $pdo;
//     }

//     // Thêm module mới
//     public function addModule($module_name) {
//         $sql = "INSERT INTO Modules (module_name) VALUES (:module_name)";
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindParam(':module_name', $module_name);
//         return $stmt->execute();
//     }

//     // Lấy danh sách tất cả modules
//     public function getAllModules() {
//         $sql = "SELECT * FROM Modules";
//         $stmt = $this->pdo->query($sql);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }

//     // Lấy module theo ID
//     public function getModuleById($module_id) {
//         $sql = "SELECT * FROM Modules WHERE module_id = :module_id";
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindParam(':module_id', $module_id);
//         $stmt->execute();
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }

//     // Xóa module
//     public function deleteModule($module_id) {
//         $sql = "DELETE FROM Modules WHERE module_id = :module_id";
//         $stmt = $this->pdo->prepare($sql);
//         $stmt->bindParam(':module_id', $module_id);
//         return $stmt->execute();
//     }
// }

?>