<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?> Table</legend>
                    <!--<hr class="bold"> comment -->
                </div>
                <div class="card-body">
                    <?= form_open(base_url("/registration/delete"),"onSubmit='return submitDelete(this);'") ?>
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
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Email Address</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder ps-2">Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($newStudents as $student): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($student->IDNO). 
                                            '"/><a href="'. esc(site_url('/registration/edit-student/'.encrypt_url($student->IDNO)),'attr').'"> '.esc($student->IDNO).'</a></td>';
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
                        <div class="btn-group col-md-auto col-sm-auto col-lg-auto">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('registration/register') ?>"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                            <a class="btn btn-instagram text-capitalize "  href="<?= site_url('registration/upload') ?>"><span class="fa fas fa-file-excel mx-1"> </span> Upload From Spreadsheet</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
<!--                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram btn-sm text-capitalize " href="<?= site_url('registration/register') ?>"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                        <a class="btn btn-instagram btn-sm text-capitalize "  href="<?= site_url('registration/upload') ?>"><span class="fa fas fa-file-excel mx-1"> </span> Upload From Spreadsheet</a>
                        <button type="submit" class="btn btn-instagram btn-sm text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        
                    </div>
                        </div>-->
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <!--</div>-->
</div>
<?= $this->endSection() ?>