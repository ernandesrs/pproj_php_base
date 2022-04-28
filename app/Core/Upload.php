<?php

namespace App\Core;

use CoffeeCode\Uploader\File;
use CoffeeCode\Uploader\Image;
use CoffeeCode\Uploader\Media;
use Exception;

class Upload
{
    /** @var string */
    private $uploadDir;

    /** @var string */
    private $subDirs;

    /** @var bool */
    private $monthYearPath;

    /** @var Alert */
    private $alert;

    /**
     * @param string $subDirs
     * @param bool $monthYearPath
     */
    public function __construct(string $subDirs, bool $monthYearPath = true)
    {
        $this->uploadDir = CONF_BASE_PATH . DIRECTORY_SEPARATOR . CONF_UPLOADS_DIR;
        $this->subDirs = $subDirs;
        $this->monthYearPath = $monthYearPath;
        $this->alert = null;
    }

    /**
     * @param array $file
     * @param string|null $name
     * @return string|null
     */
    public function file(array $file, ?string $name = null): ?string
    {
        $name = $name ?? md5($file["name"] . "-" . time());
        try {
            $uploadedPath = (new File($this->uploadDir, $this->subDirs, $this->monthYearPath))
                ->upload($file, $name);
            return $this->clearPath($uploadedPath);
        } catch (Exception $exeption) {
            $this->alert = Alert::error($exeption->getMessage());
            return null;
        }
    }

    /**
     * @param array $image
     * @param string|null $name
     * @return string|null
     */
    public function image(array $image, ?string $name = null): ?string
    {
        $name = $name ?? md5($image["name"] . "-" . time());
        try {
            $uploadedPath = (new Image($this->uploadDir, $this->subDirs, $this->monthYearPath))
                ->upload($image, $name);
            return $this->clearPath($uploadedPath);
        } catch (Exception $exeption) {
            $this->alert = Alert::error($exeption->getMessage());
            return null;
        }
    }

    /**
     * @param array $media
     * @param string|null $name
     * @return string|null
     */
    public function media(array $media, ?string $name = null): ?string
    {
        $name = $name ?? md5($media["name"] . "-" . time());
        try {
            $uploadedPath = (new Media($this->uploadDir, $this->subDirs, $this->monthYearPath))
                ->upload($media, $name);
            return $this->clearPath($uploadedPath);
        } catch (Exception $exeption) {
            $this->alert = Alert::error($exeption->getMessage());
            return null;
        }
    }

    /**
     * @return Alert|null
     */
    public function alert(): ?Alert
    {
        return $this->alert;
    }

    /**
     * @param string|null $uploadedPath
     * @return string|null
     */
    private function clearPath(?string $uploadedPath): ?string
    {
        return $uploadedPath ? str_replace($this->uploadDir, "", $uploadedPath) : null;
    }
}
