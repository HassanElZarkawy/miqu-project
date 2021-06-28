<?php

namespace Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Models\User;

class Token extends Model
{
    protected $table = 'tokens';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $dates = [ 'expires_at' ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $dbFields = [
        'id' => ['int'],
        'user_id' => ['int'],
        'token' => ['text'],
        'extended' => ['int'],
        'expires_at' => ['datetime'],
        'created_at' => ['datetime'],
        'updated_at' => ['datetime'],
    ];
}