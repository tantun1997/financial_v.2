<?php $__env->startSection('title', 'รายงานข้อมูลงบประมาณ - แผนจัดซื้อจัดจ้าง'); ?>

<?php $__env->startSection('contents'); ?>
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>
   </div>
   <br>
   <ul class="nav nav-tabs" id="myTab">
      <li class="nav-item">
         <button class="nav-link active" id="plan_true-tab" data-bs-toggle="tab" data-bs-target="#plan_true" type="button" aria-controls="plan_true" aria-selected="true">แผนจริง</button>
      </li>
      <li class="nav-item">
         <button class="nav-link" id="plan_spare-tab" data-bs-toggle="tab" data-bs-target="#plan_spare" type="button" aria-controls="plan_spare" aria-selected="false">แผนสำรอง</button>
      </li>

   </ul>
   <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="plan_true" aria-labelledby="plan_true-tab">
         <table id="dataTable1" class="table-bordered table-hover table-sm table" style="width: 100%;">
            <thead>
               <tr style="background-color: rgb(209, 209, 209)">
                  <th>แผนก</th>
                  <th>วงเงินทั้งหมด(บาท)</th>
                  <th>ใช้แล้ว(บาท)</th>
                  <th>คงเหลือ(บาท)</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $seenNames = [];
               ?>
               <?php $__currentLoopData = $plan_true; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!in_array($item->TCHN_LOCAT_NAME, $seenNames)): ?>
                     <?php
                        $seenNames[] = $item->TCHN_LOCAT_NAME;
                        $totalPrice_deptId = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
                            ->where('TCHN_LOCAT_NAME', $item->TCHN_LOCAT_NAME)
                            ->where('USAGE_STATUS_ID', 1)
                            ->sum('Total_Price');
                        $totalCurrentPrice_deptId = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
                            ->where('TCHN_LOCAT_NAME', $item->TCHN_LOCAT_NAME)
                            ->where('USAGE_STATUS_ID', 1)
                            ->sum('Total_Current_Price');
                     ?>
                     <tr class="clickable-row" data-bs-toggle="collapse" data-bs-target="#itemDetail1<?php echo e($key); ?>" aria-expanded="false" aria-controls="itemDetail1<?php echo e($key); ?>"
                         style="cursor: pointer; background-color: rgb(157, 193, 248)">
                        <td class="click_sharp"><?php echo e($item->TCHN_LOCAT_NAME); ?></td>
                        <td><?php echo e(number_format(round($totalPrice_deptId), 2)); ?> </td>
                        <td><?php echo e(number_format(round($totalCurrentPrice_deptId), 2)); ?></td>
                        <td><?php echo e(number_format(round($totalPrice_deptId - $totalCurrentPrice_deptId), 2)); ?></td>
                     </tr>
                  <?php endif; ?>
                  <?php
                     $detailItems = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
                         ->where('WK_Group', $name_group)
                         ->where('USAGE_STATUS_ID', 1)
                         ->where('deptId', $item->deptId)
                         ->get();
                  ?>
                  <?php $__currentLoopData = $detailItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr id="itemDetail1<?php echo e($key); ?>" class="collapse">
                        <td>
                           <?php if($query->TYPE_NUMBER == 1): ?>
                              <a href="<?php echo e(route('maintenances', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 2): ?>
                              <a href="<?php echo e(route('repairs', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 3): ?>
                              <a href="<?php echo e(route('contractservices', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 4): ?>
                              <a href="<?php echo e(route('calibrations', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 5): ?>
                              <a href="<?php echo e(route('potentials', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 6): ?>
                              <a href="<?php echo e(route('replacements', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 7): ?>
                              <a href="<?php echo e(route('noserials', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 8): ?>
                              <a href="<?php echo e(route('outsidewarehouses', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 9): ?>
                              <a href="<?php echo e(route('insidewarehouses', ['deptId' => $query->deptId, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php endif; ?>
                        </td>
                        <td>
                           <?php echo e(number_format(round($query->Total_Price), 2)); ?>

                        </td>
                        <td>
                           <?php echo e(number_format(round($query->Total_Current_Price), 2)); ?>


                        </td>
                        <td><?php echo e(number_format(round($query->Total_Price - $query->Total_Current_Price), 2)); ?>

                        </td>
                     </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

         </table>

      </div>
      <div class="tab-pane" id="plan_spare" aria-labelledby="plan_spare-tab">
         <table id="dataTable2" class="table-bordered table-hover table-sm table" style="width: 100%;">
            <thead>
               <tr style="background-color: rgb(209, 209, 209)">
                  <th>แผนก</th>
                  <th>วงเงินทั้งหมด(บาท)</th>
                  <th>ใช้แล้ว(บาท)</th>
                  <th>คงเหลือ(บาท)</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $seenNames = [];
               ?>

               <?php $__currentLoopData = $plan_spare; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(!in_array($item->TCHN_LOCAT_NAME, $seenNames)): ?>
                     <?php
                        $seenNames[] = $item->TCHN_LOCAT_NAME;
                        $totalPrice_deptId = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
                            ->where('TCHN_LOCAT_NAME', $item->TCHN_LOCAT_NAME)
                            ->where('USAGE_STATUS_ID', 2)

                            ->sum('Total_Price');
                        $totalCurrentPrice_deptId = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
                            ->where('TCHN_LOCAT_NAME', $item->TCHN_LOCAT_NAME)
                            ->where('USAGE_STATUS_ID', 2)

                            ->sum('Total_Current_Price');
                     ?>
                     <tr class="clickable-row" data-bs-toggle="collapse" data-bs-target="#itemDetail2<?php echo e($key); ?>" aria-expanded="false" aria-controls="itemDetail2<?php echo e($key); ?>"
                         style="cursor: pointer; background-color: rgb(157, 193, 248)">
                        <td class="click_sharp"><?php echo e($item->TCHN_LOCAT_NAME); ?></td>
                        <td><?php echo e(number_format(round($totalPrice_deptId), 2)); ?> </td>
                        <td><?php echo e(number_format(round($totalCurrentPrice_deptId), 2)); ?></td>
                        <td><?php echo e(number_format(round($totalPrice_deptId - $totalCurrentPrice_deptId), 2)); ?></td>
                     </tr>
                  <?php endif; ?>
                  <?php
                     $detailItems = DB::table('แผนครุภัณฑ์_วงเงินแต่ละแผนก_ใหม่')
                         ->where('WK_Group', $name_group)
                         ->where('USAGE_STATUS_ID', 2)
                         ->where('TCHN_LOCAT_NAME', $item->TCHN_LOCAT_NAME)
                         ->get();
                  ?>
                  <?php $__currentLoopData = $detailItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr id="itemDetail2<?php echo e($key); ?>" class="collapse">
                        <td>
                           <?php if($query->TYPE_NUMBER == 1): ?>
                              <a href="<?php echo e(route('maintenances', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 2): ?>
                              <a href="<?php echo e(route('repairs', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 3): ?>
                              <a href="<?php echo e(route('contractservices', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 4): ?>
                              <a href="<?php echo e(route('calibrations', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 5): ?>
                              <a href="<?php echo e(route('potentials', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 6): ?>
                              <a href="<?php echo e(route('replacements', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 7): ?>
                              <a href="<?php echo e(route('noserials', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 8): ?>
                              <a href="<?php echo e(route('outsidewarehouses', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php elseif($query->TYPE_NUMBER == 9): ?>
                              <a href="<?php echo e(route('insidewarehouses', ['TCHN_LOCAT_NAME' => $query->TCHN_LOCAT_NAME, 'USAGE_STATUS_ID' => $query->USAGE_STATUS_ID])); ?>" target="_blank">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="-5 0 20 27" style="fill: rgba(0, 0, 0, 1);">
                                    <path d="m9 19 8-7-8-7z"></path>
                                 </svg> <?php echo e($query->TYPE_NAME); ?>

                              </a>
                           <?php endif; ?>
                        </td>
                        <td>
                           <?php echo e(number_format(round($query->Total_Price), 2)); ?>

                        </td>
                        <td>
                           <?php echo e(number_format(round($query->Total_Current_Price), 2)); ?>


                        </td>
                        <td><?php echo e(number_format(round($query->Total_Price - $query->Total_Current_Price), 2)); ?>

                        </td>
                     </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
         </table>
      </div>

   </div>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/report/plan_report.blade.php ENDPATH**/ ?>