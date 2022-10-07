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
                <?= form_open(site_url('/courses/edit-course/'.encrypt_url(esc($course->SUBJ_CODE)))) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class="form-control form-control-plaintext"><h6>Course Code</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="name" type="text" name="subj_code" value="<?= old('subj_code') ?? $course->SUBJ_CODE ?>" placeholder="Course Name"/>
                                <?= display_error(session('validation'), 'subj_code') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="desc" class=" form-control form-control-plaintext"><h6>Course Description</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="desc" type="text" name="subj_desc" value="<?= old('subj_desc') ?? $course->SUBJ_DESCRIPTION ?>" placeholder="Course Description"/>
                                <?= display_error(session('validation'), 'subj_desc') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="unit" class=" form-control form-control-plaintext"><h6>Credit Hour</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="unit" type="number"  name="subj_unit" value="<?= old('subj_unit') ?? $course->UNIT ?>" placeholder="Credit Hour"/>
                                <?= display_error(session('validation'), 'subj_unit') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="cthr" class=" form-control form-control-plaintext"><h6>Contact Hour</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="cthr" type="number"  name="subj_cthr" value="<?= old('subj_cthr') ?? $course->CT_HR ?>" placeholder="Contact Hour"/>
                                <?= display_error(session('validation'), 'subj_cthr') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="lab" class=" form-control form-control-plaintext"><h6>Lab Hour</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="lab" type="number"  name="subj_lab" value="<?= old('subj_lab') ?? $course->LAB ?>" placeholder="Lab Hour"/>
                                <?= display_error(session('validation'), 'subj_lab') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="pre" class="form-control form-control-plaintext"><h6>Prerequisite</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <select class="form-select" id="pre" name="subj_pre">
                                    <?php
                                    echo '<option value="">--Courses--</option>';
//                                    
                                    foreach ($courses as $cr):
                                        
                                        echo (old('subj_pre') == $cr->SUBJ_CODE || $course->PRE_REQUISITE == $cr->SUBJ_CODE)  ? '<option value="'.esc($cr->SUBJ_CODE,'attr').'" selected>'.esc($cr->SUBJ_DESCRIPTION).'</option>' 
                                                                                   : '<option value="'.esc($cr->SUBJ_CODE,'attr').'">'.esc($cr->SUBJ_DESCRIPTION).'</option>';
                                    endforeach;
                                    ?>
                                </select>
                                <?= display_error(session('validation'), 'subj_pre') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/courses') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize" name="save_only" value="saveonly" type="submit"> <span class="fas fa-save mx-1"> </span> Save</button>
                        <!--<button class="btn btn-instagram text-capitalize" name="save_and_back" value="saveandback" type="submit" > <span class="fas fa-save mx-1"> </span> Save and add new</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>