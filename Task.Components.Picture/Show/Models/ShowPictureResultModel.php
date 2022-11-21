<?php

namespace Task\Components\Picture\Show\Models;

use Task\Core\Components\BaseComponentModel;
use Task\Transfer\Dto\Picture\PictureSmallDto;

class ShowPictureResultModel extends BaseComponentModel
{
    /** 
     * @var PictureSmallDto
     */
    public $picture;
   
    /** 
     * @var bool
     */
    public $status;
 
    /** 
     * @var string
     */
    public $errorMessage;
}