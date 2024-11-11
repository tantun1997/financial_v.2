<?php $__env->startSection('title', 'รายละเอียดแผนวัสดุในคลัง'); ?>

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

      .btn1 {
         font-size: 0.75em;
         padding: 0.05em 0.5em;
      }

      .table {
         width: auto;
      }

      .table th,
      .table td {
         word-wrap: break-word;
         /* ให้ตัดคำเมื่อเกินความกว้าง */
         word-break: break-all;
         max-width: 300px;
         /* กำหนดความกว้างสูงสุดของเซลล์ */
      }
   </style>
   <hr />
   <div class="row">
      <div class="col-lg-12">
         <div style="display: flex; justify-content: space-between; align-items: center;">
            <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>
            <button class="btn btn-primary" data-action="<?php echo e(route('insidewarehouses.update', $E_PLAN->PLAN_ID)); ?>" data-bs-target="#editModal" data-bs-toggle="modal" type="button">
               แก้ไขข้อมูล
            </button>
         </div>
         <div class="card mb-3 mt-2 shadow-sm">
            <h5 class="card-header" style="background-color: #188af5; color: white;">
               <i class="far fa-edit"></i> ข้อมูล
            </h5>
            <div class="card-body">
               <div class="info-container">
                  <div class="info-item">
                     <span class="info-label">เลขที่วัสดุ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PLAN_ID); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">ปีงบประมาณ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->BUDG_YEAR); ?></span>
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
                     <span class="info-label">วงเงินรวม:</span>
                     <span class="info-value"><?php echo e(number_format(round($E_PLAN->Total_Price, 2), 2)); ?> บาท</span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">จำนวนวัสดุ:</span>
                     <span class="info-value"><?php echo e(number_format(round($E_PLAN->Total_QTY, 2), 0)); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">วันที่สร้างแผน:</span>
                     <span class="info-value"><?php echo e(\Carbon\Carbon::parse($E_PLAN->CREATE_DATE)->addYears(543)->format('d/m/Y')); ?></span>
                  </div>
                  <div class="info-item">
                     <span class="info-label">หมวดพัสดุ:</span>
                     <span class="info-value"><?php echo e($E_PLAN->PRODCT_CAT_NAME); ?></span>
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
               <button class="btn btn-success mr-1" data-bs-target="#add_product_Modal" data-bs-toggle="modal" type="button">
                  <i class="fa-solid fa-arrow-up-from-bracket"></i> เพิ่มวัสดุ
               </button>
               <button class="btn btn-danger mr-1" onclick="generatePdf(<?php echo e($E_PLAN->PLAN_ID); ?>)">
                  <i class="fa-duotone fa-file-pdf fa-lg"></i> PDF
               </button>
               <?php if(Auth::user()->id != '114000041'): ?>
                  <form id="approval-form" action="<?php echo e(route('insidewarehouses.approved', $E_PLAN->PLAN_ID)); ?>" method="POST">
                     <?php echo csrf_field(); ?>
                     <?php echo method_field('PATCH'); ?>
                     <?php if($E_PLAN->REQ_APPROVED_ID == 0): ?>
                        <button class="btn btn-primary" type="button" style="white-space: nowrap;" onclick="checkCheckboxes(1)">
                           ส่งขออนุมัติ
                        </button>
                     <?php elseif($E_PLAN->REQ_APPROVED_ID == 1): ?>
                        <span class="badge bg-warning text-dark">รออนุมัติ ติดต่อหน.การเงิน</span>
                     <?php endif; ?>
                  </form>
               <?php endif; ?>

               <?php if(Auth::user()->id == '114000041'): ?>
                  <?php if($E_PLAN->REQ_APPROVED_ID == 1): ?>
                     <form id="approval-form-<?php echo e($E_PLAN->PLAN_ID); ?>" action="<?php echo e(route('insidewarehouses.approved', $E_PLAN->PLAN_ID)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="btn-group" id="button-group-<?php echo e($E_PLAN->PLAN_ID); ?>" role="group">
                           <button class="btn btn-primary" type="button" onclick="submitApprovalStore(<?php echo e($E_PLAN->PLAN_ID); ?>, 0)">อนุมัติเสร็จสิ้น</button>
                        </div>
                     </form>
                  <?php endif; ?>
               <?php endif; ?>
            </div>
         </div>

         <div class="card mb-3 mt-2 shadow-sm">
            <h5 class="card-header" style="background-color: #188af5;color: white">
               <i class="far fa-edit"></i> วัสดุ
            </h5>
            <div class="card-body">
               <div style="max-width: 100%; overflow-x: auto; overflow-y: auto;">
                  <table class="table-bordered table-sm table" id='equip_table' style="width: 100%;">
                     <thead>
                        <tr>
                           <th class="text-center" rowspan="2">เลือก</th>
                           <th class="text-center" rowspan="2">รายการวัสดุ</th>
                           <th class="text-center" rowspan="2">หน่วยนับ</th>
                           <th class="text-center" colspan="3">จำนวนการขออนุมัติ</th>
                           <th class="text-center" colspan="2">จำนวนที่ใช้เบิกตอนนี้<br><span style="color: crimson">หมายเหตุ ถ้าเบิกของ ให้ใส่จำนวนเบิกทุกครั้ง</span></th>
                           <th class="text-center" rowspan="2">เหตุผล</th>
                           <th class="text-center" rowspan="2">จัดการ</th>
                        </tr>
                        <tr>
                           <th class="text-center">จำนวน</th>
                           <th class="text-center">ราคาต่อหน่วย</th>
                           <th class="text-center">รวม</th>
                           <th class="text-center" style="background-color: rgb(174, 226, 43)">ใส่จำนวนเบิก<br></th>
                           <th class="text-center" style="background-color: rgb(174, 226, 43)">คำนวณการเบิก</th>
                        </tr>
                     </thead>

                     <?php $__currentLoopData = $EQUIP_LIST; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                           <td style="text-align: center; vertical-align: middle;">
                              <form action="<?php echo e(route('insidewarehouses.update_equip_used', $item->PRODCT_ID)); ?>" method="POST">
                                 <?php echo csrf_field(); ?>
                                 <?php echo method_field('PATCH'); ?>
                                 <input id="PRODCT_USED_<?php echo e($item->PRODCT_ID); ?>" name="PRODCT_USED" type="checkbox" <?php if($item->PRODCT_USED == 'Y'): ?> checked <?php endif; ?>>
                              </form>
                           </td>
                           <form class="equip-form" id="equip-form-<?php echo e($item->PRODCT_ID); ?>" action="<?php echo e(route('insidewarehouses.update_equip', $item->PRODCT_ID)); ?>" method="POST">
                              <?php echo csrf_field(); ?>
                              <?php echo method_field('PATCH'); ?>
                              <td>
                                 <div class="form-container">
                                    <div class="view-mode">
                                       รหัส: <?php echo e($item->PRODCT_SERIAL_NUMBER); ?><br>
                                       <div data-input-name="PRODCT_NAME">ชื่อ: <?php echo e($item->PRODCT_NAME); ?></div>
                                    </div>

                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <label class="input-group-text">รหัส:</label>
                                          <input class="form-control" id="PRODCT_SERIAL_NUMBER" name="PRODCT_SERIAL_NUMBER" type="text" value="<?php echo e($item->PRODCT_SERIAL_NUMBER); ?>" disabled>
                                       </div>
                                       <div class="input-group">
                                          <span class="input-group-text">ชื่อ:</span>
                                          <input class="form-control" id="PRODCT_NAME" name="PRODCT_NAME" data-original-value="<?php echo e($item->PRODCT_NAME); ?>" type="text"
                                                 value="<?php echo e($item->PRODCT_NAME); ?>">
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-center"><?php echo e($item->UNIT_TH_NAME); ?></td>
                              <td class="text-center">
                                 <div class="form-container">
                                    <div class="view-mode"><?php echo e(number_format($item->PRODCT_QTY, 0)); ?></div>
                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <input class="PRODCT_QTY form-control" name="PRODCT_QTY" type="number" value="<?php echo e($item->PRODCT_QTY); ?>" disabled min="1" step="1">
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-center">
                                 <div class="form-container">
                                    <div class="view-mode" data-input-name="PRODCT_CURRENT_PRICE"><?php echo e(number_format(round($item->PRODCT_CURRENT_PRICE, 2), 2)); ?></div>
                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <input class="PRODCT_CURRENT_PRICE form-control" name="PRODCT_CURRENT_PRICE" data-original-value="<?php echo e($item->PRODCT_CURRENT_PRICE); ?>" type="number"
                                                 value="<?php echo e($item->PRODCT_CURRENT_PRICE); ?>" step="0.01">
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-center">
                                 <div class="form-container">
                                    <div class="view-mode"><?php echo e(number_format(round($item->PRODCT_QTY * $item->PRODCT_CURRENT_PRICE, 2), 2)); ?></div>
                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <input class="form-control total" type="text" value="<?php echo e(number_format(round($item->PRODCT_QTY * $item->PRODCT_CURRENT_PRICE, 2), 2)); ?>" disabled
                                                 placeholder="ราคาทั้งหมด">
                                       </div>
                                    </div>
                                 </div>
                              </td>

                              <td class="text-center">
                                 <div class="form-container">
                                    <div class="view-mode">0</div>
                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <input class="PRODCT_WITHDRAW_QTY form-control" name="PRODCT_WITHDRAW_QTY" data-max="<?php echo e($item->PRODCT_QTY - $item->PRODCT_USED_QTY); ?>"
                                                 data-original-value="0" type="number" value="0" min="0" step="1">
                                       </div>
                                    </div>
                                 </div>
                              </td>
                              <td class="text-left">
                                 จำนวนเบิก(ล่าสุด): <span data-input-name="PRODCT_WITHDRAW_QTY" style="color: rgb(24, 131, 24)"><?php echo e($item->PRODCT_WITHDRAW_QTY); ?></span><br>
                                 ใช้ไป: <span data-input-name="PRODCT_USED_QTY"><?php echo e($item->PRODCT_USED_QTY); ?>/<?php echo e($item->PRODCT_QTY); ?></span>
                              </td>

                              <td>
                                 <div class="form-container">
                                    <div class="view-mode" data-input-name="PRODCT_REASON">
                                       <?php if($item->PRODCT_REASON): ?>
                                          <?php echo e($item->PRODCT_REASON); ?>

                                       <?php else: ?>
                                          <strong style="color: crimson;">โปรดระบุเหตุผล</strong>
                                       <?php endif; ?>
                                    </div>
                                    <div class="edit-mode" style="display: none;">
                                       <div class="input-group">
                                          <textarea class="form-control" id="PRODCT_REASON" name="PRODCT_REASON" data-original-value="<?php echo e($item->PRODCT_REASON); ?>" rows="2"><?php echo e($item->PRODCT_REASON); ?></textarea>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </form>

                           <td class="text-center align-middle" style="white-space: nowrap">
                              <div class="view-mode">
                                 <div class="btn-group mb-2" role="group">
                                    <button class="btn btn-primary btn-sm edit-btn" type="button">แก้ไข</button>
                                    <form class="p-0" action="<?php echo e(route('insidewarehouses.destroy_equip', $item->PRODCT_ID)); ?>" method="POST" onsubmit="return confirm('Delete?')">
                                       <?php echo csrf_field(); ?>
                                       <?php echo method_field('DELETE'); ?>
                                       <button class="btn btn-secondary btn-sm" type="submit">ลบ</button>
                                    </form>
                                 </div>
                                 <div>
                                    <?php if(Auth::user()->id == '114000041'): ?>
                                       <form id="approval-form-<?php echo e($item->PRODCT_ID); ?>" action="<?php echo e(route('insidewarehouses.approved_list_product', $item->PRODCT_ID)); ?>" method="POST">
                                          <?php echo csrf_field(); ?>
                                          <?php echo method_field('PATCH'); ?>

                                          <?php if($item->REQ_APPROVED_ID == 0): ?>
                                             <span class="badge bg-secondary">ไม่ได้ขออนุมัติ</span>
                                          <?php elseif($item->REQ_APPROVED_ID == 1): ?>
                                             <div class="btn-group" id="button-group-<?php echo e($item->PRODCT_ID); ?>" role="group">
                                                <button class="btn btn-success btn-sm" type="button" onclick="submitApproval(<?php echo e($item->PRODCT_ID); ?>, 2)">อนุมัติ</button>
                                                <button class="btn btn-secondary btn-sm" type="button" onclick="submitApproval(<?php echo e($item->PRODCT_ID); ?>, 3)">ไม่อนุมัติ</button>
                                             </div>
                                          <?php elseif($item->REQ_APPROVED_ID == 2): ?>
                                             <span class="badge bg-success">ผ่านอนุมัติ
                                                <button class="btn btn1 btn-warning" type="button" onclick="submitApproval(<?php echo e($item->PRODCT_ID); ?>, 1)"><i class="fa-solid fa-xmark"></i></button>
                                             </span>
                                          <?php elseif($item->REQ_APPROVED_ID == 3): ?>
                                             <span class="badge bg-danger">ไม่ผ่านอนุมัติ
                                                <button class="btn btn1 btn-warning" type="button" onclick="submitApproval(<?php echo e($item->PRODCT_ID); ?>, 1)"><i class="fa-solid fa-xmark"></i></button>
                                             </span>
                                          <?php endif; ?>
                                       </form>
                                    <?php endif; ?>

                                    <?php if(Auth::user()->id != '114000041'): ?>
                                       <?php if($item->REQ_APPROVED_ID == 0): ?>
                                          <span class="badge bg-secondary">ยังไม่ส่งขออนุมัติ</span>
                                       <?php elseif($item->REQ_APPROVED_ID == 1): ?>
                                          <span class="badge bg-warning text-dark">รออนุมัติ ติดต่อหน.การเงิน</span>
                                       <?php elseif($item->REQ_APPROVED_ID == 2): ?>
                                          <span class="badge bg-success">ผ่านอนุมัติ</span>
                                       <?php elseif($item->REQ_APPROVED_ID == 3): ?>
                                          <span class="badge bg-danger">ไม่ผ่านอนุมัติ</span>
                                       <?php endif; ?>
                                    <?php endif; ?>
                                 </div>
                              </div>
                              <div class="edit-mode" style="display: none;">
                                 <div class="btn-group" role="group">
                                    <button class="btn btn-success btn-sm" form="equip-form-<?php echo e($item->PRODCT_ID); ?>" type="submit">บันทึก</button>
                                    <button class="btn btn-secondary btn-sm cancel-btn" type="button">ยกเลิก</button>
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
   </div>

   <?php echo $__env->make('insidewarehouses.modal_edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php echo $__env->make('insidewarehouses.modal_add_product', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <script>
      function generatePdf(id) {
         $.ajax({
            url: '/insidewarehouses/get-plan-status/' + id,
            method: 'GET',
            success: function(response) {
               if (response.error) {
                  toastr.error(response.error);
               } else {

                  // ตรวจสอบรายการที่ PRODCT_USED === 'Y'
                  const usedItems = response.filter(item => item.PRODCT_USED === 'Y');

                  // ตรวจสอบว่ามีรายการที่ถูกเลือกหรือไม่ (PRODCT_USED === 'Y')
                  if (usedItems.length === 0) {
                     toastr.warning('โปรดเลือกรายการวัสดุที่ใช้งาน');
                     return;
                  }


                  // ตรวจสอบทุกรายการต้องมี REQ_APPROVED_ID === '2'
                  const approvedItems = usedItems.filter(item => item.REQ_APPROVED_ID === '2');

                  if (approvedItems.length !== usedItems.length) {
                     toastr.warning('บางรายการยังไม่ได้รับการอนุมัติ ติดต่อหน.การเงิน');
                     return;
                  }

                  // ตรวจสอบทุกรายการต้องมี PRODCT_REASON !== null
                  const reasonValidItems = approvedItems.filter(item => item.PRODCT_REASON !== null);

                  if (reasonValidItems.length !== approvedItems.length) {
                     toastr.warning('โปรดระบุเหตุผลสำหรับทุกรายการที่ถูกเลือก');
                     return;
                  }

                  // ถ้าทุกเงื่อนไขผ่านทั้งหมด
                  window.open('/pdf_generate_product/' + id);
               }
            },
            error: function(xhr, status, error) {
               toastr.error('เกิดข้อผิดพลาดในการดึงข้อมูล: ' + xhr.responseText);
            }
         });
      }

      function submitApprovalStore(planId, reqApprovedId) {
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


      function checkCheckboxes(approvedId) {
         const checkboxes = document.querySelectorAll('input[type="checkbox"]');
         const approvalForm = approvedId === 1 ? document.getElementById('approval-form') : document.getElementById('approval-form-finish');

         const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

         if (!anyChecked) {
            toastr.warning('เลือกอย่างน้อยหนึ่งรายการก่อนที่จะส่งขออนุมัติ!');
         } else {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'REQ_APPROVED_ID';
            input.value = approvedId;

            approvalForm.appendChild(input);
            approvalForm.submit();
         }
      }

      function submitApproval(prodctId, reqApprovedId) {
         const checkbox = document.getElementById(`PRODCT_USED_${prodctId}`);
         if (!checkbox || !checkbox.checked) {
            toastr.warning('เลือกอย่างน้อยหนึ่งรายการก่อนที่จะอนุมัติ!');
            return;
         }

         const form = document.getElementById(`approval-form-${prodctId}`);
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

                  const buttonGroup = document.querySelector(`#button-group-${prodctId}`);

                  if (buttonGroup) {
                     if (reqApprovedId == 2) {
                        buttonGroup.innerHTML = `
                        <span class="badge bg-success">ผ่านอนุมัติ
                           <button type="button" class="btn btn1 btn-warning" onclick="submitApproval(${prodctId}, 1)"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                     `;
                     } else if (reqApprovedId == 3) {
                        buttonGroup.innerHTML = `
                        <span class="badge bg-danger">ไม่ผ่านอนุมัติ
                           <button type="button" class="btn btn1 btn-warning" onclick="submitApproval(${prodctId}, 1)"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                     `;
                     } else if (reqApprovedId == 1) {
                        buttonGroup.innerHTML = `
                        <button type="button" class="btn btn-success btn-sm" onclick="submitApproval(${prodctId}, 2)">อนุมัติ</button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="submitApproval(${prodctId}, 3)">ไม่อนุมัติ</button>
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
         document.querySelectorAll('.PRODCT_WITHDRAW_QTY').forEach(input => {
            input.addEventListener('input', function() {
               let max = parseInt(this.dataset.max, 10);
               let value = parseInt(this.value, 10);

               if (value > max) {
                  toastr.error('จำนวนที่เบิกไม่สามารถเกินจำนวนที่เหลือได้');
                  this.value = max;
               }
            });
         });

         document.querySelectorAll('.PRODCT_QTY, .PRODCT_CURRENT_PRICE').forEach(input => {
            input.addEventListener('input', function() {
               var row = this.closest('tr');
               var qtyInput = row.querySelector('.PRODCT_QTY');
               var priceInput = row.querySelector('.PRODCT_CURRENT_PRICE');
               var totalInput = row.querySelector('.total');

               var qty = parseFloat(qtyInput.value) || 0;
               var price = parseFloat(priceInput.value) || 0;
               var total = qty * price;

               totalInput.value = total.toLocaleString(undefined, {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
               });
            });
         });

         document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            if (checkbox) {
               checkbox.addEventListener('change', function() {
                  let form = this.closest('form');
                  let formData = new FormData(form);

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
                        } else {
                           toastr.error('เกิดข้อผิดพลาด!');
                        }
                     })
                     .catch(error => {
                        console.error('เกิดข้อผิดพลาด:', error);
                     });
               });
            }
         });

         document.querySelectorAll('.edit-btn').forEach(button => {
            if (button) {
               button.addEventListener('click', function() {
                  let row = this.closest('tr');
                  let formContainers = row.querySelectorAll('.form-container');

                  formContainers.forEach(formContainer => {
                     let viewMode = formContainer.querySelector('.view-mode');
                     let editMode = formContainer.querySelector('.edit-mode');
                     if (viewMode) viewMode.style.display = 'none';
                     if (editMode) editMode.style.display = 'block';
                  });

                  let parentTd = this.closest('td');
                  let viewMode = parentTd.querySelector('.view-mode');
                  let editMode = parentTd.querySelector('.edit-mode');

                  if (viewMode && editMode) {
                     viewMode.style.display = 'none';
                     editMode.style.display = 'block';
                  }
               });
            }
         });

         document.querySelectorAll('.cancel-btn').forEach(button => {
            if (button) {
               button.addEventListener('click', function() {
                  let row = this.closest('tr');
                  let formContainers = row.querySelectorAll('.form-container');

                  formContainers.forEach(formContainer => {
                     let viewMode = formContainer.querySelector('.view-mode');
                     let editMode = formContainer.querySelector('.edit-mode');
                     if (viewMode) viewMode.style.display = 'block';
                     if (editMode) editMode.style.display = 'none';

                     editMode.querySelectorAll('input, textarea').forEach(input => {
                        if (input.dataset.originalValue !== undefined) {
                           input.value = input.dataset.originalValue;
                        }
                     });
                  });

                  let parentTd = this.closest('td');
                  let viewMode = parentTd.querySelector('.view-mode');
                  let editMode = parentTd.querySelector('.edit-mode');

                  if (viewMode && editMode) {
                     viewMode.style.display = 'block';
                     editMode.style.display = 'none';
                  }
               });
            }
         });

         document.querySelectorAll('.equip-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
               e.preventDefault();
               const formData = new FormData(this);
               const formId = this.id;

               const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

               fetch(this.action, {
                     method: this.method,
                     headers: {
                        'X-CSRF-TOKEN': csrfToken,
                     },
                     body: formData,
                  })
                  .then(response => response.json())
                  .then(data => {
                     if (data.success) {
                        const parentForm = document.getElementById(formId).closest('tr');

                        const prodctNameElement = parentForm.querySelector('[data-input-name="PRODCT_NAME"]');
                        if (prodctNameElement) {
                           prodctNameElement.innerText = `ชื่อ: ${formData.get('PRODCT_NAME')}`;
                        }
                        const prodctCurrentPriceElement = parentForm.querySelector('[data-input-name="PRODCT_CURRENT_PRICE"]');
                        if (prodctCurrentPriceElement) {
                           const price = parseFloat(formData.get('PRODCT_CURRENT_PRICE')); // แปลงเป็นตัวเลขทศนิยม
                           const formattedPrice = new Intl.NumberFormat('en-US', {
                              style: 'decimal',
                              minimumFractionDigits: 2,
                              maximumFractionDigits: 2
                           }).format(price);
                           prodctCurrentPriceElement.innerText = formattedPrice;
                        }

                        const prodctWithdrawQtyElement = parentForm.querySelector('[data-input-name="PRODCT_WITHDRAW_QTY"]');
                        if (prodctWithdrawQtyElement) {
                           prodctWithdrawQtyElement.innerText = `${formData.get('PRODCT_WITHDRAW_QTY')}`;
                        }
                        const prodctReasonElement = parentForm.querySelector('[data-input-name="PRODCT_REASON"]');
                        if (prodctReasonElement) {
                           prodctReasonElement.innerText = `${formData.get('PRODCT_REASON')}`;
                        }
                        const prodctUsedQtyElement = parentForm.querySelector('[data-input-name="PRODCT_USED_QTY"]');
                        if (prodctUsedQtyElement) {
                           prodctUsedQtyElement.innerText = `${data.PRODCT_USED_QTY}/${data.PRODCT_QTY}`;
                        }

                        toastr.success('อัปเดตสำเร็จ!!');

                        parentForm.querySelectorAll('.edit-mode').forEach(function(editMode) {
                           editMode.style.display = 'none';
                        });
                        parentForm.querySelectorAll('.view-mode').forEach(function(viewMode) {
                           viewMode.style.display = 'block';
                        });
                     }
                  })
                  .catch(error => console.error('Error:', error));
            });
         });

         $('#equip_table').DataTable({
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
            order: [],
            lengthMenu: [
               [20, 50, 100, -1],
               ['20', '50', '100', 'ทั้งหมด']
            ],
            columnDefs: [{
               orderable: false,
               targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
            }, {
               // กำหนดคอลัมน์แรก
               width: '31vh',
               targets: [1, 8]
            }],
         });
      });
   </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/insidewarehouses/show.blade.php ENDPATH**/ ?>