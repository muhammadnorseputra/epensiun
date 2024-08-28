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
              <h4 class="text-center text-uppercase">Laporan Trend Kesalahan Usul Pensiun</h4>
              <div class="col-md-4">
              <form action="" method="get" class="d-flex gap-3">
                <div class="w-100">
                <label for="jns_kesalahan">Pilih Jenis Kesalahan:</label>
                <select id="jns_kesalahan" name="jns_kesalahan" class="form-control">
                  <option value="SELESAI_BTL" <?= @$_GET['jns_kesalahan'] === 'SELESAI_BTL' ? 'selected' : '' ?>>BTL (Berkas Tidak Lengkap)</option>
                  <option value="SELESAI_TMS" <?= @$_GET['jns_kesalahan'] === 'SELESAI_TMS' ? 'selected' : '' ?>>TMS (Tidak Memenuhi Syarat)</option>
                </select>
                </div>
                <div>
                  &nbsp;
                  <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <hr/>
              <div class="table-responsive">
                <table class="table table-condensed table-sm table-bordered">
                  <thead class="bg-light">
                    <tr valign="middle">
                      <th width="5%">Nomor</th>
                      <th>Nama</th>
                      <th>Nomor Induk Pegawai</th>
                      <th>Jenis Kesalahan</th>
                      <th>Tanggal Proses</th>
                      <th>Catatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    if($data->num_rows() > 0):
                    foreach($data->result() as $r): 
                      $isTMS = $r->is_status === 'SELESAI_TMS' ? '<label class="p-2 text-white bg-danger">TMS (Tidak Memenuhi Syarat)</label>' : '<label class="p-2 text-dark bg-warning">BTL (Berkas Tidak Lengkap)</label>';
                    ?>
                    <tr>
                      <td class="text-center"><?= $no ?></td>
                      <td><?= $r->gelar_depan ?> <?= $r->nama ?> <?= $r->gelar_belakang ?></td>
                      <td><?= $r->nip ?></td>
                      <td><?= $isTMS ?></td>
                      <td><?= longdate_indo(substr($r->verify_at,0,10)) ?></td>
                      <td><?= $r->catatan ?></td>
                    </tr>
                    <?php $no++; endforeach; ?>
                    <?php else: ?>
                    <tr>
                      <td colspan="6" class="text-center"> Data Usul TMS/BTL Tidak Ada</td>
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
