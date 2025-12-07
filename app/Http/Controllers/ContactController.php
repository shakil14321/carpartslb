<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::latest()->paginate('100');

        return view('admin.contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'first_name' => 'required|string|max:100',
                'last_name'  => 'required|string|max:100',
                'phone'      => 'required|string|max:50',
                'email'      => 'required|email|max:150',
                'message'    => 'required|string',
            ]);

            // Store contact entry
            $contact = Contact::create($validated);

            try {
                // Send email
                Mail::to(env('MAIL_FROM_ADDRESS'))->send(new contactMail($validated));
            } catch (\Exception $e) {
                // If email fails, do NOT stop storing the message
                \Log::error('Contact form email failed: '.$e->getMessage());
            }

            return back()->with('success', 'Thank you! Your message has been sent successfully.');
        } catch (\Exception $e) {

            \Log::error('Contact form error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }


    // public function store(Request $request){
    //     $validation = Validator::make($request->all(), [
    //         'first_name' => 'required|string',
    //         'last_name' => 'required|string',
    //         'phone' => 'required|integer',
    //         'email' => 'required|email',
    //         'message' => 'required|string'
    //     ]);

    //     Contact::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'phone' => $request->phone,
    //         'email' => $request->email,
    //         'message' => $request->message,
    //     ]);

    //     Mail::to('info@carpartslb.com')->send(new contactMail($request->all()));

    //     return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully. We’ll get back to you soon.');
    // }

    public function show($id){
        $contact = Contact::find($id);
        return view('admin.contact.show', compact('contact'));
    }

    public function deleteSelectedContact(Request $request){
        $ids = $request->input('ids');

        if(empty($ids)){
           return redirect()->back()->with('error', 'Please select at least one brand to delete.');
        }

        $contacts = Contact::whereIn('id', $ids)->delete();

        return redirect()->route('contact.index')->with('success', 'Selected contacts deleted successfully.');
    }

    public function destroy($id){
        $contact = Contact::find($id);


        if($contact){
            $contact->delete();
            return redirect()->back()->with('success', 'Contact detail deleted successfully.');
        }else{
            return redirect()->back()->with('error', 'Contact not found');
        }

    }

    public function contactSearch(Request $request){
        $q = trim($request->input('q'));

        if(empty($q)){
            return redirect()->back()->with('error', 'Write something in search box.');
        }

        $contacts = Contact::query()
        ->where('first_name', 'LIKE', "%{$q}%")
        ->orWhere('last_name', 'LIKE', "%{$q}%")
        ->orWhere('email', 'LIKE', "%{$q}%")
        ->orWhere('phone', 'LIKE', "%{$q}%")
        ->latest()
        ->paginate(100)
        ->appends(['q' => $q]);

        return view('admin.contact.search', compact('contacts', 'q'));
    }
}
