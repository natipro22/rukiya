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
                    <?= form_open(base_url("/instructors/delete-instructor"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Full Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Address</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Gender</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Specialization</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Email Address</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Load</th>  
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($instructors as $inst): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($inst->USER_ID). 
                                            '"/><a href="/instructors/delete/'.esc($inst->INST_ID).'"> '.esc($inst->INST_FULLNAME).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($inst->INST_ADDRESS).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($inst->INST_SEX).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($inst->SPECIALIZATION).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($inst->INST_EMAIL).'</td>';
                                    echo '<td class="align-middle text-center text-sm"><a href="'. site_url('instructors/loads/'. esc(encrypt_url($inst->INST_ID,'url'),'url')).'"><span class="fa fa-list"></span> List of Loads</a></td>';
                                    echo '</tr>';
                                    
                                endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('instructors/new-instructor') ?>"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>