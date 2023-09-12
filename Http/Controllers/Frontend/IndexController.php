<?php

namespace Modules\TopPilot\Http\Controllers\Frontend;

use App\Contracts\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pirep;
use App\Models\User;
use App\Models\Enums\PirepState;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller 
{
    public function index(Request $request, $interval = null)
    {
        //Dates and Pilot Location
        $Day = Carbon::now()->day;
        $DayName = Carbon::now()->dayName;
        $Week = Carbon::now()->weekNumberInMonth;
        $Month = Carbon::now()->englishMonth;
        $Year = Carbon::now()->year;
        $LastYear = Carbon::now()->subYear()->year;
        $curr_unit = setting('units.currency');
        //Best Flight Time Today, This Week, This Month, This Year, and Last Year
        $resultftDay = $this->getTopFlightTimes(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $resultftWeek = $this->getTopFlightTimes(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $resultftMonth = $this->getTopFlightTimes(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $resultftYear = $this->getTopFlightTimes(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $resultftLastYear = $this->getTopFlightTimes(Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear());
        //Best Distance Today, This Week, This Month, This Year, and Last Year
        $resultdDay = $this->getTopDistance(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $resultdWeek = $this->getTopDistance(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $resultdMonth = $this->getTopDistance(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $resultdYear = $this->getTopDistance(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $resultdLastYear = $this->getTopDistance(Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear());
        //Best Landing Rate Today, This Week, This Month, This Year, and Last Year
        $resultlrDay = $this->getTopLandingRate(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $resultlrWeek = $this->getTopLandingRate(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $resultlrMonth = $this->getTopLandingRate(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $resultlrYear = $this->getTopLandingRate(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $resultlrLastYear = $this->getTopLandingRate(Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear());
        //Best Revenue Today, This Week, This Month, This Year, and Last Year
        $resultbrDay = $this->getTopRevenue(Carbon::now()->startOfDay(), Carbon::now()->endOfDay());
        $resultbrWeek = $this->getTopRevenue(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());
        $resultbrMonth = $this->getTopRevenue(Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
        $resultbrYear = $this->getTopRevenue(Carbon::now()->startOfYear(), Carbon::now()->endOfYear());
        $resultbrLastYear = $this->getTopRevenue(Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear());


        return view('toppilot::index', compact(
                                                'Day',
                                                'DayName',
                                                'Week',
                                                'Month',
                                                'Year',
                                                'LastYear',
                                                'curr_unit',
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
                                                'resultlrDay',
                                                'resultlrWeek',
                                                'resultlrMonth',
                                                'resultlrYear',
                                                'resultlrLastYear', 
                                                'resultbrDay',
                                                'resultbrWeek',
                                                'resultbrMonth',
                                                'resultbrYear',
                                                'resultbrLastYear',                                                                          
                                                )
                                            );
    }

    public function getTopFlightTimes($start, $end, $count = 10)
    {
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take($count)->get();
            
            return $bytime;
        
    }

    public function getTopDistance($start, $end, $count = 10)
    {
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(distance) as totaldistance')
                ->orderBy('totaldistance', 'DESC')
                ->take($count)->get();
            
            return $bytime;
        
    }

    public function getTopLandingRate($start, $end, $count = 10)
    {
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, MAX(landing_rate) AS landing_rate')
                ->orderBy('landing_rate', 'DESC')
                ->take($count)->get();
            
            return $bytime;
    }

    public function getTopRevenue($start, $end, $count = 10)
    {
        $all_pireps = Pirep::with(['airline', 'user', 'transactions'])
            ->where('state', PirepState::ACCEPTED)
            ->whereBetween('pireps.submitted_at', [$start, $end])
            ->orderBy('pireps.submitted_at', 'desc')
            ->take($count)->get();

        // Create an array to store the final results
        $result = [];

        // Iterate through the records and calculate the balance for each user
        foreach ($all_pireps as $pirep) {
            $userId = $pirep->user_id;
            $credit = $pirep->transactions->sum('credit');
            $debit = $pirep->transactions->sum('debit');
            $balance = $credit - $debit;

            // If the user is not in the result array, add them; otherwise, accumulate the balance
            if (!isset($result[$userId])) {
                $result[$userId] = [
                    'user_id' => $userId,
                    'name' => $pirep->user->name_private,
                    'ident' => $pirep->user->ident,
                    'total_balance' => $balance,
                    'curr_airport_id' => $pirep->user->curr_airport_id,
                ];
            } else {
                $result[$userId]['total_balance'] += $balance;
            }
        }

        // Convert the result array to a numeric array of objects
        $finalResult = array_values($result);

        return $finalResult;
    }
}
