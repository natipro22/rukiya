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
                    <?= form_open(base_url("/sections/assign-students/". encrypt_url($section))) ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> ID NO
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Full Name</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Gender</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Birth Date</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Email Address</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($student->IDNO). 
                                            '"/><a href="/users/delete/'.esc($student->IDNO).'"> '.esc($student->IDNO).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($student->FNAME).' '.esc($student->MNAME).' '.esc($student->LNAME).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($student->SEX).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student->BDAY).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student->EMAIL).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($student->DEPARTMENT).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/sections/students/'. encrypt_url($section)) ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-plus-circle mx-1"> </span> Assign Selected</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>