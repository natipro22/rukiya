<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                <legend><?= esc($title) ?></legend>
                <!--<hr class="bold"> comment -->
            </div>
            <div class="card-body">
                <?= form_open(site_url('/levels/add-level')) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class="form-control form-control-plaintext"><h6>Level Name</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="name" type="text" name="level_name" value="<?= old('level_name') ?>" placeholder="Level Name"/>
                                <?= display_error(session('validation'), 'level_name') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="address" class=" form-control form-control-plaintext"><h6>Level Description</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="address" type="text" name="level_desc" value="<?= old('level_desc') ?>" placeholder="Level Description"/>
                                <?= display_error(session('validation'), 'level_desc') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="level" class=" form-control form-control-plaintext"><h6>Level NO</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="level" type="number"  name="level_no" value="<?= old('level_no') ?>" placeholder="Level Number"/>
                                <?= display_error(session('validation'), 'level_no') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-6">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/levels') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize" name="save_only" value="saveonly" type="submit"> <span class="fas fa-save mx-1"> </span> Save</button>
                        <button class="btn btn-instagram text-capitalize" name="save_and_back" value="saveandback" type="submit" > <span class="fas fa-save mx-1"> </span> Save and add new</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>