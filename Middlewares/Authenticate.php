<?php

namespace Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Services\Security\Admin\Contracts\IAuthenticationManager;

class Authenticate implements MiddlewareInterface
{
    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * AuthenticateAdmin constructor.
     * @param IAuthenticationManager $authenticationManager
     */
    public function __construct(IAuthenticationManager $authenticationManager)
    {
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if( ! $this->authenticationManager->IsAuthenticated() )
            return response()->redirect('account/login');

        return $handler->handle($request);
    }
}