<!DOCTYPE html>
<html lang="th">

<head>
    <title>บันทึกข้อความ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-size: 11pt;
            color: #000;
            direction: ltr;
            font-family: "garuda", sans-serif;
        }

        .tableHeader {
            vertical-align: bottom;
            padding-bottom: 10px;
            font-weight: bold;
        }

        .tableHeader td {
            text-align: center;
            line-height: 28px;
        }

        .tableList {
            font-size: 10pt;
            vertical-align: top;
            border: 1px groove #000000;
        }

        .tableList th {
            text-align: center;
            line-height: 25px;
            padding-left: 3px;
            padding-right: 3px;
            border: 1px groove #000000;
        }

        .tableList td {
            line-height: 25px;
            padding-left: 3px;
            padding-right: 3px;
            border: 1px groove #000000;
        }
    </style>
</head>

<body>
    <table width="100%" class="tableHeader" cellspacing="0" cellpadding="0">
        <tr>
            <td>รายละเอียดแนบท้ายบันทึกข้อความ ที่ สส 0033/ผ.<?php echo e($id); ?> ลงวันที่ <?php echo e($dateExport); ?></td>
        </tr>
        <tr>
            <td>

                งานจัดซื้อพัสดุ จำนวน <?php echo e($Total_Used); ?> รายการ ตามแผน <?php echo e($PLAN_NAME); ?> ประจำปี <?php echo e($PLAN_SET_YEAR); ?>

            </td>
        </tr>
        <tr>
            <td>โดยวิธีเฉพาะเจาะจง ซึ่งมีรายละเอียด ดังต่อไปนี้</td>
        </tr>
    </table>

    <table width="100%" class="tableList" style="margin-bottom: 10px;" cellspacing="0" cellpadding="0">
        <tr>
            <th width="50px">ลำดับ</th>
            <th width="165px">หมายเลขพัสดุ</th>
            <th>รายการ</th>
            <th width="110px">อายุการใช้งาน</th>
            <th width="110px" style="white-space: nowrap">ราคาของครุภัณฑ์</th>
            <th width="110px">ราคาประเมินจริง</th>
        </tr>

        <?php $number = 1 ?>

        <?php $__currentLoopData = $List_Equip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="text-align: center;"><?php echo e($number++); ?></td>
                <td style="text-align: center;"><?php echo e($item->EQUP_SERIAL_NUMBER); ?></td>
                <td style="text-align: left;"><?php echo e($item->EQUP_NAME); ?></td>
                <td style="text-align: center;"><?php echo e($item->EQUP_AGE); ?> ปี</td>
                <td style="text-align: right;"><?php echo e(number_format($item->EQUP_PRICE, 2)); ?></td>
                <td style="text-align: right;"><?php echo e(number_format($item->EQUP_CURRENT_PRICE, 2)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <tr>
            <td colspan="5" style="text-align: left; padding-left: 3px; padding-right: 3px;">รวมเป็นเงินทั้งสิ้น (
                <?php echo e($Remaining_Price_Text); ?> )</td>
            <td style="text-align: right; padding-left: 3px; padding-right: 3px;">
                <?php echo e(number_format(round($Remaining_Price, 2), 2)); ?>

            </td>
        </tr>
    </table>
    <table width="100%" border="0" style="vertical-align: top; padding-top: 20px;">
        <tr>
            <td width="60%"></td>
            <td>
                <table width="100%" border="0" style="vertical-align: top;">
                    <tr>
                        <td width="45px">ลงชื่อ</td>
                        <td class="text_doted_left">&nbsp;</td>
                        <td width="120px">ผู้ขออนุมัติ</td>
                    </tr>
                    <tr>
                        <td width="45px" style="text-align: right;">(</td>
                        <td class="text_doted_left">&nbsp;</td>
                        <td width="120px">)</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>




</body>

</html>
<?php /**PATH /var/www/financial_test/resources/views/pdf/TemplatePage2.blade.php ENDPATH**/ ?>