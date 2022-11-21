<?php

namespace App\Http\RequestModel\Api\Picture;

use Task\Components\Picture\Show\Models\ShowPictureInputModel;

class ShowPictureApiRequestBuilder
{
    public static function build(array $inputData): ShowPictureInputModel
    {
        $model = new ShowPictureInputModel();

        $model->id = $inputData['id'];

        $model->json = true;

        return $model;
    }
}
