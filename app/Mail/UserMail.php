<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $app;
    public $logo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->app = DB::table('settings')->where('id', 1)->first();

        $this->logo = asset($this->app->logo);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->app->app_name)
                    ->from($this->app->from_email, 'MatchmakerDidi')
                    ->view('web.forgot_password.forgot-password-message');
    }
}
