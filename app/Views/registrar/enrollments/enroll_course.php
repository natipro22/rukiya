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
                <?= form_open(site_url("/sections/enrollments/enroll-course/{$section}/{$schoolyr}")) ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end ">
                                <label for="courses" class="form-control-plaintext"><h6>Courses</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <select class="form-select" id="courses" name="subj_code">
                                        <?php
                                        echo '<option>-- Courses --</option>';
                                        foreach ($courses as $course):
                                            echo old('subj_code') == $course->SUBJ_CODE ? '<option value="'.esc($course->SUBJ_CODE,'attr').'" selected>'.esc($course->SUBJ_DESCRIPTION).'</option>' 
                                                                             : '<option value="'.esc($course->SUBJ_CODE,'attr').'">'.esc($course->SUBJ_DESCRIPTION).'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                    <?= display_error(session('validation'), 'subj_code') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-end ">
                                <label for="inst" class="form-control-plaintext"><h6>Instructors</h6></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                                <div class="mb-3">
                                    <select class="form-select" id="inst" name="instructor">
                                        <?php
                                        echo '<option >-- Instructors --</option>';
                                        foreach ($instructors as $inst):
                                            echo old('instructor') == $inst->INST_ID ? '<option value="'.esc($inst->INST_ID,'attr').'" selected>'.esc($inst->INST_FULLNAME).'</option>' 
                                                                             : '<option value="'.esc($inst->INST_ID,'attr').'">'.esc($inst->INST_FULLNAME).'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                    <?= display_error(session('validation'), 'instructor') ?>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="py-4 px-12">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= esc(site_url("/sections/enrollments/{$section}/{$schoolyr}"),'attr') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
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
