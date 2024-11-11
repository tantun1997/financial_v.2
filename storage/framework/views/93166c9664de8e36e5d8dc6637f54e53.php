<?php $__env->startSection('title', 'รายงานข้อมูลงบประมาณ - แผนวัสดุคลังย่อย'); ?>

<?php $__env->startSection('contents'); ?>
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <a class="btn btn-danger" href="javascript:history.back()">ย้อนกลับ</a>
   </div>
   <hr>
   <div class="row row-cols-1 row-cols-lg-3 g-4">
      <div class="col">
         <a href="<?php echo e(route('store_report', ['name_report' => 'administration_report'])); ?>" class="card-link">
            <div class="card">
               <div class="card-body">
                  <span style="font-size: 22px; color: #007bff;">ด้านอำนวยการ</span>
                  <table class="table">
                     <thead>
                        <tr>
                           <th></th>
                           <th>วัสดุนอกคลัง</th>
                           <th>วัสดุในคลัง</th>

                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>วงเงิน(บาท)</td>
                           <td> <?php echo e(number_format($Administration30, 2)); ?></td>
                           <td> <?php echo e(number_format($Administration31, 2)); ?></td>
                        </tr>

                        <tr>
                           <td colspan="3" style="text-align: center">วงเงินรวม
                              <strong><?php echo e(number_format($Administration30 + $Administration31, 2)); ?></strong>
                              บาท
                           </td>
                        </tr>
                     </tbody>
                  </table>

               </div>
            </div>
         </a>
      </div>
      <div class="col">
         <a href="<?php echo e(route('store_report', ['name_report' => 'nursing_report'])); ?>" class="card-link">
            <div class="card">
               <div class="card-body">
                  <span style="font-size: 22px; color: #007bff;">ด้านการพยาบาล</span>
                  <table class="table">
                     <thead>
                        <tr>
                           <th></th>
                           <th>วัสดุนอกคลัง</th>
                           <th>วัสดุในคลัง</th>
                        </tr>

                     </thead>
                     <tbody>
                        <tr>
                           <td>วงเงิน(บาท)</td>
                           <td> <?php echo e(number_format($Nursing30, 2)); ?></td>
                           <td> <?php echo e(number_format($Nursing31, 2)); ?></td>
                        </tr>

                        <tr>
                           <td colspan="3" style="text-align: center">วงเงินรวม
                              <strong><?php echo e(number_format($Nursing30 + $Nursing31, 2)); ?></strong>
                              บาท
                           </td>
                        </tr>
                     </tbody>
                  </table>

               </div>
            </div>
         </a>
      </div>
      <div class="col">
         <a href="<?php echo e(route('store_report', ['name_report' => 'secondary_report'])); ?>" class="card-link">
            <div class="card">
               <div class="card-body">
                  <span style="font-size: 22px; color: #007bff;">ด้านบริการทุติยภูมิและตติยภูมิ</span>
                  <table class="table">
                     <thead>
                        <tr>
                           <th></th>
                           <th>วัสดุนอกคลัง</th>
                           <th>วัสดุในคลัง</th>
                        </tr>

                     </thead>
                     <tbody>
                        <tr>
                           <td>วงเงิน(บาท)</td>
                           <td> <?php echo e(number_format($Secondary30, 2)); ?></td>
                           <td> <?php echo e(number_format($Secondary31, 2)); ?></td>
                        </tr>

                        <tr>
                           <td colspan="3" style="text-align: center">วงเงินรวม
                              <strong><?php echo e(number_format($Secondary30 + $Secondary31, 2)); ?></strong>
                              บาท
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </a>

      </div>
      <div class="col">
         <a href="<?php echo e(route('store_report', ['name_report' => 'primary_report'])); ?>" class="card-link">
            <div class="card">
               <div class="card-body">
                  <span style="font-size: 22px; color: #007bff;">ด้านบริการปฐมภูมิ</span>
                  <table class="table">
                     <thead>
                        <tr>
                           <th></th>
                           <th>วัสดุนอกคลัง</th>
                           <th>วัสดุในคลัง</th>
                        </tr>

                     </thead>
                     <tbody>
                        <tr>
                           <td>วงเงิน(บาท)</td>
                           <td> <?php echo e(number_format($Primary30, 2)); ?></td>
                           <td> <?php echo e(number_format($Primary31, 2)); ?></td>
                        </tr>

                        <tr>
                           <td colspan="3" style="text-align: center">วงเงินรวม
                              <strong><?php echo e(number_format($Primary30 + $Primary31, 2)); ?></strong>
                              บาท
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </a>

      </div>
      <div class="col">
         <a href="<?php echo e(route('store_report', ['name_report' => 'supporting_report'])); ?>" class="card-link">
            <div class="card">
               <div class="card-body">
                  <h4 style="font-size: 22px; color: #007bff;">ด้านพัฒนาระบบบริการและสนับสนุนบริการสุขภาพ</h4>
                  <table class="table">
                     <thead>
                        <tr>
                           <th></th>
                           <th>วัสดุนอกคลัง</th>
                           <th>วัสดุในคลัง</th>
                        </tr>

                     </thead>
                     <tbody>
                        <tr>
                           <td>วงเงิน(บาท)</td>
                           <td> <?php echo e(number_format($Supporting30, 2)); ?></td>
                           <td> <?php echo e(number_format($Supporting31, 2)); ?></td>
                        </tr>

                        <tr>
                           <td colspan="3" style="text-align: center">วงเงินรวม
                              <strong><?php echo e(number_format($Supporting30 + $Supporting31, 2)); ?></strong>
                              บาท
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </a>
      </div>
   </div>
   <style>
      .card-link {
         text-decoration: none;
         color: inherit;
         transition: transform 0.3s ease;
         display: block;
      }

      .card {
         background-color: #ffffff;
         border-radius: 15px;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         transition: transform 0.2s, box-shadow 0.2s;
         overflow: hidden;
      }

      .card:hover {
         transform: translateY(-5px);
         box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
         background-color: rgb(159, 221, 250);
         color: #000000
      }
   </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/report/financial_store_report.blade.php ENDPATH**/ ?>