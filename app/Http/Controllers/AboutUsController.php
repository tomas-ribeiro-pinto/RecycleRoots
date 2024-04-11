<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    /**
     * Show the application About Us Page.
     * @return View
     */
    public function index() : View
    {
        $contacts = Contact::all()->first();
        return view('about-us', compact('contacts'));
    }

    /**
     * Handle a contact form submission.
     * @param Request $request
     * @return View
     */
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'postcode' => 'max:10',
            'subject' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:300',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $postcode = $request->input('postcode') ?? 'N/A';
        $subject = $request->input('subject');
        $message = $request->input('message');


        // Send email to the admin team owner
        // TODO: Change this to the actual admin team owner, using email from environment variable for testing purposes
        Mail::to(env('TEST_EMAIL'))->send(new ContactForm($name, $email, $postcode, $subject, $message));

        return back()->with('message', 'Your message has been sent successfully!');
    }
}
