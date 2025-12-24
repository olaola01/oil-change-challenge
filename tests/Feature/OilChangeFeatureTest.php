<?php

namespace Tests\Feature;

use App\Models\OilChange;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OilChangeFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_form_page_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('form');
        $response->assertSee('Current Odometer');
        $response->assertSee('Date of Previous Oil Change');
        $response->assertSee('Odometer at Previous Oil Change');
    }

    /**
     * @return void
     */
    public function test_validation_errors_are_shown_when_fields_are_missing(): void
    {
        $response = $this->post(route('oil.change.check'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'current_odometer',
            'previous_date',
            'previous_odometer',
        ]);
    }

    /**
     * @return void
     */
    public function test_validation_fails_when_current_odometer_is_less_than_previous(): void
    {
        $response = $this->post(route('oil.change.check'), [
            'current_odometer' => 5000,
            'previous_date' => '2025-01-01',
            'previous_odometer' => 6000,
        ]);

        $response->assertSessionHasErrors(['current_odometer']);
    }

    /**
     * @return void
     */
    public function test_validation_fails_when_previous_date_is_in_the_future(): void
    {
        $response = $this->post(route('oil.change.check'), [
            'current_odometer' => 10000,
            'previous_date' => '2026-01-01',
            'previous_odometer' => 5000,
        ]);

        $response->assertSessionHasErrors(['previous_date']);
    }

    /**
     * @return void
     */
    public function test_successful_submission_creates_record_and_redirects_to_result(): void
    {
        $data = [
            'current_odometer' => 8000,
            'previous_date' => Carbon::create('2025', '06', '01'),
            'previous_odometer' => 2000,
        ];

        $response = $this->post(route('oil.change.check'), $data);

        $this->assertDatabaseHas('oil_changes', $data);
        $oilChange = OilChange::latest()->first();

        $response->assertRedirect(route('oil.change.result', $oilChange));
    }

    /**
     * @return void
     */
    public function test_result_page_shows_correct_message_when_due(): void
    {
        $oilChange = OilChange::factory()->create([
            'current_odometer' => 10000,
            'previous_date' => Carbon::create('2025', '06', '01'),
            'previous_odometer' => 0,
        ]);

        $response = $this->get(route('oil.change.result', $oilChange));

        $response->assertStatus(200);
        $response->assertViewIs('result');
        $response->assertViewHas('isDue', true);
        $response->assertSee('Your car is due for an oil change!');
        $response->assertSee('10,000 km');
    }

    /**
     * @return void
     */
    public function test_result_page_shows_correct_message_when_not_due(): void
    {
        $oilChange = OilChange::factory()->create([
            'current_odometer' => 4000,
            'previous_date' => Carbon::create('2025', '09', '01'),
            'previous_odometer' => 1000,
        ]);

        $response = $this->get(route('oil.change.result', $oilChange->id));

        $response->assertStatus(200);
        $response->assertViewHas('isDue', false);
        $response->assertSee('Your car is not due for an oil change yet.');
    }

    /**
     * @return void
     */
    public function test_result_page_persists_after_refresh(): void
    {
        $oilChange = OilChange::factory()->create();

        $response = $this->get(route('oil.change.result', $oilChange->id));
        $response->assertStatus(200);

        $response = $this->get(route('oil.change.result', $oilChange->id));
        $response->assertStatus(200);
        $response->assertViewHas('oilChange', $oilChange);
    }

    /**
     * @return void
     */
    public function test_non_existent_result_returns_404(): void
    {
        $response = $this->get(route('oil.change.result',9999));

        $response->assertStatus(404);
    }
}
