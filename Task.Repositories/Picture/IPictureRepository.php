<?php

namespace Task\Repositories\Picture;

use Task\Transfer\Dto\Picture\ListingPictureDto;
use Task\Transfer\Dto\Picture\PictureSmallDto;
use Task\Transfer\Queries\Picture\CreatePictureQuery;
use Task\Transfer\Queries\Picture\GetsPictureQuery;

interface IPictureRepository
{
    public function get(int $id): ?PictureSmallDto;

    public function gets(GetsPictureQuery $query): ListingPictureDto;

    public function createPicture(CreatePictureQuery $query):int;
}
