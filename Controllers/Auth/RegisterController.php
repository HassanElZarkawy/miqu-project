<?php

namespace Controllers\Auth;

use Miqu\Core\Http\Controller;
use Miqu\Core\Http\HttpResponse;
use Exception;
use Miqu\Core\Security\Csrf\ICsrfValidator;
use ReflectionException;
use Repositories\Contracts\IUsersRepository;
use Services\Security\Contracts\IAuthenticationManager;

class RegisterController extends Controller
{
    /**
     * @var ICsrfValidator
     */
    private $csrfValidator;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var IUsersRepository
     */
    private $usersRepository;

    /**
     * @var int
     */
    private $min_password_length = 8;

    /**
     * @var string
     */
    private $redirect = '/';

    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * RegisterController constructor.
     * @param ICsrfValidator $csrfValidator
     * @param IAuthenticationManager $authenticationManager
     * @param IUsersRepository $usersRepository
     */
    public function __construct(ICsrfValidator $csrfValidator, IAuthenticationManager $authenticationManager, IUsersRepository $usersRepository)
    {
        $this->csrfValidator = $csrfValidator;
        $this->usersRepository = $usersRepository;
        $this->authenticationManager = $authenticationManager;
    }

    /**
     * @return HttpResponse
     * @throws ReflectionException
     */
    public function index(): HttpResponse
    {
        return $this->defaultView();
    }

    /**
     * @return HttpResponse
     * @throws ReflectionException
     * @throws Exception
     */
    public function register(): HttpResponse
    {
        if( ! $this->csrfValidator->validate() )
            return $this->defaultView( [ 'Invalid Request' ] );

        if ( ! $this->validateInput() )
            return $this->defaultView( $this->errors );

        if ( $this->usersRepository->emailExists($this->email) )
            return $this->defaultView( [ 'email' => 'Email address already exists.' ] );

        if ( $this->usersRepository->usernameExists($this->username) )
            return $this->defaultView( [ 'username' => 'Username already exists.' ] );

        if ( strlen( $this->password ) < $this->min_password_length )
            return $this->defaultView( [ 'password' => 'Password is too short. Minimum password length is 8 characters.' ] );

        $user = $this->usersRepository->create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'status' => 'active',
            'type' => 'student'
        ]);

        if ( $user === null )
            return $this->defaultView( [ "Something went wrong and we couldn't register your account. Please try again" ] );

        $this->authenticationManager->Authenticate( $this->email, $this->password, true );

        return response()->redirect( $this->redirect );
    }

    /**
     * @param array|null $errors
     * @return HttpResponse
     * @throws ReflectionException
     */
    private function defaultView(array $errors = null) : HttpResponse
    {
        if ( $errors !== null )
            $this->errors = $errors;

        return response()->view('auth.register.index', [
            'errors' => $this->errors
        ]);
    }

    private function validateInput() : bool
    {
        $validation = validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ( $validation->fails() )
        {
            $this->errors = $validation->errors()->all();
            return false;
        }

        $this->email = $validation->getValue('email');
        $this->username = $validation->getValue('username');
        $this->password = $validation->getValue('password');
        $this->name = $validation->getValue('name');

        return true;
    }
}