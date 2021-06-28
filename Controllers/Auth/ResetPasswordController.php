<?php

namespace Controllers\Auth;

use Miqu\Core\Http\Controller;
use Miqu\Core\Http\HttpRequest;
use Miqu\Core\Http\HttpResponse;
use Exception;
use ReflectionException;
use Services\Security\Admin\Contracts\IAuthenticationManager;

class ResetPasswordController extends Controller
{
    /**
     * @var string
     */
    private $view = 'auth.reset.index';

    /**
     * @var string
     */
    private $redirect = 'account/login';
    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * ResetPasswordController constructor.
     * @param IAuthenticationManager $authenticationManager
     */
    public function __construct(IAuthenticationManager $authenticationManager)
    {
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * @param HttpRequest $request
     * @return HttpResponse
     * @throws ReflectionException
     */
    public function index(HttpRequest $request): HttpResponse
    {
        $token = $request->getAttribute('token');
        if (!$token)
            return response()->redirect($this->redirect);

        if (! $this->authenticationManager->ValidateResetToken($token))
            return response()->redirect($this->redirect);

        return response()->view($this->view, [
            'token' => $token,
            'user' => $this->authenticationManager->UserFromToken($token)
        ]);
    }

    /**
     * @throws Exception
     */
    public function reset(HttpRequest $request): HttpResponse
    {
        $token = $request->getAttribute('token');
        if ( ! $token )
            return response()->redirect($this->redirect);

        if ( ! $this->authenticationManager->ValidateResetToken( $token ) )
            return response()->redirect($this->redirect);

        $validation = validate([
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ]);

        if ($validation->fails())
            return response()->view($this->view, [
                'token' => $token,
                'user' => $this->authenticationManager->UserFromToken($token),
                'errors' => $validation->errors()->all()
            ]);

        $this->authenticationManager->ResetPasswordWithToken( $token, $validation->getValue('password') );

        return response()->redirect($this->redirect);
    }
}