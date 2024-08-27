<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
          <div class="card-body">
              <!-- KOP Surat -->
              <div class="d-flex flex-column flex-md-row justify-content-center align-items-center" style="width: 100%">
                <div class="p-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Lambang_Kabupaten_Balangan.png/640px-Lambang_Kabupaten_Balangan.png"
                alt="Logo Kab. Balangan" width="60">
                </div>
                <div class="d-inline-flex flex-column align-items-center text-center">
                          <h3 style="margin:0; padding:2px; font-weight: bold">PEMERINTAH KABUPATEN BALANGAN</h3>
                          <h4 style="margin:0; padding:2px; font-weight: bold">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</h4>
                          Alamat: Jln. Jend Ahmad Yani No. 1 Paringin 71462 Telp. 0526-2028060
                </div>
              </div>
              <hr>
              <h4 class="text-center text-uppercase">Laporan Tanda Terima SK Pensiun</h4>
              <div class="col-md-4">
            <form action="#" method="post" class="d-flex gap-3">
              <div class="w-100">
              <label for="nip">Masukan Nomor Induk Pegawai:</label>
              <input type="text" name="nip" id="nip" class="form-control">
              </div>
              <div>
                &nbsp;
                <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
            <hr/>
              <!-- Table -->
              <div class="table-responsive">
                  <table class="table table-condensed table-sm table-bordered">
                    <thead class="bg-light">
                      <tr valign="middle">
                        <th width="5%">Nomor</th>
                        <th>Nama</th>
                        <th>Nomor Induk Pegawai</th>
                        <th>Nomor SK Pensiun</th>
                        <th>Tanggal SK Pensiun</th>
                        <th>Diterima Oleh</th>
                        <th>Diterima Tanggal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no=1;
                      if($data->num_rows() > 0):
                      foreach($data->result() as $r): ?>
                      <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $r->gelar_depan ?> <?= $r->nama ?> <?= $r->gelar_belakang ?></td>
                        <td><?= $r->nip ?></td>
                        <td><?= $r->nomor_sk ?></td>
                        <td><?= longdate_indo($r->tanggal_sk) ?></td>
                        <td><?= $r->diterima_oleh ?></td>
                        <td><?= longdate_indo(substr($r->tanggal_sk,0,10)) ?></td>
                      </tr>
                      <?php $no++; endforeach; ?>
                      <?php else: ?>
                      <tr>
                        <td colspan="5"> Data SK Tidak Ada</td>
                      </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
              </div>
              <!-- Kepala Badan -->
              <div class="d-flex flex-column justify-content-end align-items-end" style="width: 100%">
                    <div class="text-center">
                      <div>Paringin, <?= date_indo(date('Y-m-d')) ?></div>
                      <p class="fw-bold">Kepala Badan Kepegawaian dan Pengembangan <br> Sumber Daya Manusia</p>
                      <br>
                      <br>
                      <p class="fw-bold m-0 p-0"><u>H. Sufriannor, S.Sos., M.AP</u></p>
                      <div class="small">	PEMBINA UTAMA MUDA (IV/C)</div>
                      <div class="small">NIP. <?= polanip("196810121989031009") ?></div>
                    </div>
              </div>
          </div>
        </div>
    </div>
</div>
