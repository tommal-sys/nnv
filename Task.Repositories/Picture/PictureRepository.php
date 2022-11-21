<?php

namespace Task\Repositories\Picture;

use Task\Core\Cache\CacheKeys;
use Task\Models\Picture\Picture;
use Task\Repositories\Picture\IPictureRepository;
use Task\Services\Cache\ICacheService;
use Task\Services\Mapper\IMapperService;
use Task\Transfer\Dto\Picture\ListingPictureDto;
use Task\Transfer\Dto\Picture\PictureSmallDto;
use Task\Transfer\Queries\Picture\CreatePictureQuery;
use Task\Transfer\Queries\Picture\GetsPictureQuery;

class PictureRepository implements IPictureRepository
{
    /**
     * @var IMapperService
     */
    private $mapper;

    /** 
     * @var ICacheService 
     */
    public $cacheService;

    public function __construct(
        IMapperService $mapper,

        ICacheService $cacheService
    ) {
        $this->mapper = $mapper;

        $this->cacheService = $cacheService;
    }
    
    public function get(int $id): ?PictureSmallDto
    {
        $cacheKey = CacheKeys::PICTURE_SINGLE . $id;
        
        $dto = $this->cacheService->rememberForFewSecounds($cacheKey, function () use ($id) 
        {
            $picture = Picture::select('id', 'name', 'description', 'filename')->where('id', '=', $id)->first();

            if(!$picture) return null;

            return $this->mapper->map($picture, PictureSmallDto::class);    
            
        });

        return $dto;
    }

    public function gets(GetsPictureQuery $query): ListingPictureDto
    {
        $cacheKey = CacheKeys::PICTURE_LISTING . $query->name;

        $dtos = $this->cacheService->rememberForFewSecounds($cacheKey, function () use ($query) 
        {
            $pictures = Picture::select('id', 'name', 'description', 'filename');

            if($query->name !== null)
            {
                $pictures = $pictures->where('name', 'LIKE', '%'.$query->name.'%');
            }
    
            $pictures = $pictures->get();
    
            if(!$pictures->count()) return null;
    
            return $this->mapper->maps($pictures, PictureSmallDto::class);    
            
        });

        $piectureDtos = new ListingPictureDto();

        $piectureDtos->picturesArray = $dtos;

        return $piectureDtos;
    }

    public function createPicture(CreatePictureQuery $query): int
    {
        $picture = new Picture();

        $picture->name = $query->name;

        $picture->description = $query->description;

        $picture->filename = $query->filename;

        $picture->save();

        return $picture->id;
    }

}
