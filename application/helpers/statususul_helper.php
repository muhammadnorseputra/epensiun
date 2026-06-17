<?php

function trackingUsulan($data)
{
    $wrapper = 'rounded-3xl border border-slate-200 bg-white p-6 shadow-sm';
    $center  = 'flex flex-col items-center text-center gap-4';

    switch ($data->is_status) {

        case 'SKPD':
        case 'KIRIM_USUL':

            return '
            <div class="' . $wrapper . '">
                <div class="' . $center . '">
                    <div class="text-5xl">📄</div>
                    <h3 class="text-xl font-bold text-slate-800">
                        Tahap Pengusulan
                    </h3>
                    <p class="text-slate-600">
                        Usulan masih dalam tahap
                        <span class="font-semibold text-blue-600">
                            DIUSULKAN SKPD
                        </span>
                    </p>
                </div>
            </div>';

        case 'CETAK_USUL':

            return '
            <div class="' . $wrapper . '">
                <div class="' . $center . '">
                    <div class="text-5xl">🖨️</div>
                    <h3 class="text-xl font-bold text-slate-800">
                        Tahap Cetak Usulan
                    </h3>
                    <p class="text-slate-600">
                        Usulan masih dalam tahap
                        <span class="font-semibold text-blue-600">
                            CETAK USUL
                        </span>
                    </p>
                </div>
            </div>';

        case 'BKPSDM':

            return '
            <div class="' . $wrapper . '">
                <div class="' . $center . '">

                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl">
                        🔎
                    </div>

                    <h2 class="text-2xl font-bold text-slate-900">
                        Tahap Verifikasi
                    </h2>

                    <p class="text-slate-600">
                        Usulan masih dalam proses
                        <span class="font-semibold text-blue-600">
                            VERIFIKASI BKPSDM
                        </span>
                    </p>

                </div>
            </div>';

        case 'TTD_SK':

            return '
            <div class="' . $wrapper . '">
                <div class="' . $center . '">

                    <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center text-3xl">
                        ✍️
                    </div>

                    <img
                        src="' . base_url('template/assets/images/ttd_sk.png') . '"
                        class="max-w-xs w-full"
                        alt="TTD SK">

                    <h2 class="text-2xl font-bold text-slate-900">
                        Proses Penandatanganan
                    </h2>

                    <p class="text-slate-600">
                        Usulan sedang dalam proses
                        <span class="font-semibold text-yellow-600">
                            TTD BUPATI BALANGAN
                        </span>
                    </p>

                </div>
            </div>';

        case 'SELESAI':

            return '
            <div class="rounded-3xl border border-green-200 bg-green-50 p-6">

                <div class="' . $center . '">

                    <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">
                        ✅
                    </div>

                    <img
                        src="' . base_url('template/assets/images/approve.png') . '"
                        class="max-w-xs w-full"
                        alt="Selesai">

                    <h2 class="text-2xl font-bold text-green-700">
                        Usulan Selesai
                    </h2>

                    <p class="text-green-700">
                        SK telah terbit.
                        Silakan datang ke
                        <strong>BKPSDM</strong>
                        untuk pengambilan SK.
                    </p>

                </div>

            </div>';

        case 'SELESAI_ARSIP':

            return '
            <div class="rounded-3xl border border-green-200 bg-green-50 p-6">

                <div class="' . $center . '">

                    <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">
                        📦
                    </div>

                    <img
                        src="' . base_url('template/assets/images/arsip.png') . '"
                        class="max-w-xs w-full"
                        alt="Arsip">

                    <h2 class="text-2xl font-bold text-green-700">
                        SK Telah Diserahkan
                    </h2>

                    <div class="text-green-700 leading-relaxed">

                        SK telah diserahkan dan diterima oleh

                        <span class="font-bold">
                            ' . $data->diterima_oleh . '
                        </span>

                        <br>

                        pada tanggal

                        <span class="font-bold">
                            ' . @date_indo(substr($data->arsip_at, 0, 10)) . '
                        </span>

                        pukul

                        <span class="font-bold">
                            ' . substr($data->arsip_at, 10, 6) . '
                        </span>

                    </div>

                </div>

            </div>';

        default:

            return '
            <div class="rounded-3xl border border-red-200 bg-red-50 p-6">

                <div class="text-center">

                    <div class="text-5xl mb-4">
                        ⚠️
                    </div>

                    <h3 class="text-xl font-bold text-red-700 mb-2">
                        Usulan Tidak Memenuhi Syarat
                    </h3>

                    <p class="text-red-600">
                        Berkas tidak lengkap atau tidak memenuhi persyaratan.
                        Silakan menghubungi SKPD terkait.
                    </p>

                </div>

            </div>';
    }
}
