<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                <legend><?= esc($title) ?></legend>
                <!--<hr class="bold"> comment -->
            </div>
            <div class="card-body">
                <?= form_open(site_url('/instructors/add-instructor')) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class="form-control form-control-plaintext"><h6>Full Name</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="name" type="text" name="inst_name" value="<?= old('inst_name') ?>" placeholder="Instructor Full Name"/>
                                <?= display_error(session('validation'), 'inst_name') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="address" class=" form-control form-control-plaintext"><h6>Address</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="address" type="text" name="inst_address" value="<?= old('inst_address') ?>" placeholder="Address"/>
                                <?= display_error(session('validation'), 'inst_address') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="sex" class=" form-control form-control-plaintext"><h6>Gender</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <select class="form-select" name="inst_sex">
                                    <option>--Gender--</option>
                                    <option value="F" <?= old('inst_sex') == 'F' ? 'selected' : '' ?> >Female</option>
                                    <option value="M" <?= old('inst_sex') == 'M' ? 'selected' : '' ?>>Male</option>
                                    <option value="O" <?= old('inst_sex') == 'O' ? 'selected' : '' ?>>Other</option>
                                </select>
                                <!--<input class="form-control" id="sex" type="text" name="inst_sex" value="<?= old('inst_sex') ?>" placeholder=""/>-->
                                <?= display_error(session('validation'), 'inst_sex') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="specialization" class=" form-control form-control-plaintext"><h6>Specialization</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="specialization" type="text" name="inst_specialization" value="<?= old('inst_specialization') ?>" placeholder="Specialization"/>
                                <?= display_error(session('validation'), 'inst_specialization') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="status" class=" form-control form-control-plaintext"><h6>Employment Status</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="status" type="text" name="inst_status" value="<?= old('inst_status') ?>" placeholder="Employment Status"/>
                                <?= display_error(session('validation'), 'inst_status') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="email" class=" form-control form-control-plaintext"><h6>Email</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="email" type="text" name="inst_email" value="<?= old('inst_email') ?>" placeholder="Email"/>
                                <?= display_error(session('validation'), 'inst_email') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="password" class=" form-control form-control-plaintext"><h6>Password</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="password" type="text" name="inst_password" value="<?= old('inst_password') ?>" placeholder="Password"/>
                                <?= display_error(session('validation'), 'inst_password') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-6">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/instructors') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize" name="save_only" value="saveonly" type="submit"> <span class="fas fa-save mx-1"> </span> Save</button>
                        <button class="btn btn-instagram text-capitalize" name="save_and_back" value="saveandback" type="submit" > <span class="fas fa-save mx-1"> </span> Save and add new</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<?= $this->endSection() ?>