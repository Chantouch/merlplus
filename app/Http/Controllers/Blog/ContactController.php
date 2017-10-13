<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ContactRequest;
use App\Mail\AutoReply;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Model\Contact as ContactModel;
use Torann\LaravelMetaTags\Facades\MetaTag;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    MetaTag::set('title', 'Contact us - Merlplus.com');
	    MetaTag::set('keywords', 'merl,plus, plus merl, merl plus, contact us, us contact, break news, hot news, valuable news, merlplus.com');
	    MetaTag::set('description', config('settings.app_slogan', 'Up-to-date in a minute news, breaking news, feature and audio stories. Merlplus provides the trusted local Cambodia news, also the world wide news, to all original area, and regional perspective ,local news in Cambodia. Entertainments, technologies, cook recipes, science, business news....'));
	    MetaTag::set('image', asset('storage/default/ico/android-icon-192x192.png'));
        return view('blog.page.contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $object = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message'),
            'subject' => $request->get('subject')
        ];
        $mail_sent = Mail::to(config('settings.app_email'))->send(new Contact($object));
        if ($mail_sent) {
            Mail::to($object['email'])->send(new AutoReply());
            ContactModel::create($request->all());
        }
        return redirect()->route('blog.contact.index')->with('message', 'Thanks for contacting us!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
