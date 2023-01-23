<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function storeMessage(ContactRequest $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type_id' => $request->type_id,
            'message' => $request->message,
        ]);
        return redirect()->route('viewContact')->with(['success' => 'تم حفظ الرسالة بنجاح.']);
    }
}
