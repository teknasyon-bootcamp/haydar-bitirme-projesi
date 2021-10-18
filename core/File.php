<?php

namespace Core;

class File
{
    public string $name;
    public int $size;
    public string $mimeType;
    public string $tempPath;
    public string $extension;
    public string $OriginalName;

    public function __construct(array $fileData)
    {
        $this->name = $fileData['name'];
        $this->tempPath = $fileData['tmp_name'];
        $this->extension =  pathinfo($this->name, PATHINFO_EXTENSION);
        $this->originalName = basename($this->name, '.' . $this->extension);
        $this->size = round(filesize($this->tempPath) / 1024, 1);

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $this->mimeType = finfo_file($fileInfo, $this->tempPath);
    }

    public function move(string $path)
    {
        $uploadsFolder = AppRootDirectory . "/public/";

        move_uploaded_file($this->tempPath, $uploadsFolder . $path);
    }

    public function isValidMimeType(array $allowedTypes)
    {
        $mimeTypeMatch = key_exists($this->mimeType, $allowedTypes);

        $extensionMatch = false;

        if ($mimeTypeMatch) {

            if (is_string($allowedTypes[$this->mimeType])) {
                $allowedTypes[$this->mimeType] = [$allowedTypes[$this->mimeType]];
            }

            $extensionMatch = in_array($this->extension, $allowedTypes[$this->mimeType]);
        }


        return $mimeTypeMatch && $extensionMatch;
    }

    public function getRandomizeName()
    {
        return $this->originalName . "-" . uniqid() . "." . $this->extension;
    }
}
