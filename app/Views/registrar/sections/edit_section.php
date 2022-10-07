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
                <?= form_open(site_url('/sections/edit-section/'.encrypt_url(esc($section->SECTION_ID,'url')))) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class=" form-control form-control-plaintext"><h6>Section Name</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="name" type="text" name="section_name" value="<?= old('section_name') ?? $section->SECTION_NAME ?>" placeholder="Section Name"/>
                                <?= display_error(session('validation'), 'section_name') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="desc" class=" form-control form-control-plaintext"><h6>Section Description</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="desc" type="text" name="section_desc" value="<?= old('section_desc') ?? $section->SECTION_DESC ?>" placeholder="Section Description"/>
                                <?= display_error(session('validation'), 'section_desc') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="year" class=" form-control form-control-plaintext"><h6>Enterance Year</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <input class="form-control" id="year" type="text" name="section_year" value="<?= old('section_year') ?? $section->YEAR ?>" placeholder="Section Entrance Year"/>
                                <?= display_error(session('validation'), 'section_year') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="dept" class=" form-control form-control-plaintext"><h6>Section Department</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-md-2">
                                <select class="form-select" id="dept" name="department">
                                        <?php
                                        echo '<option>--Departments--</option>';
                                        foreach ($departments as $dept):
                                            echo (old('department') == $dept || $section->DEPARTMENT == $dept) ? '<option value="'.esc($dept,'attr').'" selected>'.esc($dept).'</option>' 
                                                                            : '<option value="'.esc($dept,'attr').'">'.esc($dept).'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                    <?= display_error(session('validation'), 'department') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/sections') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize" name="save_only" value="saveonly" type="submit"> <span class="fas fa-save mx-1"> </span> Update</button>
                        <!--<button class="btn btn-instagram text-capitalize" name="save_and_back" value="saveandback" type="submit" > <span class="fas fa-save mx-1"> </span> Save and add new</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<?= $this->endSection() ?>