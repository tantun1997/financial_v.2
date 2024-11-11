<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FinancialReport extends Controller
{
    public function financial_report()
    {
        $Administration_total = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->sum('Total_Price');
        $Administration_true = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Total_Price');
        $Administration_true_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Currently_Price');
        $Administration_true_remaining = $Administration_true - $Administration_true_used;
        $Administration_spare          = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Total_Price');
        $Administration_spare_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านอำนวยการ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Currently_Price');
        $Administration_spare_remaining = $Administration_spare - $Administration_spare_used;

        $Nursing_total = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->sum('Total_Price');
        $Nursing_true = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Total_Price');
        $Nursing_true_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Currently_Price');
        $Nursing_true_remaining = $Nursing_true - $Nursing_true_used;
        $Nursing_spare          = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Total_Price');
        $Nursing_spare_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านการพยาบาล')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Currently_Price');
        $Nursing_spare_remaining = $Nursing_spare - $Nursing_spare_used;

        $Secondary_total = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->sum('Total_Price');
        $Secondary_true = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Total_Price');
        $Secondary_true_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Currently_Price');
        $Secondary_true_remaining = $Secondary_true - $Secondary_true_used;
        $Secondary_spare          = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Total_Price');
        $Secondary_spare_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Currently_Price');
        $Secondary_spare_remaining = $Secondary_spare - $Secondary_spare_used;

        $Primary_total = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->sum('Total_Price');
        $Primary_true = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Total_Price');
        $Primary_true_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Currently_Price');
        $Primary_true_remaining = $Primary_true - $Primary_true_used;
        $Primary_spare          = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Total_Price');
        $Primary_spare_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Currently_Price');
        $Primary_spare_remaining = $Primary_spare - $Primary_spare_used;

        $Supporting_total = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->sum('Total_Price');
        $Supporting_true = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Total_Price');
        $Supporting_true_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('USAGE_STATUS_ID', 1)
            ->sum('Currently_Price');
        $Supporting_true_remaining = $Supporting_true - $Supporting_true_used;
        $Supporting_spare          = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Total_Price');
        $Supporting_spare_used = DB::table('แผนครุภัณฑ์_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('USAGE_STATUS_ID', 2)
            ->sum('Currently_Price');
        $Supporting_spare_remaining = $Supporting_spare - $Supporting_spare_used;

        return view('report.financial_plan_report', compact(
            'Administration_total',
            'Administration_true',
            'Administration_true_used',
            'Administration_true_remaining',
            'Administration_spare',
            'Administration_spare_used',
            'Administration_spare_remaining',

            'Nursing_total',
            'Nursing_true',
            'Nursing_true_used',
            'Nursing_true_remaining',
            'Nursing_spare',
            'Nursing_spare_used',
            'Nursing_spare_remaining',

            'Secondary_total',
            'Secondary_true',
            'Secondary_true_used',
            'Secondary_true_remaining',
            'Secondary_spare',
            'Secondary_spare_used',
            'Secondary_spare_remaining',

            'Primary_total',
            'Primary_true',
            'Primary_true_used',
            'Primary_true_remaining',
            'Primary_spare',
            'Primary_spare_used',
            'Primary_spare_remaining',

            'Supporting_total',
            'Supporting_true',
            'Supporting_true_used',
            'Supporting_true_remaining',
            'Supporting_spare',
            'Supporting_spare_used',
            'Supporting_spare_remaining',

        ));
    }
    public function plan_report($name_report)
    {
        switch ($name_report) {
            case 'administration_report':
                $name_group = 'ด้านอำนวยการ';
                break;
            case 'nursing_report':
                $name_group = 'ด้านการพยาบาล';
                break;
            case 'secondary_report':
                $name_group = 'ด้านบริการทุติยภูมิและตติยภูมิ';
                break;
            case 'primary_report':
                $name_group = 'ด้านบริการปฐมภูมิ';
                break;
            case 'supporting_report':
                $name_group = 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ';
                break;
        }

        $plan_true = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
            ->where('WK_Group', $name_group)
            ->where('USAGE_STATUS_ID', 1)
            ->orderBy('deptId', 'asc')
            ->get();

        $plan_spare = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
            ->where('WK_Group', $name_group)
            ->where('USAGE_STATUS_ID', 2)
            ->orderBy('deptId', 'asc')
            ->get();

        return view('report.plan_report', compact(
            'plan_true',
            'plan_spare',
            'name_group'
        ));

    }

    public function financial_store_report()
    {
        $Administration30 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('TYPE_ID', '30')
            ->sum('Total_Price');
        $Nursing30 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('TYPE_ID', '30')
            ->sum('Total_Price');

        $Secondary30 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('TYPE_ID', '30')
            ->sum('Total_Price');

        $Primary30 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('TYPE_ID', '30')
            ->sum('Total_Price');

        $Supporting30 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('TYPE_ID', '30')
            ->sum('Total_Price');

        $Administration31 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านอำนวยการ')
            ->where('TYPE_ID', '31')
            ->sum('Total_Price');

        $Nursing31 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านการพยาบาล')
            ->where('TYPE_ID', '31')
            ->sum('Total_Price');

        $Secondary31 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านบริการทุติยภูมิและตติยภูมิ')
            ->where('TYPE_ID', '31')
            ->sum('Total_Price');

        $Primary31 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านบริการปฐมภูมิ')
            ->where('TYPE_ID', '31')
            ->sum('Total_Price');

        $Supporting31 = DB::table('แผนวัสดุ_วงเงินแต่ละกลุ่มภารกิจ_ใหม่')
            ->where('WK_Group', 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ')
            ->where('TYPE_ID', '31')
            ->sum('Total_Price');

        return view('report.financial_store_report', compact(
            'Administration30',
            'Nursing30',
            'Secondary30',
            'Primary30',
            'Supporting30',
            'Administration31',
            'Nursing31',
            'Secondary31',
            'Primary31',
            'Supporting31',
        ));
    }
    public function store_report($name_report)
    {
        switch ($name_report) {
            case 'administration_report':
                $name_group = 'ด้านอำนวยการ';
                break;
            case 'nursing_report':
                $name_group = 'ด้านการพยาบาล';
                break;
            case 'secondary_report':
                $name_group = 'ด้านบริการทุติยภูมิและตติยภูมิ';
                break;
            case 'primary_report':
                $name_group = 'ด้านบริการปฐมภูมิ';
                break;
            case 'supporting_report':
                $name_group = 'ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ';
                break;
        }

        $store_items = DB::table('แผนวัสดุ_วงเงินแต่ละแผนก_ใหม่')
            ->where('WK_Group', $name_group)
            ->get();

        return view('report.strore_report', compact(
            'store_items',
            'name_group'
        ));

    }
}
