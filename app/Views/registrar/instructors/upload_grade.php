<?= $this->extend("templates/template") ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-xl-12 col-sm-12 mb-xl-12 mb-4">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h4> Upload spreadsheet</h4>
                <hr class="horizontal dark mt-2">
            </div>
            <div class="card-body">
                <?= form_open_multipart(base_url("/instructors/class/upload-grade/{$instructor}/{$course}/{$section}")) ?>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <div class="form-group">
                            <div class="mb-2 text-lg-end">
                                <label for="xlsx" class="form-control-plaintext"><h5>Spreadsheet File</h5></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5">
                        <div class="form-group">
                            <div class="mb-3">
                                <input class="form-control form-control-file form-control" id="xlsx" type="file"data-input="false" data-iconName="fa fa-file-upload" name="xlsxFile" value="<?= old('xlsxFile') ?>"/>
                                <?= display_error(session('validation'), 'xlsxFile') ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-lg-2">
                            <div class="form-group">
                                <div class="mb-3">
                                    <button id="" class="form-control btn btn-instagram" type="submit" name="upload" value="">
                                        <span class="fas fa-file-upload"> </span> Uplaod
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
