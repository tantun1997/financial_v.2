@extends('layouts.app')

@section('title', 'รายงานข้อมูลงบประมาณ - แผนวัสดุคลังย่อย')

@section('contents')
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>
   </div>
   <br>
   <table class="table-bordered table-hover table-sm" style="width: 100%;">
      <thead>
         <tr style="background-color: rgb(209, 209, 209)">
            <th>แผนก</th>
            <th>วงเงินทั้งหมด(บาท)</th>
            <th>ผ่านอนุมัติ</th>
            <th>ไม่ผ่านอนุมัติ</th>
         </tr>
      </thead>
      <tbody>
         @php
            $seenNames = [];
         @endphp
         @foreach ($store_items as $key => $item)
            @if (!in_array($item->TCHN_LOCAT_NAME, $seenNames))
               @php
                  $seenNames[] = $item->TCHN_LOCAT_NAME;
                  // รวมค่า Total_Price ที่ TYPE_ID เท่ากับ 30 และ 31 ของ TCHN_LOCAT_NAME เดียวกัน
                  $totalPriceByType = DB::table('แผนวัสดุ_วงเงินแต่ละแผนก_ใหม่')
                      ->where('TCHN_LOCAT_NAME', $item->TCHN_LOCAT_NAME)
                      ->whereIn('TYPE_ID', [30, 31])
                      ->sum('Total_Price');
               @endphp
               <tr class="clickable-row" data-bs-toggle="collapse" data-bs-target="#itemDetail1{{ $key }}" aria-expanded="false" aria-controls="itemDetail1{{ $key }}"
                   style="cursor: pointer;">
                  <td class="click_sharp">{{ $item->TCHN_LOCAT_NAME }}</td>
                  <td>{{ number_format($totalPriceByType, 2) }}</td>
                  <td>{{ number_format($item->Total_Used_Price_Pass, 2) }}</td>
                  <td>{{ number_format($item->Total_Used_Price_No_Pass, 2) }}</td>
               </tr>
            @endif
            @php
               $detailItems = DB::table('แผนวัสดุ_วงเงินแต่ละแผนก_ใหม่')
                   ->where('WK_Group', $name_group)
                   ->where('deptId', $item->deptId)
                   ->get();
            @endphp
            @foreach ($detailItems as $query)
               <tr id="itemDetail1{{ $key }}" class="collapse">
                  <td>
                     @if ($query->TYPE_NUMBER == 8)
                        <a href="{{ route('outsidewarehouses', ['deptId' => $query->deptId]) }}" target="_blank">
                           <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                              <path d="m9 19 8-7-8-7z"></path>
                           </svg> {{ $query->TYPE_NAME }}
                        </a>
                     @elseif ($query->TYPE_NUMBER == 9)
                        <a href="{{ route('insidewarehouses', ['deptId' => $query->deptId]) }}" target="_blank">
                           <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                              <path d="m9 19 8-7-8-7z"></path>
                           </svg> {{ $query->TYPE_NAME }}
                        </a>
                     @endif
                  </td>
                  <td>
                     {{ number_format($query->Total_Price, 2) }}
                  </td>
                  <td>
                     {{ number_format($query->Total_Used_Price_Pass, 2) }}

                  </td>
                  <td>{{ number_format($query->Total_Used_Price_No_Pass, 2) }}
                  </td>
               </tr>
            @endforeach
         @endforeach
      </tbody>

   </table>

   <style>
      .clickable-row .click_sharp {
         position: relative;
      }

      .clickable-row .click_sharp::before {
         font-size: 1.3em;
         /* เพิ่มขนาดของลูกศรเป็น 1.5 เท่าของขนาดธรรมดา */
         content: '\203A';
         /* รหัส Unicode ของลูกศรเน้นขึ้น */
         position: absolute;
         left: 95%;
         top: 50%;
         transform: translateY(-50%);
         /* เพิ่มการหมุนลูกศร 90 องศา */
         transition: transform 0.3s ease;
         /* เพิ่ม transition เพื่อให้การเคลื่อนไหวมีความนุ่มนวล */
      }

      .clickable-row:hover .click_sharp::before,
      .clickable-row.expanded .click_sharp::before {
         transform: translateY(-50%) rotate(90deg);
         /* หมุนลูกศรกลับทิศตรงข้ามเมื่อโฮเวอร์หรือกดคลิก */
      }
   </style>

@endsection
