<?php

namespace App\Http\Controllers;

use App\Models\Encounter;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    //
    public function getOPDQueue()
    {

        // 2 = In Progress
        // 7 = On Hold
        // 13 = Test Available
        // 19 = Referral Approved

        $opdQueue = Encounter::whereIn('status', [1, 7, 13, 19])->get();
        $opdQueueToBe = Encounter::whereIn('status', [6])->get();

        // dd($opdQueue);
        return view('app.queue.opd', ['opdQueue' => $opdQueue, 'opdQueueToBe' => $opdQueueToBe]);
    }
    public function getLabQueue()
    {
        return view('app.queue.lab');
    }
}
