<?php

namespace Modules\TopPilot\Http\Controllers\Frontend;

use App\Contracts\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pirep;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\TopPilot\Models\TopPilot;
/**
 * Class $CLASS$
 * @package 
 */
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request, $interval = null)
    {
        $Day = Carbon::now()->day;
        $DayName = Carbon::now()->dayName;
        $Week = Carbon::now()->weekNumberInMonth;
        $Month = Carbon::now()->englishMonth;
        $Year = Carbon::now()->year;
        $LastYear = Carbon::now()->subYear()->year;
        
        $topPilot = new TopPilot();
        $resultftDay = $topPilot->getTopFlightTimesForDay();
        $resultftWeek = $topPilot->getTopBestFlightTimeForWeek();
        $resultftMonth = $topPilot->getTopFlightTimesForMonth();
        $resultftYear = $topPilot->getTopFlightTimesForYear();
        $resultftLastYear = $topPilot->getTopFlightTimesForLastYear();
        

        $resultdDay = $topPilot->getTopDistanceForDay();
        $resultdWeek = $topPilot->getTopBestDistanceForWeek();
        $resultdMonth = $topPilot->getTopDsitanceForMonth();
        $resultdYear = $topPilot->getTopDistanceForYear();
        $resultdLastYear = $topPilot->getTopDistanceForLastYear();

        // $resultlrDay = $topPilot->getTopLandingRateForDay();
        // $resultlrWeek = $topPilot->getTopBestLandingRateForWeek();
        // $resultlrMonth = $topPilot->getTopLandingRateForMonth();
        // $resultlrYear = $topPilot->getTopLandingRateForYear();

        // $resultbrDay = $topPilot->getTopBestRevenueForDay();
        // $resultbrWeek = $topPilot->getTopBestRevenueForWeek();
        // $resultbrMonth = $topPilot->getTopBestRevenueForMonth();
        // $resultbrYear = $topPilot->getTopBestRevenueForYear();


        return view('toppilot::index', compact(
                                                'Day',
                                                'DayName',
                                                'Week',
                                                'Month',
                                                'Year',
                                                'LastYear',
                                                'resultftDay',
                                                'resultftWeek', 
                                                'resultftMonth', 
                                                'resultftYear',
                                                'resultftLastYear',                                                 
                                                'resultdDay',
                                                'resultdWeek', 
                                                'resultdMonth', 
                                                'resultdYear',
                                                'resultdLastYear',
                                                // 'resultlrDay',
                                                // 'resultlrWeek',
                                                // 'resultlrMonth',
                                                // 'resultlrYear', 
                                                // 'resultbrDay',
                                                // 'resultbrWeek',
                                                // 'resultbrMonth',
                                                // 'resultbrYear',                                                                          
                                                )
                                            );
    }

      /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('toppilot::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function show(Request $request)
    {
        return view('toppilot::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function edit(Request $request)
    {
        return view('toppilot::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
    }
}
