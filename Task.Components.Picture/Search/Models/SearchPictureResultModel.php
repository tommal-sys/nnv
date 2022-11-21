<?php

namespace Task\Components\Picture\Search\Models;

use Task\Core\Components\BaseComponentModel;
use Task\Transfer\Dto\Picture\PictureSmallDto;

class SearchPictureResultModel extends BaseComponentModel
{
    /** 
     * @var PictureSmallDto[]
     */
    public $pictures;
       
    /** 
     * @var bool
     */
    public $status;
 
    /** 
     * @var string
     */
    public $errorMessage;
}