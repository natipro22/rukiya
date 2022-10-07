<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-5">
            <div class="card-header text-decoration-underline text-decoration-underline pb-0">
                <legend><?= esc($title) ?></legend>
                <!--<hr class="bold"> comment -->
            </div>
            <div class="card-body">
                <?= form_open(site_url('/rooms/add-room')) ?>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="name" class="form-control form-control-plaintext"><h6>Room Name</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="name" type="text" name="room_name" value="<?= old('room_name') ?>" placeholder="Room Name"/>
                                <?= display_error(session('validation'), 'room_name') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="desc" class=" form-control form-control-plaintext"><h6>Room Description</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <input class="form-control" id="desc" type="text" name="room_desc" value="<?= old('room_desc') ?>" placeholder="Room Description"/>
                                <?= display_error(session('validation'), 'room_desc') ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="type" class="form-control form-control-plaintext"><h6>Room Type</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <select class="form-select" id="type" name="room_type">
                                    <option value="THEORY" <?= old('room_type') == 'THEORY' ? 'selected' : '' ?> >Theory</option>
                                    <option value="LAB" <?= old('room_type') == 'LAB' ? 'selected' : '' ?>>Lab</option>
                                    <option value="SEMILAB" <?= old('room_type') == 'SEMILAB' ? 'selected' : '' ?>>Semilab</option>
                                </select>
                                <?= display_error(session('validation'), 'room_type') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-lg-2">
                    <div class="row form-group">
                        <div class="col-md-4 col-sm-4 col-lg-3">
                            <div class="mt-lg-2 text-lg-end text-md-end">
                                <label for="type" class="form-control form-control-plaintext"><h6>Room Availability</h6></label>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-4 col-lg-6">
                            <div class="mt-lg-2">
                                <select class="form-select" id="type" name="room_availability">
                                    <option  value="1" <?= old('room_availability') == '1' ? 'selected' : '' ?> >
                                        Open
                                    </option>
                                    <option value="0" <?= old('room_availability') == '0' ? 'selected' : '' ?>>
                                        Closed
                                    </option>
                                </select>
                                <?= display_error(session('validation'), 'room_availability') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-4 justify-content-center">
                    <div class="btn-group col-md-auto col-sm-auto col-lg-6">
                        <a class="btn btn-instagram text-capitalize" href="<?= site_url('/rooms') ?>"><span class="fas fa-angle-double-left mx-1"> </span> Back</a>
                        <button class="btn btn-instagram text-capitalize" name="save_only" value="saveonly" type="submit"> <span class="fas fa-save mx-1"> </span> Save</button>
                        <button class="btn btn-instagram text-capitalize" name="save_and_back" value="saveandback" type="submit" > <span class="fas fa-save mx-1"> </span> Save and add new</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>