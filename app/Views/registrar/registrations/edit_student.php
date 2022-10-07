<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
    <div class="row">
        <div class="mb-2">
            <div class="card mb-1">
                <div class="card-header pb-0">
                    <h4>Registration Form</h4>
                    <hr class="horizontal dark mt-2">
                </div>
                <div class="card-body">
                    <?= form_open(base_url('/registration/edit-student/'. encrypt_url($student->IDNO))) ?>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext">ID NO</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="idno" type="text" name="id_no" value="<?= old('id_no') ?? $student->IDNO ?>" placeholder="ID NO"  autocomplete="off" readonly />
                                    <?= display_error(session('validation'), 'id_no') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="firstname" class="form-control-plaintext">First Name *</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="firstname" type="text" name="fname" value="<?= old('fname') ?? $student->FNAME ?>" placeholder="First Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'fname') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="fathername" class="form-control-plaintext">Fathers Name *</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="fathername" type ="text" name="mname" value="<?= old('mname') ?? $student->MNAME ?>" placeholder="Father Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'mname') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="gfathername" class="form-control-plaintext">Grand Fathers Name *</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="gfatehrname" type="text" name="lname" value="<?= old('lname') ?? $student->LNAME ?>" placeholder="Grand Father Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'lname') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="sex" class="form-control-plaintext">Gender</label>
                                <div class="mb-3">
                                    <select class="form-control form-select form-select-sm" id="sex" name="gender">
                                        <option <?= old('gender') == 'F' ? 'selected' : ($student->SEX == 'F' ? 'selected' : '')  ?> value="F">Female</option>
                                        <option <?= old('gender') == 'M' ? 'selected' : ($student->SEX == 'M' ? 'selected' : '')  ?> value="M">Male</option>
                                        <option <?= old('gender') == 'O' ? 'selected' : ($student->SEX == 'O' ? 'selected' : '')  ?> value="O">Other</option>
                                    </select>
                                    <?= display_error(session('validation'), 'gender') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="bdate" class="form-control-plaintext">Birth Date</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="bdate" type ="date" name="bday" value="<?= old('bday') ?? $student->BDAY ?>" placeholder=""  autocomplete="off" />
                                    <?= display_error(session('validation'), 'bday') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="bp" class="form-control-plaintext">Birth Place</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="bp" type="text" name="bplace" value="<?= old('bplace') ?? $student->BPLACE ?>" placeholder="Birth Place eg: Dessie"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'bplace') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="contacts" class="form-control-plaintext">Contact</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="contacts" type="text" name="contact" value="<?= old('contact') ?? $student->CONTACT_NO ?>" placeholder="Phone Number"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'contact') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="email" class="form-control-plaintext">Email *</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type ="email" name="email" value="<?= old('email') ?? $student->EMAIL ?>" placeholder="Email eg: example@gmail.com"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'email') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group">
                                <label for="dept" class="form-control-plaintext">Department</label>
                                <div class="mb-3">
                                    <select class="form-control form-select form-select-sm" id="dept" name="dept">
                                        <?php
                                        echo '<option>Departments</option>';
                                        foreach ($departments as $dept):
                                            echo '<option '.((old('dept') == $dept->DEPARTMENT_NAME || $student->DEPARTMENT == $dept->DEPARTMENT_NAME) ? 'selected' : '').' value="'.esc($dept->DEPARTMENT_NAME,'attr').'">'.esc($dept->DEPARTMENT_NAME).'</option>';
                                        endforeach; ?>
                                    </select>
                                    <?= display_error(session('validation'), 'dept') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-lg-3">
                            <div class="form-group">
                                <label for="prog" class="form-control-plaintext">Programs</label>
                                <div class="mb-3">
                                    <select class="form-control form-select form-select-sm" id="prog" name="program">
                                        <?php
                                        echo '<option>Programs</option>';
                                        foreach ($programs as $prog):
                                            
                                            echo '<option '.((old('program') == $prog->PROGRAM_NAME || $student->PROGRAM == $prog->PROGRAM_NAME) ? 'selected' : '').' value="'.esc($prog->PROGRAM_NAME,'attr').'">'.esc($prog->PROGRAM_NAME).'</option>';
                                        endforeach; ?>
                                    </select>
                                    <?= display_error(session('validation'), 'program') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-4 col-lg-5">
                            <div class="form-group">
                                <label for="home" class="form-control-plaintext">Home Address</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="home" type ="text" name="home_address" value="<?= old('home_address') ?? $student->HOME_ADD ?>" placeholder="Home Address"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'home_address') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <hr class="horizontal dark mt-2 p-2">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="f_name" class="form-control-plaintext">Father</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="f_name" value="<?= old('f_name') ?? $student->FATHER ?>" placeholder="Father Name"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'f_name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="f_occu" class="form-control-plaintext">Father Occupation</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="f_occu" value="<?= old('f_occu') ?? $student->FATHER_OCCU ?>" placeholder="Father Occupation"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'f_occu') ?>
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                        <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="m_name" class="form-control-plaintext">Mother</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="m_name" value="<?= old('m_name') ?? $student->MOTHER ?>" placeholder="Mother Name"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'm_name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="m_occu" class="form-control-plaintext">Mother Occupation</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="m_occu" value="<?= old('m_occu') ?? $student->MOTHER_OCCU ?>" placeholder="Mother Occupation"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'm_occu') ?>
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                        <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="g_name" class="form-control-plaintext">Guardian</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="g_name" value="<?= old('g_name') ?? $student->GUARDIAN ?>" placeholder="Guardian Name"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'g_name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="g_ad" class="form-control-plaintext">Guardian Address</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="g_ad" type="text" name="g_address" value="<?= old('g_address') ?? $student->GUARDIAN_ADDRESS ?>" placeholder="Guardian Occupation"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'g_address') ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                        <hr class="horizontal dark mt-2 p-2">
                        <div class="row">
                        <div class="col-md-6 col-sm-5 col-lg-6">
                            <div class="form-group">
                                <label for="g_10" class="form-control-plaintext">Grade 10 High School Name</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="g_10" type="text" name="g_10_sc" value="<?= old('g_10_sc') ?? $student->G10SC_NAME ?>" placeholder="High School Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'g_10_sc') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="g_10_res" class="form-control-plaintext">Grade Point/Result</label>
                                <div class="mb-3">
                                    <input id="g_10_res" class="form-control form-control-sm" type="text" name="g_10_res" value="<?= old('g_10_res') ?? $student->G10_VAL ?>" placeholder="Point/Result"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'g_10_res') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="g_10_yr" class="form-control-plaintext">Year</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="number" name="g_10_yr" value="<?= old('g_10_yr') ?? $student->G10_YEAR ?>" placeholder="Academic Year"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'g_10_yr') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6 col-sm-5 col-lg-6">
                            <div class="form-group">
                                <label for="g_12_sc" class="form-control-plaintext">Grade 12 High School Name</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="g_12_sc" value="<?= old('g_12_sc') ?? $student->G12SC_NAME ?>" placeholder="High School Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'g_12_sc') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="g_12_res" class="form-control-plaintext">Grade Point/Result</label>
                                <div class="mb-3">
                                    <input id="g_12_res" class="form-control form-control-sm" type="text" name="g_12_res" value="<?= old('g_12_res') ?? $student->G12_VAL ?>" placeholder="Point/Result"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'g_12_res') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="g_12_yr" class="form-control-plaintext">Year</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type ="text" name="g_12_yr" value="<?= old('g_12_yr') ?? $student->G12_YEAR ?>" placeholder="Academic Year"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'g_12_yr') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6 col-sm-5 col-lg-6">
                            <div class="form-group">
                                <label for="tvetname" class="form-control-plaintext">TVET (12+2) Name of Collage</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="tvetname" type="text" name="tvet_clg" value="<?= old('tvet_clg') ?? $student->G12_2COLLEGE_NAME ?>" placeholder="Collage Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'tvet_clg') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="tvet_res" class="form-control-plaintext">Point/Result</label>
                                <div class="mb-3">
                                    <input id="tvet_res" class="form-control form-control-sm" type="text" name="tvet_res" value="<?= old('tvet_res') ?? $student->G12_2VAL ?>" placeholder="Point/Result"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'tvet_res') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="tvet_yr" class="form-control-plaintext">Year</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="tvet_yr" value="<?= old('tvet_yr') ?? $student->G12_2YEAR ?>" placeholder="Academic Year"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'tvet_yr') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-6 col-sm-5 col-lg-6">
                            <div class="form-group">
                                <label for="tvet-level" class="form-control-plaintext">TVET (Level 3 or Level 4) Name of Collage</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="tvet-level" type="text" name="tvet_level_clg" value="<?= old('tvet_level_clg') ?? $student->LEVEL3_4COLLEGENAME ?>" placeholder="Collage Name"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'tvet_level_clg') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="tvet_level_res" class="form-control-plaintext">Point/Result</label>
                                <div class="mb-3">
                                    <input id="tvet_level_res" class="form-control form-control-sm" type="text" name="tvet_level_res" value="<?= old('tvet_level_res') ?? $student->LEVEL3_4VAL ?>" placeholder="Point/Result"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'tvet_level_res') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="tvet_level_yr" class="form-control-plaintext">Year</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type ="date" name="tvet_level_yr" value="<?= old('tvet_level_yr') ?? $student->DATE_OF_ATTEND ?>" placeholder="Academic Year"  autocomplete="off" />
                                    <?= display_error(session('validation'), 'tvet_level_yr') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-6 col-sm-5 col-lg-6">
                            <div class="form-group">
                                <label for="uni_clg" class="form-control-plaintext">Collage Or University</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type="text" name="uni_clg" value="<?= old('uni_clg') ?? $student->COLLEGE ?>" placeholder="University/Collage Name"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'uni_clg') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="uni_clg_res" class="form-control-plaintext">Point/Result</label>
                                <div class="mb-3">
                                    <input id="uni_clg_res" class="form-control form-control-sm" type="text" name="uni_clg_res" value="<?= old('uni_clg_res') ?? $student->DEGREE ?>" placeholder="Point/Result"  autocomplete="off"/>
                                    <?= display_error(session('validation'), 'uni_clg_res') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3">
                            <div class="form-group">
                                <label for="uni_clg_yr" class="form-control-plaintext">Year</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" type ="date" name="uni_clg_yr" value="<?= old('uni_clg_yr') ?? $student->DATE_OF_AWARE ?>" autocomplete="off" />
                                    <?= display_error(session('validation'), 'uni_clg_yr') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark mt-3 p-2">
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/registration') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                            <button type="submit" name="register" class="btn btn-instagram text-capitalize " ><span class="fas fa-save mx-1"> </span> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?= $this->endSection() ?>
