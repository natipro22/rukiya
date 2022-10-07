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
                            foreach ($loads as $load):

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td class="align-middle text-sm"><input type="checkbox" name="selector[]" id="selector[]" value="' . esc($load->SUBJ_ID) .
                                '"/>' . esc($load->SUBJ_CODE) . '</td>';
                                echo '<td class="align-middle text-sm">' . esc($load->SUBJ_DESCRIPTION) . '</td>';
                                echo '<td class="align-middle text-sm">' . esc($load->PRE_REQUISITE) . '</td>';
                                echo '<td class="text-center align-middle text-sm">' . esc($load->UNIT) . '</td>';
//                                    echo '<td class="align-middle text-sm">'.esc($load->INST_EMAIL).'</td>';
                                echo '<td class="align-middle text-center text-sm"><a href="/sections/' . esc($load->SUBJ_CODE) . '/' . esc($load->SUBJ_CODE) . '"><span class="fa fa-list"></span> Students</a></td>';
                                echo '</tr>';

                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="py-4">
                    <div class="btn-group">
                        <a class="btn btn-instagram btn-sm text-capitalize " target="_blank" href="#"><span class="fa fa-plus-circle mx-1"> </span> New</a>
                        <a class="btn btn-instagram btn-sm text-capitalize " target="_blank" href="#"><span class="fa fa-trash-alt mx-1"> </span> Delete Selected</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<?= $this->endSection() ?>