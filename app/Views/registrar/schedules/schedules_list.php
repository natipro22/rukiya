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
                    <?= form_open(base_url("/schedules/delete-schedule"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Course Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Section</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Instructor</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Room</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Mon</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Tue</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Wed</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Thu</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Fri</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($schedules as $schedule): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($schedule->SCHEDULE_ID). 
                                            '"/><a href="/users/delete/'.esc($schedule->SCHEDULE_ID).'"> '.esc($schedule->SUBJ_CODE).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($schedule->SECTION_NAME).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($schedule->INST_FULLNAME).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($schedule->ROOM).'</td>';
                                    echo '<td class="align-middle text-sm">'.(esc($schedule->MON) ?? '--').'</td>';
                                    echo '<td class="align-middle text-sm">'.(esc($schedule->TUE) ?? '--').'</td>';
                                    echo '<td class="align-middle text-sm">'.(esc($schedule->WED) ?? '--').'</td>';
                                    echo '<td class="align-middle text-sm">'.(esc($schedule->THU) ?? '--').'</td>';
                                    echo '<td class="align-middle text-sm">'.(esc($schedule->FRI) ?? '--').'</td>';
                                    echo '<td class="align-middle text-sm">'.(esc($schedule->SAT) ?? '--').'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('schedules/create') ?>"><span class="fa fa-plus-circle mx-1"> </span> Create Schedules</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
<!--                    <div class="py-4">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-instagram text-capitalize" href="<?= site_url('/sections/add-section') ?>"><span class="fa fa-plus-circle"> </span> New</a>
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/sections/add-section') ?>"><span class="fa fa-plus-circle "> </span> New</a>
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/sections/add-section') ?>"><span class="fa fa-plus-circle"> </span> New</a>
                            <button type="submit" class="btn btn-instagram text-capitalize "><span class="fa fa-trash-alt"> </span> Delete Selected</button>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>