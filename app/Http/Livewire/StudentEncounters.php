<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Student;

class StudentEncounters extends Component
{
    public $student;

    public function mount($student)
    {
        $this->student = $student;
        //dd($student);
    }

    public function render()
    {
        $student = Student::findOrFail($this->student->id);

        return view('livewire.student-encounters', [
            'student' => $student,
        ]);
    }
}
