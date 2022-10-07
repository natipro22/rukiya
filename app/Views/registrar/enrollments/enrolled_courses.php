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
                    <?= form_open(base_url("/sections/enrollments/delete-course/{$section}/{$schoolyr}"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Course id
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Description</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">instructor</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Pre-requisite</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Credit<br>Hour</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Contact<br>Hour</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Lab<br>Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($course->STUDSUBJ_ID). 
                                            '"/><a href="/sections/enrollments/edit-course/'.esc(encrypt_url($course->STUDSUBJ_ID),'url').'"> '.esc($course->SUBJ_CODE).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->SUBJ_DESCRIPTION).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->INST_FULLNAME).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->PRE_REQUISITE).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->UNIT).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->CT_HR).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->LAB).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-6">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/sections/enrollments/'.esc($section,'url')) ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/sections/enrollments/enroll-course/'.esc($section,'url').'/'.esc($schoolyr,'url')) ?>"><span class="fa fa-plus-circle mx-1"> </span> Add Course</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>