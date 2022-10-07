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
                    <?= form_open(base_url("/sections/delete-section"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Section Description</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Entrance Year</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Options</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Enrollment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sections as $section): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($section->SECTION_ID). 
                                            '"/><a href="'.site_url('/sections/edit-section/'. encrypt_url(esc($section->SECTION_ID,'url'))).'"> '.esc($section->SECTION_NAME).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($section->SECTION_DESC).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($section->YEAR).'</td>';
                                    echo '<td class="align-middle text-sm"><a class="" href="'.esc(site_url('/sections/students/'.encrypt_url($section->SECTION_ID)),'attr').
                                        '"><span class="fa fa-list"></span>  Students</a></td>';
                                    echo '<td class="align-middle text-sm"><a href="'. esc(site_url('/sections/enrollments/'.encrypt_url($section->SECTION_ID)),'attr').
                                        '"><span class="fa fa-list"></span>  Enrollments</a></td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('/sections/add-section') ?>"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>