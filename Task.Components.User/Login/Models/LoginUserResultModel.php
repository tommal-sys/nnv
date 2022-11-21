<?php

namespace Task\Components\User\Login\Models;

use Task\Core\Components\BaseComponentModel;

class LoginUserResultModel extends BaseComponentModel
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