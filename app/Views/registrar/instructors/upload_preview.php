<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?> Table</legend>
                    <!--<hr class="bold"> comment -->
                </div>
                <div class="card-body">
<!--                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext">Department</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="idno" type="text" name="department" value="<?= esc('') ?>" placeholder="Department" readonly/>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="firstname" class="form-control-plaintext">Program</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="firstname" type="text" name="program" value="<?= esc('') ?>" placeholder="Program" readonly/>
                                    
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <?= form_open(base_url("/instructors/class-students/update-grade-excel/{$instructor}/{$course}/{$section}")) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th width="16%" class="text-uppercase text-secondary text-sm font-weight-bolder"> ID NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">First</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Second</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Third</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Fourth</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Fifth</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Total</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Final</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Total</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    $ASSESSMENT = $student['FIRST'] + $student['SECOND'] + $student['THIRD'] + $student['FOURTH'] + $student['FIFTH'];
                                    echo '<td width="16%" class="align-middle text-sm" ><input class="form-control form-control-sm" name="id[]"'
                                            . 'type="hidden" value="'.esc($student['GRADE_ID']).'" readonly/>'.esc($student['IDNO']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" value="'.esc($student['FIRST']).'" readonly/>'.esc($student['FIRST']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" value="'.esc($student['SECOND']).'" readonly/>'.esc($student['SECOND']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" value="'.esc($student['THIRD']).'" readonly/>'.esc($student['THIRD']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" value="'.esc($student['FOURTH']).'" readonly/>'.esc($student['FOURTH']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" value="'.esc($student['FIFTH']).'" readonly/>'.esc($student['FIFTH']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" name="assessment[]" value="'.esc($ASSESSMENT).'" readonly/>'.esc($ASSESSMENT).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" name="final[]" value="'.esc($student['FINAL']).'" readonly/>'.esc($student['FINAL']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" name="total[]" value="'.esc($student['TOTAL']).'" readonly/>'.esc($student['TOTAL']).'</td>';
                                    echo '<td class="text-center align-middle text-sm" ><input class="form-control form-control-sm" '
                                            . 'type="hidden" name="grade[]" value="'.esc($student['GRADE']).'" readonly/>'.esc($student['GRADE']).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/instructors/class/upload-grade/'.esc($instructor,'url').'/'.esc($course,'url').'/'.esc($section,'url')) ?>"><span class="fa fa-backward mx-1"> </span> Cancel</a>
                            <button type="submit" name="upload" value="upload" class="btn btn-instagram text-capitalize " >Continue<span class="fa fa-forward mx-1"> </span> </button>
                        </div>
                    </div>
                    
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <!--</div>-->
</div>
<?= $this->endSection() ?>


