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
                    <?= form_open(base_url("/sections/student-enrollment/drop-courses/{$section}/{$schoolyr}/{$student}/"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Course id
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Credit<br>Hour</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">First<br>Test</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Second<br>Test</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Third<br>Test</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Fourth<br>Test</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Final</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Total</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($course->GRADE_ID). 
                                            '"/><a href="/sections/enrollments/edit-course/'.esc(encrypt_url($course->STUDSUBJ_ID),'url').'"> '.esc($course->SUBJ_CODE).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->SUBJ_DESCRIPTION).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->UNIT).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->FIRST).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->SECOND).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->THIRD).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->FOURTH).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->FINAL).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->TOTAL).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->GRADE).'</td>';
//                                    echo '<td class="align-middle text-center text-sm">'.esc($course->REMARKS).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/sections/student-enrollment/'.esc($section,'url').'/'.esc($student,'url')) ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/sections/student-enrollment/add-courses/'.esc($section,'url').'/'
                                .esc($schoolyr,'url').'/'.esc($student,'url')) ?>"><span class="fa fa-plus-circle mx-1"> </span> Add Course</a>
                        <button class="btn btn-instagram text-capitalize " type="submit"><span class="fa fa-trash-alt mx-1"> </span> Drop Selected</button>
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/sections/student-enrollment/enrolled-courses/download-report/'
                                .esc($schoolyr,'url').'/'.esc($student,'url'))?>"><span class="fa fa-download mx-1"> </span> Download Grade Report</a>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>