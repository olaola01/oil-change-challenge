<?php

namespace Tests\Unit;

use App\Models\OilChange;
use App\Services\OilChangeService;
use Carbon\Carbon;
use Tests\TestCase;

class OilChangeServiceTest extends TestCase
{
    private OilChangeService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new OilChangeService();
    }

    /**
     * @return void
     */
    public function test_it_returns_true_when_more_than_5000_km_driven(): void
    {
        $oilChange = new OilChange([
            'current_odometer' => 10000,
            'previous_odometer' => 0,
            'previous_date' => Carbon::now()->subMonth(),
        ]);

        $this->assertTrue($this->service->isDue($oilChange));
    }

    /**
     * @return void
     */
    public function test_it_returns_true_when_more_than_6_months_passed(): void
    {
        $oilChange = new OilChange([
            'current_odometer' => 2000,
            'previous_odometer' => 1000,
            'previous_date' => Carbon::now()->subMonths(7),
        ]);

        $this->assertTrue($this->service->isDue($oilChange));
    }

    /**
     * @return void
     */
    public function test_it_returns_false_when_neither_condition_is_met(): void
    {
        $oilChange = new OilChange([
            'current_odometer' => 4000,
            'previous_odometer' => 1000,
            'previous_date' => Carbon::now()->subMonths(4),
        ]);

        $this->assertFalse($this->service->isDue($oilChange));
    }

    /**
     * @return void
     */
    public function test_it_returns_true_when_both_conditions_are_met(): void
    {
        $oilChange = new OilChange([
            'current_odometer' => 8000,
            'previous_odometer' => 0,
            'previous_date' => Carbon::now()->subYears(),
        ]);

        $this->assertTrue($this->service->isDue($oilChange));
    }
}
