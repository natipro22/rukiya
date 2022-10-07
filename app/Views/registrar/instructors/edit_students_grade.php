<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?> Table</legend>
                    <hr class="horizontal dark mt-2">
                </div>
                <div class="card-body">
                    <?php foreach ($grades as $grade){
//                                    echo '<tr >';
                                    echo '<input name="gr[]" type="hidden" value="'.esc($grade->GRADE).'"/>';
                                    echo '<input name="min[]" type="hidden" value="'.esc($grade->MIN_VAL).'"/>';
//                                    echo '</tr>';
                                         
                                } ?>
                    <?= form_open(base_url("/instructors/class-students/update-grade/{$instructor}/{$course}/{$section}/")) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">IDNO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Full Name</th>
                                    <!--<th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Credit<br>Hour</th>-->
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2"> First <br>Exam</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Second<br>Exam</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Third<br>Exam</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Fourth<br>Exam</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Final<br>Exam</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Total</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input class="form-control form-control-sm" id="gid" name="id[]" type="hidden" value="'.esc($student->GRADE_ID).'"/>'.esc($student->IDNO).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student->FNAME).' '.esc($student->MNAME).' '.esc($student->LNAME).'</td>';
//                                    echo '<td class="align-middle text-center text-sm">'.esc($course->UNIT).'</td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="first"'
                                        . ' name="first[]" onkeyup="calculate();javascript:checkNumber(this);" type="text" value="'.(esc($student->FIRST) ?? 0).'" /></td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="second" '
                                        . 'name="second[]" onkeyup="calculate();javascript:checkNumber(this);" type="text" value="'.(esc($student->SECOND) ?? 0).'" /></td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="third" '
                                    . 'name="third[]" onkeyup="calculate();javascript:checkNumber(this);" type="text" value="'.(esc($student->THIRD) ?? 0).'" /></td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="fourth" '
                                    . 'name="fourth[]" onkeyup="calculate();javascript:checkNumber(this);" type="text" value="'.(esc($student->FOURTH) ?? 0).'" /></td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="final" '
                                    . 'name="final[]" onkeyup="calculate();javascript:checkNumber(this);" type="text" value="'.(esc($student->FINAL) ?? 0).'" /></td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="total" '
                                    . 'name="total[]" type="text" value="'.(esc($student->TOTAL) ?? 0).'"readonly/></td>';
                                    echo '<td class="align-middle text-center text-sm"><input class="form-control form-control-sm" id="grade" '
                                    . 'name="grade[]" type="text" value="'.(esc($student->GRADE) ?? 'F').'" readonly/></td>';
//                                    echo '<td class="align-middle text-center text-sm">'.esc($course->REMARKS).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/instructors/class-students/'.urlencode(esc($instructor,'url')).'/'.urlencode(esc($course,'url')).'/'.urlencode(esc($section,'url'))) ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize " type="submit"><span class="fa fa-save mx-1"> </span> Save Changes</button>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>