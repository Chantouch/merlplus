<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsletterSubscriptionRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Model\NewsletterSubscription;
use App\Jobs\UnsubscribeEmailNewsletter;
use Illuminate\Support\Facades\Validator;

class NewsletterSubscriptionsController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param NewsletterSubscriptionRequest $request
	 */
    public function store(NewsletterSubscriptionRequest $request)
    {
        $newsletterSubscription = NewsletterSubscription::create([
            'email' => $request->input('email')
        ]);

        return back()->withSuccess(__('newsletter.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:newsletter_subscriptions,email'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $route = 'login';

            if (Auth::check()) {
                $route = '/';
            }

            return redirect()->route($route)->withErrors($errors);
        }

        $this->dispatch(new UnsubscribeEmailNewsletter($request->input('email')));

        Session::flash('success', __('newsletter.unsubscribed'));

        return view('newsletters.unsubscribed');
    }
}
