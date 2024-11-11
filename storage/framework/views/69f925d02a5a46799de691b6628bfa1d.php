<?php $__env->startSection('contents'); ?>
    <div class="container-fluid">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a class="btn btn-danger" href="/" role="button">ย้อนกลับ</a>
        </div>
        <hr />
        <h1 class="text-center mb-4" style="color: #555555"></h1>
        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col mb-3">
                <a href="<?php echo e(route('maintenances')); ?>" class="card-link">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <span style="font-size: 20px; white-space: nowrap;">บำรุงรักษา</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_1); ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col mb-3">
                <a href="<?php echo e(route('repairs')); ?>" class="card-link">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">

                            <span style="font-size: 20px; white-space: nowrap;">ซ่อม</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_2); ?></span>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col mb-3">
                <a href="<?php echo e(route('contractservices')); ?>" class="card-link">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">

                            <span style="font-size: 20px; white-space: nowrap;">จ้างเหมาบริการ</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_3); ?></span>

                        </div>
                    </div>
                </a>

            </div>
            <div class="col mb-3">
                <a href="<?php echo e(route('calibrations')); ?>" class="card-link">
                    <div class="card h-100">

                        <div class="card-body d-flex flex-column">

                            <span style="font-size: 20px; white-space: nowrap;">สอบเทียบเครื่องมือ</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_4); ?></span>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col mb-3">
                <a href="<?php echo e(route('replacements')); ?>" class="card-link">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <span style="font-size: 20px; white-space: nowrap;">เพิ่มศักยภาพ</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_5); ?></span>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col mb-3">
                <a href="<?php echo e(route('potentials')); ?>" class="card-link">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">

                            <span style="font-size: 20px; white-space: nowrap;">ทดแทน</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_6); ?></span>

                        </div>
                    </div>
                </a>

            </div>
            <div class="col mb-3">
                <a href="<?php echo e(route('noserials')); ?>" class="card-link">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <span style="font-size: 20px; white-space: nowrap;">ไม่มีเลขครุภัณฑ์</span>
                            <span style="font-size: 16px; white-space: nowrap;">จำนวน: <?php echo e($PLAN_7); ?></span>
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
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                background-color: rgb(76, 164, 247);
                color: #000000
            }
        </style>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/financial_test/resources/views/select_plan.blade.php ENDPATH**/ ?>