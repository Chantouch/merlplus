<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Mail\Newsletter;
use App\Model\Post;
use Illuminate\Support\Facades\Mail;

class SendNewsletterSubscriptionEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, DispatchesJobs;

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
        $posts = Post::lastMonth()->get();
        $email = $this->email;
        Mail::to($this->email)->send(new Newsletter($posts, $email));
    }
}
