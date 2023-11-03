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



    // CREATE TABLE `students` (
    //     `id` bigint UNSIGNED NOT NULL,
    //     `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `sex` enum('M','F') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `id_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `religion_id` int DEFAULT NULL,
    //     `campus_id` int DEFAULT NULL,
    //     `program_id` int DEFAULT NULL,
    //     `user_id` int DEFAULT NULL,
    //     `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `date_of_birth` date DEFAULT NULL,
    //     `year` int DEFAULT NULL,
    //     `year_of_entrance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `is_id_active` tinyint(1) DEFAULT NULL,
    //     `is_student_active` tinyint(1) DEFAULT NULL,
    //     `id_significant_digit` int DEFAULT NULL,
    //     `is_registered` tinyint(1) DEFAULT NULL,
    //     `rfid` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `mrn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `section` int DEFAULT NULL,
    //     `semester` int DEFAULT NULL,
    //     `entrance_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `is_fresh_registered` tinyint(1) DEFAULT NULL,
    //     `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `rfid_temp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    //     `created_at` timestamp NULL DEFAULT NULL,
    //     `updated_at` timestamp NULL DEFAULT NULL
    //   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


//     SELECT
//     id AS student_id,
//     am_full_name,
//     entrance_exam_id,
//     mother_name,
//     photo,
//     zone_id,
//     woreda,
//     kebele,
//     telephone,
//     family_phone,
//     place_of_birth,
//     NULL AS sf_guard_user_id,
//     birth_date,
//     admission_year,
//     sex,
//     program_id
// FROM student_detail
// WHERE 1

// UNION

// SELECT
//     NULL AS student_id,
//     sf_guard_user_id,
//     student_id,
//     birth_date,
//     admission_year,
//     sex,
//     program_id,
//     NULL AS am_full_name,
//     NULL AS entrance_exam_id,
//     NULL AS mother_name,
//     NULL AS photo,
//     NULL AS zone_id,
//     NULL AS woreda,
//     NULL AS kebele,
//     NULL AS telephone,
//     NULL AS family_phone,
//     NULL AS place_of_birth
// FROM student
// WHERE 1;

    public function insert()
    {

       
        // $hrm = DB::connection('mysql_srs'); 
        // $fields = ['id','program_id','first_name', 'middle_name','last_name', 'sex', 'photo','religion_id','academic_year','year','is_student_active','is_registered','year_of_enterance','nationality','section','semester','date_of_birth', 'entrance_reg_no', 'created_at'];


        $results = DB::connection('mysql_srs')->select(DB::raw(" SELECT s.id, sf.username, ifo.program_id, sf.first_name, sf.fathers_name, sf.grand_fathers_name, s.student_id, s.sex,
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
        ORDER BY ifo.id DESC
        LIMIT 10;  -- Replace 10 with the desired limit
    "));

// Convert the results to a JSON format
$data = $results;
  
        $targetTable = 'students'; 
        foreach ($data as $value) {
            // Convert the result object to an associative array
            $value = (array) $value;
            // dd($value);
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
                        'photo' => $value['photo'],
                        'academic_year' => $value['academic_year'],
                        'year' => $value['year'],
                        'is_student_active' => 1,
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
