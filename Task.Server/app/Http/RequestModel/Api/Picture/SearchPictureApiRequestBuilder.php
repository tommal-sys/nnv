<?php

namespace App\Http\RequestModel\Api\Picture;

use Task\Components\Picture\Search\Models\SearchPictureInputModel;

class SearchPictureApiRequestBuilder
{
    public static function build(array $inputData): SearchPictureInputModel
    {
        $model = new SearchPictureInputModel();

        $model->name = $inputData['name'] ?? '';
        
        $model->json = true;

        return $model;
    }
}
