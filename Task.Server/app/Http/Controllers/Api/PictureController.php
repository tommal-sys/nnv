<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\RequestModel\Api\Picture\SearchPictureApiRequestBuilder;
use App\Http\RequestModel\Api\Picture\ShowPictureApiRequestBuilder;
use App\Http\RequestModel\Picture\StorePictureRequestBuilder;
use App\Http\Requests\Picture\SearchPictureRequest;
use App\Http\Requests\Picture\StorePictureRequest;
use Illuminate\Http\Request;
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

    public function show(Request $request)
    {
        $model = ShowPictureApiRequestBuilder::build($request->all());
        
        $context = $this->componentDispatcher->dispatch(ShowPictureComponent::class, $model);

        if($context->error)
        {
            return $this->jsonUnexpectedError($context->error);
        }

        if($context->result->errorMessage != null)
        {
            return $this->jsonUnexpectedError($context->result->errorMessage);
        }

        return $this->json($context->result);
    }

    public function store(StorePictureRequest $request)
    {
        $model = StorePictureRequestBuilder::build($request->all());

        $context = $this->componentDispatcher->dispatch(StorePictureComponent::class, $model);

        if ($context->error) 
        {
            return $this->unexpectedError($context->error);
        }

        return $this->json($context->result);
    }


    public function search(Request $request)
    {
        $model = SearchPictureApiRequestBuilder::build($request->all());

        $context = $this->componentDispatcher->dispatch(SearchPictureComponent::class, $model);

        if($context->error)
        {
            return $this->jsonUnexpectedError($context->error);
        }

        if($context->result->errorMessage != null)
        {
            return $this->jsonUnexpectedError($context->result->errorMessage);
        }

        return $this->json($context->result);
    }
}
