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
                    <?= form_open(base_url('/instructors/class-students/'.urlencode(esc($instructor,'url')).'/'.urlencode(esc($course,'url')).'/'.urlencode(esc($section,'url')).'/')) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> IDNO
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Full Name</th>
                                    <!--<th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Credit<br>Hour</th>-->
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">First<br>Exam</th>
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
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($student->GRADE_ID). 
                                            '"/>'.esc($student->IDNO).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student->FNAME).' '.esc($student->MNAME).' '.esc($student->LNAME).'</td>';
//                                    echo '<td class="align-middle text-center text-sm">'.esc($course->UNIT).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->FIRST).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->SECOND).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->THIRD).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->FOURTH).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->FINAL).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->TOTAL).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->GRADE).'</td>';
//                                    echo '<td class="align-middle text-center text-sm">'.esc($course->REMARKS).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/instructors/class/'. urlencode(esc($instructor,'url')).'/'.urlencode(esc($course,'url'))) ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize " type="submit"><span class="fa fa-edit mx-1"> </span> Edit Selected</button>
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/instructors/class/upload-grade/'. urlencode(esc($instructor,'url')).'/'.urlencode(esc($course,'url')).'/'.urlencode(esc($section,'url'))) ?>">
                            <span class="fas fa-upload mx-1"> </span> Upload Grade From Spreadsheet</a>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>