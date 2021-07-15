<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ApproveUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $app;
    public $logo;
    public $url;


    public function __construct()
    {
        $this->app = DB::table('settings')->where('id', 1)->first();
        $this->logo = asset($this->app->logo);
        $this->url = url('/');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account approval')
                    ->from($this->app->from_email)
                    ->view('admin.unapproved.mail-template');
    }
}
