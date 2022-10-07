<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">SIMS Settings</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close cursor-pointer"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-2">
      <div class="card-body max-height-vh-100 h-100 pt-sm-3 pt-0 overflow-y-scroll">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- System Setting -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="form-group">
                    <label for="idno" class="form-control-plaintext">System Name</label>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" id="idno" type="text" name="system_name" 
                               value="<?= old('system_name') ?>" placeholder="System Name"  autocomplete="off" />
                        <?= display_error(session('validation'), 'system_name') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="form-group">
                    <label for="idno" class="form-control-plaintext">University/College Name</label>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" id="idno" type="text" name="system_name" 
                               value="<?= old('system_name') ? esc(old('system_name'),'attr') : esc(config('Settings')->company,'attr') ?>" placeholder="System Name"  autocomplete="off" />
                        <?= display_error(session('validation'), 'system_name') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="form-group">
                    <label for="idno" class="form-control-plaintext">Campus Name</label>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" id="idno" type="text" name="system_name" 
                               value="<?= old('system_name') ?>" placeholder="System Name"  autocomplete="off" />
                        <?= display_error(session('validation'), 'system_name') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="form-group">
                    <label for="idno" class="form-control-plaintext">Address/Location</label>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" id="idno" type="text" name="system_name" 
                               value="<?= old('system_name') ?>" placeholder="System Name"  autocomplete="off" />
                        <?= display_error(session('validation'), 'system_name') ?>
                    </div>
                </div>
            </div>
        </div><!-- comment -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="form-group">
                    <label for="idno" class="form-control-plaintext">Email</label>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" id="idno" type="text" name="system_name" 
                               value="<?= old('system_name') ?>" placeholder="System Name"  autocomplete="off" />
                        <?= display_error(session('validation'), 'system_name') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="form-group">
                    <label for="idno" class="form-control-plaintext">PO.Box</label>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" id="idno" type="text" name="system_name" 
                               value="<?= old('system_name') ?>" placeholder="System Name"  autocomplete="off" />
                        <?= display_error(session('validation'), 'system_name') ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 " data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2 active" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 " data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2 active" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
      </div>
    </div>
  </div>