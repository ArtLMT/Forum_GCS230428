<?php
namespace src\utils;

class Utils {
    public static function handleImageUpload($file, $uploadDir) 
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null; // No file uploaded or error in upload
        }

        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allow only image file types
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Invalid file type.";
            return null;
        }

        // Generate a unique filename
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Ensure upload directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Define full path for saving the file
        $destPath = $uploadDir . DIRECTORY_SEPARATOR . $newFileName;
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            return "uploads/" . basename($uploadDir) . "/" . $newFileName; // Return relative path
        } else {
            echo "Error moving the uploaded file.";
            return null;
        }
    }

    public static function deleteImage($imagePath) {
        $fullPath = realpath(__DIR__ . '/../../public/' . $imagePath);
        
        if ($fullPath && file_exists($fullPath)) {
            unlink($fullPath); // Delete the file
        }
    }
    
    
}

?>