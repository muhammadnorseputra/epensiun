<?php  
$template = "";
if ($usul->is_status === 'SKPD') {
    $template .= $this->pensiun->timeline($usul, $usul->is_status);
    $template .= '<div class="card shadow-none border">
                    <div class="card-body">
                        Usulan Masih Dalam Tahap "<strong>DIUSULKAN SKPD</strong>"
                    </div>
                </div>';
} elseif ($usul->is_status === 'BKPSDM') {
    $template .= $this->pensiun->timeline($usul, $usul->is_status);
    $template .= '<div class="card shadow-none border">
                    <div class="card-header">
                    <i class="bi bi-check-circle-fill text-success me-2"></i> Data "<strong>' . $usul->nip . '</strong>" ditemukan pada tahap verifikasi.
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                        <i class="bi bi-bookmark-check-fill text-primary fs-1 mb-8"></i>
                        <img src="' . base_url('template/assets/images/svg/verify.svg') . '" class="w-75 w-md-50 rounded mb-6" alt="Verify Status">
                        <h2>TAHAP VERIFIKASI</h2>
                        <span>Usulan masih dalam tahap "<strong>VERIFIKASI BKPSDM</strong>"</span>
                        </div>
                    </div>
                </div>';
} elseif ($usul->is_status === 'SELESAI') {
    $template .= $this->pensiun->timeline($usul, $usul->is_status);
    $template .= '<div class="card shadow-none border">
                    <div class="card-header">
                    <i class="bi bi-check-circle-fill text-success me-2"></i> Data "<strong>' . $usul->nip . '</strong>" ditemukan pada tahap selesai.
                    </div>
                    <div class="card-body d-flex flex-column align-items-center gap-3">
                        <i class="bi bi-bookmark-check-fill text-success fs-1 mb-0 pb-0"></i>
                        <img src="' . base_url('template/assets/images/approve.png') . '" class="w-50"/>
                        <div>Usulan Pensiun Telah "<strong>SELESAI & SK Sudah Terbit</strong>". <br> Silahkan Ke Kantor BKPSDM untuk pengambilan SK</div>
                    </div>
                </div>';
} elseif ($usul->is_status === 'TTD_SK') {
    $template .= $this->pensiun->timeline($usul, $usul->is_status);
    $template .= '<div class="card shadow-none border">
                    <div class="card-header">
                    <i class="bi bi-check-circle-fill text-success me-2"></i> Data "<strong>' . $usul->nip . '</strong>" ditemukan pada tahap signature.
                    </div>
                    <div class="card-body d-flex flex-column align-items-center gap-3">
                        <i class="bi bi-bookmark-check-fill text-success fs-1 mb-8"></i>
                        <img src="' . base_url('template/assets/images/ttd_sk.png') . '" class="w-50"/>
                        <p>Usulan Pensiun dalam proses "<strong>Signature (TTD) oleh BUPATI BALANGAN</strong>"</p>
                    </div>
                </div>';
} elseif ($usul->is_status === 'SELESAI_ARSIP') {
    $template .= $this->pensiun->timeline($usul, $usul->is_status);
    $template .= '<div class="card shadow-none border">
                    <div class="card-header">
                    <i class="bi bi-check-circle-fill text-success me-2"></i> Data "<strong>' . $usul->nip . '</strong>" ditemukan pada tahap diserahkan dan diterima.
                    </div>
                    <div class="card-body d-flex flex-column align-items-center gap-3">
                        <i class="bi bi-bookmark-check-fill text-success fs-1 mb-0 pb-0"></i>
                        <img src="' . base_url('template/assets/images/arsip.png') . '" class="w-50"/>
                        <div>SK telah <strong class="text-dark">DI-SERAHKAN</strong> dan <strong class="text-dark">DI-TERIMA</strong> oleh Pensiunan yang bersangkutan <br> pada tanggal <strong>' . @date_indo(substr($usul->arsip_at, 0, 10)) . '</strong> jam <strong>' . substr($usul->arsip_at, 10, 6) . '</strong></div>
                    </div>
                </div>';
} else {
    $template .= '<div class="card shadow-none border">
                    <div class="card-body">
                        Ops, usulan sepertinya <strong>Tidak Memenuhi Syarat</strong> atau <strong>Berkas Tidak Lengkap</strong>. <br> Silahkan hubungi SKPD terkait !
                    </div>
                </div>';
}
echo json_encode($template);
?>