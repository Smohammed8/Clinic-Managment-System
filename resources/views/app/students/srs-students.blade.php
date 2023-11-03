@extends('layouts.app')

@section('content')
    <div class="">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-9">
                  

                    <form method="GET" action="">
                        <div class="row">
                            
                            <div class="col-md-2">
                                <select name="campus" class="form-control select2">
                                    <option value="">Select Campus</option>
                                    <!-- Add options for Filter 1 -->
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="program" class="form-control select2">
                                    <option value=""> Select Program</option>
                                    <!-- Add options for Filter 2 -->
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="dept" class="form-control select2">
                                    <option value=""> Select Department</option>
                                    <!-- Add options for Filter 3 -->
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select name="programType" class="form-control select2">
                                    <option value="">Select Program type</option>
                                    <!-- Add options for Filter 3 -->
                                </select>
                            </div>

                     

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-sm btn-outline-primary mx-1">Apply Filters</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-3 text-right">
                    {{-- @can('create', App\Models\Student::class)
                        <a href="{{ route('students.create') }}" class="btn  btn-sm btn-outline-primary float-right mr-1">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan --}}
              
                    @can('create', App\Models\Student::class)
                        <a href="{{ route('sync') }}" class="btn  btn-sm btn-outline-primary float-right mr-1">
                            <i class="fa fa-sync-alt"></i> Sync SRS Data
                        </a>
                    @endcan
                </div>


                
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.students.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">
                                  Student Name
                                </th>
                                <th class="text-left">
                                    Gender
                                 </th>
                               
                                <th class="text-left">
                                    ID Number
                                </th>
                                <th class="text-left">
                                    Program
                                </th>
                                <th class="text-left"> Age(in year)</th>
                                <th class="text-left">
                                   Campus </th>
                                <th class="text-left">
                                   Department
                                </th>
                             
                                <th class="text-left">
                                    Year
                                  </th>
                             
                              
                                <th class="text-center">
                                 Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                                @forelse($students as $key => $student)
                                    <tr>
                                        {{-- @dd($students->first()) --}}

                                        <td> {{ $key + 1 }}
                                        <td>{{ $student->first_name ?? '-' }} {{ $student->middle_name ?? '-' }} {{ $student->last_name ?? '-' }} </td>
                                        <td>{{ $student->sex ?? '-' }}</td>
                                        <td>{{ $student->id_number ?? '-' }} </td>
                                        <td>{{ $student->program ?? '-' }} </td>

                                        <td>    {{ \Carbon\Carbon::parse($student->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years old') }} </td>
                                        <td>{{ $student->campus ?? '-'}} </td>
                                        <td>{{ $student->department ?? '-'}} </td>
                                        <td>{{ $student->year }} </td>
                                    
                                  
                                    

                                        </td>
                                        <td class="text-center">
                                            <div role="group" aria-label="Row Actions" class="btn-group">
                                               

                                                {{-- @can('update', $student)
                                                    <a href="{{ route('students.edit', $student) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                    </a>
                                                @endcan --}}
                                                
                                                  @can('view', $student)
                                                    <a href="{{ route('students.show', $student) }}">
                                                        <button type="button" class="btn btn-sm btn-outline-primary mx-1">
                                                            <i class="icon ion-md-eye"></i> Show
                                                        </button>
                                                    </a>
                                                @endcan
                                                {{-- @can('delete', $student)
                                                    <form action="{{ route('students.destroy', $student) }}" method="POST"
                                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mx-1">
                                                            <i class="icon ion-md-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                @endcan --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                              
                                <tr>
                                    <td colspan="8">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                          
                        </tfoot>
                    </table>
                </div>
                <div class="m-auto float-right">
                    {{ $students->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
