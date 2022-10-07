<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?></legend>
                </div>
                <div class="card-body">
                    <?= form_open(base_url("departments/remove-courses/{$department}")) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Course id
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Description</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Pre-requisite</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Credit Hour</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Contact Hour</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $course): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($course->SUBJDEPT_ID). 
                                            '"/>'.esc($course->SUBJ_CODE).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->SUBJ_DESCRIPTION).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($course->PRE_REQUISITE).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->UNIT).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($course->CT_HR).'</td>';
                                    echo '<td class="text-center align-middle text-center text-sm">'.(esc($course->IS_MAJOR) == true ? 'Major' : 'Minor').'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram btn-sm text-capitalize" href="<?= site_url('/departments/') ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                            <a class="btn btn-instagram btn-sm text-capitalize " href="<?= site_url('/departments/assign-courses/'.esc($department)) ?>" ><span class="fa fa-plus-circle mx-1"> </span> Add Course</a>
                        <button type="submit" class="btn btn-instagram btn-sm text-capitalize " ><span class="fa fa-plus-circle mx-1"> </span> Delete Selected</button>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>