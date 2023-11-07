<?php

namespace App\Widgets;

use App\Models\Encounter;
use Arrilot\Widgets\AbstractWidget;

class OpdQueueTable extends AbstractWidget
{
    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 5;

    protected $config = [];
    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */


    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */

    public function placeholder()
    {
        return 'Loading...';
    }

    public function run()
    {
        //
        // 1 = Checked-In



        $opdQueueToBe = Encounter::whereIn('status', [STATUS_CHECKED_IN])->get();



        return view('widgets.opd_queue_table', [
            'config' => $this->config,
            'reloadTimeout' => $this->reloadTimeout,
            'opdQueueToBe' => $opdQueueToBe,


        ]);
    }
}
