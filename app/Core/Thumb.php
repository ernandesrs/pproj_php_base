<?php

namespace App\Core;

use CoffeeCode\Cropper\Cropper;

class Thumb
{
    /** @var Cropper */
    private $engine;

    /**
     * @param int $quality
     * @param int $compressor
     * @param bool $webP
     */
    public function __construct(int $quality = 75, int $compressor = 1, bool $webP = true)
    {
        $this->engine = new Cropper(CONF_BASE_PATH . "/" . CONF_CACHE_DIR, $quality, $compressor, $webP);
    }

    /**
     * @param string $imagePath
     * @param int $width
     * @param int|null $height
     * @return string|null
     */
    public function make(string $imagePath, int $width, ?int $height = null): ?string
    {
        $thumbPath = $this->engine->make($imagePath, $width, $height);
        return $thumbPath ? str_replace(CONF_BASE_PATH . "/", "", $thumbPath) : null;
    }

    /**
     * @param string|null $cache
     * @return void
     */
    public function clearCache(?string $cache = null): void
    {
        $cache ? $this->engine->flush($cache) : $this->engine->flush();
        return;
    }
}
