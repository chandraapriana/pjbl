<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-image: linear-gradient(180deg,#9b4ceb 10%,	#7c45e1 100%)";>

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book-open"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Edumark</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider ">

  <!-- QUERY MENU -->



   <!-- LOOPING MENU -->

     <div class="sidebar-heading">
       Menu
     </div>

        <?php if ($menu=="dashboard"): ?>
          <li class="nav-item active">
        <?php else: ?>
          <li class="nav-item">
        <?php endif; ?>
         <a class="nav-link pb-0" href="<?= base_url('siswa') ?>">
           <i class="fas fa-tachometer-alt"></i>
           <span>Dashboard</span>
         </a>
       </li>
       <?php if ($menu=="profile"): ?>
         <li class="nav-item active">
       <?php else: ?>
         <li class="nav-item">
       <?php endif; ?>
         <a class="nav-link pb-0" href="<?= base_url('siswa/profile') ?>">
           <i class="fas fa-user-alt"></i>
           <span>Profile Kelompok</span>
         </a>
       </li>


      <hr class="sidebar-divider mt-3">

      <div class="sidebar-heading">
        Project
      </div>

      <?php if ($menu=="project"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif; ?>
          <a class="nav-link pb-0" href="<?= base_url('siswa/project') ?>">
            <i class="far fa-plus-square"></i>
            <span>Tugas Project</span>
          </a>
        </li>
          <hr class="sidebar-divider mt-3">






  <!-- Divider -->

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
      <i class="fas fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
