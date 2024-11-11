<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      <i class="fa fa-university fa-2x"></i>
      <div class="sidebar-brand-text mx-2">
         ระบบบริหารงบประมาณค่าใช้จ่าย </div>
   </a>

   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">

   <!-- Nav Item - Dashboard -->
   <div class="sidebar-heading" style="font-size: 12px">
      แผนจัดซื้อจัดจ้าง
   </div>
   <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <i class="fas fa-fw fa-folder"></i>
         <span>แผนจัดซื้อจัดจ้าง</span>
      </a>

      <div id="collapseOne" class="{{ Route::is('maintenances', 'repairs', 'contractservices', 'calibrations', 'potentials', 'replacements', 'noserials', 'projectworks') ? 'show' : '' }} collapse"
           aria-labelledby="headingOne" data-parent="#accordionSidebar">
         <div class="collapse-inner rounded bg-white py-2">
            <a class="collapse-item {{ request()->is('maintenances') ? 'active' : '' }}" href="{{ route('maintenances') }}"><i class="fa-regular fa-clipboard"></i> บำรุงรักษา</a>
            <a class="collapse-item {{ request()->is('repairs') ? 'active' : '' }}" href="{{ route('repairs') }}"><i class="fa-regular fa-clipboard"></i> ซ่อม
            </a>
            <a class="collapse-item {{ request()->is('contractservices') ? 'active' : '' }}" href="{{ route('contractservices') }}"><i class="fa-regular fa-clipboard"></i> จ้างเหมาบริการ</a>
            <a class="collapse-item {{ request()->is('calibrations') ? 'active' : '' }}" href="{{ route('calibrations') }}"><i class="fa-regular fa-clipboard"></i> สอบเทียบเครื่องมือ
            </a>
            <a class="collapse-item {{ request()->is('replacements') ? 'active' : '' }}" href="{{ route('replacements') }}"><i class="fa-regular fa-clipboard"></i> ทดแทน</a>
            <a class="collapse-item {{ request()->is('potentials') ? 'active' : '' }}" href="{{ route('potentials') }}"><i class="fa-regular fa-clipboard"></i> เพิ่มศักยภาพ
            </a>
            <a class="collapse-item {{ request()->is('noserials') ? 'active' : '' }}" href="{{ route('noserials') }}"><i class="fa-regular fa-clipboard"></i> ไม่มีเลขครุภัณฑ์</a>
            {{-- <a class="collapse-item {{ request()->is('projectworks') ? 'active' : '' }}"
                    href="{{ route('projectworks') }}"><i class="fa-regular fa-clipboard"></i> งานโครงการ</a> --}}
         </div>
      </div>
      <a class="nav-link" href="{{ route('select_plan_close') }}">
         <i class="fas fa-fw fa-folder"></i>
         <span>แผนถูกปิดใช้งาน</span>
      </a>
   </li>

   <div class="sidebar-heading" style="font-size: 12px">
      วัสดุคลังย่อย
   </div>
   <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_store" aria-expanded="true" aria-controls="collapse_store">
         <i class="fas fa-fw fa-folder"></i>
         <span>วัสดุคลังย่อย</span>
      </a>
      <div id="collapse_store" class="{{ Route::is('outsidewarehouses', 'insidewarehouses') ? 'show' : '' }} collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
         <div class="collapse-inner rounded bg-white py-2">
            <a class="collapse-item {{ request()->is('outsidewarehouses') ? 'active' : '' }}" href="{{ route('outsidewarehouses') }}"><i class="fa-regular fa-clipboard"></i> วัสดุนอกคลัง</a>
            <a class="collapse-item {{ request()->is('insidewarehouses') ? 'active' : '' }}" href="{{ route('insidewarehouses') }}"><i class="fa-regular fa-clipboard"></i> วัสดุในคลัง
            </a>
         </div>
      </div>
   </li>
   <!-- Divider -->
   <hr class="sidebar-divider d-none d-md-block">
   @if (Auth::user()->isAdmin == 'Y')
      <div class="sidebar-heading" style="font-size: 12px">
         เมนูแอดมิน
      </div>
      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>เมนูแอดมิน</span>
         </a>
         <div id="collapseTwo" class="{{ Route::is('select_approved', 'select_plan_report') ? 'show' : '' }} collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="collapse-inner rounded bg-white py-2">
               <a class="collapse-item {{ request()->is('select_plan_report') ? 'active' : '' }}" href="{{ route('select_plan_report') }}"><i class="fa-regular fa-clipboard"></i>
                  รายงานข้อมูลงบประมาณ</a>
               @if (Auth::user()->id == '114000041')
                  <a class="collapse-item {{ request()->is('select_approved') ? 'active' : '' }}" href="{{ route('select_approved') }}"><i class="fa-regular fa-clipboard"></i>
                     ขออนุมัติ
                  </a>
               @endif

            </div>
         </div>
      </li>
   @endif
   <!-- Sidebar Toggler (Sidebar) -->
   <div class="d-none d-md-inline text-center">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>

</ul>
