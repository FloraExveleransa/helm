<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         <div class="navbar-brand">
           <a class="navbar-brand brand-logo" href="index.html">
             <div class="sidebar-header">
                  <img src="<?php echo base_url('images/motor.png') ?>" alt="logo">
                <div style="font-size: 20px; color: #333; font-weight: bold;">
                  <?= $setting->nama_toko ?>
                </div>
             </div>
          </a>
          <!-- Display Caption Below Logo -->
          <?php if (!empty($flora->caption)): ?>
            <div class="navbar-caption">
              <p><?= htmlspecialchars($flora->caption) ?></p>
            </div>
          <?php endif; ?>
        </div>
        <a class="navbar-brand brand-logo-mini" href="index.html"></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
          <!-- Dropdown Notifikasi -->
<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
  <a class="dropdown-item" href="logout">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M10.5 3a.5.5 0 0 1 .5.5V6h1.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H11V11a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5H4v-2H2.5a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1V1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1.5h1zM10 0h-4a1 1 0 0 0-1 1v1h-1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5H5v2H3.5a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5H10V5h1.5a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5H11V1a1 1 0 0 0-1-1z"/>
    </svg>
    Log Out
  </a>
</div>



<!-- Dropdown Profil -->
<li class="nav-item nav-profile dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
        <img src="<?php echo base_url('images/logo8.png') ?>" alt="User Profile">
    </a>

 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown" style="text-align: center;">
    <a class="nav-link" href="update_profile" aria-controls="ui-basic">Lihat Profile</a>
     <a class="nav-link" href="update_profile" aria-controls="ui-basic">change password</a>
</div>

</li>

          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="tambah note :">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Meeting jam 2
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                     cek transaksi
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                     bimbingan pkl
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
               
                
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">tambah codingan</p>
             
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting dgn pak bos</p>
                        </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>


  <?php
        if(session()->get('level')==1){
          ?>
            <li class="nav-item">
  <a class="nav-link" href="penitipan" aria-controls="ui-basic">
    <i class="fas fa-building menu-icon"></i>
    <span class="menu-title">Data Penitipan</span>
    
  </a>
</li>
  <?php } ?>
 <?php
        if(session()->get('level')==1){
          ?>
            <li class="nav-item">
  <a class="nav-link" href="users" aria-controls="ui-basic">
    <i class="fas fa-building menu-icon"></i>
    <span class="menu-title">Daftar User</span>
    
  </a>
</li>
  <?php } ?>
<!-- <?php
        if(session()->get('level')==1){
          ?>
            <li class="nav-item">
  <a class="nav-link" href="jenishelm" aria-controls="ui-basic">
    <i class="fas fa-building menu-icon"></i>
    <span class="menu-title">Jenis Helm</span>
    
  </a>
</li>
  <?php } ?>
  -->


  <?php
        if(session()->get('level')==1){
          ?>
            <li class="nav-item">
  <a class="nav-link" href="laporanpenitipan" aria-controls="ui-basic">
    <i class="fas fa-building menu-icon"></i>
    <span class="menu-title">Laporan Penitipan</span>
    
  </a>
</li>
  <?php } ?>
  

  <?php
          if(session()->get('level')==1 || session()->get('level') == 2){
            ?>
<li class="nav-item">
  <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
    <i class="fas fa-box menu-icon"></i>
    <span class="menu-title">Riwayat</span>
  </a>
</li>
    </a>
    </li>
           
          
           <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="activity"> Login</a></li>
              </ul>
            </div>
          </li>
            
<?php } ?>

<?php
        if(session()->get('level')==1){
          ?>
            <li class="nav-item">
  <a class="nav-link" href="pt" aria-controls="ui-basic">
    <i class="fas fa-building menu-icon"></i>
    <span class="menu-title">e-Profile </span>
    
  </a>
</li>
  <?php } ?>
<?php
if(session()->get('level') == 1) {
?>
<li class="nav-item">
  <a class="nav-link" href="rak" aria-controls="ui-basic">
    <i class="fas fa-calendar-alt menu-icon"></i> <!-- Changed icon -->
    <span class="menu-title">Rak Helm</span>
  </a>
</li>
<?php } ?>
 

<?php
if(session()->get('level') == 2) {
?>
<li class="nav-item">
  <a class="nav-link" href="jadwal" aria-controls="ui-basic">
    <i class="fas fa-calendar-alt menu-icon"></i> <!-- Changed icon -->
    <span class="menu-title">Kode Penitipan</span>
  </a>
</li>
<?php } ?>


             <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                
                

                </ul>
            </div>
          </li>
                    </li>
        </ul>
      </nav>