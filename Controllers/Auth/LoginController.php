<?php

namespace Controllers\Auth;

use Miqu\Core\Http\Controller;
use Miqu\Core\Http\HttpResponse;
use Exception;
use ReflectionException;
use Services\Security\Admin\Contracts\IAuthenticationManager;
use Services\Security\Admin\Contracts\IAuthorizationManager;
use Services\Validation\Interfaces\ICsrfValidator;

class LoginController extends Controller
{
    /**
     * @var ICsrfValidator
     */
    private $csrfValidator;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $remember = false;

    /**
     * @var array
     */
    private $validation_errors = [];

    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * @var IAuthorizationManager
     */
    private $authorizationManager;

    /**
     * @var string
     */
    private $redirect = '/';

    /**
     * LoginController constructor.
     * @param ICsrfValidator $csrfValidator
     * @param IAuthenticationManager $authenticationManager
     * @param IAuthorizationManager $authorizationManager
     */
    public function __construct(ICsrfValidator $csrfValidator, IAuthenticationManager $authenticationManager, IAuthorizationManager $authorizationManager )
    {
        $this->csrfValidator = $csrfValidator;
        $this->authenticationManager = $authenticationManager;
        $this->authorizationManager = $authorizationManager;
    }

    /**
     * @throws ReflectionException
     */
    public function index(): HttpResponse
    {
        return $this->default_login_view();
    }

    /**
     * @throws Exception
     */
    public function login(): HttpResponse
    {
        if ( ! $this->csrfValidator->validate() )
            return response()->notAcceptable();

        if ( ! $this->valid_input() )
            return $this->default_login_view( $this->validation_errors );

        if ( ! $this->authenticationManager->Authenticate( $this->email, $this->password, $this->remember ) )
            return $this->default_login_view( [ 'Email or password are incorrect.' ] );

        if ( ! $this->authorizationManager->CanAccessSystem() )
            return response()->unauthorized();

        if ($this->hasParameter('referrer'))
            return response()->redirect(request()->getParsedBody()['referrer']);

        return response()->redirect( $this->redirect );
    }

    private function valid_input() : bool
    {
        $validation = validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email:required' => 'Email or username are required.',
            'password:required' => 'You cant login without a password, right?'
        ]);

        if ( $validation->fails() )
        {
            $this->validation_errors = $validation->getMessages();
            return false;
        }

        $data = $validation->getValidatedData();

        $this->email = $data[ 'email' ];
        $this->password = $data[ 'password' ];
        $this->remember = $this->hasParameter('remember-me');

        return true;
    }

    /**
     * @throws ReflectionException
     */
    private function default_login_view(array $errors = [] ): HttpResponse
    {
        $parameters = [];
        if ( count( $errors ) > 0 )
            $parameters[ 'errors' ] = $errors;

        if (session('referrer'))
            $parameters['referrer'] = str_replace( getBaseUrl(), '', session('referrer') );

        return response()->view('auth.login.index', $parameters);
    }

    /**
     * @param string $name
     * @return bool
     */
    private function hasParameter(string $name) : bool
    {
        $requestBody = request()->getParsedBody();
        if ( is_null( $requestBody ) )
            return false;

        return isset( $requestBody[ $name ] );
    }
}