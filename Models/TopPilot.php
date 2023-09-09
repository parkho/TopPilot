<?php
namespace Modules\TopPilot\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Pirep;
use App\Models\User;
use App\Models\Enums\PirepState;
use Illuminate\Support\Facades\DB;
class TopPilot extends Model
{
    public function pireps()
    {
        return $this->hasMany(Pirep::class, 'pilot_id');
    }

    public function getTopFlightTimesForDay()
    {
            $start = Carbon::now()->startOfDay();
            $end = Carbon::now()->endOfDay();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take(10)->get();
            
            return $bytime;
        
    }

    public function getTopBestFlightTimeForWeek()
        {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take(10)->get();
            
            return $bytime;
        }

        public function getTopFlightTimesForMonth()
        {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take(10)->get();
            
            return $bytime;
        }

        public function getTopFlightTimesForYear()
        {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take(10)->get();
            
            return $bytime;
        }

        public function getTopFlightTimesForLastYear()
        {
            
            $start = Carbon::now()->subYear()->startOfYear();
            $end = Carbon::now()->subYear()->endOfYear();            
            
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take(10)->get();
            
            return $bytime;
        }

    public function getTopDistanceForDay()
    {
            $start = Carbon::now()->startOfDay();
            $end = Carbon::now()->endOfDay();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(distance) as totaldistance')
                ->orderBy('totaldistance', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopBestDistanceForWeek()
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        $bytime = Pirep::with('user')
            ->where('state', PirepState::ACCEPTED)
            ->whereBetween('submitted_at', [$start, $end])
            ->groupBy('user_id')->selectRaw('id, user_id, sum(distance) as totaldistance')
            ->orderBy('totaldistance', 'DESC')
            ->take(10)->get();
        
        return $bytime;
    }

    public function getTopDsitanceForMonth()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $bytime = Pirep::with('user')
            ->where('state', PirepState::ACCEPTED)
            ->whereBetween('submitted_at', [$start, $end])
            ->groupBy('user_id')->selectRaw('id, user_id, sum(distance) as totaldistance')
            ->orderBy('totaldistance', 'DESC')
            ->take(10)->get();
        
        return $bytime;
    }

