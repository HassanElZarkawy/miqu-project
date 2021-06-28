<?php

namespace Middlewares;

use Miqu\Core\Localization\LocalizationManager;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use ReflectionException;

class UserLanguage implements MiddlewareInterface
{
    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @throws ReflectionException
     * @throws Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var LocalizationManager $manager */
        $manager = app()->make(LocalizationManager::class);
        $manager->setLanguage( $this->getUserLanguage() );

        return $handler->handle($request);
    }

    private function getUserLanguage() : string
    {
        return 'en';
    }
}