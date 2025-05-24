<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact; 

class ContactController extends Controller
{
    public function confirm(ContactRequest $request)
    {
        $validated = $request->validated();
        $validated['building'] = $request->input('building');

        $validated['tel'] = $validated['tel1'] . '-' . $validated['tel2'] . '-' . $validated['tel3'];

        $category = Category::find($validated['category_id']);
        $validated['category'] = $category ? $category->name : '未選択';

        $request->session()->put('contact_input', $validated);

        return view('contact.confirm', ['inputs' => $validated]);
    }

    private function getContactFormView()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    public function index()
    {
        return $this->getContactFormView();
    }

    public function complete(ContactRequest $request)
    {
         if ($request->input('action') === 'back') {
        
        return redirect()->route('contact.index')->withInput();
    }

        $inputs = $request->all();
        $inputs['tel'] = $inputs['tel1'] . '-' . $inputs['tel2'] . '-' . $inputs['tel3'];

        Contact::create([
            'last_name'      => $inputs['last_name'],
            'first_name'     => $inputs['first_name'],
            'gender'         => $inputs['gender'],
            'email'          => $inputs['email'],
            'tel1'           => $inputs['tel1'],
            'tel2'           => $inputs['tel2'],
            'tel3'           => $inputs['tel3'],
            'address'        => $inputs['address'],
            'building_name'  => $inputs['building'], 
            'category_id'    => $inputs['category_id'],
            'message'        => $inputs['message'],  
        ]);

        return view('contact.thanks');
    }
}
