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

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
