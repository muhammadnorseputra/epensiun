<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="git-merge" class="icon-sm"></i>
                    <h4 class="mb-0">Referensi Jenis Pensiun ASN</h4>.
                </div>
            </div>
            <!-- table  -->
            <div class="table-responsive">
                <table id="table-arsip" class="table table-hover table-nowrap mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-nowrap">Nomor</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Kelompok</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($datares as $row): ?>
                        <tr>
                            <td class="text-nowrap"><?= $no++ ?></td>
                            <td><?= $row->nama ?></td>
                            <td><?= $row->keterangan ?></td>
                            <td><?= $row->kelompok ?></td>
                            <td class="text-nowrap">#</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>