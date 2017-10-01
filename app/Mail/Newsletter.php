<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
	use Queueable, SerializesModels;

	protected $posts;
	protected $email;

	/**
	 * Create a new message instance.
	 *
	 * @param $posts
	 * @param $email
	 */
	public function __construct($posts, $email)
	{
		$this->posts = $posts;
		$this->email = $email;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->from('hello@app.com', ['app_name' => config('settings.app_name')])
			->subject(__('newsletter.email.subject'))
			->view('emails.newsletter')
			->with([
				'posts' => $this->posts,
				'email' => $this->email
			]);
	}
}
