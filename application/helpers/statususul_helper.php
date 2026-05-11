<?php

function TrackingUsulan($data)
{
    $template = "";
    if ($data->is_status === 'SKPD' || $data->is_status === 'KIRIM_USUL') {
        $template .= '<div class="card shadow-lg text-center">
                        <div class="card-body">
                            Usulan Masih Dalam Tahap "<strong>DIUSULKAN SKPD</strong>"
                        </div>
                    </div>';
    } elseif ($data->is_status === 'CETAK_USUL') {
        $template .= '<div class="card shadow-lg text-center">
                        <div class="card-body">
                            Usulan Masih Dalam Tahap "<strong>CETAK USUL</strong>"
                        </div>
                    </div>';
    } elseif ($data->is_status === 'BKPSDM') {
        $template .= '<div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                            <i class="bi bi-bookmark-check-fill text-primary fs-1 mb-8"></i>
                            <img src="' . base_url('template/assets/images/svg/verify.svg') . '" class="w-75 w-md-50 rounded mb-6" alt="Verify Status">
                            <h2>TAHAP VERIFIKASI</h2>
                            <span>Usulan masih dalam tahap "<strong>VERIFIKASI BKPSDM</strong>"</span>
                            </div>
                        </div>
                    </div>';
    } elseif ($data->is_status === 'SELESAI') {
        $template .= '<div class="card shadow-none border">
                        <div class="card-body d-flex flex-column align-items-center gap-3">
                            <i class="bi bi-bookmark-check-fill text-success fs-1 mb-0 pb-0"></i>
                            <img src="' . base_url('template/assets/images/approve.png') . '" class="w-50"/>
                            <div>Usulan Pensiun Telah "<strong>SELESAI & SK Sudah Terbit</strong>". <br> Silahkan Ke Kantor BKPSDM untuk pengambilan SK</div>
                        </div>
                    </div>';
    } elseif ($data->is_status === 'TTD_SK') {
        $template .= '<div class="card shadow-none border">
                        <div class="card-body d-flex flex-column align-items-center gap-3">
                            <i class="bi bi-bookmark-check-fill text-success fs-1 mb-8"></i>
                            <img src="' . base_url('template/assets/images/ttd_sk.png') . '" class="w-50"/>
                            <p>Usulan Pensiun dalam proses "<strong>Signature (TTD) oleh BUPATI BALANGAN</strong>"</p>
                        </div>
                    </div>';
    } elseif ($data->is_status === 'SELESAI_ARSIP') {
        $template .= '<div class="card shadow-none border">
                        <div class="card-body d-flex flex-column align-items-center gap-3">
                            <i class="bi bi-bookmark-check-fill text-success fs-1 mb-0 pb-0"></i>
                            <img src="' . base_url('template/assets/images/arsip.png') . '" class="w-50"/>
                            <div>SK telah <strong class="text-dark">DI-SERAHKAN</strong> dan <strong class="text-dark">DI-TERIMA</strong> oleh <strong class="text-success">' . $data->diterima_oleh . '</strong> <br> pada tanggal <strong>' . @date_indo(substr($data->arsip_at, 0, 10)) . '</strong> jam <strong>' . substr($data->arsip_at, 10, 6) . '</strong></div>
                        </div>
                    </div>';
    } else {
        $template .= '<div class="card shadow-none border border-danger">
                        <div class="card-body text-danger">
                            Ops, usulan sepertinya <strong>Tidak Memenuhi Syarat</strong> atau <strong>Berkas Tidak Lengkap</strong>. Silahkan hubungi SKPD terkait !
                        </div>
                    </div>';
    }

    return $template;
}
