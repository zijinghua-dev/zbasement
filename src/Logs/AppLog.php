<?php


namespace Zijinghua\Basement\Logs;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AppLog
{
    public function saveRequest($request)
    {
        if (!$this->whetherLog($request)) {
            return;
        }
        $route = $request->route();
        $uri = $route? is_object($route)? $route->uri():$route : $request->getUri();

        $content = [
            'RequestName'=>class_basename($request),
            'RequestTime' => Carbon::now(),//->format('Y-m-d H:i:s')
            'UserId' => var_export(\Auth::id(), true),
            'RequestMethod' => $request->method(),
            'Endpoint' => $uri,
            'ClientIp' => implode(',', $request->getClientIps()),
            'RequestData' => $this->getAllRequestData(),
            'RequestHeader' => $request->headers->all(),
            'UserAgent' => $request->userAgent()
        ];
        Log::channel('interfacelog')->info('request', $content);
    }

    public function saveResponse($request, $response)
    {
        if (!$this->whetherLog($request)) {
            return;
        }
        $route = $request->route();
        $uri = $route? is_object($route)? $route->uri():$route : $request->getUri();

        $content = [
            'RequestName'=>class_basename($request),
            'RequestTime' => Carbon::now(),
            'UserId' => var_export(\Auth::id(), true),
            'RequestMethod' => $request->method(),
            'Endpoint' => $uri,
            'ClientIp' => implode(',', $request->getClientIps()),
            'RequestData' => $this->getAllRequestData(),
            'RequestHeader' => $request->headers->all(),
            'UserAgent' => $request->userAgent()
        ];
        $content['ResponseData'] = json_decode($response->content());
        Log::channel('interfacelog')->info('response', $content);
    }

    public function getAllRequestData()
    {
        $data = request()->all();
        if (request()->route() instanceof Route) {
            $data += request()->route()->parameters();
        }
        return $data;
    }

    public function whetherLog(Request $request)
    {
        return config('app.interface_log') && strpos($request->userAgent(), 'Symfony')===false;
    }
}
