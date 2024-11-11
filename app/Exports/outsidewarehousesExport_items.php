<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \Illuminate\Support\Collection;

class outsidewarehousesExport_items implements FromCollection, WithHeadings, WithStyles
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
        $query = DB::table('วัสดุทั้งหมด')
            ->select('PLAN_ID', 'BUDG_YEAR', 'Budget_NAME', 'TYPE_NAME', 'PRODCT_CAT_NAME', 'PRODCT_SERIAL_NUMBER', 'PRODCT_NAME', 'PRODCT_CURRENT_PRICE', 'PRODCT_QTY', 'UNIT_TH_NAME', 'PRODCT_TOTAL_PRICE', 'PRODCT_REASON', 'REQ_APPROVED_NAME', 'PRODCT_WITHDRAW_QTY', 'PRODCT_WITHDRAW_QTY_PRICE', 'PRODCT_USED_QTY', 'TCHN_LOCAT_NAME', 'PRODCT_CREATED_DATE')
            ->where('TYPE_NUMBER', 8);

        if (Auth::user()->isAdmin == 'Y') {
            if (!empty($this->PLAN_SET_YEAR)) {
                $query->where('BUDG_YEAR', $this->PLAN_SET_YEAR);
            }
            if (!empty($this->TCHN_LOCAT_NAME)) {
                $query->where('IC_LOCAT_ID', $this->TCHN_LOCAT_NAME); // ตรวจสอบค่าที่ถูกต้อง
            }
        } else {
            $query->where('IC_LOCAT_ID', Auth::user()->deptId);

            if (!empty($this->PLAN_SET_YEAR)) {
                $query->where('BUDG_YEAR', $this->PLAN_SET_YEAR);
            }
            if (!empty($this->TCHN_LOCAT_NAME)) {
                $query->where('IC_LOCAT_ID', $this->TCHN_LOCAT_NAME); // ตรวจสอบค่าที่ถูกต้อง
            }
        }

        // คืนค่าที่เป็น Collection
        return $query->orderBy('PLAN_ID', 'desc')->get(); // คืนค่าที่เป็น Collection
    }

    public function headings(): array
    {
        return [
            'เลขที่แผน',
            'ปีงบประมาณ',
            'ประเภทงบ',
            'ประเภทแผน',
            'ชื่อหมวด',
            'รหัสวัสดุ',
            'ชื่อวัสดุ',
            'ราคาต่อหน่วย',
            'จำนวนวัสดุ',
            'หน่วยนับ',

            'ราคาทั้งหมด',
            'เหตุผล',
            'การอนุมัติ',
            'จำนวนเบิก(ล่าสุด)',
            'ราคาเบิก(ล่าสุด)',
            'เบิกใช้ไปแล้ว',
            'หน่วยงานที่เบิก',
            'วันที่สร้าง',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // ตั้งชื่อเรื่อง
        $sheet->setCellValue('A1', 'ชื่อเรื่อง: แผนวัสดุคลังย่อย ประเภทวัสดุนอกคลัง');
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->mergeCells('A1:U1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        $sheet->fromArray($this->headings(), null, 'A2');
        $sheet->getStyle('A2:U2')->getFont()->setBold(true);
        $sheet->getStyle('A2:U2')->getAlignment()->setHorizontal('center');

        // แปลงข้อมูล collection เป็นอาเรย์ก่อน
        $dataArray = $this->collection()->map(function ($item) {
            return (array) $item;
        })->toArray();

        $sheet->fromArray($dataArray, null, 'A3');

        // กำหนดรูปแบบเซลล์ในคอลัมน์ ให้เป็นตัวเลข
        $sheet->getStyle('H3:H' . (count($dataArray) + 2))->getNumberFormat()->setFormatCode('#,##0.00'); // ราคาต่อหน่วย
        $sheet->getStyle('I3:I' . (count($dataArray) + 2))->getNumberFormat()->setFormatCode('#,##0'); // จำนวนวัสดุ
        $sheet->getStyle('K3:K' . (count($dataArray) + 2))->getNumberFormat()->setFormatCode('#,##0.00'); // ราคาทั้งหมด
        $sheet->getStyle('N3:N' . (count($dataArray) + 2))->getNumberFormat()->setFormatCode('#,##0'); // จำนวนเบิก(ล่าสุด)
        $sheet->getStyle('O3:O' . (count($dataArray) + 2))->getNumberFormat()->setFormatCode('#,##0.00'); // ราคาเบิก(ล่าสุด)
        $sheet->getStyle('P3:P' . (count($dataArray) + 2))->getNumberFormat()->setFormatCode('#,##0'); // เบิกใช้ไปแล้ว

    }

}
