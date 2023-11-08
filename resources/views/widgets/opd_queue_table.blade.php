<div class="row m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>OPD Queue To Be</h2>
                <table class="table">
                    <tbody>
                        @foreach ($opdQueueToBe->chunk(3) as $chunk)
                            <tr>
                                @foreach ($chunk as $encounter)
                                    <td>
                                        <h4>Student ID: {{ $encounter->student->id_number ?? '-' }}</h4>
                                        <p>Status:
                                            @if ($encounter->status === 0)
                                                Checked In
                                            @elseif ($encounter->status === 1)
                                                Encounter Closed
                                            @elseif ($encounter->status === 2)
                                                Called by the Doctor
                                            @elseif ($encounter->status === 3)
                                                Missed and Closed
                                            @elseif ($encounter->status === 4)
                                                Rescheduled
                                            @elseif ($encounter->status === 5)
                                                Waiting
                                            @elseif ($encounter->status === 6)
                                                On Hold
                                            @elseif ($encounter->status === 7)
                                                Test Pending
                                            @elseif ($encounter->status === 8)
                                                Test Available
                                            @elseif ($encounter->status === 9)
                                                Test Reviewed
                                            @elseif ($encounter->status === 10)
                                                Follow-up Scheduled
                                            @elseif ($encounter->status === 11)
                                                Follow-up Completed
                                            @else
                                                Unknown
                                            @endif
                                        </p>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
