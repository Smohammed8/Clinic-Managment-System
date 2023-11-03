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
    }
    public function insert()
    {

        try {
            $dbcon = DB::connection('mysql_srs');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

        $results = $dbcon->select(DB::raw(" SELECT s.id, sf.username, ifo.program_id, sf.first_name, sf.fathers_name, sf.grand_fathers_name, s.student_id, s.sex,
        IFNULL(sd.photo, '') AS photo, ifo.academic_year, ifo.year, 1,
        IF(ifo.is_registered = 1, 1, 0) AS is_registered, s.admission_year, 'Ethiopian' AS nationality, ifo.section, ifo.semester, s.birth_date,
        sd.entrance_exam_id, sd.mother_name AS adopter_name,
        sd.zone_id AS school_zone, sd.woreda AS school_woreda, sd.kebele AS school_kebele,
        sd.telephone AS phone, sd.family_phone
        FROM student s
        INNER JOIN sf_guard_user sf ON sf.id = s.sf_guard_user_id
        INNER JOIN student_info ifo ON s.id = ifo.student_id
        JOIN student_detail sd ON s.id = sd.student_id
        WHERE ifo.record_status = 1 AND s.id != 0 AND ifo.year != 0
        ORDER BY ifo.id DESC;
        -- LIMIT 100; 
    "));

        $data = $results;
        $targetTable = 'students';
        foreach ($data as $value) {
            // Convert the result object to an associative array
            $value = (array) $value;
            try {
                $moh = DB::connection('mysql');
                $result = $moh->table($targetTable)->updateOrInsert(
                    ['id_number' => $value['id']],
                    [
                        //'username' => $value['username'],
                        'first_name' => $value['first_name'],
                        'middle_name' => $value['fathers_name'],
                        'last_name' => $value['grand_fathers_name'],
                        'sex' => $value['sex'],
                        'program_id' => $value['program_id'],
                        'photo' => $value['photo'],
                        'academic_year' => $value['academic_year'],
                        'year' => $value['year'],
                        //'campus_id'=>$value['campus_id'],
                        'year_of_entrance' => $value['admission_year'],
                        'is_student_active' => 1,
                        'mobile_number' => $value['phone'],
                        'is_registered' => $value['is_registered'],
                        'nationality' => $value['nationality'],
                        'section' => $value['section'],
                        'semester' => $value['semester'],
                        'date_of_birth' => $value['birth_date'],
                        'entrance_reg_no' => $value['entrance_exam_id'],
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

    // public function syncProgramRelated()
    // {
    //     $programTypeQuery = $this->conn->table('program_type')->select('program_type.id as program_type_id', 'program_type.program_type_name')->get();

    //     $programLevelQuery = $this->conn->table('program_level')->select('program_level.id as program_level_id', 'program_level.program_level_name')->get();

    //     $enrollmentTypeQuery = $this->conn->table('enrollment_type')->select('enrollment_type.id as enroll_type_id', 'enrollment_type.enrollment_type_name')->get();

    //     foreach ($programTypeQuery as $key => $proType) {
    //         $proType = (array) $proType;
    //         ProgramType::updateOrCreate(['id' => $proType['program_type_id']], ['id' => $proType['program_type_id'], 'name' => $proType['program_type_name']]);
    //     }

    //     foreach ($programLevelQuery as $key => $proLevel) {
    //         $proLevel = (array) $proLevel;
    //         ProgramLevel::updateOrCreate(['id' => $proLevel['program_level_id']], ['id' => $proLevel['program_level_id'], 'name' => $proLevel['program_level_name']]);
    //     }

    //     foreach ($enrollmentTypeQuery as $key => $enrType) {
    //         $enrType = (array) $enrType;
    //         EnrollmentType::updateOrCreate(['id' => $enrType['enroll_type_id']], ['id' => $enrType['enroll_type_id'], 'name' => $enrType['enrollment_type_name']]);
    //     }
    // }

    // public function fetch()
    // {
    //     // $this->syncProgramRelated();
    //     $query = $this->conn->table('college')
    //         ->join('department', 'college.id', '=', 'department.college_id')
    //         ->join('program', 'department.id', '=', 'program.department_id')
    //         ->select('college.id as college_id', 'college.college_name', 'department.id as department_id', 'department.department_name', 'program.id as program_id', 'program.name as program_name', 'program.enrollment_type_id', 'program.program_level_id', 'program.program_type_id')
    //         ->get();

    //     $collegesWithDepartments = [];

    //     foreach ($query as $result) {
    //         $collegeID = $result->college_id;
    //         $collegeName = $result->college_name;
    //         $departmentID = $result->department_id;
    //         $departmentName = $result->department_name;

    //         $programID = $result->program_id;
    //         $programName = $result->program_name;
    //         $programEnrollment = $result->enrollment_type_id;
    //         $programType = $result->program_type_id;
    //         $programLevel = $result->program_level_id;

    //         // Store the college name and associated departments
    //         if (!isset($collegesWithDepartments[$collegeID])) {
    //             $collegesWithDepartments[$collegeID] = [
    //                 'college_name' => $collegeName,
    //                 'departments' => [],
    //             ];
    //         }

    //         $collegesWithDepartments[$collegeID]['departments'][] = [
    //             'department_id' => $departmentID,
    //             'department_name' => $departmentName,
    //         ];
    //     }

    //     foreach ($collegesWithDepartments as $key => $collegesWithDepartment) {
    //         if ($key == 0) {
    //             continue;
    //         }
    //         $college = College::updateOrCreate(['id' => $key], ['id' => $key, 'name' => $collegesWithDepartment['college_name']]);

    //         foreach ($collegesWithDepartment['departments'] as $dep) {
    //             $dep =  Department::updateOrCreate(['id' => $dep['department_id']], ['id' => $dep['department_id'], 'name' => $dep['department_name'], 'college_id' => $college->id]);
    //             $dep->getDepartmentSessionStatus($this->latestAcademicSession);

    //             $this->syncProgram($dep->id);
    //             $this->syncInstructor($dep->id);
    //             try {
    //                 $this->assignDepartmentHead($dep->id);
    //             } catch (Exception $e) {
    //                 continue;
    //             }
    //         }
    //     }
    // }
}
