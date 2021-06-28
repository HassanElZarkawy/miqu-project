<?php

namespace Controllers;

use Miqu\Core\Http\HttpResponse;
use Psr\Http\Message\ServerRequestInterface;
use Miqu\Core\Http\Controller;
use ReflectionException;

class HomeController extends Controller
{
    /**
     * Invoked automatically if no method is supplied with this controller in the Route
     * @param ServerRequestInterface $request
     * @return HttpResponse
     * @throws ReflectionException
     */
    public function index(ServerRequestInterface $request): HttpResponse
    {
        return response()->view('home.index');
    }
}