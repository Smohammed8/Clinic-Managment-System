<style>
    .notification-badge {
        animation: blinkAnimation 1s infinite; /* Blinking animation */
    }

    @keyframes blinkAnimation {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }

</style>

<div class="row m-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>OPD Queue To Be</h2>
                <table class="table">
                    <tbody>
                        @foreach ($opdQueueToBe->chunk(4) as $chunk)
                            <tr>
                                @foreach ($chunk as $encounter)
                                    <td>
                                        <h4>Student ID: {{ $encounter->student->id_number ?? '-' }}</h4>
                                        <p class="notification-badge" style="font-size:20px; color:yellow; font-weight:bold;">
                                            <i class="fa fa-wheelchair"> </i>
                                            @if ($encounter->status === 1)
                                                Waiting
                                            @elseif ($encounter->status === 2)
                                                Called by the Doctor
                                            @elseif ($encounter->status === 3)
                                                Encounter Closed
                                            @else
                                            Waiting
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
