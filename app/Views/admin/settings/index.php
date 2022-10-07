<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
<div class="row mt-2">
    <div class="col-lg-7 ">
        <div class="card h-100 p-3">
            <div class="card-header position-relative text-center text-decoration-underline text-decoration-underline pb-2">
                <legend><?= esc($title) ?></legend>
                <hr class="horizontal dark mt-3">
            </div>
            <?= form_open(site_url('/settings/update')) ?>
            <div class="overflow-hidden border-radius-lg bg-cover h-100">
                <span class="mask"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext text-lg">System Name</label>
                                <div class="mb-3">
                                    <input class="form-control" id="idno" type="text" name="system_name" 
                                           value="<?= old('system_name') ? esc(old('system_name'),'attr') : $setting[0] ?>" placeholder="System Name"  autocomplete="off" />
                                           <?= display_error(session('validation'), 'system_name') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext text-lg">University/College Name</label>
                                <div class="mb-3">
                                    <input class="form-control" id="idno" type="text" name="company_name" 
                                           value="<?= old('company_name') ? esc(old('company_name'),'attr') : $setting[1] ?>" placeholder="University/College"  autocomplete="off" />
                                           <?= display_error(session('validation'), 'company_name') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext text-lg">Campus Name</label>
                                <div class="mb-3">
                                    <input class="form-control" id="idno" type="text" name="campus_name" 
                                           value="<?= old('campus_name') ? esc(old('campus_name'),'attr') : $setting[2] ?>" placeholder="Campus Name"  autocomplete="off" />
                                           <?= display_error(session('validation'), 'campus_name') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext text-lg">Address/Location</label>
                                <div class="mb-3">
                                    <input class="form-control" id="idno" type="text" name="address" 
                                           value="<?= old('address') ? esc(old('address'),'attr') : $setting[3] ?>" placeholder="System Name"  autocomplete="off" />
                                           <?= display_error(session('validation'), 'address') ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- comment -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext text-lg">Website/Email</label>
                                <div class="mb-3">
                                    <input class="form-control" id="idno" type="text" name="website" 
                                           value="<?= old('website') ? esc(old('website'),'attr') : $setting[4] ?>" placeholder="System Name"  autocomplete="off" />
                                           <?= display_error(session('validation'), 'website') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext text-lg">PO.Box</label>
                                <div class="mb-3">
                                    <input class="form-control" id="idno" type="text" name="pobox" 
                                           value="<?= old('pobox') ? esc(old('pobox'),'attr') : $setting[5] ?>" placeholder="System Name"  autocomplete="off" />
                                           <?= display_error(session('validation'), 'pobox') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark mt-3">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="sex" class="form-control-plaintext text-lg">Sidenav Type</label>
                                <div class="mb-3">
                                    <select class="form-select" id="sex" name="sidenav">
                                        <option value="transparent" <?= old('sidenav') == 'transparent' || $setting[6] == 'transparent' ? esc('selected','attr') : '' ?> >Transparent</option>
                                        <option value="white" <?= old('sidenav') == 'white' || $setting[6] == 'white' ? esc('selected','attr') : '' ?>>White</option>
                                    </select>
                                    <?= display_error(session('validation'), 'sidenav') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class=" mt-3">
                            <h6 class="mb-0">Navbar Fixed</h6>
                        </div>
                        <div class="form-check form-switch ps-3">
                            <input class="form-check-input mt-1 ms-auto " name="topnav" <?= old('topnav') == 'fixed' || $setting[7] == 'fixed' ? esc('checked','attr'): '' ?> value="fixed" type="checkbox" id=""> <!-- onclick="navbarFixed(this)" -->
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="row mt-3">
                        <div class="btn-group">
                            <button class="btn btn-instagram text-capitalize" name="save" value="save" type="submit"> <span class="fas fa-save mx-1"> </span> Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
    <div class="col-lg-5 mb-lg-0">
        <div class=" h-100">
            <div class="card mb-3">
            <div class="card-header text-decoration-underline text-decoration-underline pb-2">
                <legend>Change Logo</legend>
                <hr class="horizontal dark mt-1">
            </div>
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                <span class="mask"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    <div class="form-group">
                        <div class="width-100px height-100px text-center">
                            <img src="<?= esc(site_url('/public/assets/img/logo.png'), 'attr') ?>" alt="...">
                        </div>
                        
                        <div class="form-control mt-4">
                            <input type="file" id="img" accept="image/png,image/jpeg" name="logo">
                        </div>
                        <div class="row mt-3">
                            <div class="btn-group">
                                <button class="btn btn-instagram text-capitalize" name="save" value="save" type="submit"> <span class="fas fa-save mx-1"> </span> Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card p-3 pb-12">
            <div class="card-header text-decoration-underline text-decoration-underline pb-12">
                <legend></legend>
                <hr class="horizontal dark mt-1">
            </div>
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                <span class="mask"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    
                </div>
            </div>
            
        </div>
        </div>
        
    </div>
    
</div>  
    <!--</div>-->
    <?= $this->endSection() ?>