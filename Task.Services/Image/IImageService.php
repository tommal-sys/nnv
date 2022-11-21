<?php

namespace Task\Services\Image;

interface IImageService
{
    public function saveOrginal(string $nameFile, $picture);

    public function saveMedium(string $nameFile);

    public function saveThumbnail(string $nameFile);
}