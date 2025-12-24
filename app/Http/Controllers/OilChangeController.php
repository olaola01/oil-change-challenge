<?php

namespace App\Http\Controllers;

use App\Http\Requests\OilChangeRequest;
use App\Models\OilChange;
use App\Services\OilChangeService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class OilChangeController extends Controller
{

    public function __construct(private readonly OilChangeService $oilChangeService){}

    /**
     * Shows the form
     *
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        return view('form');
    }

    /**
     * Validates the request data and creates a new oil change record.
     * Redirects to the result page of the created oil change record.
     *
     * @param OilChangeRequest $request The HTTP request instance containing input data.
     * @return Redirector|RedirectResponse
     */
    public function check(OilChangeRequest $request): Redirector|RedirectResponse
    {
        $validated = $request->validated();

        $oilChange = OilChange::create($validated);

        return redirect(route("oil.change.result", $oilChange->id));
    }

    /**
     * Handle the logic to determine if an oil change is due and return the appropriate view.
     *
     * @param int $id The instance representing the oil change details.
     * @return View The resulting view displaying the oil change information and status.
     */
    public function result(int $id): View
    {
        $oilChange = OilChange::findOrFail($id);
        $isDue = $this->oilChangeService->isDue($oilChange);

        return view('result', compact('oilChange', 'isDue'));
    }
}
