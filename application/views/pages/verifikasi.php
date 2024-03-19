<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="inbox" class="icon-sm"></i>
                    <h4 class="mb-0">Verifikasi Usulan Pensiun ASN</h4>.
                </div>
                <div>
                    <button class="btn btn-secondary btn-md" onclick="return TabelVerifikasiPesiun.ajax.reload();"><i class="icon-xs" data-feather="refresh-ccw"></i></a>
                </div>
            </div>
            <!-- table  -->
            <div class="table-responsive p-4">
                <table id="table-verifikasi" class="table table-hover table-nowrap mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-nowrap">Nomor & Tanggal Usul</th>
                            <th>Jenis Usulan</th>
                            <th>Pensiun ASN</th>
                            <th>Usia</th>
                            <th>Status</th>
                            <th class="text-nowrap none">Detail SK</th>
                            <th class="none">Link Berkas Usul</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal ubah status usulan-->
<div class="modal fade" id="modalUbahStatusUsul" tabindex="-1" data-bs-backdrop="static" data-bs-delay='{"show":0,"hide":150}' role="dialog" aria-labelledby="modalUbahStatusUsulTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open(base_url('/app/verifikasi/ubahstatus'), ['id' => 'FormUbahStatus', 'class' => 'needs-validation', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
            <input type="hidden" name="token">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUbahStatusUsulTitle">UBAH STATUS USUL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="loadProfile"></div>
                <div class="form-floating">
                    <select class="form-select" name="status" id="floatingSelect" aria-label="Floating label select example" required="">
                        <option value="" selected>Open this select menu</option>
                        <option value="SKPD">SKPD</option>
                        <option value="TTD_SK">TANDA TANGAN SK</option>
                        <option value="SELESAI_TMS">TMS</option>
                        <option value="SELESAI_BTL">BTL</option>
                    </select>
                    <label for="floatingSelect">Pilih Status Usul</label>
                </div>
                <div class="form-floating mt-3 d-none field-catatan">
                    <textarea class="form-control" name="catatan" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"></textarea>
                    <label for="floatingTextarea">Masukan Catatan TMS atau BTL</label>
                </div>
                <div class="mt-3 d-none field-sk">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nomorsk" id="nomorsk" placeholder="Masukan Nomor SK Pensiun">
                        <label for="nomorsk">Nomor SK</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control tanggal" name="tanggalsk" id="tanggalsk" placeholder="Masukan Tanggal SK Pensiun">
                        <label for="tanggalsk">Tanggal SK</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-2"></i> Batal</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-send me-2"></i> Simpan Perubahan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal approve usulan-->
<div class="modal fade" id="modalApprove" tabindex="-1" data-bs-backdrop="static" data-bs-delay='{"show":0,"hide":150}' role="dialog" aria-labelledby="modalApproveTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <?= form_open_multipart(base_url('/app/verifikasi/approve'), ['id' => 'FormApprove', 'class' => 'needs-validation', 'data-parsley-validate' => '', 'novalidate' => '']) ?>
            <input type="hidden" name="token">
            <input type="hidden" name="nip">
            <div class="modal-header bg-success">
                <h5 class="modal-title  text-white" id="modalApproveTitle"><i class="bi bi-check-circle-fill me-2"></i> APPROVE USUL</h5>
                <button type="button" class="btn-close  text-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="loadProfile"></div>
                <div id="loadMessage"></div>
                <div class="form-floating">
                    <div class="input-group">
                        <label class="input-group-text bg-light" for="inputGroupFile01">Upload SK</label>
                        <input type="file" name="filesk" class="form-control" id="inputGroupFile01" data-parsley-errors-container=".errorBlock" required>
                    </div>
                    <div class="errorBlock"></div>
                </div>
                <div class="form-floating mt-4">
                    <input type="text" class="form-control tanggal-waktu" name="tanggal_approve" id="tanggal_approve" placeholder="Masukan Tanggal Approve" required>
                    <label for="tanggal_approve">Pilih Tanggal Approve</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-2"></i> Batal</button>
                <button type="submit" class="btn btn-success"><i class="bi bi-hand-thumbs-up-fill me-2"></i> Approve</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>