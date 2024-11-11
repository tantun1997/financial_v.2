<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \Illuminate\Support\Collection;

class replacementsExport implements FromCollection, WithHeadings, WithStyles
{
    protected $PLAN_SET_YEAR;
    protected $TCHN_LOCAT_NAME;

    public function __construct($PLAN_SET_YEAR, $TCHN_LOCAT_NAME)
    {
        $this->PLAN_SET_YEAR   = $PLAN_SET_YEAR;
        $this->TCHN_LOCAT_NAME = $TCHN_LOCAT_NAME;
    }

    public function collection()
    {
        $query = DB::table('แผนครุภัณฑ์')
            ->select('PLAN_ID', 'PLAN_NAME', 'PLAN_SET_YEAR', 'PLAN_PRICE_PER', 'PLAN_QTY', 'PLAN_REASON', 'CREATE_DATE', 'TCHN_LOCAT_NAME', 'Budget_NAME', 'TYPE_NAME', 'USAGE_STATUS_NAME', 'REQ_APPROVED_NAME')
            ->where('PLAN_IS_ACTIVE', '!=', 'N')
            ->where('TYPE_NUMBER', 6);

        if (Auth::user()->isAdmin == 'Y') {
            if (!empty($this->PLAN_SET_YEAR)) {
                $query->where('PLAN_SET_YEAR', $this->PLAN_SET_YEAR);
            }
            if (!empty($this->TCHN_LOCAT_NAME)) {
                $query->where('deptId', $this->TCHN_LOCAT_NAME); // ตรวจสอบค่าที่ถูกต้อง
            }
        } else {
            $query->where('deptId', Auth::user()->deptId);

            if (!empty($this->PLAN_SET_YEAR)) {
                $query->where('PLAN_SET_YEAR', $this->PLAN_SET_YEAR);
            }
            if (!empty($this->TCHN_LOCAT_NAME)) {
                $query->where('deptId', $this->TCHN_LOCAT_NAME); // ตรวจสอบค่าที่ถูกต้อง
            }
        }

        // คืนค่าที่เป็น Collection
        return $query->orderBy('PLAN_ID', 'desc')->get(); // คืนค่าที่เป็น Collection
    }

    public function headings(): array
    {
        return [
            'เลขที่แผน',
            'ชื่อแผนงาน',
            'ปีงบประมาณ',
            'ราคาต่อหน่วย',
            'จำนวน',
            'เหตุผลและความจำเป็น',
            'วันที่สร้าง',
            'หน่วยงานที่เบิก',
            'ประเภทงบ',
            'ประเภทแผน',
            'แผน',
            'การอนุมัติ',

        ];
    }

    public function styles(Worksheet $sheet)
    {
        // ตั้งชื่อเรื่อง
        $sheet->setCellValue('A1', 'ชื่อเรื่อง: แผนการจัดซื้อจัดจ้าง ประเภททดแทน');
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->fromArray($this->headings(), null, 'A2');
        $sheet->getStyle('A2:L2')->getFont()->setBold(true);
        $sheet->getStyle('A2:L2')->getAlignment()->setHorizontal('center');

        // แปลงข้อมูล collection เป็นอาเรย์ก่อน
        $dataArray = $this->collection()->map(function ($item) {
            return (array) $item;
        })->toArray();

        $sheet->fromArray($dataArray, null, 'A3');

        // กำหนดรูปแบบเซลล์ในคอลัมน์ 'ราคาต่อหน่วย' ให้เป็นตัวเลข
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('D3:D' . $highestRow)->getNumberFormat()->setFormatCode('#,##0.00');

    }

}
