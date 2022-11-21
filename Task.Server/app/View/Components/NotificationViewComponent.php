<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Task\Transfer\Dto\Notification\NotificationDto;

class NotificationViewComponent extends Component
{
    /** @var NotificationDto|null */
    public $notification;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(NotificationDto $notification = null)
    {
        $this->notification = $notification;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if ($this->notification)
            return view('components.notification');
    }
}
