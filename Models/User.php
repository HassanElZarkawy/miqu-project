<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Models\Security\Token;
use Models\Traits\HasPermission;
use Models\Traits\HasRole;
use Models\Traits\InteractsWithMedia;
use Models\Traits\Notifiable;

class User extends Model
{
    use InteractsWithMedia, HasPermission, HasRole, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $hidden = [
        'password', 'username', 'type'
    ];

    /**
     * @return HasOne
     */
    public function token(): HasOne
    {
        return $this->hasOne(Token::class);
    }

    /**
     * @return HasOne
     */
    public function resetToken(): HasOne
    {
        return $this->hasOne(PasswordResetToken::class);
    }
}