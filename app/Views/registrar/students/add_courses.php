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
                    <?= form_open(base_url("/sections/student-enrollment/add-courses/{$section}/{$schoolyr}/{$student}")) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Course
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Credit Hour</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Section</th>
                                    <!--<th class="text-uppercase text-secondary text-sm font-weight-bolder">Date Enrolled</th>-->
                                    <!--<th class="text-uppercase text-secondary text-sm font-weight-bolder">Options</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course):
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($course->STUDSUBJ_ID). 
                                            '"/>'.esc($course->SUBJ_CODE).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->SUBJ_DESCRIPTION).'</td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($course->UNIT).'</td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($course->SECTION_NAME).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram btn-sm text-capitalize " href="<?= site_url('/sections/student-enrollment/enrolled-courses/'
                                .esc($section,'url').'/'.esc($schoolyr,'url').'/'.esc($student,'url')) ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button type="submit" class="btn btn-instagram btn-sm text-capitalize "><span class="fa fa-plus-circle mx-1"> </span> Add Selected</button>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>