<?php

namespace Task\Components\Picture\Search;

use Task\Components\Picture\Search\Logic\SearchPictureRedirector;
use Task\Components\Picture\Search\Models\SearchPictureInputModel;
use Task\Components\Picture\Search\Models\SearchPictureResultModel;
use Task\Core\Components\BaseComponent;
use Task\Services\Mapper\IMapperService;
use Task\Repositories\Picture\IPictureRepository;
use Task\Transfer\Queries\Picture\GetsPictureQuery;

class SearchPictureComponent extends BaseComponent
{
    /**
    * @var IMapperService
    */
    private $mapper;
    
    /**
    * @var IPictureRepository
    */
    private $pictureRepository;

    /**
    * @var SearchPictureRedirector
    */
    private $redirector;

    public function __construct(
        IMapperService $mapper,

        IPictureRepository $pictureRepository,

        SearchPictureRedirector $redirector
    ) {
        parent::__construct();
        $this->mapper = $mapper;

        $this->pictureRepository = $pictureRepository;

        $this->redirector = $redirector;
    }

    /**
     * @param SearchPictureInputModel $model for component
     * @return SearchPictureResultModel model result for component
     */
    public function execute(SearchPictureInputModel $model): SearchPictureResultModel
    {
        $result = new SearchPictureResultModel();

        $query = $this->mapper->map($model, GetsPictureQuery::class);

        $pictures = $this->pictureRepository->gets($query);
        
        if($model->json == true)
        {
            $result->errorMessage = $this->redirector->checkForJson($pictures, $model);

            if ($result->errorMessage)
            {
                $result->status = false;

                return $result;
            }
        }
        else
        {
            $result->redirectContext = $this->redirector->getRedirection($pictures, $model);

            if ($result->redirectContext) return $result;
        }
      
        $result->pictures = $pictures;

        $result->status = true;

        return $result;
    }
}