<?php

namespace App\Http\Controllers;


use Illuminate\Console\View\Components\Alert;
use PDOException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

require_once app_path('Helper/constants.php');
class SRSController extends Controller
{


    public function srsData(Request $request)
    {
        if ($request->input('syncdata')) {
            $this->insert();
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
        $sis = DB::connection('mysql');
        try {
            $srs = DB::connection('mysql_srs')->getPdo();
            //  dd("The connection is successful");
            
            
            
            $data = DB::connection('mysql_srs')->select("SELECT id, program_level_name as name FROM program_level");
//   dd($data);
            try {
                foreach ($data as $value) {
                    // dd($data);
                    // dd("herse");
                    $value = (array) $value;

                    try {
    DB::statement("INSERT INTO program_level (id, name) VALUES (:id, :name) ON DUPLICATE KEY UPDATE name = :name", $value);
                    } catch (\Throwable $th) {
                        dd($th->getMessage());
                    }
                }
                Session::flash('success', 'Program Level Successfully Synchronized');
            } catch (\Throwable $th) {
                Session::flash('danger', 'Error Occurred While Fetching Program Level');
            }

            dd("finshed");

            $sql = "SELECT id, program_level_name as name FROM program_level ";
            $stmt = $srs->prepare($sql);
            $stmt->execute();
            // dd($stmt);
            $data = $stmt->fetchAll();
            // dd($data);
            // $statement = $srs->prepare('INSERT INTO users (name, email) VALUES (?, ?)');
            $sql = "INSERT INTO program_level (id,name) Values(:id,:name) ON DUPLICATE KEY UPDATE name = :name";
            $stmt = $sis->prepare($sql);
            try {
                foreach ($data as $value) {
                    $stmt->execute($value);
                }
            } catch (\Throwable $th) {
                Session::flash('danger', "Error Occured While Fetching Program Level ");
            }
            Session::flash("success", "Program Level Successfully Syncronized");

            /*
            * Progam Type Sync
            */
            $sql = "SELECT id,program_type_name as name FROM program_type where id!=0 ";
            $stmt = $srs->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            // dd($data);
            $sql = "INSERT INTO program_type (id,name) Values(:id,:name) ON DUPLICATE KEY UPDATE name = :name";
            $stmt = $sis->prepare($sql);
            try {
                foreach ($data as $value) {
                    $stmt->execute($value);
                }
            } catch (\Throwable $th) {
                Session::flash('danger', "Error Occured While Fetching Program Type ");
            }
            Session::flash("success", "Program Type Successfully Syncronized");
            /*
    * Enrollment Type Sync
    */
            $sql = "SELECT id,enrollment_type_name as name FROM  enrollment_type where id!=0 ";
            $stmt = $srs->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            $sql = "INSERT INTO enrollment_type (id,name) Values(:id,:name) ON DUPLICATE KEY UPDATE name = :name";
            $stmt = $sis->prepare($sql);
            try {
                foreach ($data as $value) {
                    $stmt->execute($value);
                }
            } catch (\Throwable $th) {
                Session::flash('danger', "Error Occured While Fetching Enrollment Type ");
            }
            Session::flash("success", "Enrollment Type Successfully Syncronized");
            /*
    * College Sync
    */
            $sql = "SELECT id,college_name as name FROM college where id!=0";
            $stmt = $srs->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            $sql = "INSERT INTO college (id,name) Values(:id,:name) ON DUPLICATE KEY UPDATE name = :name";
            $stmt = $sis->prepare($sql);
            try {
                foreach ($data as $value) {
                    $stmt->execute($value);
                }
            } catch (\Throwable $th) {
                Session::flash('danger', "Error Occured While Fetching College ");
            }
            Session::flash("success", "College Successfully Syncronized");

            /*
    * Department Sync
    */
            $sql = "SELECT id,college_id,department_name as name FROM department where id!=0";
            $stmt = $srs->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            $sql = "INSERT INTO department (id,college_id,name) Values(:id,:college_id,:name) ON DUPLICATE KEY UPDATE college_id=:college_id, name = :name";
            $stmt = $sis->prepare($sql);
            try {
                foreach ($data as $value) {
                    $stmt->execute($value);
                }
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
