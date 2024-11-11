<?php

namespace App\Http\Controllers;

use App\Exports\approveditemsplansExport;
use App\Exports\approveditemsstoresExport;
use App\Exports\calibrationsExport;
use App\Exports\contractservicesExport;
use App\Exports\insidewarehousesExport;
use App\Exports\insidewarehousesExport_items;
use App\Exports\maintenancesExport;
use App\Exports\nopassedapproveditemsplansExport;
use App\Exports\noserialsExport;
use App\Exports\outsidewarehousesExport;
use App\Exports\outsidewarehousesExport_items;
use App\Exports\passedapproveditemsplansExport;
use App\Exports\potentialsExport;
use App\Exports\repairsExport;
use App\Exports\replacementsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export($type, Request $request)
    {
        $PLAN_SET_YEAR   = $request->query('PLAN_SET_YEAR');
        $TCHN_LOCAT_NAME = $request->query('TCHN_LOCAT_NAME');

        if ($type == 'maintenances') {
            return $this->maintenancesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'repairs') {
            return $this->repairsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'contractservices') {
            return $this->contractservicesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'calibrations') {
            return $this->calibrationsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'potentials') {
            return $this->potentialsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'replacements') {
            return $this->replacementsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'noserials') {
            return $this->noserialsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'outsidewarehouses') {
            return $this->outsidewarehousesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'outsidewarehouses_items') {
            return $this->outsidewarehousesExport_items($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'insidewarehouses') {
            return $this->insidewarehousesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'insidewarehouses_items') {
            return $this->insidewarehousesExport_items($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'approved_items_plans') {
            return $this->approveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'passed_approved_items') {
            return $this->passedapproveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'no_passed_approved_items') {
            return $this->nopassedapproveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } elseif ($type == 'approved_items_stores') {
            return $this->approveditemsstoresExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME);
        } else {
            abort(404, 'Export type not found');
        }
    }
    public function maintenancesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนบำรุงรักษา_' . $timestamp . '.xlsx';

        return Excel::download(new maintenancesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }

    public function repairsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนซ่อม_' . $timestamp . '.xlsx';

        return Excel::download(new repairsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function contractservicesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนจ้างเหมาบริการ_' . $timestamp . '.xlsx';

        return Excel::download(new contractservicesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function calibrationsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนสอบเทียบเครื่องมือ_' . $timestamp . '.xlsx';

        return Excel::download(new calibrationsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function replacementsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนทดแทน_' . $timestamp . '.xlsx';

        return Excel::download(new replacementsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function potentialsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนเพิ่มศักยภาพ_' . $timestamp . '.xlsx';

        return Excel::download(new potentialsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function noserialsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนม่มีเลขครุภัณฑ์_' . $timestamp . '.xlsx';

        return Excel::download(new noserialsExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function outsidewarehousesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนวัสดุนอกคลัง_' . $timestamp . '.xlsx';

        return Excel::download(new outsidewarehousesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function outsidewarehousesExport_items($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการวัสดุนอกคลังแต่ละหมวด_' . $timestamp . '.xlsx';

        return Excel::download(new outsidewarehousesExport_items($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function insidewarehousesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนวัสดุในคลัง_' . $timestamp . '.xlsx';

        return Excel::download(new insidewarehousesExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function insidewarehousesExport_items($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการวัสดุในคลังแต่ละหมวด_' . $timestamp . '.xlsx';

        return Excel::download(new insidewarehousesExport_items($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function approveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนการขออนุมัติ_' . $timestamp . '.xlsx';

        return Excel::download(new approveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function passedapproveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนผ่านอนุมัติ_' . $timestamp . '.xlsx';

        return Excel::download(new passedapproveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function nopassedapproveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนไม่ผ่านอนุมัติ_' . $timestamp . '.xlsx';

        return Excel::download(new nopassedapproveditemsplansExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
    public function approveditemsstoresExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $timestamp = date('Y-m-d_His'); // รูปแบบวันที่เวลา เช่น 2023-10-25_135500
        $fileName  = 'รายการแผนวัสดุการขออนุมัติ_' . $timestamp . '.xlsx';

        return Excel::download(new approveditemsstoresExport($PLAN_SET_YEAR, $TCHN_LOCAT_NAME), $fileName);
    }
}
