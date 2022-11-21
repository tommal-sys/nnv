<?php

namespace Task\Transfer\Dto\Notification;

class NotificationDto
{	
    public $type;

    public $message;

    public function __construct($type = null, $message = null)
    {
        $this->type = $type;

        $this->message = $message;
    }
}