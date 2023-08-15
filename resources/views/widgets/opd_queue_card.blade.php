<div class="row m-2">

    <?php
    // Array of possible background colors
    $bgColors = ['bg-info', 'bg-success', 'bg-warning', 'bg-danger', 'bg-primary', 'bg-secondary'];
    
    // Shuffle the array to randomize the color order
    shuffle($bgColors);
    ?>

    @foreach ($opdQueue as $index => $encounter)
        <?php
        // Get a random background color from the shuffled array
        $bgColor = $bgColors[$index % count($bgColors)];
        ?>

        <div class="col-lg-3 col-6">
            <div class="small-box {{ $bgColor }}">
                <div class="inner">
                    <h3>{{ $encounter->student->id_number }}</h3>
                    <p>{{ $encounter->Doctor ? $encounter->Doctor->user->name : '-' }}
                    </p>

                </div>
                <div class="icon">
                    <i class="ion ion-stat text-light font-weight-bold"><span class="small text-md"> OPD</span>101</i>
                </div>
                <h5 class="small-box-footer">{{ $encounter->student->getFullNameAttribute() }} <i
                        class="fas fa-arrow-circle-right"></i>
                </h5>
            </div>
        </div>
    @endforeach
</div>
