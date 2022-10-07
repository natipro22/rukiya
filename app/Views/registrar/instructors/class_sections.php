<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?></legend>
                    <hr class="horizontal dark mt-2">
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder"> Section Name</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Section Description</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Entrance Year</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sections as $section): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm">'.esc($section->SECTION_NAME).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($section->SECTION_DESC).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($section->YEAR).'</td>';
                                    echo '<td class="align-middle text-sm"><a class="" href="'.site_url('/instructors/class-students/' .urlencode(esc($instructor,'url')).'/'.urlencode(esc($course,'url')).'/'.esc(encrypt_url($section->SECTION_ID),'url')).
                                        '"><span class="fa fa-list"></span>  Students</a></td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/instructors/loads/'.urlencode(esc($instructor,'url'))) ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>