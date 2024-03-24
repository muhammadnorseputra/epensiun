<!-- row  -->
<div class="row mt-6 px-2 px-md-4">
    <div class="col-md-12 col-12">
        <!-- card  -->
        <div class="card p-0">
            <!-- card header  -->
            <div class="card-header bg-white pt-4 d-flex justify-content-between align-items-start">
                <div class="d-flex gap-4">
                    <i data-feather="archive" class="icon-sm"></i>
                    <h4 class="mb-0">Arsip Pensiun ASN</h4>.
                </div>
                <div>
                    <button class="btn btn-secondary btn-md" onclick="return TabelArsip.ajax.reload();"><i class="icon-xs" data-feather="refresh-ccw"></i></a>
                </div>
            </div>
            <!-- table  -->
            <div class="table-responsive p-4">
                <table id="table-arsip" class="table table-hover table-nowrap mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-nowrap">Nomor & Tanggal SK</th>
                            <th>Jenis Usul</th>
                            <th>Pensiun ASN</th>
                            <th>Usia</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>