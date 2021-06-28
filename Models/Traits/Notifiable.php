<?php /** @noinspection PhpUnused */

namespace Models\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Models\Notification;
use Services\Notifications\Contracts\INotification;
use Services\Notifications\Notifier;

trait Notifiable
{
    /**
     * @return array|null
     * @throws Exception
     */
    public function notifications(): ?Collection
    {
        return $this->notificationsBaseQuery()->get();
    }

    /**
     * @return array|null
     * @throws Exception
     */
    public function unreadNotifications(): ?Collection
    {
        return $this->notificationsBaseQuery()->where('is_read', 0)->get();
    }

    /**
     * @return array|null
     * @throws Exception
     */
    public function readNotifications(): ?Collection
    {
        return $this->notificationsBaseQuery()->where('is_read', 1)->get();
    }

    /**
     * @param int $id
     * @return Notification|null
     * @throws Exception
     */
    public function notification(int $id) : Model
    {
        return $this->notificationsBaseQuery()->where('id', $id)->first();
    }

    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function notify(INotification $notification )
    {
        (new Notifier)->send($this, $notification);
    }

    /**
     * @return Builder
     */
    private function notificationsBaseQuery(): Builder
    {
        return Notification::where('notifiable_type', get_class($this))
            ->where('notifiable_id', $this->{$this->primaryKey})->latest();
    }
}