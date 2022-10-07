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
                <?= form_open(site_url('/faculties/add-faculty')) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class="form-control form-control-plaintext"><h6>Faculty Name</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="name" type="text" name="facult_name" value="<?= old('facult_name') ?>" placeholder="Faculty Name"/>
                                <?= display_error(session('validation'), 'facult_name') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="desc" class=" form-control form-control-plaintext"><h6>Faculty Description</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="desc" type="text" name="facult_desc" value="<?= old('facult_desc') ?>" placeholder="Faculty Description"/>
                                <?= display_error(session('validation'), 'facult_desc') ?>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="office" class=" form-control form-control-plaintext"><h6>Office</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="office" min="1" max="9" type="text" name="office_no" value="<?= old('office') ?>" placeholder="Office"/>
                                <?= display_error(session('validation'), 'office_no') ?>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-6">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/faculties') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
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