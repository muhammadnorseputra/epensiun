<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Rate Limit Helper
 *
 * Rate limiting berbasis tabel database `rate_limit`.
 * Reusable untuk action apa pun: cukup berikan daftar identifier
 * (mis. IP, NIP, user id, token, dll) beserta batas percobaan & durasi blokir.
 *
 * Contoh penggunaan:
 *   $identifiers = ['ip:' . $this->input->ip_address(), 'nip:' . $nip];
 *
 *   // Cek blokir
 *   if ($block = rate_limit_check($identifiers, 3, 2)) {
 *       $this->session->set_flashdata('error', rate_limit_message($block));
 *       redirect('somewhere');
 *   }
 *
 *   // Catat percobaan gagal (3x gagal -> blokir 2 menit)
 *   rate_limit_fail($identifiers, 3, 2);
 *
 *   // Reset saat sukses
 *   rate_limit_reset($identifiers);
 */

if (!function_exists('rate_limit_check')) {
    /**
     * Cek apakah salah satu identifier sedang dalam masa blokir.
     *
     * @param array|string $identifiers   Satu atau lebih identifier (mis. ['ip:1.2.3.4', 'nip:123'])
     * @param int          $max_attempts  Batas percobaan gagal sebelum blokir (default 5)
     * @param int          $block_minutes Durasi blokir dalam menit (default 1)
     * @return array|false Array ['identifier' => ..., 'remaining' => detik sisa blokir] jika diblokir,
     *                      false jika tidak diblokir
     */
    function rate_limit_check($identifiers, $max_attempts = 5, $block_minutes = 1)
    {
        $CI =& get_instance();
        foreach ((array) $identifiers as $identifier) {
            $row = $CI->db->select('id, attempts, blocked_until')
                ->from('rate_limit')
                ->where('identifier', $identifier)
                ->get()
                ->row();

            if ($row && !empty($row->blocked_until)) {
                $remaining = strtotime($row->blocked_until) - time();
                if ($remaining > 0) {
                    return [
                        'identifier' => $identifier,
                        'remaining'  => $remaining,
                    ];
                }
            }
        }
        return false;
    }
}

if (!function_exists('rate_limit_fail')) {
    /**
     * Catat satu percobaan gagal untuk tiap identifier.
     * Jika jumlah percobaan mencapai $max_attempts, identifier diblokir
     * selama $block_minutes menit dan hitungan di-reset.
     *
     * @param array|string $identifiers   Satu atau lebih identifier
     * @param int          $max_attempts  Batas percobaan gagal sebelum blokir (default 5)
     * @param int          $block_minutes Durasi blokir dalam menit (default 1)
     * @return void
     */
    function rate_limit_fail($identifiers, $max_attempts = 5, $block_minutes = 1)
    {
        $CI =& get_instance();
        foreach ((array) $identifiers as $identifier) {
            $row = $CI->db->select('id, attempts, blocked_until')
                ->from('rate_limit')
                ->where('identifier', $identifier)
                ->get()
                ->row();

            if (!$row) {
                $CI->db->insert('rate_limit', [
                    'identifier' => $identifier,
                    'attempts'   => 1,
                ]);
                continue;
            }

            $attempts = (int) $row->attempts + 1;
            $data = ['attempts' => $attempts];

            // Mencapai batas percobaan, blokir dan reset hitungan
            if ($attempts >= (int) $max_attempts) {
                $data['attempts'] = 0;
                $data['blocked_until'] = date('Y-m-d H:i:s', strtotime('+' . (int) $block_minutes . ' minute'));
            }

            $CI->db->where('id', $row->id)->update('rate_limit', $data);
        }
    }
}

if (!function_exists('rate_limit_reset')) {
    /**
     * Reset jumlah percobaan dan hapus blokir untuk tiap identifier.
     * Panggil saat action berhasil.
     *
     * @param array|string $identifiers Satu atau lebih identifier
     * @return void
     */
    function rate_limit_reset($identifiers)
    {
        $CI =& get_instance();
        foreach ((array) $identifiers as $identifier) {
            $CI->db->where('identifier', $identifier)
                ->update('rate_limit', ['attempts' => 0, 'blocked_until' => null]);
        }
    }
}

if (!function_exists('rate_limit_message')) {
    /**
     * Buat pesan blokir berdasarkan hasil rate_limit_check().
     *
     * @param array|false $block Hasil dari rate_limit_check()
     * @return string
     */
    function rate_limit_message($block)
    {
        if (!$block) {
            return 'Terlalu banyak percobaan. Silakan coba lagi nanti.';
        }
        $remaining = (int) $block['remaining'];
        $minutes   = floor($remaining / 60);
        $seconds   = $remaining % 60;
        return 'Terlalu banyak percobaan. Silakan coba lagi dalam ' . $minutes . ' menit ' . $seconds . ' detik.';
    }
}
