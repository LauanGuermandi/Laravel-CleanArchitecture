<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\IViewModel;
use Illuminate\Http\Response as LaravelResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class HttpResponseViewModel implements IViewModel
{
    private HttpResponse $response;

    public function __construct(HttpResponse | View $response)
    {
        if ($response instanceof View) {
            $response = new LaravelResponse($response);
        }

        $this->response = $response;
    }

    public function getResponse(): HttpResponse
    {
        return $this->response;
    }
}
