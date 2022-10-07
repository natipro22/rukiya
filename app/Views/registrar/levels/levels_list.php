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
                    <?= form_open(base_url("/levels/delete-level"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Level Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Level Description</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($levels as $level): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="text-uppercase align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($level->COURSE_ID). 
                                            '"/><a href="/users/delete/'.esc($level->COURSE_ID).'"> '.esc($level->COURSE_NAME).'</a></td>';
                                    echo '<td class="text-uppercase align-middle text-sm">'.esc($level->COURSE_DESC).'</td>';
                                    echo '<td class="align-middle text-center text-sm">'.esc($level->COURSE_LEVEL).'</td>';
//                                    echo '<td class="align-middle text-center text-sm">'.esc($level->ACCOUNT_TYPE).'</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('levels/new-level') ?>"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>