    public function getTopDistanceForYear()
    {
        $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(flight_time) as totaltime')
                ->orderBy('totaltime', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopDistanceForLastYear()
        {
            
            $start = Carbon::now()->subYear()->startOfYear();
            $end = Carbon::now()->subYear()->endOfYear();            
            
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, sum(distance) as totaldistance')
                ->orderBy('totaldistance', 'DESC')
                ->take(10)->get();
            
            return $bytime;
        }

    // public function getTopLandingRateForDay($day)
    // {
    //     $query = $this->selectRaw('users.id AS user_id, users.name AS user_name, MIN(pireps.landing_rate) AS landing_rate')
    //     ->join('pireps', 'users.pilot_id', '=', 'pireps.user_id')
    //     ->where('pireps.state', PirepState::ACCEPTED)
    //     ->whereRaw("DAY(pireps.submitted_at) = ?", [$day]) // Compare day portion
    //     ->groupBy('users.id', 'users.name')
    //     ->orderByDesc('landing_rate');

    //     $results = $query->limit(10)->get();

    //     return $results;
    // }

    // public function getTopLandingRateForMonth($month)
    // {
    //     $query = $this->selectRaw('users.id AS user_id, users.name AS user_name, MIN(pireps.landing_rate) AS landing_rate')
    //     ->join('pireps', 'users.pilot_id', '=', 'pireps.user_id')
    //     ->where('pireps.state', PirepState::ACCEPTED)
    //     ->whereRaw("MONTH(pireps.submitted_at) = ?", [$month]) // Compare day portion
    //     ->groupBy('users.id', 'users.name')
    //     ->orderByDesc('landing_rate');

    //     $results = $query->limit(10)->get();

    //     return $results;
    // }

    // public function getTopLandingRateForYear($year)
    // {
    //     $query = $this->selectRaw('users.id AS user_id, users.name AS user_name, pireps.landing_rate AS landing_rate')
    //     ->join('pireps', 'users.pilot_id', '=', 'pireps.user_id')
    //     ->where('pireps.state', PirepState::ACCEPTED)
    //     ->whereRaw("YEAR(pireps.submitted_at) = ?", [$year]) // Compare day portion
    //     ->groupBy('users.id', 'users.name')
    //     ->orderByDesc('landing_rate');

    //     $results = $query->limit(10)->get();

    //     return $results;
    // }

    // public function getTopBestRevenueForDay($day)
    // {
    //     $all_pireps = Pirep::with(['transactions'])
    //         ->join('users', 'users.id', '=', 'pireps.user_id')
    //         ->whereRaw("DAY(pireps.submitted_at) = ?", [$day]) // Filter by the specific day
    //         ->orderBy('pireps.submitted_at', 'desc')
    //         ->select('pireps.*', 'users.name', 'users.id AS user_id') // Select the necessary columns
    //         ->get();

    //     // Create an array to store the final results
    //     $result = [];

    //     // Iterate through the records and calculate the balance for each user
    //     foreach ($all_pireps as $pirep) {
    //         $userId = $pirep->user_id;
    //         $credit = $pirep->transactions->sum('credit');
    //         $debit = $pirep->transactions->sum('debit');
    //         $balance = $credit - $debit;

    //         // If the user is not in the result array, add them; otherwise, accumulate the balance
    //         if (!isset($result[$userId])) {
    //             $result[$userId] = [
    //                 'user_id' => $userId,
    //                 'name' => $pirep->name,
    //                 'total_balance' => $balance,
    //             ];
    //         } else {
    //             $result[$userId]['total_balance'] += $balance;
    //         }
    //     }

    //     // Convert the result array to a numeric array of objects
    //     $finalResult = array_values($result);

    //     return $finalResult;
    // }


    // public function getTopBestRevenueForMonth($month)
    // {
    //     $all_pireps = Pirep::with(['transactions'])
    //         ->join('users', 'users.id', '=', 'pireps.user_id')
    //         ->whereRaw("MONTH(pireps.submitted_at) = ?", [$month]) // Filter by the specific day
    //         ->orderBy('pireps.submitted_at', 'desc')
    //         ->select('pireps.*', 'users.name', 'users.id AS user_id') // Select the necessary columns
    //         ->get();

    //     // Create an array to store the final results
    //     $result = [];

    //     // Iterate through the records and calculate the balance for each user
    //     foreach ($all_pireps as $pirep) {
    //         $userId = $pirep->user_id;
    //         $credit = $pirep->transactions->sum('credit');
    //         $debit = $pirep->transactions->sum('debit');
    //         $balance = $credit - $debit;

    //         // If the user is not in the result array, add them; otherwise, accumulate the balance
    //         if (!isset($result[$userId])) {
    //             $result[$userId] = [
    //                 'user_id' => $userId,
    //                 'name' => $pirep->name,
    //                 'total_balance' => $balance,
    //             ];
    //         } else {
    //             $result[$userId]['total_balance'] += $balance;
    //         }
    //     }

    //     // Convert the result array to a numeric array of objects
    //     $finalResult = array_values($result);

    //     return $finalResult;
    // }

    // public function getTopBestRevenueForYear($year)
    // {
    //     $all_pireps = Pirep::with(['transactions'])
    //         ->join('users', 'users.id', '=', 'pireps.user_id')
    //         ->whereRaw("YEAR(pireps.submitted_at) = ?", [$year]) // Filter by the specific day
    //         ->orderBy('pireps.submitted_at', 'desc')
    //         ->select('pireps.*', 'users.name', 'users.id AS user_id') // Select the necessary columns
    //         ->get();

    //     // Create an array to store the final results
    //     $result = [];

    //     // Iterate through the records and calculate the balance for each user
    //     foreach ($all_pireps as $pirep) {
    //         $userId = $pirep->user_id;
    //         $credit = $pirep->transactions->sum('credit');
    //         $debit = $pirep->transactions->sum('debit');
    //         $balance = $credit - $debit;

    //         // If the user is not in the result array, add them; otherwise, accumulate the balance
    //         if (!isset($result[$userId])) {
    //             $result[$userId] = [
    //                 'user_id' => $userId,
    //                 'name' => $pirep->name,
    //                 'total_balance' => $balance,
    //             ];
    //         } else {
    //             $result[$userId]['total_balance'] += $balance;
    //         }
    //     }

    //     // Convert the result array to a numeric array of objects
    //     $finalResult = array_values($result);

    //     return $finalResult;
    // }
    
    
    
}

