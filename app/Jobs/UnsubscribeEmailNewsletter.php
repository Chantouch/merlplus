<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\NewsletterSubscription;

class UnsubscribeEmailNewsletter implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected $email;

	/**
	 * Create a new job instance.
	 *
	 * @param $email
	 */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->email;
        $newsletterSubscription = NewsletterSubscription::where('email', $email)->first();
        if ($newsletterSubscription) {
            $newsletterSubscription->delete();
        }
    }
}
