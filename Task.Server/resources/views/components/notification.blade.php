@if ($notification->type === NotificationType::ERROR)
    <div class="alert alert-danger" role="alert">{!! __($notification->message) !!}</div>
@elseif ($notification->type === NotificationType::WARNING)
    <div class="alert alert-warning" role="alert">{!! __($notification->message) !!}</div>
@elseif ($notification->type === NotificationType::INFO)
    <div class="alert alert-info" role="alert">{!! __($notification->message) !!}</div>
@elseif ($notification->type === NotificationType::SUCCESS)
    <div class="alert alert-success" role="alert">{!! __($notification->message) !!}</div>
@endif