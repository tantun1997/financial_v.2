<?php $__env->startSection('title', 'รายงานข้อมูลงบประมาณ'); ?>

<?php $__env->startSection('contents'); ?>
   <div class="container-fluid">
      <div class="row row-cols-1 row-cols-lg-6">
         <div class="col mb-3 text-center">
            <a href="<?php echo e(route('financial_plan_report')); ?>" class="card-link">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column">
                     <span style="font-size: 20px;">แผนจัดซื้อจัดจ้าง</span>
                  </div>
               </div>
            </a>
         </div>
         <div class="col mb-3 text-center">
            <a href="<?php echo e(route('financial_store_report')); ?>" class="card-link">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column">
                     <span style="font-size: 20px;">แผนวัสดุคลังย่อย</span>
                  </div>
               </div>
            </a>
         </div>
      </div>

      <style>
         .card-link {
            text-decoration: none;
            transition: transform 0.3s ease;
            display: block;
         }

         .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s, box-shadow 0.2s;
            min-height: auto;
            /* Allow card to expand automatically */
         }

         .card-body {
            flex-grow: 1;
            /* Make the card body expand to fill the card */
            display: flex;
            justify-content: center;
            align-items: center;
         }

         .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background-color: rgb(76, 164, 247);
            color: #000000;
         }

         h4 {
            word-wrap: break-word;
            /* Allow long text to wrap */
            white-space: normal;
            /* Allow text to wrap to the next line */
         }
      </style>

   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/report/select_plan_report.blade.php ENDPATH**/ ?>