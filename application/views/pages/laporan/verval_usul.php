<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="table" class="icon-sm"></i>
                    <h4 class="mb-0">Laporan Verifikasi & Validasi Usul Pensiun</h4>.
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
                    <th>Jenis Usul</th>
                    <th>Status Verval</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Tanggal Approve</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no=1;
                  if($data->num_rows() > 0):
                  foreach($data->result() as $r):
                    if($r->is_status === 'BKPSDM') {
                      $status = '<label class="p-2 border border-primary rounded text-primary">VERIFIKASI</label>';
                      if($r->verify_at !== null) {
                        $tgl_proses = longdate_indo(substr($r->verify_at,0,10));
                      } else {
                        $tgl_proses = 'Dalam Proses';
                      }

                    } elseif($r->is_status === 'TTD_SK') {
                      $status = '<label class="p-2 border border-warning rounded">TTD BUPATI BALANGAN</label>';
                      if($r->verify_at !== null) {
                        $tgl_proses = longdate_indo(substr($r->verify_at,0,10));
                      } else {
                        $tgl_proses = 'Dalam Proses';
                      }
                    } elseif($r->is_status === 'SELESAI') {
                      $status = '<label class="p-2 border border-success rounded">APPROVE</label>';
                      if($r->approve_at !== null) {
                        $tgl_proses = longdate_indo(substr($r->approve_at,0,10));
                      } else {
                        $tgl_proses = 'Dalam Proses';
                      }
                    }
                  ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $r->gelar_depan ?> <?= $r->nama ?> <?= $r->gelar_belakang ?></td>
                    <td><?= $r->nip ?></td>
                    <td><?= $r->nama_jenis ?> (<?= $r->keterangan_jenis ?>)</td>
                    <td><?= $status ?></td>
                    <td><?= $tgl_proses ?></td>
                    <td><?= $tgl_proses ?></td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  <?php else: ?>
                  <tr>
                    <td colspan="7" class="text-center text-secondary"> Data Verifikasi dan Validasi Usul Tidak Ada</td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
           </div>
        </div>
    </div>
</div>