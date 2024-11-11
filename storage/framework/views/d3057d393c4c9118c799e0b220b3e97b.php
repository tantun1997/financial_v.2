    

    <?php $__env->startSection('title', 'แผนวัสดุนอกคลัง'); ?>

    <?php $__env->startSection('contents'); ?>
       <style>
          .btn1 {
             font-size: 0.75em;
             padding: 0.05em 0.5em;
          }
       </style>

       <div class="mb-3">
          <?php if($E_CLOSE_PLAN->status == 'Y'): ?>
             <button type="button" class="btn btn-primary" id="addItemButton" data-bs-toggle="modal" data-bs-target="#addModal_product" data-action="<?php echo e(route('outsidewarehouses.store')); ?>">
                + เพิ่มรายการ
             </button>
          <?php endif; ?>

          <?php if(Auth::user()->id == '114000041'): ?>
             <div class="ml-4 mt-2">
                <div class="form-check form-switch mr-5">
                   <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" <?php if($E_CLOSE_PLAN->status == 'Y'): ?> checked <?php endif; ?> data-id="<?php echo e($E_CLOSE_PLAN->id); ?>">
                   <label class="form-check-label" for="flexSwitchCheckDefault">เปิดการเพิ่มแผนฯ</label>
                </div>
             </div>
          <?php endif; ?>
       </div>

       <div style="display: flex; justify-content: space-between; align-items: center;">

          <p>
             <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa-solid fa-magnifying-glass"></i> กรองข้อมูล
             </button>
          </p>

          <hr />
          <div style="display: flex; align-items: center;">
             <a href="javascript:void(0)" onclick="exportFilteredData()" class="btn btn-success mr-2">
                <i class="fa-solid fa-file-excel fa-lg"></i> หมวดวัสดุ
             </a>
             <a href="javascript:void(0)" onclick="exportFilteredData_items()" class="btn btn-success">
                <i class="fa-solid fa-file-excel fa-lg"></i> รายการวัสดุแต่ละหมวด
             </a>
          </div>
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
                   <th class="text-center">หมวดวัสดุ</th>
                   <th class="text-center">จำนวนรายการ</th>
                   <th class="text-center">รายละเอียดเพิ่มเติม</th>
                   <th class="text-center">การจัดการ</th>
                </tr>
             </thead>
             <tbody>
                <?php $__currentLoopData = $E_PLAN; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <tr>
                      <td>
                         เลขที่: ว.<?php echo e($item->PLAN_ID); ?> <br>
                         ชื่อหมวด:<strong> <?php echo e($item->PRODCT_CAT_NAME); ?></strong><br>
                         ปีงบประมาณ: <strong><?php echo e($item->BUDG_YEAR); ?></strong> <br>
                      </td>
                      <td>
                         <span style="color: #2a60f3">วงเงินรวม:
                            <?php echo e(number_format(round($item->Total_Price, 2), 2)); ?>

                            บาท</span><br>
                         จำนวนวัสดุ: <?php echo e(number_format(round($item->Total_QTY, 2), 0)); ?>


                      </td>

                      <td style="text-align: left;">
                         วันที่สร้าง:
                         <?php echo e(\Carbon\Carbon::parse($item->CREATE_DATE)->addYears(543)->format('d/m/Y')); ?>


                         <br>
                         หน่วยงานที่เบิก: <strong><?php echo e($item->TCHN_LOCAT_NAME); ?></strong> <br>
                         ประเภทแผน: <strong><?php echo e($item->TYPE_NAME); ?></strong>
                         <span style="display:none;">deptId: <strong><?php echo e($item->deptId); ?></strong></span>

                      </td>
                      <td class="text-center align-middle">
                         <div class="btn-group mb-2" role="group">
                            <a href="<?php echo e(route('outsidewarehouses.show', $item->PLAN_ID)); ?>" type="button" class="btn btn-outline-primary btn-sm" style="white-space: nowrap;">ดูข้อมูล</a>
                            <form action="<?php echo e(route('outsidewarehouses.destroy', $item->PLAN_ID)); ?>" method="POST" onsubmit="return confirm('ต้องการปิดใช้งานหรือไม่?')" class="p-0">
                               <?php echo csrf_field(); ?>
                               <?php echo method_field('DELETE'); ?>
                               <button type="submit" class="btn btn-outline-danger btn-sm" style="white-space: nowrap;">ปิดใช้งาน</button>
                            </form>
                         </div>

                         <div>
                            <?php if(Auth::user()->id != '114000041'): ?>
                               <form id="approval-form" action="<?php echo e(route('outsidewarehouses.approved', $item->PLAN_ID)); ?>" method="POST">
                                  <?php echo csrf_field(); ?>
                                  <?php echo method_field('PATCH'); ?>
                                  <?php if($item->REQ_APPROVED_ID == 0): ?>
                                     <span class="badge bg-primary">ตรวจสอบวัสดุก่อนขออนุมัติ</span>
                                  <?php elseif($item->REQ_APPROVED_ID == 1): ?>
                                     <span class="badge bg-warning text-dark">รออนุมัติ ติดต่อหน.การเงิน</span>
                                  <?php endif; ?>
                               </form>
                            <?php endif; ?>
                            <?php if(Auth::user()->id == '114000041'): ?>
                               <?php if($item->REQ_APPROVED_ID == 1): ?>
                                  <form id="approval-form-<?php echo e($item->PLAN_ID); ?>" action="<?php echo e(route('outsidewarehouses.approved', $item->PLAN_ID)); ?>" method="POST">
                                     <?php echo csrf_field(); ?>
                                     <?php echo method_field('PATCH'); ?>
                                     <div class="btn-group" id="button-group-<?php echo e($item->PLAN_ID); ?>" role="group">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="submitApproval(<?php echo e($item->PLAN_ID); ?>, 0)">อนุมัติเสร็จสิ้น</button>
                                     </div>
                                  </form>
                               <?php endif; ?>
                            <?php endif; ?>
                         </div>
                      </td>
                   </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </tbody>
          </table>
       </div>

       <!-- Include the modal -->
       <?php echo $__env->make('outsidewarehouses.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

       <script>
          function exportFilteredData() {
             const PLAN_SET_YEAR = $('#filterSelectID').val();
             const TCHN_LOCAT_NAME = $('#filterSelectTCHN').val();

             // สร้างลิงก์ส่งออกด้วยข้อมูลตัวกรอง
             const exportUrl = `<?php echo e(route('export.data', ['type' => 'outsidewarehouses'])); ?>?PLAN_SET_YEAR=${PLAN_SET_YEAR}&TCHN_LOCAT_NAME=${TCHN_LOCAT_NAME}`;

             // เปลี่ยนที่อยู่ของหน้าเว็บไปยังลิงก์ส่งออก
             window.location.href = exportUrl;
          }

          function exportFilteredData_items() {
             const PLAN_SET_YEAR = $('#filterSelectID').val();
             const TCHN_LOCAT_NAME = $('#filterSelectTCHN').val();

             // สร้างลิงก์ส่งออกด้วยข้อมูลตัวกรอง
             const exportUrl = `<?php echo e(route('export.data', ['type' => 'outsidewarehouses_items'])); ?>?PLAN_SET_YEAR=${PLAN_SET_YEAR}&TCHN_LOCAT_NAME=${TCHN_LOCAT_NAME}`;

             // เปลี่ยนที่อยู่ของหน้าเว็บไปยังลิงก์ส่งออก
             window.location.href = exportUrl;
          }

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
                         if (reqApprovedId == 0) {
                            buttonGroup.innerHTML = `
                     <span class="badge bg-success">ผ่านอนุมัติ</span>
                  `;
                         }
                      }
                   } else {
                      toastr.error(data.message || 'เกิดข้อผิดพลาดในการส่งข้อมูล!');
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
                   [10, 50, 100, -1],
                   ['10', '50', '100', 'ทั้งหมด']
                ],
                columnDefs: [{
                      // กำหนดคอลัมน์แรก
                      width: '40vh',
                      targets: 0
                   },
                   {
                      // กำหนดคอลัมน์แรก
                      width: '30vh',
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
                      width: '20vh',
                      orderable: false,
                      targets: 3
                   }
                ],

             });
             // Handle the filtering for the year select
             $('#filterSelectID').on('change', function() {
                const year = $(this).val();
                const location = $('#filterSelectTCHN').val();
                table.columns(0).search(year ? `ปีงบประมาณ: ${year}` : '', true, false);
                table.columns(2).search(location ? `deptId: ${location}` : '', true, false);
                table.draw();
             });

             // Handle the filtering for the location select
             $('#filterSelectTCHN').on('change', function() {
                const location = $(this).val();
                const year = $('#filterSelectID').val();
                table.columns(2).search(location ? `deptId: ${location}` : '', true, false);
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
                const locationMatch = rowNode.cells[2].textContent.match(/หน่วยงานที่เบิก:\s*(.+)\s*/);
                const deptIdMatch = rowNode.cells[2].textContent.match(/deptId:\s*(.+)\s*/);
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

             // ดึงค่า deptId จาก URL
             const urlParams = new URLSearchParams(window.location.search);
             const deptIdFromUrl = urlParams.get('deptId');

             // ตรวจสอบว่ามีค่า deptId ใน URL หรือไม่
             if (deptIdFromUrl) {
                // ค้นหา option ที่มีค่า value ตรงกับ deptId
                const options = filterSelectTCHN.options;
                for (let i = 0; i < options.length; i++) {
                   if (options[i].value === deptIdFromUrl) {
                      options[i].selected = true; // ตั้งค่า selected ให้กับ option ที่ตรงกัน
                      break;
                   }
                }
             }

             document.getElementById('resetButton').addEventListener('click', function() {
                // Reset the filter dropdowns
                document.getElementById('filterSelectID').selectedIndex = 0; // Reset ปีงบประมาณ
                document.getElementById('filterSelectTCHN').selectedIndex = 0; // Reset หน่วยงาน

                table.search('').columns().search('')
                   .draw(); // Clear all searches and redraw the table
             });

             document.querySelectorAll('.form-check-input').forEach((checkbox) => {
                checkbox.addEventListener('change', function() {
                   const id = this.getAttribute('data-id');
                   const status = this.checked ? 'Y' : 'N';

                   fetch('<?php echo e(route('outsidewarehouses.close_plan')); ?>', {
                         method: 'POST',
                         headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                         },
                         body: JSON.stringify({
                            id: id,
                            status: status
                         })
                      })
                      .then(response => response.json())
                      .then(data => {
                         console.log(data.message);

                         // Toggle the button visibility based on the status
                         const addItemButton = document.getElementById('addItemButton');
                         if (status === 'Y') {
                            if (!addItemButton) {
                               const button = document.createElement('button');
                               button.type = 'button';
                               button.classList.add('btn', 'btn-primary');
                               button.id = 'addItemButton';
                               button.setAttribute('data-bs-toggle', 'modal');
                               button.setAttribute('data-bs-target', '#addModal_product');
                               button.setAttribute('data-action',
                                  '<?php echo e(route('outsidewarehouses.store')); ?>');
                               button.textContent = '+ เพิ่มรายการ';
                               document.querySelector('.mb-3').prepend(button);
                            }
                         } else {
                            if (addItemButton) {
                               addItemButton.remove();
                            }
                         }
                      })
                      .catch(error => console.error('Error:', error));
                });
             });

          });
       </script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/outsidewarehouses/index.blade.php ENDPATH**/ ?>