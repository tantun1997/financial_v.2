    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" action="<?php echo e(route('replacements.update', $E_PLAN->PLAN_ID)); ?>">
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
                                <select class="form-select" id="PLAN_SET_YEAR" name="PLAN_SET_YEAR" required>
                                    <option value="" selected hidden>ปีงบประมาณ</option>
                                    <?php
                                        $currentYear = date('Y');
                                        $nextYear2 = $currentYear + 2;
                                        $nextYear = $currentYear + 1;
                                        $displayedNextYear = $nextYear + 543;
                                        $displayedNextYear2 = $nextYear2 + 543;
                                    ?>
                                    <option value="<?php echo e($nextYear2 + 543); ?>"
                                        <?php echo e($E_PLAN->PLAN_SET_YEAR == $nextYear2 + 543 ? 'selected' : ''); ?>>
                                        <?php echo e($displayedNextYear2); ?></option>
                                    <option value="<?php echo e($nextYear + 543); ?>"
                                        <?php echo e($E_PLAN->PLAN_SET_YEAR == $nextYear + 543 ? 'selected' : ''); ?>>
                                        <?php echo e($displayedNextYear); ?></option>
                                    <option value="<?php echo e($currentYear + 543); ?>"
                                        <?php echo e($E_PLAN->PLAN_SET_YEAR == $currentYear + 543 ? 'selected' : ''); ?>>
                                        <?php echo e($currentYear + 543); ?></option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <span>แผนฯ</span>
                                <select class="form-select" id="USAGE_STATUS_ID" name="USAGE_STATUS_ID" required>
                                    <option value="" selected hidden>แผนฯ</option>
                                    <?php $__currentLoopData = $E_USAGE_STATUS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $USAGE_STATUS): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($USAGE_STATUS->USAGE_STATUS_ID); ?>"
                                            <?php echo e($E_PLAN->USAGE_STATUS_ID == $USAGE_STATUS->USAGE_STATUS_ID ? 'selected' : ''); ?>>
                                            <?php echo e($USAGE_STATUS->USAGE_STATUS_NAME); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <span>ชื่อแผนงาน</span>
                                <textarea class="form-control" id="PLAN_NAME" name="PLAN_NAME" placeholder="ชื่อแผนงาน" rows="3" required><?php echo e($E_PLAN->PLAN_NAME); ?></textarea>
                            </div>

                            <div class="col mb-3">
                                <span>ราคาต่อหน่วย </span>
                                <input class="form-control" type="number" id="PLAN_PRICE_PER" name="PLAN_PRICE_PER"
                                    value="<?php echo e($E_PLAN->PLAN_PRICE_PER); ?>" min="1" required>
                            </div>

                            <div class="col mb-3">
                                <span>จำนวนครุภัณฑ์</span>
                                <input class="form-control" type="number" id="PLAN_QTY" name="PLAN_QTY"
                                    value="<?php echo e($E_PLAN->PLAN_QTY); ?>" min="1" required>
                            </div>

                            <div class="col mb-3">
                                <span>ราคาทั้งหมด</span>
                                <input class="form-control" type="text" placeholder="ราคาทั้งหมด"
                                    value="<?php echo e(number_format($E_PLAN->PLAN_PRICE_PER * $E_PLAN->PLAN_QTY, 2)); ?>"
                                    disabled>
                            </div>

                            <div class="col mb-3">
                                <span>เหตุผลและความจำเป็น</span>
                                <textarea class="form-control" id="PLAN_REASON" name="PLAN_REASON" placeholder="เหตุผลและความจำเป็น" rows="3"
                                    required><?php echo e($E_PLAN->PLAN_REASON); ?></textarea>
                            </div>

                            <div class="col mb-3">
                                <span>หมายเหตุ</span>
                                <textarea class="form-control" id="PLAN_REMARK" name="PLAN_REMARK" placeholder="หมายเหตุ (ถ้ามี)" rows="3"><?php echo e($E_PLAN->PLAN_REMARK); ?></textarea>
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
        document.addEventListener('DOMContentLoaded', function() {
            var qtyInput = document.getElementById('PLAN_QTY');
            var priceInput = document.getElementById('PLAN_PRICE_PER');
            var totalInput = document.querySelector('input[disabled][placeholder="ราคาทั้งหมด"]');

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
        });
    </script>
<?php /**PATH /var/www/financial_test/resources/views/replacements/modal_edit.blade.php ENDPATH**/ ?>