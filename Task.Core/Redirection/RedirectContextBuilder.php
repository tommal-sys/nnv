<?php

namespace Task\Core\Redirection;

use Task\Core\Redirection\RedirectContext;
use Task\Transfer\Dto\Notification\NotificationDto;

class RedirectContextBuilder
{
    /**
     * @var RedirectContext
     */
    private $redirectionContext;
    
    public function __construct()
    {
        $this->redirectionContext = new RedirectContext();
    }
    
    public function build(): RedirectContext
    {
        return $this->redirectionContext;
    }

    public static function default() : RedirectContextBuilder
    {
        return new RedirectContextBuilder();
    }

    public function withType(string $type) : RedirectContextBuilder
    {
        $this->redirectionContext->type = $type;

        return $this;
    }

    public function withMessage(string $message) : RedirectContextBuilder
    {
        $this->redirectionContext->message = $message;

        return $this;
    }

    public function withStatus(string $status) : RedirectContextBuilder
    {
        $this->redirectionContext->status = $status;

        return $this;
    }

    public function withParams(array $params) : RedirectContextBuilder
    {
        $this->redirectionContext->params = $params;

        return $this;
    }

    public function withUrl(string $url) : RedirectContextBuilder
    {
        $this->redirectionContext->url = $url;

        return $this;
    }

    public function withRouteName(string $routeName) : RedirectContextBuilder
    {
        $this->redirectionContext->routeName = $routeName;

        return $this;
    }

    public function withNotification(NotificationDto $notification) : RedirectContextBuilder
    {
        $this->redirectionContext->notifications[] = $notification;

        return $this;
    }

    public function withInput() : RedirectContextBuilder
    {
        $this->redirectionContext->withInput = true;

        return $this;
    }

    public function withCookie($cookie) : RedirectContextBuilder
    {
        $this->redirectionContext->cookie = $cookie;

        return $this;
    }
}