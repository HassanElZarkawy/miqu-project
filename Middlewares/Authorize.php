<?php

namespace Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReflectionException;
use Services\Security\Contracts\IAuthenticationManager;
use Services\Security\Contracts\IAuthorizationManager;

class Authorize implements MiddlewareInterface
{
    /**
     * @var IAuthorizationManager
     */
    private $authorizationManager;

    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * AdminAreaAuthorization constructor.
     * @param IAuthorizationManager $authorizationManager
     * @param IAuthenticationManager $authenticationManager
     */
    public function __construct(IAuthorizationManager $authorizationManager, IAuthenticationManager $authenticationManager)
    {
        $this->authorizationManager = $authorizationManager;
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @throws ReflectionException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ( ! $this->authorizationManager->CanAccessSystem() )
        {
            if ( ! $this->authenticationManager->IsAuthenticated() )
                return response()->unauthorized();

            return response()->forbidden();
        }

        return $handler->handle( $request );
    }
}