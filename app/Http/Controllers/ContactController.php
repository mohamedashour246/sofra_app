<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index',compact('contacts'));
    }

    public function deleteContacts($id)
    {
        $contacts = Contact::findOrFail($id);

        $contacts->delete();

        return redirect()->back()->with('success','تم الحذف بنجاح');
    }
}
