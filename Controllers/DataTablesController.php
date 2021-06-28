<?php

namespace Controllers;

use Miqu\Core\Http\Controller;
use Miqu\Core\Http\HttpResponse;
use Miqu\Core\Views\DataTable;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionException;

class DataTablesController extends Controller
{
    /**
     * Invoked automatically if no method is supplied with this controller in the Route
     * @param ServerRequestInterface $request
     * @return HttpResponse
     * @throws ReflectionException
     */
    public function index(ServerRequestInterface $request): HttpResponse
    {
        $data = $request->getParsedBody();
        if ( ! $data )
            return response()->json([]);
        $results = (new DataTable( $data['abstract'] ))->process();
        return response()->json($results);
    }
}