<?php

namespace Notifications\Auth;

use Miqu\Core\Mailer;
use Miqu\Core\Models\User;
use Miqu\Core\Notifications\INotification;
use PHPMailer\PHPMailer\Exception;

/**
 * Every notification must implement INotification interface
 */
class ResetPasswordNotification implements INotification
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $token;

    /**
     * You can accept here whatever you need to raise the notification properly
     */
    public function __construct( User $user, string $token )
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Return an array of channels used to notify your notifiable.
     * Supported channels are [ 'mail', 'database' ]
     * 
     * @return array
     */
    public function via() : array
    {
        return [ 'mail' ];
    }

    /**
     * Return an instance of Mailer without sending it.
     * The actual logic of figuring out should this mail be sent via SMTP or not
     * is handled by the notifier class
     *
     * @return Mailer
     * @throws Exception
     */
    public function toMail() : Mailer
    {
        $app_name = env('APP_NAME');
        $url = url('account/reset-password/' . $this->token);
        return (new Mailer)->setSubject( "$app_name - Reset Your Password" )
            ->addReceiver( $this->user->email )
            ->setContentHTML(
                "<a href='$url'>Click Here</a>"
            );
    }

    /**
     * Return an array to be stored in database for the notifiable.
     * 
     * @return array
     */
    public function toDatabase() : array
    {
        return [
            
        ];
    }
}