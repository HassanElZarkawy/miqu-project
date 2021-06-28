<?php

namespace Controllers\Auth;

use Miqu\Core\Http\Controller;
use Miqu\Core\Http\HttpResponse;
use Notifications\Auth\ResetPasswordNotification;
use PHPMailer\PHPMailer\Exception;
use ReflectionException;
use Repositories\Contracts\IUsersRepository;
use Services\Security\Admin\Contracts\IAuthenticationManager;
use Services\Validation\Interfaces\ICsrfValidator;

class ForgotPasswordController extends Controller
{
    /**
     * @var ICsrfValidator
     */
    private $csrfValidator;

    /**
     * @var string
     */
    private $view = 'auth.forgot-password.form';

    /**
     * @var string
     */
    private $invalid_email_message = 'This email is not valid';

    /**
     * @var string
     */
    private $success_message = 'an email has been sent to you with instructions on how to reset your password';

    /**
     * @var IAuthenticationManager
     */
    private $authenticationManager;

    /**
     * @var IUsersRepository
     */
    private $usersRepository;

    /**
     * ForgotPasswordController constructor.
     * @param IAuthenticationManager $authenticationManager
     * @param ICsrfValidator $csrfValidator
     * @param IUsersRepository $usersRepository
     */
    public function __construct(IAuthenticationManager $authenticationManager, ICsrfValidator $csrfValidator, IUsersRepository $usersRepository)
    {
        $this->csrfValidator = $csrfValidator;
        $this->authenticationManager = $authenticationManager;
        $this->usersRepository = $usersRepository;
    }

    /**
     * @return HttpResponse
     * @throws ReflectionException
     */
    public function index(): HttpResponse
    {
        return view($this->view);
    }

    /**
     * @return HttpResponse
     * @throws ReflectionException|Exception
     */
    public function reset(): HttpResponse
    {
        if (!$this->csrfValidator->validate())
            return response()->notAcceptable();

        $validation = validate([
           'email' => 'required|email'
        ]);

        if ($validation->fails())
            return response()->view($this->view, ['error' => $this->invalid_email_message]);

        $parameters = $validation->getValidatedData();

        $user = $this->usersRepository->fromEmail($parameters['email']);

        if (!$user)
            return response()->view($this->view, ['success' => $this->success_message]); // show success even if not user is found.

        $token = $this->authenticationManager->PasswordResetToken($user);

        $user->notify(new ResetPasswordNotification( $user, $token ));

        return response()->view($this->view, ['success' => $this->success_message]);
    }
}