<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-body blur shadow-blur mb-2 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="<?= $instructor->INST_SEX == 'F' ? site_url('public/assets/img/lady.png') : site_url('public/assets/img/male.png') ?>" 
                                 alt="profile_image" class="w-100 border-radius-lg shadow-sm m-4">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?= esc($instructor->INST_FULLNAME) ?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                Address: 
                                <?= esc($instructor->INST_ADDRESS) ?>
                            </p>
                            <p class="mb-0 font-weight-bold text-sm">
                                Gender: 
                                <?= esc($instructor->INST_SEX) == 'F' ? 'Female' : 'Male' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                    <legend><?= esc($title) ?> Table</legend>
                    <!--<hr class="bold"> comment -->
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="example" class="table table-condensed align-items-center justify-content-center mb-0 p-xl-0" style="width:100%">
                            <thead> 
                                <tr>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">#NO</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">
                                        <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');"> Course ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Description</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder">Pre-requisite</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Unit</th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Students</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total_loads = 0;
                                foreach ($loads as $load): 
                                    
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="'.esc($load->SUBJ_CODE). 
                                            '"/>'.esc($load->SUBJ_CODE).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($load->SUBJ_DESCRIPTION).'</td>';
                                    echo '<td class="align-middle text-sm">'.esc($load->PRE_REQUISITE).'</td>';
                                    echo '<td class="text-center align-middle text-sm">'.esc($load->UNIT).'</td>';
//                                    echo '<td class="align-middle text-sm">'.esc($load->INST_EMAIL).'</td>';
                                    echo '<td class="align-middle text-center text-sm"><a href="'. site_url('instructors/class/'.esc(encrypt_url($instructor->INST_ID),'url').'/'.esc(encrypt_url($load->SUBJ_CODE),'url')).'"><span class="fa fa-list"></span> Students</a></td>';
                                    echo '</tr>';
                                    $total_loads += $load->UNIT;
                                endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end align-bottom text-sm"  colspan="5"><Strong>Total</Strong></td>
                                    <td class="align-middle text-sm" ><strong><?= esc($total_loads) ?></strong></td>
                                </tr>
				<tr><td  colspan="7"></td></tr>	
                            </tfoot>
                        </table>

                    </div>
                    <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/instructors/') ?>">
                            <span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <a class="btn btn-instagram text-capitalize " target="_blank" href="#"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                        <a class="btn btn-instagram text-capitalize " target="_blank" href="#"><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</a>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>