<?php

namespace App\Http\Controllers;


use App\Models\Encounter;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    //
    public function getOPDQueue()
    {
        return view('app.queue.opd');
    }
    public function getLabQueue()
    {
        return view('app.queue.lab');
    }
}
