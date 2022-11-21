<?php

namespace Task\Components\Picture\Show;

use Task\Components\Picture\Show\Logic\ShowPictureRedirector;
use Task\Components\Picture\Show\Models\ShowPictureInputModel;
use Task\Components\Picture\Show\Models\ShowPictureResultModel;
use Task\Core\Components\BaseComponent;
use Task\Repositories\Picture\IPictureRepository;

class ShowPictureComponent extends BaseComponent
{
    /**
    * @var IPictureRepository
    */
    private $pictureRepository;

    /**
    * @var ShowPictureRedirector
    */
    private $redirector;

    public function __construct(
        IPictureRepository $pictureRepository,

        ShowPictureRedirector $redirector
    ) {
        parent::__construct();
        $this->pictureRepository = $pictureRepository;

        $this->redirector = $redirector;
    }

    /**
     * @param ShowPictureInputModel $model for component
     * @return ShowPictureResultModel model result for component
     */
    public function execute(ShowPictureInputModel $model): ShowPictureResultModel
    {
        $result = new ShowPictureResultModel();

        $picture = $this->pictureRepository->get($model->id);

        if($model->json == true)
        {
            $result->errorMessage = $this->redirector->checkForJson($picture);

            if ($result->errorMessage)
            {
                $result->status = false;

                return $result;
            }
        }
        else
        {
            $result->redirectContext = $this->redirector->getRedirection($picture);

            if ($result->redirectContext) return $result;
        }

        $result->status = true;

        $result->picture = $picture;

        return $result;
    }
}