<?php

namespace Task\Components\Picture\Show\Logic;

use Task\Core\Messages\Picture\PictureErrorStatus;
use Task\Core\Notification\NotificationType;
use Task\Core\Redirection\RedirectType;
use Task\Core\Redirection\RedirectContext;
use Task\Core\Redirection\RedirectContextBuilder;
use Task\Core\Routing\RoutingName;
use Task\Transfer\Dto\Picture\PictureSmallDto;
use Task\Transfer\Dto\Notification\NotificationDto;

class ShowPictureRedirector
{
    public function getRedirection(?PictureSmallDto $picture): ?RedirectContext
    {
        if ($picture == null) 
        {
            return RedirectContextBuilder::default()
                ->withType(RedirectType::ROUTE)
                ->withRouteName(RoutingName::PICTURE_INDEX)
                ->withParams([])
                ->withStatus(302)
                ->withNotification(new NotificationDto(NotificationType::ERROR, PictureErrorStatus::pictureNotFound()))
                ->build();
        }

        return null;
    }

    public function checkForJson(?PictureSmallDto $picture): ?string
    {
        if ($picture == null) 
        {
            return PictureErrorStatus::pictureNotFound();
        }

        return null;
    }
}