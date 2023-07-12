<?php

namespace App\Http\Controllers;

use App\Models\Encounter;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        
    $students = Student::count();
    $encounters = Encounter::count();
    $users = DB::table('users')->count();
    $clinics = DB::table('clinic')->count();
    $programs = DB::table('programs')->count();
    $clinic_users = DB::table('clinic_users')->count();
   // $count = DB::table('students')->count();
   // $count = Student::where('status','=','1')->count();

    return view('dashboard', compact(
        'users',
        'students',
        'clinics',
        'programs',
        'clinic_users',
        'encounters',

    ));
}

}
