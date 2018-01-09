<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUserInquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquirydetails)
    {
        $this->inquirydetails = $inquirydetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $inquirydetails = $this->inquirydetails;
		
        return $this->from('hello@app.com', 'Efficient Corporate')
            ->subject('Thank you for your inquiry at efficient corporate')
            ->view('mailtemplate.usercontactmail')
			->with(compact('inquirydetails'));
    }
}
