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
                    <?= form_open(base_url("/departments/delete-department"),"onSubmit='return submitDelete(this);'") ?>
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Department Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Department Description</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Faculty</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Courses</th>
                                    <!--<th class="text-secondary opacity-7">option</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($departments as $dept): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($dept->DEPT_ID). 
                                            '"/><a href="/users/delete/'.esc($dept->DEPT_ID).'"> '.esc($dept->DEPARTMENT_NAME).'</a></td>';
                                    echo '<td class="align-middle text-sm">'.esc($dept->DEPARTMENT_DESC).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($dept->FACULTY_NAME).'</td>';
                                    echo '<td class="align-middle text-center text-sm"><a href="departments/courses/'. encrypt_url(esc($dept->DEPARTMENT_NAME)).
                                        '"><span class="fa fa-link"></span> View</td>';
                                    echo '</tr>';
                                    
                                     endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="row py-4">
                        <div class="btn-group col-md-auto col-sm-auto col-lg-4">
                            <a class="btn btn-instagram text-capitalize " href="<?= site_url('departments/new-department') ?>"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                            <button type="submit" class="btn btn-instagram text-capitalize " ><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>