<?php

namespace Modules\TopPilot\Http\Controllers\Frontend;

use App\Contracts\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pirep;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\TopPilot\Models\TopPilot;

class IndexController extends Controller
{
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
}
