<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                <legend><?= esc($title) ?></legend>
                <hr class="horizontal dark mt-2">
            </div>
            <div class="card-body">
                <?= form_open(site_url("/sections/enrollments/enroll-semester/". encrypt_url($section->SECTION_ID))) ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end ">
                                <label for="sect" class="form-control-plaintext"><h6>Section</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <input type="hidden" id="sect" name="section_id" value="<?= $section->SECTION_ID ?>" readonly>
                                    <input class="form-control" type="text" id="sect" value="<?= $section->SECTION_NAME ?>"  readonly/>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end">
                                <label for="year" class="form-control-plaintext"><h6>Year</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <input class="form-control" name="year" type="text" id="sect" value="<?= $year ?>" readonly/>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end">
                                <label for="lev" class="form-control-plaintext"><h6>Level</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <select class="form-select" id="lev" name="level">
                                        <?php
                                        echo '<option>-- Levels --</option>';
                                        foreach ($levels as $level):
                                            echo old('level') == $level->COURSE_ID ? '<option value="'.esc($level->COURSE_ID,'attr').'" selected>'.esc($level->COURSE_NAME).'</option>' 
                                                                             : '<option value="'.esc($level->COURSE_ID,'attr').'">'.esc($level->COURSE_NAME).'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                    <?= display_error(session('validation'), 'level') ?>
                                    <?= display_error(session('validation'), 'section_id') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end">
                                <label for="inst" class="form-control-plaintext"><h6>Semesters</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <select class="form-select" id="sem" name="semester">
                                        <?php
                                        echo '<option >-- Semesters --</option>';
                                        foreach ($semesters as $semester):
                                            echo old('semester') == $semester->SEM_ID ? '<option value="'.esc($semester->SEM_ID,'attr').'" selected>'.esc($semester->SEM).'</option>' 
                                                                                      : '<option value="'.esc($semester->SEM_ID,'attr').'">'.esc($semester->SEM).'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                    <?= display_error(session('validation'), 'semester') ?>
                                    <?= display_error(session('validation'), 'section_id') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end">
                                <label for="no" class="form-control-plaintext"><h6>Class Begin</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <input class="form-control" name="start_date" type="date" id="no" value="<?= old('start_date') ?? gregorianDate() ?>" placeholder=""/>
                                    <?= display_error(session('validation'), 'start_date') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end">
                                <label for="no" class="form-control-plaintext"><h6>Class End</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <input class="form-control" name="end_date" type="date" id="no" value="<?= old('end_date') ?? gregorianDate('+4 months') ?>" placeholder=""/>
                                    <?= display_error(session('validation'), 'end_date') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end">
                                <label for="no" class="form-control-plaintext"><h6>Number of Courses</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <input class="form-control" name="no_of_subj" min="1"  max="7" type="number" id="no" value="<?= old('no_of_subj') ?>" placeholder="No of Courses"/>
                                    <?= display_error(session('validation'), 'no_of_subj') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="py-4 px-12">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= esc(site_url("/sections/enrollments/". encrypt_url($section->SECTION_ID)),'attr') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
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
