<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use App\Models\ProcurementMechanism;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->data(NULL);
    }

    public function indexWithYear($year)
    {
        return $this->data($year);
    }

    public function data($year)
    {
        $year = ($year == NULL) ? date('Y') : $year;

        $procs = Procurement::MyProcurement()->latest()->take(5)->get();
        $procs_total = Procurement::MyProcurement()->get();
        $procs_total = $procs_total->sortByDesc(function($proc){
            return $proc->total;
        });
        $procs_total = $procs_total->toArray();
        $procs_total = array_slice($procs_total, 0, 5, true);

        $menunggu_persetujuan = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', 1)->get();
        $sedang_berjalan = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', '<>', 0)->where('status', '<>', 1)->where('status', '<>', 10)->get();
        $selesai = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', 10)->get();
        $batal = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', 100)->get();

        $menunggu_persetujuan_yearly_data = $this->makeYearlyData($menunggu_persetujuan);
        $sedang_berjalan_yearly_data = $this->makeYearlyData($sedang_berjalan);
        $selesai_yearly_data = $this->makeYearlyData($selesai);
        $batal_yearly_data = $this->makeYearlyData($batal);

        $menunggu_persetujuan_weekly_data = $this->makeWeeklyData($menunggu_persetujuan);
        $sedang_berjalan_weekly_data = $this->makeWeeklyData($sedang_berjalan);
        $selesai_weekly_data = $this->makeWeeklyData($selesai);
        $batal_weekly_data = $this->makeWeeklyData($batal);

        $mechanisms = ProcurementMechanism::all();

        $month = date('m');
        $mechanisms_choosen = 0;

        $menunggu_persetujuan_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 1)->get();
        $sedang_berjalan_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', '<>', 0)->where('status', '<>', 1)->where('status', '<>', 10)->get();
        $selesai_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 10)->get();
        $batal_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 100)->get();

        $menunggu_persetujuan_pie_count = $menunggu_persetujuan_pie->count();
        $sedang_berjalan_pie_count = $sedang_berjalan_pie->count();
        $selesai_pie_count = $selesai_pie->count();
        $batal_pie_count = $batal_pie->count();

        $menunggu_persetujuan_pie_sum = 0;
        foreach($menunggu_persetujuan_pie as $row){
            $menunggu_persetujuan_pie_sum += $row->items->sum('price_total');
        }

        $sedang_berjalan_pie_sum = 0;
        foreach($sedang_berjalan_pie as $row){
            $sedang_berjalan_pie_sum += $row->items->sum('price_total');
        }

        $selesai_pie_sum = 0;
        foreach($selesai_pie as $row){
            $selesai_pie_sum += $row->items->sum('price_total');
        }

        $batal_pie_sum = 0;
        foreach($batal_pie as $row){
            $batal_pie_sum += $row->items->sum('price_total');
        }

        $pie_label = ["Diajukan", "Sedang Proses", "Selesai", "Dibatalkan"];
        $pie_count = [$menunggu_persetujuan_pie_count, $sedang_berjalan_pie_count, $selesai_pie_count, $batal_pie_count];
        $pie_sum = [$menunggu_persetujuan_pie_sum, $sedang_berjalan_pie_sum, $selesai_pie_sum, $batal_pie_sum];

        
        return view('module.dashboard.index', compact('procs', 'procs_total', 'month', 'mechanisms_choosen', 'pie_label', 'pie_count', 'pie_sum', 'mechanisms', 'menunggu_persetujuan_yearly_data', 'sedang_berjalan_yearly_data', 'selesai_yearly_data', 'batal_yearly_data', 
        'menunggu_persetujuan_weekly_data', 'sedang_berjalan_weekly_data', 'selesai_weekly_data', 'batal_weekly_data', 'year'));
    }

    private function makeYearlyData($proc) {
        $now = Carbon::now();

        $grouped = $proc->map(function ($item)  {
            return collect([
                'date_status' => Carbon::parse($item->date_status)->format('M')
            ]);
        })->groupBy('date_status')->map->count();
        

        return collect(range(1, 12))->mapWithKeys(function ($i) use ($now, $grouped) {
            $date = $now->copy()->startOfMonth()->months($i)->format('M');
            return [$date => $grouped->get($date, 0)];
        });
    }

    private function makeWeeklyData($proc) {
        $now = Carbon::now();

        $grouped = $proc->map(function ($item) use($now)  {
            return collect([
                'date_status' => Carbon::parse($item->date_status)->format('W')
            ]);
        })->groupBy('date_status')->map->count();
        
        $week_now = $now->format('W');
        $week_last = $week_now - 3;

        return collect(range($week_last, $week_now))->mapWithKeys(function ($i) use ($grouped) {
            $date = $i;
            return [$date => $grouped->get($date, 0)];
        });
    }

    public function month(Request $request)
    {
        $year = (!isset($request->year)) ? date('Y') : $request->year;

        $procs = Procurement::MyProcurement()->latest()->take(5)->get();
        $procs_total = Procurement::MyProcurement()->get();
        $procs_total = $procs_total->sortByDesc(function($proc){
            return $proc->total;
        });
        $procs_total = $procs_total->toArray();
        $procs_total = array_slice($procs_total, 0, 5, true);

        $menunggu_persetujuan = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', 1)->get();
        $sedang_berjalan = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', '<>', 0)->where('status', '<>', 1)->where('status', '<>', 10)->get();
        $selesai = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', 10)->get();
        $batal = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-%')->where('status', 100)->get();

        $menunggu_persetujuan_yearly_data = $this->makeYearlyData($menunggu_persetujuan);
        $sedang_berjalan_yearly_data = $this->makeYearlyData($sedang_berjalan);
        $selesai_yearly_data = $this->makeYearlyData($selesai);
        $batal_yearly_data = $this->makeYearlyData($batal);

        $menunggu_persetujuan_weekly_data = $this->makeWeeklyData($menunggu_persetujuan);
        $sedang_berjalan_weekly_data = $this->makeWeeklyData($sedang_berjalan);
        $selesai_weekly_data = $this->makeWeeklyData($selesai);
        $batal_weekly_data = $this->makeWeeklyData($batal);

        $mechanisms = ProcurementMechanism::all();

        $month = $request->month;
        $mechanisms_choosen = $request->mechanism_id;

        if(strlen($month)==1){
            $month = '0'.$month;
        }

        if($mechanisms_choosen==0){

            $menunggu_persetujuan_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 1)->get();
            $sedang_berjalan_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', '<>', 0)->where('status', '<>', 1)->where('status', '<>', 10)->get();
            $selesai_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 10)->get();
            $batal_pie = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 100)->get();

            $menunggu_persetujuan_pie_count = $menunggu_persetujuan_pie->count();
            $sedang_berjalan_pie_count = $sedang_berjalan_pie->count();
            $selesai_pie_count = $selesai_pie->count();
            $batal_pie_count = $batal_pie->count();

            $menunggu_persetujuan_pie_sum = 0;
            foreach($menunggu_persetujuan_pie as $row){
                $menunggu_persetujuan_pie_sum += $row->items->sum('price_total');
            }

            $sedang_berjalan_pie_sum = 0;
            foreach($sedang_berjalan_pie as $row){
                $sedang_berjalan_pie_sum += $row->items->sum('price_total');
            }

            $selesai_pie_sum = 0;
            foreach($selesai_pie as $row){
                $selesai_pie_sum += $row->items->sum('price_total');
            }

            $batal_pie_sum = 0;
            foreach($batal_pie as $row){
                $batal_pie_sum += $row->items->sum('price_total');
            }

            $pie_label = ["Diajukan", "Sedang Proses", "Selesai", "Dibatalkan"];
            $pie_count = [$menunggu_persetujuan_pie_count, $sedang_berjalan_pie_count, $selesai_pie_count, $batal_pie_count];
            $pie_sum = [$menunggu_persetujuan_pie_sum, $sedang_berjalan_pie_sum, $selesai_pie_sum, $batal_pie_sum];
        
        } else if($mechanisms_choosen==1 || $mechanisms_choosen==3 || $mechanisms_choosen==4 || $mechanisms_choosen==6){

            $proc[1] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 1)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[2] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 2)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[3] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 3)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[4] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 4)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[5] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 5)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[6] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 6)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[7] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 7)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[8] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 8)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[9] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 9)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[10] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 10)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[11] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 100)->where('mechanism_id', $mechanisms_choosen)->get();
            

            $proc_count[1] = $proc[1]->count();
            $proc_count[2] = $proc[2]->count();
            $proc_count[3] = $proc[3]->count();
            $proc_count[4] = $proc[4]->count();
            $proc_count[5] = $proc[5]->count();
            $proc_count[6] = $proc[6]->count();
            $proc_count[7] = $proc[7]->count();
            $proc_count[8] = $proc[8]->count();
            $proc_count[9] = $proc[9]->count();
            $proc_count[10] = $proc[10]->count();
            $proc_count[11] = $proc[11]->count();

            $proc_sum[1] = 0;
            foreach($proc[1] as $row){
                $proc_sum[1] += $row->items->sum('price_total');
            }
            $proc_sum[2] = 0;
            foreach($proc[2] as $row){
                $proc_sum[2] += $row->items->sum('price_total');
            }
            $proc_sum[3] = 0;
            foreach($proc[3] as $row){
                $proc_sum[3] += $row->items->sum('price_total');
            }
            $proc_sum[4] = 0;
            foreach($proc[4] as $row){
                $proc_sum[4] += $row->items->sum('price_total');
            }
            $proc_sum[5] = 0;
            foreach($proc[5] as $row){
                $proc_sum[5] += $row->items->sum('price_total');
            }
            $proc_sum[6] = 0;
            foreach($proc[6] as $row){
                $proc_sum[6] += $row->items->sum('price_total');
            }
            $proc_sum[7] = 0;
            foreach($proc[7] as $row){
                $proc_sum[7] += $row->items->sum('price_total');
            }
            $proc_sum[8] = 0;
            foreach($proc[8] as $row){
                $proc_sum[8] += $row->items->sum('price_total');
            }
            $proc_sum[9] = 0;
            foreach($proc[9] as $row){
                $proc_sum[9] += $row->items->sum('price_total');
            }
            $proc_sum[10] = 0;
            foreach($proc[10] as $row){
                $proc_sum[10] += $row->items->sum('price_total');
            }
            $proc_sum[11] = 0;
            foreach($proc[11] as $row){
                $proc_sum[11] += $row->items->sum('price_total');
            }

            $pie_label = ["Approval Pengajuan", "SPPH", "Tender Evaluasi", "BA Negosiasi dan Klarifikasi", "BAPP", "PO", "BAST", "Penilaian Vendor", "Input SP3", "Selesai", "Dibatalkan"];
            $pie_count = [$proc_count[1], $proc_count[2], $proc_count[3], $proc_count[4], $proc_count[5], $proc_count[6], $proc_count[7], $proc_count[8], $proc_count[9], $proc_count[10], $proc_count[11]];
            $pie_sum =  [$proc_sum[1], $proc_sum[2], $proc_sum[3], $proc_sum[4], $proc_sum[5], $proc_sum[6], $proc_sum[7], $proc_sum[8], $proc_sum[9], $proc_sum[10], $proc_sum[11]];

        } else {

            $proc[1] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 1)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[2] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 2)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[3] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 3)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[4] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 4)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[5] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 5)->where('mechanism_id', $mechanisms_choosen)->get();
            $proc[6] = Procurement::MyProcurement()->where('date_status', 'LIKE', '%'.$year.'-'.$month.'-%')->where('status', 100)->where('mechanism_id', $mechanisms_choosen)->get();

            $proc_count[1] = $proc[1]->count();
            $proc_count[2] = $proc[2]->count();
            $proc_count[3] = $proc[3]->count();
            $proc_count[4] = $proc[4]->count();
            $proc_count[5] = $proc[5]->count();
            $proc_count[6] = $proc[6]->count();

            $proc_sum[1] = 0;
            foreach($proc[1] as $row){
                $proc_sum[1] += $row->items->sum('price_total');
            }
            $proc_sum[2] = 0;
            foreach($proc[2] as $row){
                $proc_sum[2] += $row->items->sum('price_total');
            }
            $proc_sum[3] = 0;
            foreach($proc[3] as $row){
                $proc_sum[3] += $row->items->sum('price_total');
            }
            $proc_sum[4] = 0;
            foreach($proc[4] as $row){
                $proc_sum[4] += $row->items->sum('price_total');
            }
            $proc_sum[5] = 0;
            foreach($proc[5] as $row){
                $proc_sum[5] += $row->items->sum('price_total');
            }
            $proc_sum[6] = 0;
            foreach($proc[6] as $row){
                $proc_sum[6] += $row->items->sum('price_total');
            }

            $pie_label = ["Approval Pengajuan", "SP3", "BAST", "PJ UMK", "Selesai", "Dibatalkan"];
            $pie_count = [$proc_count[1], $proc_count[2], $proc_count[3], $proc_count[4], $proc_count[5], $proc_count[6]];
            $pie_sum =  [$proc_sum[1], $proc_sum[2], $proc_sum[3], $proc_sum[4], $proc_sum[5], $proc_sum[6]];

        }

        return view('module.dashboard.index', compact('procs','procs_total', 'month', 'mechanisms_choosen', 'pie_label', 'pie_count', 'pie_sum', 'mechanisms', 'menunggu_persetujuan_yearly_data', 'sedang_berjalan_yearly_data', 'selesai_yearly_data', 'batal_yearly_data', 
        'menunggu_persetujuan_weekly_data', 'sedang_berjalan_weekly_data', 'selesai_weekly_data', 'batal_weekly_data', 'year'));
    }
}
