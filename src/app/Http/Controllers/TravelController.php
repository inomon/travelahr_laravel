<?php

namespace App\Http\Controllers;

use App\Services\TravelService;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * @var TravelService
     */
    protected $travelService;

    /**
     * AuthenticateController constructor.
     *
     * @param TravelService $travelService
     */
    public function __construct(
        TravelService $travelService
    ) {
        $this->travelService = $travelService;
    }
    /**
     * Home page
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        $data = $this->travelService->searchVenues(false, 20, false, true, 'Home');

        return view('home', $data);
    }

    /**
     * Venue listing page
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function go(Request $request)
    {
        $data = $this->travelService->searchVenues(true, 30, true, false);

        return view('travel', $data);
    }
}
