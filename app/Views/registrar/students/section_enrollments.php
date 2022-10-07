<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?></legend>
                    <hr class="horizontal dark mt-2">
                </div>
                <div class="card-body">
                    <?= form_open(base_url("/sections/student-enrollment/enroll-semester/{$section}/{$student}")) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Session
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Semester</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Year</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Date Enrolled</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($enrollments as $enroll): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($enroll->SYID). 
                                            '"/>'.esc($enroll->COURSE_NAME).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($enroll->SEM).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($enroll->AY).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($enroll->START_DATE).'</td>';
                                    echo '<td class="align-middle text-sm"><a href="'. site_url('/sections/student-enrollment/courses/'.esc($section,'url').'/'.esc(encrypt_url($enroll->SYID),'url').'/'.esc($student,'url')).
                                        '"><span class="fa fa-list"></span>  Enrolled Courses</a></td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram btn-sm text-capitalize " href="<?= site_url('/sections/student-enrollment/'.esc($section,'url').'/'.esc($student,'url')) ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button type="submit" class="btn btn-instagram btn-sm text-capitalize "><span class="fa fa-plus-circle mx-1"> </span> Enroll Selected</button>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>