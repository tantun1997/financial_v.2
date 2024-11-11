@extends('layouts.app')

@section('title', 'แผนซ่อม')

@section('contents')
   <style>
      .btn1 {
         font-size: 0.75em;
         padding: 0.05em 0.5em;
      }
   </style>

   <div style="display: flex; justify-content: space-between; align-items: center;">

      <p>
         <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-magnifying-glass"></i> กรองข้อมูล
         </button>
      </p>

      <hr />
      {{-- <a href="{{ route('export.data', ['type' => 'repairs']) }}" class="btn btn-success mb-2">Export to
         Excel</a> --}}
   </div>
   <div class="collapse mb-3" id="collapseExample">
      <div class="card card-body">
         <div class="row">
            <div class="col-md-3">
               <select class="form-select" id="filterSelectID">
                  <option value="" selected hidden>เลือกปีงบประมาณ</option>
                  <!-- ตัวเลือกจะถูกเติมที่นี่โดย JavaScript -->
               </select>
            </div>
            <div class="col-md-3">
               <select class="form-select" id="filterSelectTCHN">
                  <option value="" selected hidden>เลือกหน่วยงาน</option>
                  <!-- ตัวเลือกจะถูกเติมที่นี่โดย JavaScript -->
               </select>
            </div>
            <div class="col-md-3">

               <button id="resetButton" class="btn btn-secondary">Reset</button>
            </div>

         </div>
      </div>
   </div>
   <hr />
   <div style="max-width: 100%; overflow-x: auto; overflow-y: auto;">

      <table id="plan_table" class="table-bordered table" style="width:100%">
         <thead class="table-primary">
            <tr>
               <th class="text-center">รายการแผนงาน</th>
               <th class="text-center">ราคาโดยประมาณ</th>
               <th class="text-center">เหตุผลและความจำเป็น</th>
               <th class="text-center">รายละเอียดเพิ่มเติม</th>
               <th class="text-center">การจัดการ</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($E_PLAN as $item)
               <tr>
                  <td>
                     เลขที่แผน: ผ.{{ $item->PLAN_ID }} <br>
                     ชื่อแผน: <strong>{{ $item->PLAN_NAME }}</strong><br>
                     ปีงบประมาณ: <strong>{{ $item->PLAN_SET_YEAR }}</strong> <br>

                     ประเภทแผน: <strong>{{ $item->TYPE_NAME }}</strong>

                     @if ($item->USAGE_STATUS_ID == 1)
                        <span class="badge bg-success">จริง</span>
                     @elseif($item->USAGE_STATUS_ID == 2)
                        <span class="badge bg-secondary">สำรอง</span>
                     @endif

                  </td>
                  <td style="white-space: nowrap;">
                     <span style="color: #2a60f3">วงเงินรวม:
                        {{ number_format(round($item->PLAN_PRICE_PER * $item->PLAN_QTY, 2), 2) }}
                        บาท</span>
                     <br>
                     @if ($item->Total_Used === null || $item->Total_Used == 0)
                        จำนวนครุภัณฑ์ที่ตั้งไว้:
                        0/{{ number_format(round($item->PLAN_QTY, 2), 0) }}
                        <br> ใช้ไปแล้ว: 0 บาท
                        <br> คงเหลือ: 0 บาท
                     @else
                        จำนวนครุภัณฑ์ที่ตั้งไว้:
                        {{ $item->Total_Used }}/{{ number_format(round($item->PLAN_QTY, 2), 0) }}
                        <br>ใช้ไปแล้ว:<span style="color: green">
                           {{ number_format(round($item->Total_Current_Price, 2), 2) }}
                        </span>บาท
                        <br>คงเหลือ:
                        <span style="color: red">{{ number_format(round($item->Remaining_Price, 2), 2) }}
                        </span>บาท
                     @endif

                  </td>
                  <td>
                     {{ $item->PLAN_REASON }}
                  </td>
                  <td style="text-align: left;">
                     วันที่สร้างแผน
                     {{ \Carbon\Carbon::createFromFormat('d/m/Y H:i', $item->CREATE_DATE)->addYears(543)->format('d/m/Y H:i') }}

                     <br>
                     หน่วยงานที่เบิก: <strong>{{ $item->TCHN_LOCAT_NAME }}</strong> <br>
                     ประเภทงบ: <strong>{{ $item->Budget_NAME }}</strong>
                  </td>
                  <td class="text-center align-middle">
                     <div class="btn-group" role="group">
                        {{-- <a href="{{ $item->TYPE_ID == 1
                            ? route('maintenances.show', $item->PLAN_ID)
                            : ($item->TYPE_ID >= 2 && $item->TYPE_ID <= 14
                                ? route('repairs.show', $item->PLAN_ID)
                                : ($item->TYPE_ID >= 15 && $item->TYPE_ID <= 25
                                    ? route('contractservices.show', $item->PLAN_ID)
                                    : ($item->TYPE_ID == 26
                                        ? route('calibrations.show', $item->PLAN_ID)
                                        : ($item->TYPE_ID == 27
                                            ? route('potentials.show', $item->PLAN_ID)
                                            : ($item->TYPE_ID == 28
                                                ? route('replacements.show', $item->PLAN_ID)
                                                : ($item->TYPE_ID == 29
                                                    ? route('noserials.show', $item->PLAN_ID)
                                                    : '#')))))) }}"
                           type="button" class="btn btn-outline-primary btn-sm" style="white-space: nowrap;">ดูข้อมูล</a> --}}
                        <form action="{{ route('select_plan_close.enabled', $item->PLAN_ID) }}" method="POST">
                           @csrf
                           @method('PATCH')
                           <button type="submit" class="btn btn-outline-success btn-sm" style="white-space: nowrap;">เปิดใช้งาน</button>
                        </form>
                     </div>
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>

   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const table = $('#plan_table').DataTable({
            language: {
               "sProcessing": "กำลังดำเนินการ...",
               "sLengthMenu": "แสดง _MENU_ รายการ",
               "sZeroRecords": "ไม่พบข้อมูลในตาราง",
               "sEmptyTable": "ไม่มีข้อมูลในตาราง",
               "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
               "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
               "sInfoFiltered": "(กรองข้อมูลทั้งหมด _MAX_ รายการ)",
               "sSearch": "ค้นหา:",
               "sInfoThousands": ",",
               "sLoadingRecords": "กำลังโหลด...",
               "oPaginate": {
                  "sFirst": "หน้าแรก",
                  "sLast": "หน้าสุดท้าย",
                  "sNext": "ถัดไป",
                  "sPrevious": "ก่อนหน้า"
               }
            },
            order: [],
            lengthMenu: [
               [10, 50, 100, -1],
               ['10', '50', '100', 'ทั้งหมด']
            ],
            columnDefs: [{
                  // กำหนดคอลัมน์แรก
                  width: '50vh',
                  orderable: false,
                  targets: 0
               },
               {
                  // กำหนดคอลัมน์แรก
                  width: '20vh',
                  orderable: false,
                  targets: 1
               },
               {
                  // กำหนดคอลัมน์แรก
                  width: '40vh',
                  orderable: false,
                  targets: 2
               },
               {
                  // กำหนดคอลัมน์แรก
                  width: '30vh',
                  orderable: false,
                  targets: 3
               },
               {
                  width: '20vh',
                  orderable: false,
                  targets: 4
               }
            ],

         });
         // Handle the filtering for the year select
         $('#filterSelectID').on('change', function() {
            const year = $(this).val();
            const location = $('#filterSelectTCHN').val();
            table.columns(0).search(year ? `ปีงบประมาณ: ${year}` : '', true, false);
            table.columns(3).search(location ? `หน่วยงานที่เบิก: ${location}` : '', true, false);
            table.draw();
         });

         // Handle the filtering for the location select
         $('#filterSelectTCHN').on('change', function() {
            const location = $(this).val();
            const year = $('#filterSelectID').val();
            table.columns(3).search(location ? `หน่วยงานที่เบิก: ${location}` : '', true, false);
            table.columns(0).search(year ? `ปีงบประมาณ: ${year}` : '', true, false);
            table.draw();
         });



         // Populate filter selects with unique values from the table
         const planTable = document.getElementById('plan_table');
         const filterSelectID = document.getElementById('filterSelectID');
         const filterSelectTCHN = document.getElementById('filterSelectTCHN');
         const uniqueYears = new Set();
         const uniqueLocations = new Set();

         // รวบรวมข้อมูลจากตาราง
         const rows = planTable.querySelectorAll('tbody tr');
         rows.forEach(row => {
            const year = row.cells[0].textContent.match(/ปีงบประมาณ: (.+)/)[1]?.trim();
            const location = row.cells[3].textContent.match(/หน่วยงานที่เบิก: (.+)/)[1]?.trim();
            if (year) uniqueYears.add(year);
            if (location) uniqueLocations.add(location);
         });

         // เติมค่าใน select ปีงบประมาณ
         Array.from(uniqueYears).sort((a, b) => b - a).forEach(year => {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            filterSelectID.appendChild(option);
         });

         // เติมค่าใน select หน่วยงาน
         uniqueLocations.forEach(location => {
            const option = document.createElement('option');
            option.value = location;
            option.textContent = location;
            filterSelectTCHN.appendChild(option);
         });

         document.getElementById('resetButton').addEventListener('click', function() {
            // Reset the filter dropdowns
            document.getElementById('filterSelectID').selectedIndex = 0; // Reset ปีงบประมาณ
            document.getElementById('filterSelectTCHN').selectedIndex = 0; // Reset หน่วยงาน

            table.search('').columns().search('')
               .draw(); // Clear all searches and redraw the table
         });
      });
   </script>

@endsection
