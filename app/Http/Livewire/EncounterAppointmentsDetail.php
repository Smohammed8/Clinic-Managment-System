<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use App\Models\Encounter;
use Illuminate\View\View;
use App\Models\ClinicUser;
use App\Models\Appointment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EncounterAppointmentsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Encounter $encounter;
    public Appointment $appointment;
    public $clinicUsersForSelect = [];
    public $studentsForSelect = [];
    public $appointmentADate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Appointment';

    protected $rules = [
        'appointmentADate' => ['nullable', 'date'],
        'appointment.reason' => ['nullable', 'max:255', 'string'],
        'appointment.status' => ['nullable', 'max:255'],
        // 'appointment.clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
        // 'appointment.student_id' => ['required', 'exists:students,id'],
    ];

    public function mount(Encounter $encounter): void
    {
        $this->encounter = $encounter;
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->studentsForSelect = Student::pluck('first_name', 'id');
        $this->resetAppointmentData();
    }

    public function resetAppointmentData(): void
    {
        $this->appointment = new Appointment();

        $this->appointmentADate = null;
        $this->appointment->clinic_user_id = null;
        $this->appointment->student_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAppointment(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.encounter_appointments.new_title');
        $this->resetAppointmentData();

        $this->showModal();
    }

    public function editAppointment(Appointment $appointment): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.encounter_appointments.edit_title');
        $this->appointment = $appointment;

        $this->appointmentADate = optional($this->appointment->a_date)->format(
            'Y-m-d'
        );

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();
        // dd($this);

        if (!$this->appointment->encounter_id) {
            $this->authorize('create', Appointment::class);

            $this->appointment->encounter_id = $this->encounter->id;
        } else {
            $this->authorize('update', $this->appointment);
        }

        $this->appointment->a_date = \Carbon\Carbon::make(
            $this->appointmentADate
        );

        $this->appointment->clinic_user_id = Auth::user()->clinicUsers->id;
        $this->appointment->student_id = $this->encounter->student->id;


        $this->appointment->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Appointment::class);

        Appointment::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAppointmentData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->encounter->appointments as $appointment) {
            array_push($this->selected, $appointment->id);
        }
    }

    public function render(): View
    {
        return view('livewire.encounter-appointments-detail', [
            'appointments' => $this->encounter->appointments()->paginate(20),
        ]);
    }
}
