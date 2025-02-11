<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
         <?php
         function cariBarisBerdasarkanKolom($data, $kolom, $kataKunci) {
          $hasil = array();
      
          foreach ($data as $baris) {
              if (isset($baris[$kolom]) && stripos($baris[$kolom], $kataKunci) !== false) {
                  $hasil[] = $baris;
              }
          }
      
          return $hasil;
      }

         ?>
        <div class="card p-0">
        <div class="card-body">
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
            <h4 class="text-center text-uppercase">Laporan Pengantar Usul Pensiun</h4>
            <div class="row">
              <div class="col-md-4">
                <form action="" method="get" class="d-flex gap-3">
                  <div class="w-100">
                  <label for="bulan">Pilih Bulan:</label>
                  <select id="bulan" name="bulan" class="form-control">
                    <?php  
                    foreach (listBulan() as $key => $bulan) {
                        $getBulan = @$_GET['bulan'] ?? date('m');
                        $selected = intval($getBulan) === $key ? 'selected' : '';
                        echo "<option value='$key' $selected>$bulan</option>";
                    }
                    ?>
                  </select>
                  </div>
                  <div class="w-100">
                  <?php  
                  $tahun_sekarang = date('Y'); // Ambil tahun saat ini
                  $range_tahun = range($tahun_sekarang - 5, $tahun_sekarang + 5); // Membuat array range dari 5 tahun lalu sampai 5 tahun depan
                  ?>
                  <label for="tahun">Pilih Tahun:</label>
                  <select id="tahun" name="tahun" class="form-control">
                    <?php  
                    foreach ($range_tahun as $tahun) {
                      $getTahun = @$_GET['tahun'] ?? date('Y');
                      $selected = intval($getTahun) === $tahun ? 'selected' : '';
                      echo "<option value='$tahun' $selected>$tahun</option>";
                  }
                    ?>
                  </select>
                  </div>
                  <div>
                    &nbsp;
                    <button type="submit" value="Submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <div class="col-md-8 d-flex justify-content-end align-items-end">
                <?php if($data->num_rows() > 0): ?><span><b>Total : </b><?= $data->num_rows() ?><?php endif; ?>
              </div>
            </div>
            <hr/>
            <div class="table-responsive">
              <table class="table table-condensed table-small table-bordered">
                <thead class="bg-light">
                  <tr valign="middle">
                    <th width="5%">Nomor</th>
                    <th>Nomor Pengantar</th>
                    <th>Instansi Pengusul</th>
                    <th>Tanggal Usul</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  if($data->num_rows() > 0):
                  foreach($data->result() as $r): 
                    $cari = cariBarisBerdasarkanKolom($skpd['data'], 'id_unit_kerja', $r->created_by_unorid);
                  ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $r->nomor ?></td>
                    <td><?= $cari[0]['nama_unit_kerja'] ?></td>
                    <td><?= longdate_indo($r->tanggal) ?></td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center"> Data Usul Tidak Ada</td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
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
