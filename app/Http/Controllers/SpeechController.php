<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SpeechController extends Controller
{
    //
    public function submit(Request $request)
    {
        $text = $request->input('text');

        // Process the recognized text as needed
        dd($text);

        return redirect()->back()->with('success', 'Text submitted successfully');
    }
}
