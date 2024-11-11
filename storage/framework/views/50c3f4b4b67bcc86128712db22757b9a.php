<?php $__env->startSection('title', 'รายละเอียดแผนจ้างเหมาบริการ'); ?>

<?php $__env->startSection('contents'); ?>
   <style>
      .info-container {
         display: flex;
         flex-wrap: wrap;
         gap: 1rem;
         max-width: 100%;
      }

      .info-item {
         display: flex;
         flex-direction: column;
         width: 200px;
         /* ปรับขนาดได้ตามต้องการ */
      }

      .info-label {
         font-weight: bold;
         color: #333;
      }

      .info-value {
         color: #555;
      }

      .table {
         width: auto;
         /* กำหนดความกว้างของตารางให้เป็นอัตโนมัติ */
      }

      .table th,
      .table td {
         white-space: nowrap;
         /* ป้องกันการตัดบรรทัด */
         text-align: left;
         /* จัดข้อความให้อยู่ทางซ้าย */
         padding: 5px;
         /* เพิ่มระยะห่างระหว่างขอบและข้อความ */
      }
   </style>
   <hr />

   <div class="row">
      <div class="col-lg-12">
         <div style="display: flex; justify-content: space-between; align-items: center;">
            <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-action="<?php echo e(route('contractservices.update', $E_PLAN->PLAN_ID)); ?>">
               แก้ไขข้อมูล
            </button>

         </div>
         <div class="card mb-3 mt-2 shadow-sm">
            <h5 class="card-header" style="background-color: #188af5; color: white;">
               <i class="far fa-edit"></i> ข้อมูลแผน
            </h5>
            <div class="card-body">
               <div class="info-container">
                  <div class="info-item">
                     <span class="info-label">เลขที่วัสดุ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PLAN_ID); ?></span>
                  </div>

                  <div class="info-item">
                     <span class="info-label">แผนฯ:</span>
                     <span class="info-value">
                        <?php if($E_PLAN->USAGE_STATUS_ID == 1): ?>
                           <span class="text-success">จริง</span>
                        <?php elseif($E_PLAN->USAGE_STATUS_ID == 2): ?>
                           <span class="text-danger">สำรอง</span>
                        <?php endif; ?>
                     </span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">ประเภทแผน:</span>
                     <span class="info-value"><?php echo e($E_PLAN->TYPE_NAME); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">ประเภทงบ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->Budget_NAME); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">ราคาต่อหน่วย:</span>
                     <span class="info-value"><?php echo e(number_format(round($E_PLAN->PLAN_PRICE_PER, 2), 2)); ?> บาท</span>

                  </div>
                  <div class="info-item">
                     <span class="info-label">จำนวน:</span>
                     <span class="info-value"><?php echo e(number_format(round($E_PLAN->PLAN_QTY, 2), 0)); ?></span>

                  </div>
                  <div class="info-item">
                     <span class="info-label">วงเงินรวม:</span>
                     <span class="info-value"><?php echo e(number_format(round($E_PLAN->PLAN_PRICE_PER * $E_PLAN->PLAN_QTY, 2), 2)); ?> บาท</span>

                  </div>
                  <div class="info-item">
                     <span class="info-label">ปีงบประมาณ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PLAN_SET_YEAR); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">วันที่สร้างแผน:</span>
                     <span class="info-value"><?php echo e(\Carbon\Carbon::createFromFormat('d/m/Y H:i', $E_PLAN->CREATE_DATE)->addYears(543)->format('d/m/Y H:i')); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">ชื่อแผน:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PLAN_NAME); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">เหตุผลและความจำเป็น:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PLAN_REASON); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">หมายเหตุ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PLAN_REMARK); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">หน่วยงานที่เบิก:</span>
                     <span class="info-value"><?php echo e($E_PLAN->TCHN_LOCAT_NAME); ?></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-12">
         <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 10px;">
            <div style="display: flex; align-items: center;">
               <form action="<?php echo e(route('contractservices.addRow', $E_PLAN->PLAN_ID)); ?>" method="POST">
                  <?php echo csrf_field(); ?> <!-- Don't forget to include CSRF token for form security -->
                  <button class="btn btn-success mr-1">
                     <i class="fa-solid fa-arrow-up-from-bracket"></i> เพิ่มการจ้างเหมา
                  </button>
               </form>
               <button onclick="generatePdf(<?php echo e($E_PLAN->PLAN_ID); ?>, 'contractservices')" class="btn btn-danger mr-1">
                  <i class="fa-duotone fa-file-pdf fa-lg"></i> PDF
               </button>
               <?php if($E_PLAN->USAGE_STATUS_ID == 1 && Auth::user()->id == '114000041'): ?>
                  <form id="approval-form-<?php echo e($E_PLAN->PLAN_ID); ?>" action="<?php echo e(route('contractservices.approved', $E_PLAN->PLAN_ID)); ?>" method="POST">
                     <?php echo csrf_field(); ?>
                     <?php echo method_field('PATCH'); ?>
                     <?php if($E_PLAN->REQ_APPROVED_ID == 0): ?>
                        <span class="badge bg-secondary">ไม่ได้ขออนุมัติ</span>
                     <?php elseif($E_PLAN->REQ_APPROVED_ID == 1 || $E_PLAN->REQ_APPROVED_ID == 4): ?>
                        <div class="btn-group" id="button-group-<?php echo e($E_PLAN->PLAN_ID); ?>" role="group">
                           <button class="btn btn-success" type="button" onclick="submitApproval(<?php echo e($E_PLAN->PLAN_ID); ?>, 2)">อนุมัติ</button>
                           <button class="btn btn-secondary" type="button" onclick="submitApproval(<?php echo e($E_PLAN->PLAN_ID); ?>, 3)">ไม่อนุมัติ</button>
                        </div>
                     <?php elseif($E_PLAN->REQ_APPROVED_ID == 2): ?>
                        <div class="btn-group" id="button-group-<?php echo e($E_PLAN->PLAN_ID); ?>" role="group">

                           <span class="badge bg-success">ผ่านอนุมัติ
                              <button class="btn btn1 btn-warning" type="button" onclick="submitApproval(<?php echo e($E_PLAN->PLAN_ID); ?>, 4)"><i class="fa-solid fa-xmark"></i></button>
                           </span>
                        </div>
                     <?php elseif($E_PLAN->REQ_APPROVED_ID == 3): ?>
                        <div class="btn-group" id="button-group-<?php echo e($E_PLAN->PLAN_ID); ?>" role="group">

                           <span class="badge bg-danger">ไม่ผ่านอนุมัติ
                              <button class="btn btn1 btn-warning" type="button" onclick="submitApproval(<?php echo e($E_PLAN->PLAN_ID); ?>, 4)"><i class="fa-solid fa-xmark"></i></button>
                           </span>
                        </div>
                     <?php endif; ?>
                  </form>
               <?php endif; ?>

               <?php if($E_PLAN->USAGE_STATUS_ID == 1 && Auth::user()->id != '114000041'): ?>
                  <?php if($E_PLAN->REQ_APPROVED_ID == 0): ?>
                     <form id="approval-form-<?php echo e($E_PLAN->PLAN_ID); ?>" action="<?php echo e(route('contractservices.approved', $E_PLAN->PLAN_ID)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="btn-group" id="button-group-<?php echo e($E_PLAN->PLAN_ID); ?>" role="group">
                           <button class="btn btn-primary" type="button" onclick="submitApproval(<?php echo e($E_PLAN->PLAN_ID); ?>, 1)">ส่งขออนุมัติ</button>
                        </div>
                     </form>
                  <?php elseif($E_PLAN->REQ_APPROVED_ID == 1 || $E_PLAN->REQ_APPROVED_ID == 4): ?>
                     <span class="badge bg-warning text-dark">รออนุมัติ ติดต่อหน.การเงิน</span>
                  <?php elseif($E_PLAN->REQ_APPROVED_ID == 2): ?>
                     <span class="badge bg-success">ผ่านอนุมัติ</span>
                  <?php elseif($E_PLAN->REQ_APPROVED_ID == 3): ?>
                     <span class="badge bg-danger">ไม่ผ่านอนุมัติ</span>
                  <?php endif; ?>
               <?php endif; ?>
            </div>
         </div>

         <div class="card mb-3 mt-2 shadow-sm">
            <h5 class="card-header" style="background-color: #188af5;color: white"><i class="far fa-edit"></i>
               การจ้างเหมา</h5>
            <div class="card-body">
               <span>วงเงินรวม:</span>
               <strong><?php echo e(number_format(round($E_PLAN->PLAN_PRICE_PER * $E_PLAN->PLAN_QTY, 2), 2)); ?>

                  บาท
               </strong>
               <span>ราคาประเมินจริงรวม:</span>
               <strong><?php echo e(number_format(round($E_PLAN->Total_Current_Price, 2), 2)); ?> บาท
               </strong>
               <span>คงเหลือ:</span>
               <strong style="color: <?php echo e($E_PLAN->Remaining_Price < 0 ? 'red' : 'green'); ?>">
                  <?php echo e(number_format(round($E_PLAN->Remaining_Price, 2), 2)); ?> บาท
               </strong>

               <table id='equip_table' class="table-bordered table-sm table" style="width: 100%;">
                  <thead>
                     <tr>
                        <th style="text-align: center;">เลือก</th>
                        <th style="text-align: left;">รายการ</th>
                        
                        <th style="text-align: center;">สถานะ</th>
                        <th style="text-align: center; width: 5%">จัดการ</th>
                     </tr>
                  </thead>
                  <?php $__currentLoopData = $EQUIP_LIST; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td style="text-align: center; vertical-align: middle;">
                           <form action="<?php echo e(route('contractservices.update_equip_used', [$item->EQUP_ID, $E_PLAN->PLAN_ID])); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <?php echo method_field('PATCH'); ?>
                              <?php if($item->EQUP_CURRENT_PRICE == null): ?>
                                 <small style="color: red;">ใส่ราคา</small>
                              <?php else: ?>
                                 <input type="radio" id="EQUP_USED_<?php echo e($item->EQUP_ID); ?>" name="EQUP_USED" value="<?php echo e($item->EQUP_ID); ?>" <?php if($item->EQUP_USED != 0): ?> checked <?php endif; ?>>
                              <?php endif; ?>
                           </form>

                        </td>
                        <td style="text-align: left; white-space: nowrap; vertical-align: middle;">
                           <div class="form-container">
                              <form action="<?php echo e(route('contractservices.update_equip', $item->EQUP_ID)); ?>" method="POST" class="equip-form" id="equip-form-<?php echo e($item->EQUP_ID); ?>">
                                 <?php echo csrf_field(); ?>
                                 <?php echo method_field('PATCH'); ?>
                                 <div class="view-mode">
                                    หมายเลข: <span class="EQUP_SERIAL_NUMBER"><?php echo e($item->EQUP_SERIAL_NUMBER); ?></span><br>
                                    ชื่อรายการ: <span class="EQUP_NAME"><?php echo e($item->EQUP_NAME); ?></span><br>
                                    ราคาประเมินจริงต่อหน่วย: <span class="EQUP_CURRENT_PRICE"><?php echo e(number_format($item->EQUP_CURRENT_PRICE, 2)); ?>

                                       บาท</span><br>
                                    จำนวน: <span class="EQUP_QTY"><?php echo e(round($item->EQUP_QTY, 0)); ?></span><br>
                                    ทั้งหมดราคา: <span class="total-price"><?php echo e(number_format(round($item->EQUP_CURRENT_PRICE * $item->EQUP_QTY, 2), 2)); ?>

                                       บาท</span><br>
                                 </div>
                                 <form class="equip-form">
                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <label class="input-group-text">หมายเลข:</label>
                                          <input type="text" name="EQUP_SERIAL_NUMBER" value="<?php echo e($item->EQUP_SERIAL_NUMBER); ?>" class="form-control" disabled>
                                       </div>

                                       <div class="input-group">
                                          <span class="input-group-text">ชื่อรายการ:</span>
                                          <input type="text" name="EQUP_NAME" value="<?php echo e($item->EQUP_NAME); ?>" class="form-control">
                                       </div>

                                       <div class="input-group">
                                          <span class="input-group-text">ราคาประเมินจริงต่อหน่วย:</span>
                                          <input type="number" name="EQUP_CURRENT_PRICE" step="0.01" value="<?php echo e(round($item->EQUP_CURRENT_PRICE, 2)); ?>" class="form-control">
                                       </div>

                                       <div class="input-group">
                                          <span class="input-group-text">จำนวน:</span>
                                          <input type="number" name="EQUP_QTY" value="<?php echo e(round($item->EQUP_QTY, 0)); ?>" class="form-control">
                                       </div>

                                       <div class="input-group">
                                          <span class="input-group-text">ทั้งหมดราคา:</span>
                                          <input class="form-control total-price" type="text" placeholder="ทั้งหมดราคา"
                                                 value="<?php echo e(number_format(round($item->EQUP_CURRENT_PRICE * $item->EQUP_QTY, 2), 2)); ?>" disabled>
                                       </div>
                                    </div>
                                 </form>
                              </form>

                           </div>
                        </td>

                        
                        <td class="text-center">
                           <div class="form-container">
                              <div class="view-mode">
                                 <?php echo e($item->STATUS_NAME); ?><br>
                                 <?php echo e(\Carbon\Carbon::createFromFormat('d/m/Y H:i', $item->EQUP_STATUS_DATE)->addYears(543)->format('d/m/Y H:i')); ?>

                              </div>
                              <div class="edit-mode" style="display: none;">
                                 <select class="form-select" id="STATUS_ID" name="STATUS_ID" form="equip-form-<?php echo e($item->EQUP_ID); ?>">
                                    <option value="" selected hidden>สถานะ</option>
                                    <?php $__currentLoopData = $E_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $STATUS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($STATUS->STATUS_ID); ?>" <?php echo e($EQUIP_STATUS->STATUS_ID == $STATUS->STATUS_ID ? 'selected' : ''); ?>>
                                          <?php echo e($STATUS->STATUS_NAME); ?>

                                       </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                                 <?php echo e(\Carbon\Carbon::createFromFormat('d/m/Y H:i', $item->EQUP_STATUS_DATE)->addYears(543)->format('d/m/Y H:i')); ?>


                              </div>
                           </div>
                        </td>
                        <td class="text-center align-middle">

                           <div class="view-mode">
                              <div class="btn-group" role="group">

                                 <button type="button" class="btn btn-primary btn-sm edit-btn">แก้ไข</button>

                                 <form action="<?php echo e(route('contractservices.destroy_equip', $item->EQUP_ID)); ?>" method="POST" onsubmit="return confirm('Delete?')" class="p-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-secondary btn-sm" style="white-space: nowrap;">ลบ</button>

                                 </form>
                              </div>

                           </div>

                           <div class="edit-mode" style="display: none;">
                              <div class="btn-group" role="group">
                                 <button type="submit" form="equip-form-<?php echo e($item->EQUP_ID); ?>" class="btn btn-success btn-sm mt-2">บันทึก</button>

                                 <button type="button" class="btn btn-secondary btn-sm cancel-btn mt-2">ยกเลิก</button>
                              </div>
                           </div>
                        </td>
                     </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </table>

            </div>
         </div>
      </div>
   </div>

   <?php echo $__env->make('contractservices.modal_edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <script>
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
                     if (<?php echo e(Auth::user()->id); ?> == '114000041') {
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
                        <button type="button" class="btn btn-success" onclick="submitApproval(${planId}, 2)">อนุมัติ</button>
                        <button type="button" class="btn btn-secondary" onclick="submitApproval(${planId}, 3)">ไม่อนุมัติ</button>
                     `;
                        } else if (reqApprovedId == 4) {
                           buttonGroup.innerHTML = `
                        <button type="button" class="btn btn-success" onclick="submitApproval(${planId}, 2)">อนุมัติ</button>
                        <button type="button" class="btn btn-secondary" onclick="submitApproval(${planId}, 3)">ไม่อนุมัติ</button>
                     `;
                        }
                     }
                     if (<?php echo e(Auth::user()->id); ?> != '114000041') {
                        if (reqApprovedId == 1) {
                           buttonGroup.innerHTML = `
                        <span class="badge bg-warning text-dark">รออนุมัติ ติดต่อหน.การเงิน</span>
                     `;
                        }
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

      function generatePdf(id, type) {
         $.ajax({
            url: '/contractservices/get-plan-status/' + id, // เส้นทาง API

            method: 'GET',
            success: function(response) {
               if (response.error) {
                  toastr.error(response.error);
               } else {
                  if (response.REQ_APPROVED_ID == 0) {
                     toastr.warning('กดส่งขออนุมัติ และรออนุมัติ');
                  } else if (response.REQ_APPROVED_ID == 1 || response.REQ_APPROVED_ID == 4) {
                     toastr.warning('รออนุมัติ ติดต่อหน.การเงิน');
                  } else if (response.REQ_APPROVED_ID == 3) {
                     toastr.error('ไม่ผ่านอนุมัติ ติดต่อหน.การเงิน');
                  } else if (response.total_current_price == '.00') {
                     toastr.warning('เพิ่มครุภัณฑ์และใส่ราคา');
                  } else if (response.checked_use == 0) {
                     toastr.warning('เลือกรายการครุภัณฑ์');
                  } else if (response.usage_status_id == 2) {
                     toastr.warning('เปลี่ยนแผนให้เป็นจริง โดยกดแก้ไขข้อมูล');
                  } else {
                     window.open('/GeneratePDF/' + id + '/' + type, '_blank');
                  }
               }
            },
            error: function(xhr, status, error) {
               toastr.error('เกิดข้อผิดพลาดในการดึงข้อมูล: ' + xhr.responseText);
            }
         });
      }


      document.addEventListener('DOMContentLoaded', function() {
         document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
               let form = this.closest('form');
               let formData = new FormData(form);

               // ส่งคำขอ AJAX โดยไม่รีเฟรชหน้า
               fetch(form.action, {
                     method: form.method,
                     body: formData,
                     headers: {
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                     }
                  })
                  .then(response => response.json())
                  .then(data => {
                     if (data.success) {
                        toastr.success('อัปเดตสำเร็จ!!');

                        // ดึง PLAN_ID จาก form action
                        let planId = form.action.split('/')
                           .pop(); // หาค่า PLAN_ID จาก URL ใน action

                        // รีเซ็ต Radio Button อื่นๆ ในแผนเดียวกัน (PLAN_ID)
                        document.querySelectorAll(`input[name="EQUP_USED"]`).forEach(
                           radioItem => {
                              if (radioItem !== radio && radioItem.closest('form')
                                 .action.includes(planId)) {
                                 radioItem.checked =
                                    false; // ยกเลิกการเลือกของ Radio Button อื่นๆ
                              }
                           });

                     } else {
                        toastr.error('เกิดข้อผิดพลาด!');
                     }
                  })
                  .catch(error => {
                     console.error('เกิดข้อผิดพลาด:', error);
                     toastr.error('เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์!');
                  });
            });
         });


         document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
               let row = this.closest('tr'); // หาคอลัมน์ปัจจุบัน
               let formContainers = row.querySelectorAll(
                  '.form-container'); // หาฟอร์มทั้งหมดในแถวนี้

               formContainers.forEach(formContainer => {
                  let viewMode = formContainer.querySelector('.view-mode');
                  let editMode = formContainer.querySelector('.edit-mode');
                  if (viewMode) viewMode.style.display = 'none';
                  if (editMode) editMode.style.display = 'block';
               });

               let parentTd = this.closest('td'); // หา td ปัจจุบันที่ปุ่มอยู่
               let viewMode = parentTd.querySelector('.view-mode'); // หา div ที่เป็น view-mode
               let editMode = parentTd.querySelector('.edit-mode'); // หา div ที่เป็น edit-mode

               if (viewMode && editMode) {
                  viewMode.style.display = 'none'; // ซ่อน view-mode
                  editMode.style.display = 'block'; // แสดง edit-mode
               }
            });
         });

         document.querySelectorAll('.cancel-btn').forEach(button => {
            button.addEventListener('click', function() {
               let row = this.closest('tr'); // หาคอลัมน์ปัจจุบัน
               let formContainers = row.querySelectorAll(
                  '.form-container'); // หาฟอร์มทั้งหมดในแถวนี้

               formContainers.forEach(formContainer => {
                  let viewMode = formContainer.querySelector('.view-mode');
                  let editMode = formContainer.querySelector('.edit-mode');
                  if (viewMode) viewMode.style.display = 'block';
                  if (editMode) editMode.style.display = 'none';
               });

               let parentTd = this.closest('td'); // หา td ปัจจุบันที่ปุ่มอยู่
               let viewMode = parentTd.querySelector('.view-mode'); // หา div ที่เป็น view-mode
               let editMode = parentTd.querySelector('.edit-mode'); // หา div ที่เป็น edit-mode

               if (viewMode && editMode) {
                  viewMode.style.display = 'block'; // แสดง view-mode
                  editMode.style.display = 'none'; // ซ่อน edit-mode
               }
            });
         });

         var forms = document.querySelectorAll('.equip-form');

         forms.forEach(function(form) {
            var qtyInput = form.querySelector('input[name="EQUP_QTY"]');
            var priceInput = form.querySelector('input[name="EQUP_CURRENT_PRICE"]');
            var totalInput = form.querySelector('input.total-price');

            function calculateTotal() {
               var qty = parseFloat(qtyInput.value) || 0;
               var price = parseFloat(priceInput.value) || 0;
               var total = qty * price;
               totalInput.value = total.toLocaleString(undefined, {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
               });
            }

            qtyInput.addEventListener('input', calculateTotal);
            priceInput.addEventListener('input', calculateTotal);

            // Calculate total on page load if values are present
            calculateTotal();
         });

         var table = $('#equip_table').DataTable({
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

            },
            autoWidth: true,

            dom: 'rtip', // ซ่อนช่องค้นหาเริ่มต้นของ DataTables
            order: [],
            lengthMenu: [
               [10, 50, 100, -1],
               ['10', '50', '100', 'ทั้งหมด']
            ],
            columnDefs: [{
               orderable: false,
               targets: 0
            }],
         });
      });
   </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/contractservices/show.blade.php ENDPATH**/ ?>