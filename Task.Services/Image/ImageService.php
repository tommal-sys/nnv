<?php

namespace Task\Services\Image;

use Image;
use Task\Services\Image\IImageService;

class ImageService implements IImageService
{
    public function saveOrginal(string $nameFile, $picture)
    {
        $destinationPath = public_path('images/orginal');

        $picture->move($destinationPath, $nameFile);
    }

    public function saveMedium(string $nameFile)
    {
        $destinationPath = public_path('images/orginal');

        $img = Image::make($destinationPath .'/'. $nameFile);
        
        $savePath = public_path('images/medium');

        $img->resize(300, null, function ($constraint) {

            $constraint->aspectRatio();

        })->save($savePath.'/'.$nameFile);
    }

    public function saveThumbnail(string $nameFile)
    {
        $destinationPath = public_path('images/orginal');

        $img = Image::make($destinationPath .'/'. $nameFile);
        
        $destinationPath = public_path('images/thumbnail');

        $img->resize(100, 100, function ($constraint) {

            $constraint->aspectRatio();

        })->save($destinationPath.'/'.$nameFile);
    }
}