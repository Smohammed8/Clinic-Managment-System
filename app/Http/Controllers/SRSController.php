<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use PDOException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class SRSController extends Controller
{



    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }
    ///// This method is for making a third-party API request.
    public function apiRequest()
    {
        $apiToken = config('app.API_TOKEN');
        $response = Http::get('https://hrm.ju.edu.et/api/employees', [
            'api_token' => $apiToken,
        ]);
        $employeeData = $response->json();

        if ($response->successful()) {

            return view('employee', ['employeeData' => $employeeData]);
        } else {

            return response()->json(['error' => 'Failed to retrieve employee data'], 500);
        }
    }
    # Address : https://hrm.ju.edu.et/api/employees  and   Token="NtksaZqkSwS77ilG1L8uxvnH9lK39yZCJQy38O2A"

    public function srsData(Request $request)
    {
        if ($request->input('syncdata')) {
            $this->employee();
            session()->flash('success', 'SRS Data Successfully Synchronized');
        }
        if ($request->input('syncphoto')) {
            shell_exec(config('photo_sync_script'));
            session()->flash('success', 'SRS Data Successfully Synchronized');
        }
        if ($request->input('syncStudent')) {
            $this->unit();
            session()->flash('success', 'SRS Data Successfully Synchronized' . $this->student());
        }

        $data = [];
        $data['campus'] = DB::table('campuses')->count();
        $data['religion'] = DB::table('religions')->count();
        $data['program'] = DB::table('programs')->count();
        $data['programLevel'] = DB::table('program_levels')->count();
        $data['programType'] = DB::table('program_types')->count();
        $data['enrollmentType'] = DB::table('enrollment_types')->count();
        $data['college'] = DB::table('colleges')->count();
        $data['department'] = DB::table('departments')->count();

        return view('srs_data.dashboard', compact('data'));
    }


    public function unit()
    {
    }

    // student s INNER JOIN sf_guard_user sf ON sf.id = s.sf_guard_user_id
    // INNER JOIN student_info ifo ON s.id=ifo.student_id
    //  JOIN student_detail sd ON s.id = sd.student_id
    //  where ifo.record_status=1


    public function insert()
    {

        $hrm = DB::connection('mysql'); 
       
        $fields = ['id','username','program_id','first_name', 'middle_name','last_name', 'sex', 'photo','religion_id','academic_year','year','is_student_active','is_registered','year_of_enterance','nationality','section','semester','date_of_birth', 'entrance_reg_no', 'created_at'];

        $query = "SELECT " . implode(', ', $fields) . " FROM student where is_student_active=1";
        $data = DB::connection('mysql')->select($query);

        dd(     $data );
        $targetTable = 'employees'; 
        foreach ($data as $value) {
            // Convert the result object to an associative array
            $value = (array) $value;
            try {
                $moh = DB::connection('mysql_MoH');
                $result = $moh->table($targetTable)->updateOrInsert(
                    ['student_id' => $value['id']],
                    [
                        'username' => $value['username'],
                        'middle_name' => $value['middle_name'],
                        'last_name' => $value['last_name'],
                        'sex' => $value['sex'],
                        'photo' => $value['photo'],
                        'religion_id' => $value['religion_id'],
                        'academic_year' => $value['academic_year'],
                        'year' => $value['year'],
                        'is_student_active' => $value['is_student_active'],
                        'is_registered' => $value['is_registered'],
                        'year_of_enterance' => $value['year_of_enterance'],
                        'nationality' => $value['nationality'],
                        'section' => $value['section'],
                        'semester' => $value['semester'],
                        'date_of_birth' => $value['date_of_birth'],
                        'entrance_reg_no' => $value['entrance_reg_no'],
                        'created_at' => $value['created_at'],

                    ]
                );


            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
        if ($result) {
            return redirect()->route('dashboard')->with('success', 'Data Successfully Synchronized');
        }
    }
    //////////////////////////////////////////////////////////////////////////////

    
    public function syncDepartment()
    {
    }
    public function syncProgram()
    {
    }

    public function syncProgramType()
    {
    }
    public function syncProgramLevel()
    {
    }
}
