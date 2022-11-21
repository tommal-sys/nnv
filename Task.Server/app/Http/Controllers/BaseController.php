<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Task\Core\Exceptions\TaskException;
use Task\Core\Redirection\RedirectContextBuilder;
use Task\Core\Redirection\RedirectType;
use Task\Core\Redirection\RedirectContext;
use Task\Core\Routing\RoutingName;
use Task\Core\Notification\NotificationType;
use Task\Transfer\Dto\Notification\NotificationDto;

abstract class BaseController extends Controller
{
    public function redirect(RedirectContext $context)
    {
        if($context->type == RedirectType::ROUTE)
        {
            $response = redirect()
                ->route($context->routeName, $context->params, $context->status ?? 302)
                ->with('notifications', $context->notifications);

            if($context->cookie != null)
            {
                $response->withCookie($context->cookie);
            }

            if ($context->withInput != null)
            {
                $response->withInput();
            }

            return $response;
        }

        if($context->type == RedirectType::URL)
        {
            return redirect()->to($context->url, $context->status ?? 302);
        }

        if($context->type == RedirectType::NOT_FOUND)
        {
            return $this->notFound($context->message);
        }

        if($context->type == RedirectType::BACK)
        {
            $response = redirect()->back()->with('notifications', $context->notifications);

            if ($context->withInput != null)
            {
                $response->withInput();
            }

            if ($context->message)
            {
                $response->withErrors([$context->message]);
            }

            if($context->cookie != null)
            {
                $response->withCookie($context->cookie);
            }

            return $response;
        }

        throw new TaskException('Given redirect type is not currently supported. Consider to add new redirect type to handle this action.');
    }

    public function redirectErrors($validator)
    {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function redirectToRoute($routeName, $parameters = [])
    {
        return redirect()
                ->route($routeName, $parameters, 303);
    }

    public function redirectToRouteWithNotifications($routeName, $parameters = [], $notifications = [], $cookie = null)
    {
        $response = redirect()
            ->route($routeName, $parameters, 303)
            ->with('notifications', $notifications);

        if ($cookie)
        {
            $response->withCookie($cookie);
        }

        return $response;
    }

    public function redirectToHome()
    {
        $redirectContext = RedirectContextBuilder::default()
                ->withType(RedirectType::ROUTE)
                ->withRouteName(RoutingName::HOME_INDEX)
                ->withParams([])
                ->withStatus(302)
                ->build();

        return $this->redirect($redirectContext);
    }

    public function redirectSuccess($route, $message, $params = [])
    {
        $redirectContext = RedirectContextBuilder::default()
                ->withType(RedirectType::ROUTE)
                ->withRouteName($route)
                ->withParams($params ?? [])
                ->withStatus(303)
                ->withNotification( 
                    new NotificationDto( 
                        NotificationType::SUCCESS, 
                        $message)
                    )
                ->build();

        return $this->redirect($redirectContext);
    }

    public function redirectExternal($url)
    {
        return redirect()->to($url);
    }

    protected function view(string $viewName, $model = null, $cookie = null)
    {
        $response = response()->view($viewName, $model ? ['model' => $model] : []);

        if ($cookie) 
        {
            $response->withCookie($cookie);
        }

        return $response;
    }

    protected function json($model, $alwaysMakeObject = false, $cookie = null)
    {
        $content = 'application/json';

        if($model == null && $alwaysMakeObject)
        {
            $model = (object) [];
        }

        $response = response(json_encode($model), 200)->header('Content-Type', $content);

        if ($cookie) 
        {
            $response->withCookie($cookie);
        }

        return $response;
    }

    public function notFound($error = '')
    {
        return abort(404, $error);
    }

    public function unexpectedError($error = '')
    {
        return abort(500, $error);
    }

    public function unexpectedPostError($error = '')
    {
        return $this->redirect( RedirectContextBuilder::default()
                ->withType(RedirectType::BACK)
                ->withNotification(
                    new NotificationDto(
                        NotificationType::ERROR, 
                        $error))
                ->build());
    }

    public function jsonUnexpectedError($error = '')
    {
        $content = 'application/json';
        
        $message = $error != '' ? $error : 'Wystąpił nieoczekiwany błąd';
      
        return response(json_encode($message), 200)->header('Content-Type', $content);
    }

    protected function renderView(string $viewName, $model = null)
    {
        return preg_replace('/\s+/', ' ', view($viewName, $model ? ['model' => $model] : [])->render());
    }
    
    protected function writeJsonSession($request, $key, $value)
    {
        $json = json_encode($value);

        $request->session()->put($key, $json);
    }

    protected function readJsonSession($request, $key)
    {
        $obj = $request->session()->get($key);

        return $obj;
    }

    protected function clearSession($request, $key)
    {
        $request->session()->forget($key);
    }

    protected function queueCookie($cookie)
    {
        Cookie::queue($cookie);
    }

    protected function clearCookie($name)
    {
        Cookie::queue(Cookie::forget($name));
    }
}
