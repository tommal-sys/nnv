<?php

namespace App\Http\RequestModel\Picture;

use Task\Components\Picture\Show\Models\ShowPictureInputModel;

class ShowPictureRequestBuilder
{
    public static function build(int $id): ShowPictureInputModel
    {
        $model = new ShowPictureInputModel();

        $model->id = $id;

        $model->json = false;

        return $model;
    }
}
