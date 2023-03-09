<?php

namespace App\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Queue\SerializesModels;

class Registered
{
    use SerializesModels;

    public $user;
    public $introduced_user_id;

    /**
     * Create a new event instance.
     *
     * @param Authenticatable $user
     * @param Authenticatable $introduced_user_id
     * @return void
     */
    public function __construct($user, $introduced_user_id)
    {
        $this->user = $user;
        $this->introduced_user_id = $introduced_user_id;
    }
}

