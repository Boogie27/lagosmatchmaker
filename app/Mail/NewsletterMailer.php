<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class NewsletterMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $app;
    public $logo;
    public $newsletter;


    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
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
        return $this->subject($this->newsletter->title)
                    ->from($this->app->from_email, 'Lagosmatchmaker')
                    ->view('admin.newsletter.template');
    }
}
