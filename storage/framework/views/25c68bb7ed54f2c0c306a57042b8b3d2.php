    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('outsidewarehouses.update', $E_PLAN->PLAN_ID)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">แก้ไขรายการ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-cols-1 row-cols-lg-4">
                            <div class="col mb-3">
                                <span>ปีงบประมาณ</span>
                                <select class="form-select" id="BUDG_YEAR" name="BUDG_YEAR" required>
                                    <option value="" selected hidden>ปีงบประมาณ</option>
                                    <?php
                                        $currentYear = date('Y');
                                        $nextYear2 = $currentYear + 2;
                                        $nextYear = $currentYear + 1;
                                        $displayedNextYear = $nextYear + 543;
                                        $displayedNextYear2 = $nextYear2 + 543;
                                    ?>
                                    <option value="<?php echo e($nextYear2 + 543); ?>"
                                        <?php echo e($E_PLAN->BUDG_YEAR == $nextYear2 + 543 ? 'selected' : ''); ?>>
                                        <?php echo e($displayedNextYear2); ?></option>
                                    <option value="<?php echo e($nextYear + 543); ?>"
                                        <?php echo e($E_PLAN->BUDG_YEAR == $nextYear + 543 ? 'selected' : ''); ?>>
                                        <?php echo e($displayedNextYear); ?></option>
                                    <option value="<?php echo e($currentYear + 543); ?>"
                                        <?php echo e($E_PLAN->BUDG_YEAR == $currentYear + 543 ? 'selected' : ''); ?>>
                                        <?php echo e($currentYear + 543); ?></option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <span>ประเภทงบ</span>
                                <select class="form-select" id="Budget_ID" name="Budget_ID" required>
                                    <option value="" selected hidden>ประเภทงบ</option>
                                    <?php $__currentLoopData = $E_BUDGET; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $BUDGET): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($BUDGET->Budget_ID); ?>"
                                            <?php echo e($E_PLAN->Budget_ID == $BUDGET->Budget_ID ? 'selected' : ''); ?>>
                                            <?php echo e($BUDGET->Budget_NAME); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <span>ประเภทแผน</span>
                                <select class="form-select" id="TYPE_ID" name="TYPE_ID" required>
                                    <option value="" selected hidden>ประเภทแผน</option>
                                    <?php $__currentLoopData = $E_TYPE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->TYPE_ID); ?>"
                                            <?php echo e($E_PLAN->TYPE_ID == $type->TYPE_ID ? 'selected' : ''); ?>>
                                            <?php echo e($type->TYPE_NAME); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <span>หมวดวัสดุ</span>
                                <input class="form-control" list="categories" id="PRODCT_CAT_ID" name="PRODCT_CAT_ID"
                                    placeholder="หมวดวัสดุ" value="<?php echo e($E_PLAN->PRODCT_CAT_ID); ?>" required>
                                <datalist id="categories">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->PRODCT_CAT_ID); ?>"
                                            data-name="<?php echo e($category->PRODCT_CAT_NAME); ?>"
                                            <?php echo e($E_PLAN->PRODCT_CAT_ID == $category->PRODCT_CAT_ID ? 'selected' : ''); ?>>
                                            <?php echo e($category->PRODCT_CAT_NAME); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                                <input type="hidden" id="PRODCT_CAT_NAME" name="PRODCT_CAT_NAME"
                                    value="<?php echo e($E_PLAN->PRODCT_CAT_NAME); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('PRODCT_CAT_ID').addEventListener('input', function() {
            var options = document.querySelectorAll('#categories option');
            var input = this.value;
            var nameField = document.getElementById('PRODCT_CAT_NAME');

            options.forEach(function(option) {
                if (option.value === input) {
                    nameField.value = option.getAttribute('data-name');
                }
            });
        });

        // Set initial value for PRODCT_CAT_NAME based on the selected PRODCT_CAT_ID
        window.onload = function() {
            var selectedOption = document.querySelector('#categories option[value="<?php echo e($E_PLAN->PRODCT_CAT_ID); ?>"]');
            if (selectedOption) {
                document.getElementById('PRODCT_CAT_NAME').value = selectedOption.getAttribute('data-name');
            }
        };
    </script>
<?php /**PATH /var/www/financial_test/resources/views/outsidewarehouses/modal_edit.blade.php ENDPATH**/ ?>