<?php

namespace Services\Notifications\Contracts;

use Miqu\Core\Mailer;

interface INotification
{
    public function via() : array;

    public function toMail() : Mailer;

    public function toDatabase() : array;
}