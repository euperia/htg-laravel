<?php
namespace App\Modules\Contact\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class IndexController extends Controller {

    public function index()
    {
        return View('Contact::Index');
    }


    public function submit(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|max:100|min:2',
            'email' => 'required|email|max:255',
            'contact_message' => 'required|min:5'
        ]);

        Mail::queue('Contact::emails/contactus', $data, function($message) use($data) {
                $message->from($data['email'], $data['name']);
                $message->to(
                    config('module.modules.Contact.contact_recipient_email'),
                    config('module.modules.Contact.contact_recipient_name')
                )->subject(config('module.modules.Contact.contact_subject'));
            }
        );       

        return redirect('/contact/thank-you');
    }


    public function thankyou()
    {
        return View('Contact::Thankyou');
    }

}
