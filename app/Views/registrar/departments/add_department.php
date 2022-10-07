<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                <legend><?= esc($title) ?> Table</legend>
                <!--<hr class="bold"> comment -->
            </div>
            <div class="card-body">
                <?= form_open(site_url('/departments/add-department')) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class=" form-control form-control-plaintext"><h6>Department Name</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="name" type="text" name="dept_name" value="<?= old('dept_name') ?>" placeholder="Department Name"/>
                                <?= display_error(session('validation'), 'dept_name') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="desc" class=" form-control form-control-plaintext"><h6>Department Description</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="desc" type="text" name="dept_desc" value="<?= old('dept_desc') ?>" placeholder="Department Description"/>
                                <?= display_error(session('validation'), 'dept_desc') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="duration" class=" form-control form-control-plaintext"><h6>Department Duration</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="duration" min="1" max="9" type="number" name="dept_duration" value="<?= old('dept_duration') ?>" placeholder="Department Duration"/>
                                <?= display_error(session('validation'), 'dept_duration') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="desc" class=" form-control form-control-plaintext"><h6>Faculty</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <select class="form-select" id="facult" name="faculty">
                                        <?php
                                        echo '<option>--Faculty--</option>';
                                        foreach ($faculties as $faculty):
                                            echo old('faculty') == $faculty->FACULTY_ID ? '<option value="'.esc($faculty->FACULTY_ID,'attr').'" selected>'.esc($faculty->FACULTY_NAME).'</option>' 
                                                                            : '<option value="'.esc($faculty->FACULTY_ID,'attr').'">'.esc($faculty->FACULTY_NAME).'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                    <?= display_error(session('validation'), 'faculty') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-6">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/departments') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
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