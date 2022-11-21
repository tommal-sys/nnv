<?php

namespace Task\Components\Picture\Search\Logic;

use Task\Components\Picture\Search\Models\SearchPictureInputModel;
use Task\Core\Messages\Picture\PictureErrorStatus;
use Task\Core\Notification\NotificationType;
use Task\Core\Redirection\RedirectType;
use Task\Core\Redirection\RedirectContext;
use Task\Core\Redirection\RedirectContextBuilder;
use Task\Core\Routing\RoutingName;
use Task\Transfer\Dto\Picture\ListingPictureDto;
use Task\Transfer\Dto\Notification\NotificationDto;

class SearchPictureRedirector
{
    public function getRedirection(ListingPictureDto $pictures, SearchPictureInputModel $model): ?RedirectContext
    {
        if ($pictures->picturesArray == null) 
        {
            return RedirectContextBuilder::default()
                ->withType(RedirectType::ROUTE)
                ->withRouteName(RoutingName::PICTURE_INDEX)
                ->withParams([])
                ->withStatus(302)
                ->withNotification(new NotificationDto(NotificationType::ERROR, PictureErrorStatus::picturesWithNameNotFound($model->name)))
                ->build();
        }

        return null;
    }

    public function checkForJson(?ListingPictureDto $pictures, SearchPictureInputModel $model): ?string
    {
        if ($pictures->picturesArray == null) 
        {
            return PictureErrorStatus::picturesWithNameNotFound($model->name);
        }

        return null;
    }

}