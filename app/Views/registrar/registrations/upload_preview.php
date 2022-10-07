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
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="idno" class="form-control-plaintext">Department</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="idno" type="text" name="department" value="<?= esc($department) ?>" placeholder="Department" readonly/>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="firstname" class="form-control-plaintext">Program</label>
                                <div class="mb-3">
                                    <input class="form-control form-control-sm" id="firstname" type="text" name="program" value="<?= esc($program) ?>" placeholder="Program" readonly/>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= form_open(base_url("/registration/register")) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> ID NO
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Fullname</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Gender</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Birth Date</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Grade 10</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">year</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Grade 12</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.
                                            esc($student['IDNO'].",".$student['FULLNAME'].",".$student['SEX'].",".$student['BDAY'].",".$department.
                                                ",".$program.",".$student['G10RES'].",".$student['G10YR'].",".$student['G12RES'].",".$student['G12YR']).'"/>'.
                                            esc($student['IDNO']).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student['FULLNAME']).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student['SEX']).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student['BDAY']).'</td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($student['G10RES']).' </td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($student['G10YR']).'</td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($student['G12RES']).'</td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($student['G12YR']).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('registration/register') ?>"><span class="fa fa-backward mx-1"> </span> Cancel</a>
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


