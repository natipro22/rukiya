<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<!--<div class="container-fluid py-4">-->
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Registrar</p>
                                <p class="font-weight-bolder mb-0 text-capitalize">
                                    <!--$53,000-->
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($total_students) ? esc($total_students) : 0 ?></span>
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($total_students) ? esc($total_students) : 0 ?></span>
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($total_students) ? esc($total_students) : 0 ?></span>
                                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
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
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <span class="p-1 badge badge-success bg-gradient-success"> <?= isset($total_students) ? esc($total_students) : 0 ?></span>
                                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                                </h5>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7">
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
                <div class="card-body p-3">
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
                                <p class="mb-1 pt-2 text-bold">Built by developers</p>
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
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Authors table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="example" class="table align-items-center justify-content-center mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">John Michael</h6>
                                                <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Alexa Liras</h6>
                                                <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                                                <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Executive</p>
                                        <p class="text-xs text-secondary mb-0">Projects</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user4">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Michael Levi</h6>
                                                <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Online</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user5">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Richard Gran</h6>
                                                <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                        <p class="text-xs text-secondary mb-0">Executive</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Miriam Eric</h6>
                                                <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Programtor</p>
                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="nav-item d-flex align-items-center">
                        <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="#">Online Builder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>position</th>
                                    <th>age</th>
                                    <th>option</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $user->ACCOUNT_NAME ?></td>
                                    <td><?= $user->ACCOUNT_USERNAME ?></td>
                                    <td><?= $user->ACCOUNT_TYPE ?></td>
                                    <td><a href="<?= site_url('/logout') ?>">Logout</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
<?= $this->endSection() ?>