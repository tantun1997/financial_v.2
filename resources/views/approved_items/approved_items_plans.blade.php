@extends('layouts.app')

@section('title', 'ขออนุมัติ - แผนจัดซื้อจัดจ้าง')

@section('contents')
   <style>
      .btn1 {
         font-size: 0.75em;
         padding: 0.05em 0.5em;
      }
   </style>
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>
   </div>
   <hr>
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <p>
         <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <i class="fa-solid fa-magnifying-glass"></i> กรองข้อมูล
         </button>
      </p>

      <hr />
      <a href="javascript:void(0)" onclick="exportFilteredData()" class="btn btn-success mb-2">
         Export to Excel
      </a>
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
                        <br>ใช้ไปแล้ว:<span style="color: red ">
                           {{ number_format(round($item->Total_Current_Price, 2), 2) }}
                        </span>บาท
                        <br>คงเหลือ:
                        <span style="color: green">{{ number_format(round($item->Remaining_Price, 2), 2) }}</span>บาท
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
                     <span style="display:none;">deptId: <strong>{{ $item->deptId }}</strong></span>

                  </td>
                  <td class="text-center align-middle">
                     <div class="btn-group" role="group">
                        <a href="{{ $item->TYPE_ID == 1
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
                           type="button" class="btn btn-outline-primary btn-sm" style="white-space: nowrap;">ดูข้อมูล</a>

                        <form action="{{ route('approved_items_plans.destroy', $item->PLAN_ID) }}" method="POST" onsubmit="return confirm('Delete?')" class="p-0">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-outline-danger btn-sm" style="white-space: nowrap;">ปิดใช้งาน</button>
                        </form>
                     </div>
                     <br><br>
                     @if ($item->USAGE_STATUS_ID == 1 && Auth::user()->id == '114000041')
                        <form id="approval-form-{{ $item->PLAN_ID }}" action="{{ route('approved_items_plans.approved', $item->PLAN_ID) }}" method="POST">
                           @csrf
                           @method('PATCH')
                           @if ($item->REQ_APPROVED_ID == 0)
                              <span class="badge bg-secondary">ไม่ได้ขออนุมัติ</span>
                           @elseif($item->REQ_APPROVED_ID == 1 || $item->REQ_APPROVED_ID == 4)
                              <div class="btn-group" id="button-group-{{ $item->PLAN_ID }}" role="group">
                                 <button class="btn btn-success btn-sm" type="button" onclick="submitApproval({{ $item->PLAN_ID }}, 2)">อนุมัติ</button>
                                 <button class="btn btn-secondary btn-sm" type="button" onclick="submitApproval({{ $item->PLAN_ID }}, 3)">ไม่อนุมัติ</button>
                              </div>
                           @elseif($item->REQ_APPROVED_ID == 2)
                              <div class="btn-group" id="button-group-{{ $item->PLAN_ID }}" role="group">
                                 <span class="badge bg-success">ผ่านอนุมัติ
                                    <button class="btn btn1 btn-warning" type="button" onclick="submitApproval({{ $item->PLAN_ID }}, 4)"><i class="fa-solid fa-xmark"></i></button>
                                 </span>
                              </div>
                           @elseif($item->REQ_APPROVED_ID == 3)
                              <div class="btn-group" id="button-group-{{ $item->PLAN_ID }}" role="group">
                                 <span class="badge bg-danger">ไม่ผ่านอนุมัติ
                                    <button class="btn btn1 btn-warning" type="button" onclick="submitApproval({{ $item->PLAN_ID }}, 4)"><i class="fa-solid fa-xmark"></i></button>
                                 </span>
                              </div>
                           @endif
                        </form>
                     @endif

                     @if ($item->USAGE_STATUS_ID == 1 && Auth::user()->id != '114000041')
                        @if ($item->REQ_APPROVED_ID == 0)
                           <form id="approval-form-{{ $item->PLAN_ID }}" action="{{ route('approved_items_plans.approved', $item->PLAN_ID) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button type="submit" name="REQ_APPROVED_ID" value="1" class="btn btn-primary btn-sm" style="white-space: nowrap;">
                                 ส่งขออนุมัติ
                              </button>
                           </form>
                        @elseif($item->REQ_APPROVED_ID == 1 || $item->REQ_APPROVED_ID == 4)
                           <span class="badge bg-warning text-dark">รออนุมัติ ติดต่อหน.การเงิน</span>
                        @elseif($item->REQ_APPROVED_ID == 2)
                           <span class="badge bg-success">ผ่านอนุมัติ</span>
                        @elseif($item->REQ_APPROVED_ID == 3)
                           <span class="badge bg-danger">ไม่ผ่านอนุมัติ</span>
                        @endif
                     @endif
                  </td>
               </tr>
            @endforeach
         </tbody>

      </table>
   </div>

   <script>
      function exportFilteredData() {
         const PLAN_SET_YEAR = $('#filterSelectID').val();
         const TCHN_LOCAT_NAME = $('#filterSelectTCHN').val();

         // สร้างลิงก์ส่งออกด้วยข้อมูลตัวกรอง
         const exportUrl = `{{ route('export.data', ['type' => 'approved_items_plans']) }}?PLAN_SET_YEAR=${PLAN_SET_YEAR}&TCHN_LOCAT_NAME=${TCHN_LOCAT_NAME}`;

         // เปลี่ยนที่อยู่ของหน้าเว็บไปยังลิงก์ส่งออก
         window.location.href = exportUrl;
      }
      // จัดการกับการส่งฟอร์มอนุมัติ
      function submitApproval(planId, reqApprovedId) {
         const form = document.getElementById(`approval-form-${planId}`);
         const formData = new FormData(form);
         formData.append('REQ_APPROVED_ID', reqApprovedId);

         fetch(form.action, {
               method: 'POST',
               headers: {
                  'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                  'Accept': 'application/json',
               },
               body: formData
            })
            .then(response => response.json())
            .then(data => {
               if (data.success) {
                  toastr.success(data.message);

                  const buttonGroup = document.querySelector(`#button-group-${planId}`);

                  if (buttonGroup) {
                     if (reqApprovedId == 2) {
                        buttonGroup.innerHTML = `
                        <span class="badge bg-success">ผ่านอนุมัติ
                           <button type="button" class="btn btn1 btn-warning" onclick="submitApproval(${planId}, 4)"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                     `;
                     } else if (reqApprovedId == 3) {
                        buttonGroup.innerHTML = `
                        <span class="badge bg-danger">ไม่ผ่านอนุมัติ
                           <button type="button" class="btn btn1 btn-warning" onclick="submitApproval(${planId}, 4)"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                     `;
                     } else if (reqApprovedId == 1) {
                        buttonGroup.innerHTML = `
                        <button type="button" class="btn btn-success btn-sm" onclick="submitApproval(${planId}, 2)">อนุมัติ</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="submitApproval(${planId}, 3)">ไม่อนุมัติ</button>
                     `;
                     } else if (reqApprovedId == 4) {
                        buttonGroup.innerHTML = `
                        <button type="button" class="btn btn-success btn-sm" onclick="submitApproval(${planId}, 2)">อนุมัติ</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="submitApproval(${planId}, 3)">ไม่อนุมัติ</button>
                     `;
                     }
                  }
               } else {
                  toastr.error('เกิดข้อผิดพลาดในการส่งข้อมูล!');
               }
            })
            .catch(error => {
               console.error('Error:', error);
               toastr.error('เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์!');
            });
      }

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
               [50, 100, -1],
               ['50', '100', 'ทั้งหมด']
            ],
            columnDefs: [{
                  // กำหนดคอลัมน์แรก
                  width: '50vh',
                  targets: 0
               },
               {
                  // กำหนดคอลัมน์แรก
                  width: '20vh',
                  targets: 1
               },
               {
                  // กำหนดคอลัมน์แรก
                  width: '40vh',
                  targets: 2
               },
               {
                  // กำหนดคอลัมน์แรก
                  width: '30vh',
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
            table.columns(3).search(location ? `deptId: ${location}` : '', true, false);
            table.draw();
         });

         // Handle the filtering for the location select
         $('#filterSelectTCHN').on('change', function() {
            const location = $(this).val();
            const year = $('#filterSelectID').val();
            table.columns(3).search(location ? `deptId: ${location}` : '', true, false);
            table.columns(0).search(year ? `ปีงบประมาณ: ${year}` : '', true, false);
            table.draw();
         });


         // Populate filter selects with unique values from the table
         const filterSelectID = document.getElementById('filterSelectID');
         const filterSelectTCHN = document.getElementById('filterSelectTCHN');
         const uniqueYears = new Set();
         const uniqueLocations = new Map();
         // รวบรวมข้อมูลจากตาราง
         table.rows().every(function() {
            const rowNode = this.node(); // ดึง Node ของแถวปัจจุบัน

            // เข้าถึงเซลล์โดยใช้ rowNode
            const yearMatch = rowNode.cells[0].textContent.match(/ปีงบประมาณ:\s*(.+)\s*/);
            const locationMatch = rowNode.cells[3].textContent.match(/หน่วยงานที่เบิก:\s*(.+)\s*/);
            const deptIdMatch = rowNode.cells[3].textContent.match(/deptId:\s*(.+)\s*/);
            const year = yearMatch ? yearMatch[1].trim() : null;

            if (locationMatch && deptIdMatch) {
               const location = locationMatch[1].trim();
               const deptId = deptIdMatch[1].trim();
               uniqueLocations.set(deptId, location); // deptId เป็น key และ location เป็น value
            }
            if (year) uniqueYears.add(year);

         });

         // เติมค่าใน select ปีงบประมาณ
         Array.from(uniqueYears).sort((a, b) => b - a).forEach(year => {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            filterSelectID.appendChild(option);
         });

         // เติมค่าใน select หน่วยงาน
         uniqueLocations.forEach((location, deptId) => {
            const option = document.createElement('option');
            option.value = deptId; // ตั้งค่า value เป็น deptId
            option.textContent = location; // แสดงชื่อเป็น TCHN_LOCAT_NAME
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
