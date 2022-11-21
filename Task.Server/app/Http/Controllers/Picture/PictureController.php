<?php

namespace App\Http\Controllers\Picture;

use App\Http\Controllers\BaseController;
use App\Http\RequestModel\Picture\SearchPictureRequestBuilder;
use App\Http\RequestModel\Picture\ShowPictureRequestBuilder;
use App\Http\RequestModel\Picture\StorePictureRequestBuilder;
use App\Http\Requests\Picture\SearchPictureRequest;
use App\Http\Requests\Picture\StorePictureRequest;
use Task\Components\Picture\Search\SearchPictureComponent;
use Task\Components\Picture\Show\ShowPictureComponent;
use Task\Components\Picture\Store\StorePictureComponent;
use Task\Core\Components\IComponentDispatcher;
use Task\Core\Routing\RoutingName;

class PictureController extends BaseController
{
    /**
     * @var IComponentDispatcher
     */
    private $componentDispatcher;

    public function __construct(
        IComponentDispatcher $componentDispatcher
    ) {
        $this->componentDispatcher = $componentDispatcher;
    }

    public function index()
    {
        return $this->view(RoutingName::PICTURE_INDEX);
    }

    public function show($id)
    { 
        $model = ShowPictureRequestBuilder::build($id);

        $context = $this->componentDispatcher->dispatch(ShowPictureComponent::class, $model);

        if ($context->error) 
        {
            return $this->unexpectedError($context->error);
        }

        if ($context->result->redirectContext) 
        {
            return $this->redirect($context->result->redirectContext);
        }

        return $this->view(RoutingName::PICTURE_SHOW, $context->result);
    }

    public function store(StorePictureRequest $request)
    {
        $model = StorePictureRequestBuilder::build($request->all());

        $context = $this->componentDispatcher->dispatch(StorePictureComponent::class, $model);

        if ($context->error) 
        {
            return $this->unexpectedError($context->error);
        }

        if ($context->result->redirectContext) 
        {
            return $this->redirect($context->result->redirectContext);
        }

        return $this->redirectToRoute(RoutingName::PICTURE_SHOW, ['id' => $context->result->idPicture]);
    }

    public function search(SearchPictureRequest $request)
    {
        $model = SearchPictureRequestBuilder::build($request->all());

        $context = $this->componentDispatcher->dispatch(SearchPictureComponent::class, $model);

        if ($context->error)
        {
            return $this->unexpectedError($context->error);
        }

        if ($context->result->redirectContext)
        {
            return $this->redirect($context->result->redirectContext);
        }

        return $this->view(RoutingName::PICTURE_LISTING, $context->result);
    }
}
