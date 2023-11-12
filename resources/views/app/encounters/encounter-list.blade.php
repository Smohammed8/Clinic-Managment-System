<div class="">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center display-4"> Search</h2>


                </div>

        <div class="card-body">  
             <section class="content">
                <div class="container-fluid">
              
                    <div class="row">
                      <div class="col-md-8 offset-md-2">
                    
                      <form id="checkInForm" action="{{ route('checkin') }}" method="post">
                        @csrf
                      <div class="input-group">
                        <input type="search" autocomplete="off" id="manualInput" name="student_id" class="form-control form-control-lg" placeholder="Enter Student ID here">

                        <input type="text" id="barcodeInput" class="form-control form-control-lg" style="display: none;" placeholder="Scan Barcode">
                        <div class="input-group-append">
                            
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-search"></i><b> Check in </b>
                            </button>
                          </div>
                            </div>
                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </section>
                   
                <br><br>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-sm table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                     
                                        <th class="text-left">Student ID </th>
                                        <th class="text-left">Patient Name</th>
                                        <th class="text-left">Age </th>
                                        <th class="text-left">Gender</th>
                                        <th class="text-left"> Date of visit </th>
                                        <th class="text-left">Status  </th>
                                        <th class="text-left"> Mapped RFID</th>
                                        <th class="text-center">
                                            @lang('crud.common.actions')
                                        </th>
                                    </tr>
                                </thead>
        
        
                                <tbody>
                                    @foreach ($encounters as $key => $encounter)
                                        <tr>
        
                                            <td> {{ $key + 1 }}
                                             
                                            <td>{{ $encounter->student->id_number ?? '-' }}</td>
                                            <td>{{ $encounter->student?->fullName ?? '-' }}</td>
                                            <td>
                                                @php
                                                    try {
                                                        $age = \Carbon\Carbon::parse($encounter->student->date_of_birth)
                                                            ->diff(\Carbon\Carbon::now())
                                                            ->format('%y years old');
                                                    } catch (\Exception $e) {
                                                        $age = '<span style="color: red;">Error</span>';
                                                    }
                                                    echo $age;
                                                @endphp
                                            </td>
                                            <td>{{ optional($encounter->student)->sex ?? '-' }}</td>
        
                                            <td>{{ $encounter->created_at->diffForHumans() }} </td>
                                            <td>
                                               
        
                                                <span class="badge badge-info">
                                                 
                                                    @if($encounter->status ==1 )
                                                      <span class="typcn typcn-input-checked-outline"> Checked-in</span>
                                                   @else
                                                   <span class="typcn typcn-input-checked-outline"> Called by Doctor </span>
                                                   @endif
                                                   
                                                   
                                               
                                                     
                                             
                                            </td>
                                        <td>{{ $encounter->student->rfid ?? '-' }} </td>
        
                                            <td class="text-right">
                                                <div role="group" aria-label="Row Actions" class="btn-group">
        
        

                                                 
                                                        @can('map-rfid')
                                                        @if($encounter->student->rfid === null )
                                            

                                                            <form method="post" action="{{ route('map-rfid') }}">
                                                                @csrf
                                                                <input type="hidden" name="student_id" value="{{ $encounter->student->id }}">
                                                                <input type="text"   required class="form-control-sm" autocomplete="off"  name="rfid" placeholder="Enter RFID">
                                                                <button type="submit" class="btn btn-sm btn-outline-primary mr-1" > <i class="icon fa fa-plus"></i> Map RFID</button>
                                                            </form>

                                                            @else
                                            
                                                        

                                                                        <form method="post" action="{{ route('unmap-rfid') }}" onsubmit="return confirm('Are you sure to unmap this RFID from the student?');">
                                                                            @csrf

                                                                        <input hidden name="remove_mapping" value="true">
                                                                        <input hidden name="rfid" value="{{ $encounter->student->rfid }}">
                                                                        <button class="btn btn-sm btn-outline-primary mx-1" type="submit">  <i class="icon fa fa-book"></i>  UnMap Rfid</button>
                                                                    </form>
                                                             

                                                            @endif
                                                 
                                                         @endcan
        

                                                        @can('delete', $encounter)
                                                        @if($encounter->status ==1 )
                                                            <form data-route="{{ route('encounters.destroy', $encounter) }}"
                                                                method="POST" id="deletebtnid">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    <i class="fa fa-user-minus"></i> Uncheck
                                                                </button>
                                                            </form>
                                                            @else
                                                            <button type="submit" class="btn btn-sm btn-outline-info">
                                                                <i class="fa fa-user"></i> In-Process
                                                            </button>
                                                            @endif
                                                        @endcan

                                                  
                                            </td>
                                        </tr>
                                    @endforeach
                        </div>
        
                        @if ($encounters->isEmpty())
                            <tr>
                                <td colspan="12" style="color:red;">
                                  No check-in records today!
                                </td>
                            </tr>
                        @endif
        
                        </tbody>
                   
                        </table>
                    
                   
                        <div  class="float-right" style="text-align: right;">
                            {{ $encounters->links() }}
                        </div>
               

                    
                </div>
            </div>
        </div>
    </div>
</div>