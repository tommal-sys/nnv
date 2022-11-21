<?php

namespace Task\Components\User\Create\Models;

use Task\Core\Components\BaseComponentModel;

class CreateUserResultModel extends BaseComponentModel
{
    /** 
     * @var bool
     */
    public $status;

    /** 
     * @var string
     */
    public $message;

    /** 
     * @var string
     */
    public $token;

    /** 
     * @var string
     */
    public $errorMessage;
}