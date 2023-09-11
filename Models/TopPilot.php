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
                ->groupBy('user_id')->selectRaw('id, user_id, sum(distance) as totaldistance')
                ->orderBy('totaldistance', 'DESC')
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

    public function getTopLandingRateForDay()
    {
            $start = Carbon::now()->startOfDay();
            $end = Carbon::now()->endOfDay();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, MAX(landing_rate) AS landing_rate')
                ->orderBy('landing_rate', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopLandingRateForWeek()
    {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, MAX(landing_rate) AS landing_rate')
                ->orderBy('landing_rate', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopLandingRateForMonth()
    {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, MAX(landing_rate) AS landing_rate')
                ->orderBy('landing_rate', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopLandingRateForYear()
    {
            $start = Carbon::now()->startOfYear();
            $end = Carbon::now()->endOfYear();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, MAX(landing_rate) AS landing_rate')
                ->orderBy('landing_rate', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopLandingRateForLastYear()
    {
            $start = Carbon::now()->subYear()->startOfYear();
            $end = Carbon::now()->subYear()->endOfYear();
            $bytime = Pirep::with('user')
                ->where('state', PirepState::ACCEPTED)
                ->whereBetween('submitted_at', [$start, $end])
                ->groupBy('user_id')->selectRaw('id, user_id, MAX(landing_rate) AS landing_rate')
                ->orderBy('landing_rate', 'DESC')
                ->take(10)->get();
            
            return $bytime;
    }

    public function getTopBestRevenueForDay()
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();
        $all_pireps = Pirep::with(['transactions'])
        ->join('users', 'users.id', '=', 'pireps.user_id')
        ->leftJoin('airlines', 'airlines.id', '=', 'users.airline_id') // Join the 'Airlines' table
        ->whereBetween('pireps.submitted_at', [$start, $end])
        ->orderBy('pireps.submitted_at', 'desc')
        ->select(
            'pireps.*', 
            'users.name', 
            'users.id AS user_id',
            'users.curr_airport_id',
            'airlines.icao AS airline_code' // Select 'code' column from 'Airlines' table
        )
        ->get();

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
                    'name' => $pirep->name,
                    'total_balance' => $balance,
                    'airline_code' => $pirep->airline_code,
                    'curr_airport_id' => $pirep->user->curr_airport_id,
                    'user' => $pirep->toArray(),
                ];
            } else {
                $result[$userId]['total_balance'] += $balance;
            }
        }

        // Convert the result array to a numeric array of objects
        $finalResult = array_values($result);

        return $finalResult;
    }


    public function getTopBestRevenueForWeek()
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        $all_pireps = Pirep::with(['transactions'])
        ->join('users', 'users.id', '=', 'pireps.user_id')
        ->leftJoin('airlines', 'airlines.id', '=', 'users.airline_id') // Join the 'Airlines' table
        ->whereBetween('pireps.submitted_at', [$start, $end])
        ->orderBy('pireps.submitted_at', 'desc')
        ->select(
            'pireps.*', 
            'users.name', 
            'users.id AS user_id',
            'users.curr_airport_id',
            'airlines.icao AS airline_code' // Select 'code' column from 'Airlines' table
        )
        ->get();

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
                    'name' => $pirep->name,
                    'total_balance' => $balance,
                    'airline_code' => $pirep->airline_code,
                    'curr_airport_id' => $pirep->user->curr_airport_id,
                    'user' => $pirep->toArray(),
                ];
            } else {
                $result[$userId]['total_balance'] += $balance;
            }
        }

        // Convert the result array to a numeric array of objects
        $finalResult = array_values($result);

        return $finalResult;
    }

    public function getTopBestRevenueForMonth()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $all_pireps = Pirep::with(['transactions'])
        ->join('users', 'users.id', '=', 'pireps.user_id')
        ->leftJoin('airlines', 'airlines.id', '=', 'users.airline_id') // Join the 'Airlines' table
        ->whereBetween('pireps.submitted_at', [$start, $end])
        ->orderBy('pireps.submitted_at', 'desc')
        ->select(
            'pireps.*', 
            'users.name', 
            'users.id AS user_id',
            'users.curr_airport_id',
            'airlines.icao AS airline_code' // Select 'code' column from 'Airlines' table
        )
        ->get();

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
                    'name' => $pirep->name,
                    'total_balance' => $balance,
                    'airline_code' => $pirep->airline_code,
                    'curr_airport_id' => $pirep->user->curr_airport_id,
                    'user' => $pirep->toArray(),
                ];
            } else {
                $result[$userId]['total_balance'] += $balance;
            }
        }

        // Convert the result array to a numeric array of objects
        $finalResult = array_values($result);

        return $finalResult;
    }

    public function getTopBestRevenueForYear()
    {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
        $all_pireps = Pirep::with(['transactions'])
        ->join('users', 'users.id', '=', 'pireps.user_id')
        ->leftJoin('airlines', 'airlines.id', '=', 'users.airline_id') // Join the 'Airlines' table
        ->whereBetween('pireps.submitted_at', [$start, $end])
        ->orderBy('pireps.submitted_at', 'desc')
        ->select(
            'pireps.*', 
            'users.name', 
            'users.id AS user_id',
            'users.curr_airport_id',
            'airlines.icao AS airline_code' // Select 'code' column from 'Airlines' table
        )
        ->get();

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
                    'name' => $pirep->name,
                    'total_balance' => $balance,
                    'airline_code' => $pirep->airline_code,
                    'curr_airport_id' => $pirep->user->curr_airport_id,
                    'user' => $pirep->toArray(),
                ];
            } else {
                $result[$userId]['total_balance'] += $balance;
            }
        }

        // Convert the result array to a numeric array of objects
        $finalResult = array_values($result);

        return $finalResult;
    }

    public function getTopBestRevenueForLastYear()
    {
        $start = Carbon::now()->subYear()->startOfYear();
        $end = Carbon::now()->subYear()->endOfYear();
        $all_pireps = Pirep::with(['transactions'])
        ->join('users', 'users.id', '=', 'pireps.user_id')
        ->leftJoin('airlines', 'airlines.id', '=', 'users.airline_id') // Join the 'Airlines' table
        ->whereBetween('pireps.submitted_at', [$start, $end])
        ->orderBy('pireps.submitted_at', 'desc')
        ->select(
            'pireps.*', 
            'users.name', 
            'users.id AS user_id',
            'users.curr_airport_id',
            'airlines.icao AS airline_code' // Select 'code' column from 'Airlines' table
        )
        ->get();

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
                    'name' => $pirep->name,
                    'total_balance' => $balance,
                    'airline_code' => $pirep->airline_code,
                    'curr_airport_id' => $pirep->user->curr_airport_id,
                    'user' => $pirep->toArray(),
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

