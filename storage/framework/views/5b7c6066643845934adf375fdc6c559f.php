<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>ระบบสร้างแผนงานครุภัณฑ์</title>
      <!-- Custom fonts for this template-->
      <link href="<?php echo e(asset('admin_assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="<?php echo e(asset('admin_assets/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
   </head>
   <style>
      .img-border {
         border: 2px solid #bbb9b9;
         /* กำหนดความหนาและสีของกรอบ */
         border-radius: 5px;
         /* ทำให้มุมกรอบโค้ง */
         padding: 2px;
         /* ระยะห่างระหว่างรูปภาพกับกรอบ */
      }
   </style>

   <body class="bg-gradient-primary">
      <div class="container">
         <!-- Outer Row -->
         <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
               <div class="card o-hidden my-5 border-0 shadow-lg">
                  <div class="card-body p-0">
                     <!-- Nested Row within Card Body -->
                     <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                           <img src="assets/img/img-cartoon.png" class="w-100 img-border" alt="Logo">
                        </div>
                        <div class="col-lg-6">
                           <div class="p-5">
                              <div class="text-center">
                                 <h1 class="h4 mb-4 text-gray-900">ระบบบริหารงบประมาณค่าใช้จ่าย</h1>
                              </div>
                              <form action="<?php echo e(route('login.action')); ?>" method="POST" class="user">
                                 <?php echo csrf_field(); ?>
                                 <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                       <ul>
                                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <li><?php echo e($error); ?></li>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       </ul>
                                    </div>
                                 <?php endif; ?>
                                 <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-user" id="exampleInputUsername" placeholder="ชื่อล็อกอิน...">
                                 </div>
                                 <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="รหัสผ่าน">
                                 </div>
                                 <button type="submit" class="btn btn-primary btn-block btn-user mt-4">เข้าสู่ระบบ</button>
                              </form>
                           </div>
                           <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript-->
      <script src="<?php echo e(asset('admin_assets/vendor/jquery/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
      <!-- Core plugin JavaScript-->
      <script src="<?php echo e(asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
      <!-- Custom scripts for all pages-->
      <script src="<?php echo e(asset('admin_assets/js/sb-admin-2.min.js')); ?>"></script>
   </body>

</html>
<?php /**PATH /var/www/financial_test/resources/views/auth/login.blade.php ENDPATH**/ ?>