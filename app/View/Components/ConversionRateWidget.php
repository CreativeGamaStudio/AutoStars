<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConversionRateWidget extends Component
{
    public $conversionRate;
    public $percentageChange;

    public $changeDirection;

    public function __construct($conversionRate, $percentageChange, $changeDirection)
    {
        $this->conversionRate = $conversionRate;
        $this->percentageChange = $percentageChange;
        $this->changeDirection = $changeDirection;
    }

    public function render()
    {
        return view('components.conversion-rate-widget');
    }
}
