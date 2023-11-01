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
                                        <p>Status: {{ $encounter->status }}</p>
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
