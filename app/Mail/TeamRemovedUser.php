<?php

namespace App\Mail;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\User;

class TeamRemovedUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user and team instance.
     *
     */
    public $user;
    public $team;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Team  $team
     * @return void
     */
    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user-removed', ['user' => $this->user, 'team' => $this->team])->subject(__('Deleted Account'));
    }
}
