<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\history;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HistoryChart extends Component
{


    public $count_std, $count_teacher, $count_guest;

    public function render()
    {

        //         $date_distinct = history::select('created_at')->distinct()->get()->groupBy( );
        // dd($date_distinct);
        //         // มา loop เอาวันที่ distinct มา where
        //         $data = [];

        //         foreach($date_distinct as $distinct){
        //             $data['prices'][] = history::whereDate('created_at', $distinct->created_at)->count();
        //             $data['dates'][] = date('d M Y' , strtotime($distinct->created_at));
        //         }

        //         dd(json_encode($data['prices'], JSON_NUMERIC_CHECK));


        //         return view('livewire.admin.index.chart', [
        //             'prices' =>  json_encode($data['prices'], JSON_NUMERIC_CHECK),
        //             'dates' =>  json_encode($data['dates'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK),
        //         ]);


        $month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $datasetstudent = [];

        foreach ($month as $key => $value) {
            $datasetstudent[] = history::whereHas('guest', function (Builder $query) {
                $query->where('guest_type_id', 3);
            })->where(DB::raw("DATE_FORMAT(created_at, '%m')"), $value)->count();
        }

        $datasetteacher = [];

        foreach ($month as $key => $value) {
            $datasetteacher[] = history::whereHas('guest', function (Builder $query) {
                $query->where('guest_type_id', 2);
            })->where(DB::raw("DATE_FORMAT(created_at, '%m')"), $value)->count();
        }

        $datasetguest = [];

        foreach ($month as $key => $value) {
            $datasetguest[] = history::whereHas('guest', function (Builder $query) {
                $query->where('guest_type_id', 1);
            })->where(DB::raw("DATE_FORMAT(created_at, '%m')"), $value)->count();
        }

        $this->count_guest = history::whereHas('guest', function ($query) {
            return $query->where('guest_type_id', 1);
        })->count();
        $this->count_teacher = history::whereHas('guest', function ($query) {
            return $query->where('guest_type_id', 2);
        })->count();
        $this->count_std = history::whereHas('guest', function ($query) {
            return $query->where('guest_type_id', 3);
        })->count();


        return view('livewire.dashboard.history-chart', [

            'student' => json_encode($datasetstudent, JSON_NUMERIC_CHECK),
            'teacher' =>  json_encode($datasetteacher, JSON_NUMERIC_CHECK),
            'guest' =>  json_encode($datasetguest, JSON_NUMERIC_CHECK),
            'date' =>  json_encode($month, JSON_NUMERIC_CHECK),


        ]);
    }
}
