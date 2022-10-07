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
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Course id</th>
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
                                    echo '<td class="align-middle text-sm"><a href="/sections/enrollments/edit-course/'.esc(encrypt_url($course->STUDSUBJ_ID),'url').'"> '.esc($course->SUBJ_CODE).'</a></td>';
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
                        <a class="btn btn-instagram btn-sm text-capitalize" href="<?= site_url('/student/enrollments/') ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>