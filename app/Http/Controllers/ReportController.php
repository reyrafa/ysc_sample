<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branch_under;
use App\Models\Depositor;
use App\Models\OfficialMember;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReportController extends Controller
{
    public function adminIndex(){
        $transaction = Transaction::all();
        $depositor = Depositor::all();
        $branch = Branch::all();
        $branch_under = Branch_under::all();
        $official_member = OfficialMember::all();

        //counters
        $counter_day = 0;
        $counter_week = 0;
        $counter_month =0;
        $counter_year = 0;
        $counter_alltime =0;

        foreach($official_member as $official_info){
            if($official_info->isAlumni == '1'){
                if ($official_info->created_at->toDateString() == Carbon::now()->toDateString()){
                    ++$counter_day;
              }
              if ($official_info->created_at->endOfWeek() == Carbon::now()->endOfWeek()){
                ++$counter_week;
                }
              if ($official_info->created_at->format('F') == Carbon::now()->format('F')){
                  ++$counter_month;
                  }
              if ($official_info->created_at->format('Y') == Carbon::now()->format('Y')){
                  ++$counter_year;
                  }
              ++$counter_alltime;

            }
        }
        $chart_options = [
            'chart_title' => 'Registered but is not yet approved',
            'chart_type'            => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Transaction',
            'group_by_field' => 'created_at',
            'group_by_period'       => 'day',
            'filter_field'          => 'created_at',
            'filter_days'           => '15',
            'date_format' => 'F j, Y',
            'conditions'            => [
                ['condition'=>'level_id != "3"','color' => 'blue', 'fill' => true],
                    ],
            'entries_number'        => '5',

            'continuous_time'       => true,
           
            'chart_color'=> '0,255,255',
            'show_blank_data' => true,
            
        ];
        $chart = new LaravelChart($chart_options);
        
      

        return \view('officer.admin.report.index', compact('counter_day','counter_week', 'counter_month', 'counter_year', 'counter_alltime', 'chart', 'transaction', 
        'depositor', 'branch', 'branch_under', 'official_member'));
    }



    public function alumni(Request $req){
        $data = OfficialMember::find($req->id);
        $data->isAlumni = '2';
        $data->save();
        return \redirect('/admin/user/report');
    }
}
