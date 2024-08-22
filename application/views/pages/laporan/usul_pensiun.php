<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="table" class="icon-sm"></i>
                    <h4 class="mb-0">Laporan Usul Pensiun</h4>.
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
                    <th>Tanggal/Jam Usul</th>
                    <th>Unit Kerja</th>
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
                    <td><?= longdate_indo(substr($r->created_at,0,10)) ?></td>
                    <td><?= $r->nama_unit_kerja ?></td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  <?php else: ?>
                  <tr>
                    <td colspan="5"> Data Usul Tidak Ada</td>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
           </div>
        </div>
    </div>
</div>
