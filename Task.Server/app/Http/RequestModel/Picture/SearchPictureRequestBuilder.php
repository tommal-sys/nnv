<?php

namespace App\Http\RequestModel\Picture;

use Task\Components\Picture\Search\Models\SearchPictureInputModel;

class SearchPictureRequestBuilder
{
    public static function build(array $inputData): SearchPictureInputModel
    {
        $model = new SearchPictureInputModel();

        $model->name = $inputData['name'] ?? '';

        $model->json = false;

        return $model;
    }
}
