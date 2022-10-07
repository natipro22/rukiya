<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Students</p>
                                <p class="font-weight-bolder mb-0 text-capitalize">
                                    <!--$53,000-->
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($students) ? esc($students) : 0 ?></span>
                                    <!--<span class="text-success text-sm font-weight-bolder">+55%</span>-->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Instructors</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($instructors) ? esc($instructors) : 0 ?></span>
                                    <!--<span class="text-success text-sm font-weight-bolder">+3%</span>-->
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Departments</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($departments) ? esc($departments) : 0 ?></span>
                                    <!--<span class="text-danger text-sm font-weight-bolder">-2%</span>-->
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Rooms</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($rooms) ? esc($rooms) : 0 ?></span>
                                    <!--<span class="text-success text-sm font-weight-bolder">+5%</span>-->
                                </h5>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-6">
        <div class="col-lg-7 col-sm-6 mb-xl-0 mb-4">
            <div class="card h-100 p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
                    <span class="mask"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                        <h5 class="font-weight-bolder mb-4 pt-2">Welcome to Unity University Rukiya Campus</h5>
                        <p class="text-black-50 text-justify">Unity University is the first privately owned institution of higher learning to be awarded full-fledged 
                            university status in Ethiopia by the ministry of education. It is also the first private university in the country to offer 
                            postgraduate programs leading to master’s degree in business administration (MBA) and development economics (MA).</p>
                        <a class="text-black-50 text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="http://www.uu.edu.et/" target="_blank">
                            Read More
                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body p-3 mb-sm-2">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="bg-gradient-primary border-radius-lg h-100">
                                <img src="<?= site_url('public/assets/img/shapes/waves-white.svg') ?>" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                                <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                    <img class="w-100 position-relative z-index-2 pt-4" src="<?= isset($profile) ? site_url('writeble/uploads/takecard.jpg') : 
                                       (($user->GENDER == 'F') ? site_url('public/assets/img/lady.png') : site_url('public/assets/img/male.png'))?>" alt="rocket">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex flex-column h-100">
                                <p class="my-2 py-3 text-bold"></p>
                                <h5 class="font-weight-bolder">Admin Dashboard</h5>
                                <p class="">Name: <span class="text-capitalize"><?= esc($user->ACCOUNT_NAME)?></span></p>
                                <p class="">Email: <span class=""><?= esc($user->ACCOUNT_USERNAME)?></span></p>
                                <p class="mb-5">Role: <span class="text-capitalize"><?= esc($user->ACCOUNT_TYPE)?></span></p>
                                
                                <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                                    Read More
                                    <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>