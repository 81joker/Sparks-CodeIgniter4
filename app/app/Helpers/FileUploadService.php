<?php

namespace App\Helpers;

use CodeIgniter\HTTP\Files\UploadedFile;
use RuntimeException;

class FileUploadService
{
    public function upload(UploadedFile $file, string $directory): string
    {

        if (!$file->isValid() || $file->hasMoved()) {
            // throw new RuntimeException('Invalid or already moved file');
            return '';
        }
        $uploadPath = FCPATH . "uploads/{$directory}/";

        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0777, true) && !is_dir($uploadPath)) {
            throw new RuntimeException(sprintf('Failed to create directory: %s', $uploadPath));
        }

        $newName = $file->getRandomName();

        try {
            $file->move($uploadPath, $newName);
        } catch (\Exception $e) {
            throw new RuntimeException('File upload failed: ' . $e->getMessage());
        }

        return "uploads/{$directory}/{$newName}";
    }

    public static function updateFile(
        ?UploadedFile $file,
        string $directory,
        ?string $oldFilePath = null
    ): ?string {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        $uploadService = new FileUploadService();

        try {
            $newPath = $uploadService->upload($file, $directory);
            
            $uploadService->deleteOldFile($oldFilePath);

            return $newPath;
        } catch (RuntimeException $e) {
            throw new RuntimeException('Image update failed: ' . $e->getMessage());
        }
    }

    public function deleteOldFile(?string $filePath): void
    {
        if ($filePath && file_exists(FCPATH . $filePath)) {
            @unlink(FCPATH . $filePath);
        }
    }
}