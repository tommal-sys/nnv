<?php

namespace App\Http\RequestModel\Picture;

use Task\Components\Picture\Store\Models\StorePictureInputModel;

class StorePictureRequestBuilder
{
    public static function build(array $inputData): StorePictureInputModel
    {
        $model = new StorePictureInputModel();

        $model->name = $inputData['name'] ?? '';

        $model->description = $inputData['description'] ?? '';

        $model->picture = $inputData['picture'] ?? '';

        return $model;
    }
}
