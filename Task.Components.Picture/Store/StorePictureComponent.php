<?php

namespace Task\Components\Picture\Store;

use Task\Components\Picture\Store\Models\StorePictureInputModel;
use Task\Components\Picture\Store\Models\StorePictureResultModel;
use Task\Components\Picture\Store\Mappings\StorePictureMapping;
use Task\Core\Components\BaseComponent;
use Task\Core\Messages\Picture\PictureErrorStatus;
use Task\Repositories\Picture\IPictureRepository;
use Task\Services\Image\IImageService;

class StorePictureComponent extends BaseComponent
{
    /**
     * @var StorePictureMapping
     */
    private $storePictureMapper;

    /**
    * @var IPictureRepository
    */
    private $pictureRepository;

    /**
    * @var IImageService
    */
    private $imageService;


    public function __construct(
        StorePictureMapping $storePictureMapper,

        IPictureRepository $pictureRepository,

        IImageService $imageService
    ) {
        parent::__construct();
        $this->storePictureMapper = $storePictureMapper;

        $this->pictureRepository = $pictureRepository;

        $this->imageService = $imageService;
    }

    /**
     * @param StorePictureInputModel $model for component
     * @return StorePictureResultModel model result for component
     */
    public function execute(StorePictureInputModel $model): StorePictureResultModel
    {
        $result = new StorePictureResultModel();

        $nameFile = time().'.'.$model->picture->extension();

        $query = $this->storePictureMapper->mapToStorePictureQuery($model, $nameFile);

        $result->idPicture = $this->pictureRepository->createPicture($query);
        
        $this->imageService->saveOrginal($nameFile, $model->picture);

        $this->imageService->saveMedium($nameFile);

        $this->imageService->saveThumbnail($nameFile);

        $result->message = PictureErrorStatus::pictureAddWithSuccess();

        $result->status = true;

        return $result;
    }
}