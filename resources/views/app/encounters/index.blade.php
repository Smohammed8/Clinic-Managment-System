@extends('layouts.app')

@section('content')
    <div class="">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon io-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Encounter::class)
                        <a href="{{ route('encounters.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.encounters.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.check_in_time') --}}
                                    MRN
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.student_id') --}}
                                    ID
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.status') --}}

                                    @unless (auth()->user()->hasRole('doctor'))
                                        Patient Name
                                    @endunless
                                </th>

                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.closed_at') --}}
                                    Age
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.priority') --}}
                                    Gender
                                </th>
                                <th class="text-left">
                                    {{-- @lang('crud.encounters.inputs.clinic_id') --}}
                                    Date of visit
                                </th>

                                <th class="text-left">
                                    Status
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($encounters  as $key =>  $encounter)
                                <tr>

                                    <td> {{ $key + 1 }}
                                    <td>{{ $encounter->student->id_number ?? '-' }}</td>
                                    <td>{{ $encounter->student->id_number ?? '-' }}</td>
                                    <td>
                                        @unless (auth()->user()->hasRole('doctor'))
                                            {{ $encounter->student->fullName ?? '-' }}
                                        @endunless
                                    </td>
                                    <td>{{ $encounter->priority ?? '-' }}</td>
                                    <td>{{ optional($encounter->student)->sex ?? '-' }}</td>
                                    <td>{{ $encounter->check_in_time ?? '-' }}</td>
                                    <td>
                                        @php
                                            $statusDetails = [
                                                0 => [
                                                    'name' => 'Scheduled',
                                                    'description' => 'The patient\'s appointment is confirmed but not yet attended.',
                                                    'color' => 'btn-outline-primary',
                                                ],
                                                1 => [
                                                    'name' => 'Checked-In',
                                                    'description' => 'The patient has arrived at the clinic and registered their presence.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                2 => [
                                                    'name' => 'In Progress',
                                                    'description' => 'The patient is currently being seen by a healthcare provider.',
                                                    'color' => 'btn-outline-info',
                                                ],
                                                3 => [
                                                    'name' => 'Completed',
                                                    'description' => 'The patient\'s appointment has concluded successfully.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                4 => [
                                                    'name' => 'Missed',
                                                    'description' => 'The patient did not show up for their scheduled appointment.',
                                                    'color' => 'btn-outline-danger',
                                                ],
                                                5 => [
                                                    'name' => 'Rescheduled',
                                                    'description' => 'The appointment was rescheduled for a future date.',
                                                    'color' => 'btn-outline-warning',
                                                ],
                                                6 => [
                                                    'name' => 'Waiting',
                                                    'description' => 'The patient is waiting to be called for their appointment.',
                                                    'color' => 'btn-outline-secondary',
                                                ],
                                                7 => [
                                                    'name' => 'On Hold',
                                                    'description' => 'The patient is temporarily on hold (e.g., waiting for test results).',
                                                    'color' => 'btn-outline-secondary',
                                                ],
                                                8 => [
                                                    'name' => 'Queue Completed',
                                                    'description' => 'The patient has been seen and their encounter is completed.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                9 => [
                                                    'name' => 'Rejected',
                                                    'description' => 'The encounter has been reviewed and changes are needed before approval.',
                                                    'color' => 'btn-outline-danger',
                                                ],
                                                10 => [
                                                    'name' => 'Prescription Active',
                                                    'description' => 'The patient is currently prescribed medication.',
                                                    'color' => 'btn-outline-info',
                                                ],
                                                11 => [
                                                    'name' => 'Prescription Renewed',
                                                    'description' => 'The prescription has been renewed by the healthcare provider.',
                                                    'color' => 'btn-outline-info',
                                                ],
                                                12 => [
                                                    'name' => 'Test Pending',
                                                    'description' => 'Test or lab results are pending.',
                                                    'color' => 'btn-outline-secondary',
                                                ],
                                                13 => [
                                                    'name' => 'Test Available',
                                                    'description' => 'Test or lab results are available for review.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                14 => [
                                                    'name' => 'Test Reviewed',
                                                    'description' => 'Test or lab results have been reviewed by a healthcare provider.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                15 => [
                                                    'name' => 'Follow-up Scheduled',
                                                    'description' => 'A follow-up appointment is scheduled.',
                                                    'color' => 'btn-outline-primary',
                                                ],
                                                16 => [
                                                    'name' => 'Follow-up Completed',
                                                    'description' => 'The follow-up appointment has been completed.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                17 => [
                                                    'name' => 'Follow-up Rescheduled',
                                                    'description' => 'The follow-up appointment has been rescheduled.',
                                                    'color' => 'btn-outline-warning',
                                                ],
                                                18 => [
                                                    'name' => 'Referral Requested',
                                                    'description' => 'Referral to a specialist or another healthcare provider has been requested.',
                                                    'color' => 'btn-outline-secondary',
                                                ],
                                                19 => [
                                                    'name' => 'Referral Approved',
                                                    'description' => 'The referral request has been approved.',
                                                    'color' => 'btn-outline-success',
                                                ],
                                                20 => [
                                                    'name' => 'Referral Rejected',
                                                    'description' => 'The referral request has been rejected.',
                                                    'color' => 'btn-outline-danger',
                                                ],
                                                // ... Add details for other status values ...
                                            ];
                                        @endphp

                                        <button
                                            class="btn btn-sm {{ $statusDetails[$encounter->status]['color'] ?? 'btn-outline-secondary' }} mx-1">
                                            {{ $statusDetails[$encounter->status]['name'] ?? '-' }}
                                        </button>

                                        <!-- Status Description (Hidden) -->
                                        {{-- {{ $statusDetails[$encounter->status]['description'] ?? '-' }} --}}
                                    </td>

                                    <td class="text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">

                                            {{-- @can('update', $encounter) --}}
                                            {{-- <a href="{{ route('medical-sick-leaves.show', $encounter) }}">
                                                <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                    <i class="fa fa-print"></i> Sick Leave
                                                </button>
                                            </a> --}}
                                            {{-- @endcan  --}}

                                            <!-- Check if user is a doctor -->
                                            @if (auth()->user()->hasRole('doctor'))
                                                @if ($key === 0)
                                                    <a href="{{ route('encounters.show', $encounter) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="icon fa fa-user"></i> Accept
                                                        </button>
                                                    </a>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1"
                                                        disabled>
                                                        <i class="icon fa fa-user"></i> Accept
                                                    </button>
                                                @endif
                                            @else
                                                @can('view', $encounter)
                                                    <a href="{{ route('encounters.show', $encounter) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="icon fa fa-user"></i> Profile
                                                        </button>
                                                    </a>
                                                @endcan
                                            @endif
                                    <td>
                                        @if (auth()->user()->hasRole(['admin', 'super-admin']))
                                            @can('update', $encounter)
                                                <a href="{{ route('encounters.edit', $encounter) }}">
                                                    <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                </a>
                                            @endcan

                                            @can('delete', $encounter)
                                                <form data-route="{{ route('encounters.destroy', $encounter) }}" method="POST"
                                                    id="deletebtnid">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    </td>

                </div>
                </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        @lang('crud.common.no_items_found')
                    </td>
                </tr>
                @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">{!! $encounters->render() !!}</td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
    {{-- <script>
            swal(
                'The Internet?',
                'That thing is still around?',
                'question'
            )
        </script> --}}
    </div>
@endsection
