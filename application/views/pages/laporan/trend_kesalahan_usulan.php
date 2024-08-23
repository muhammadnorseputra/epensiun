<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="git-merge" class="icon-sm"></i>
                    <h4 class="mb-0">Laporan Trend Kesalahan Usulan Pensiun</h4>.
                </div>
            </div>
            <div class="card-body">
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
           </div>
        </div>
    </div>
</div>
