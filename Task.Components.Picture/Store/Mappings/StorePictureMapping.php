<?php

namespace Task\Components\Picture\Store\Mappings;

use Task\Components\Picture\Store\Models\StorePictureInputModel;
use Task\Transfer\Queries\Picture\CreatePictureQuery;

class StorePictureMapping
{
    public function mapToStorePictureQuery(StorePictureInputModel $model, string $nameFile): CreatePictureQuery
    {
        $query = new CreatePictureQuery();
            
        $query->name = $model->name;

        $query->description = $model->description;

        $query->filename = $nameFile;

        return $query;
    }
}