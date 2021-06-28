<?php /** @noinspection PhpUnused */

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $casts = [
        'settings' => 'array'
    ];

    protected $attributes = [
        'is_read' => 0,
        'is_sent' => 0,
        'settings' => []
    ];

    protected $hidden = [
        'notifiable_type', 'notifiable_id'
    ];

    protected $dbFields = [
        'id' => ['int'],
        'notifiable_type' => ['text'],
        'notifiable_id' => ['int'],
        'is_read' => ['int'],
        'is_sent' => ['int'],
        'content' => ['text'],
        'group' => ['text'],
        'settings' => ['text'],
    ];

    public function markAsRead()
    {
        $this->update([
            'is_read' => 1
        ]);
    }

    public function markAsUnread()
    {
        $this->update([
            'is_read' => 0
        ]);
    }
}