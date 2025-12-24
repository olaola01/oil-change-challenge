<?php

namespace App\Services;

use App\Models\OilChange;
use Illuminate\Support\Carbon;

class OilChangeService
{
    /**
     * Determines if an oil change is due based on odometer reading and time elapsed since the previous change.
     *
     * @param OilChange $oilChange The oil change data including current odometer, previous odometer, and previous date.
     * @return bool Returns true if the oil change is due; otherwise, false.
     */
    public function isDue(OilChange $oilChange): bool
    {
        $kmDue = ($oilChange->current_odometer - $oilChange->previous_odometer) > config('oilchange.km_threshold');

        $timeDue = Carbon::parse($oilChange->previous_date)->lt(
            now()->subMonths(config('oilchange.month_threshold'))
        );

        return $kmDue || $timeDue;
    }
}
