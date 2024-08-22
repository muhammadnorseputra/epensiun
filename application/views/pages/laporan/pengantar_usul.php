<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="table" class="icon-sm"></i>
                    <h4 class="mb-0">Laporan Pengantar Usul Pensiun</h4>.
                </div>
            </div>
            <div class="card-body">
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
                  foreach($data->result() as $r): ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $r->nomor ?></td>
                    <td><?= $r->created_by_unorid ?></td>
                    <td><?= longdate_indo($r->tanggal) ?></td>
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
