<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="git-merge" class="icon-sm"></i>
                    <h4 class="mb-0">Laporan Trend Periode Usulan Pensiun</h4>.
                </div>
            </div>
           
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel"><b>UPDATE JENIS PENSIUN</b></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div id="loading"></div>
    <?= 
    form_open(base_url('app/referensi/updateJenisPensiun'), ['id' => 'FormUpdateJenisPensiun'], ['id' => '']);
     ?>
            <div class="form-floating mb-3">
            <input type="text" name="nama" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Judul</label>
            </div>
            <div class="form-floating mb-3">
            <textarea class="form-control" name="keterangan" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Keterangan</label>
            </div>
            <div class="form-floating mb-3">
  <select class="form-select" name="kelompok" id="floatingSelect" aria-label="Floating label select example">
    <option value="BUP">BUP</option>
    <option value="NONBUP">NONBUP</option>
  </select>
  <label for="floatingSelect">KELOMPOK</label>
</div>
<div class="form-floating mb-3">
  <select class="form-select" name="is_aktif" id="floatingSelect" aria-label="Floating label select example">
    <option value="Y">AKTIF</option>
    <option value="N">NON AKTIF</option>
  </select>
  <label for="floatingSelect">Status Aktif</label>
</div>

<div class="d-grid gap-2">
  <button type="submit" class="btn btn-block btn-primary">Simpan</button>
</div>
            
     <?= 
     form_close();
     ?>
  </div>
</div>