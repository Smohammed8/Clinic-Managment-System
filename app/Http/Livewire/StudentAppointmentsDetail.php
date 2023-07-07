<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\View\View;
use App\Models\Encounter;
use App\Models\ClinicUser;
use App\Models\Appointment;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentAppointmentsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Student $student;
    public Appointment $appointment;
    public $encountersForSelect = [];
    public $clinicUsersForSelect = [];
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
        'appointment.encounter_id' => [
            'nullable',
            'boolean',
            'exists:encounters,id',
        ],
        'appointment.clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
    ];

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->encountersForSelect = Encounter::pluck('id', 'id');
        $this->clinicUsersForSelect = ClinicUser::pluck('id', 'id');
        $this->resetAppointmentData();
    }

    public function resetAppointmentData(): void
    {
        $this->appointment = new Appointment();

        $this->appointmentADate = null;
        $this->appointment->encounter_id = null;
        $this->appointment->clinic_user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAppointment(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.student_appointments.new_title');
        $this->resetAppointmentData();

        $this->showModal();
    }

    public function editAppointment(Appointment $appointment): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.student_appointments.edit_title');
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

        if (!$this->appointment->student_id) {
            $this->authorize('create', Appointment::class);

            $this->appointment->student_id = $this->student->id;
        } else {
            $this->authorize('update', $this->appointment);
        }

        $this->appointment->a_date = \Carbon\Carbon::make(
            $this->appointmentADate
        );

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

        foreach ($this->student->appointments as $appointment) {
            array_push($this->selected, $appointment->id);
        }
    }

    public function render(): View
    {
        return view('livewire.student-appointments-detail', [
            'appointments' => $this->student->appointments()->paginate(20),
        ]);
    }
}
