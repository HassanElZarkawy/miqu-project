<?php

namespace Services\Security\Admin;

use Miqu\Core\Authentication;
use Exception;
use Models\PasswordResetToken;
use Models\User;

class AuthenticationManager implements Contracts\IAuthenticationManager
{
    /**
     * @var Authentication
     */
    private $auth;

    public function __construct()
    {
        $this->auth = new Authentication;
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return bool
     * @throws Exception
     */
    public function Authenticate(string $email, string $password, bool $remember ) : bool
    {
        return $this->auth->attempt($email, $password, $remember);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function IsAuthenticated() : bool
    {
        return $this->auth->check();
    }

    /**
     * @throws Exception
     */
    public function DeAuthenticate() : void
    {
        $this->auth->logout();
    }

    /**
     * @return User
     * @throws Exception
     */
    public function CurrentUser(): User
    {
        return $this->auth->user();
    }

    /**
     * @throws Exception
     */
    public function PasswordResetToken(User $user ) : string
    {
        $token = bin2hex( random_bytes( 32 ) );

        $reset_token = PasswordResetToken::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        return $reset_token ? $token : '';
    }


    public function ValidateResetToken( string $token ) : bool
    {
        $record = PasswordResetToken::where( 'token', $token )->first();
        if ( ! $record )
            return false;

        // $creation_time = strtotime( $record->data['created_at'] );
        // $expiry_time = ($this->expiry_time * 60) + $creation_time;
        // if ( $expiry_time < time() )
        // {
        //     $record->delete();
        //     return false;
        // }

        return true;
    }


    /**
     * @throws Exception
     */
    public function ResetPasswordWithToken(string $token, string $password) : bool
    {
        if ( ! $this->ValidateResetToken( $token ) )
            return false;

        $record = PasswordResetToken::where( 'token', $token )->first();

        $user = User::where( 'id', $record->user_id )->first();
        if ( ! $user )
            return false;

        $user->password = password_hash( $password, PASSWORD_DEFAULT );

        $user->update();

        $record->delete();

        return true;
    }

    /**
     * @throws Exception
     */
    public function UserFromToken(string $token) : ?User
    {
        $token = PasswordResetToken::with('user')->where('token', $token)->first();
        if (! $token)
            return null;
        return $token->user;
    }
}