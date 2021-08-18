<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SubscriptionMail extends Mailable
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
    public $subscription_message;


    public function __construct($message)
    {
        $this->app = DB::table('settings')->where('id', 1)->first();
        $this->logo = asset($this->app->logo);
        $this->url = url('/');
        $this->subscription_message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Membership Subscription')
                    ->from($this->app->from_email, 'Lagosmatchmaker')
                    ->view('admin.subscription.subscription-mail-template');
    }
}
