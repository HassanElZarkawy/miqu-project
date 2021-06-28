<?php

namespace Controllers\Auth;

use Miqu\Core\Http\Controller;
use Miqu\Core\Http\HttpResponse;
use ReflectionException;
use Services\Security\Admin\Contracts\IAuthenticationManager;

class LogoutController extends Controller
{
    /**
     * @var string
     */
    private $redirect = 'account/login';

    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * LogoutController constructor.
     * @param IAuthenticationManager $authenticationManager
     */
    public function __construct(IAuthenticationManager $authenticationManager)
    {
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * @return HttpResponse
     */
    public function index() : HttpResponse
    {
        if ($this->authenticationManager->IsAuthenticated())
            $this->authenticationManager->DeAuthenticate();

        return response()->redirect($this->redirect);
    }

    /**
     * @return HttpResponse
     * @throws ReflectionException
     */
    public function lock(): HttpResponse
    {
        if( ! $this->authenticationManager->IsAuthenticated() )
            return response()->redirect($this->redirect);

        $user = $this->authenticationManager->CurrentUser();
        $this->authenticationManager->DeAuthenticate();

        return response()->view('auth.lock.index', [
            'user' => $user
        ]);
    }
}