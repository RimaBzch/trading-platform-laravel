<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


use App\Models\IndicatorAnalysis;

class IndicatorAnalysisUpdated
{
    use Dispatchable, SerializesModels;

    public $indicatorAnalysis;
    public $previousValues;

    public function __construct(IndicatorAnalysis $indicatorAnalysis , array $previousValues)
    {
        $this->indicatorAnalysis = $indicatorAnalysis;
        $this->previousValues = $previousValues;

    }
}
