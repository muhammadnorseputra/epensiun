<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Favicon icon-->
  <link
    rel="shortcut icon"
    type="image/png"
    href="<?= base_url('template/assets/images/approve.png') ?>" />

  <!-- Libs CSS -->
  <link
    href="<?= base_url('template/assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/dropzone/dist/dropzone.css') ?>"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/@mdi/font/css/materialdesignicons.min.css') ?>"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/jquery-toast/iziToast.min.css') ?>"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/jquery-confirm/jquery-confirm.min.css') ?>"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/prismjs/themes/prism-okaidia.min.css') ?>"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>"
    rel="stylesheet" />
  <link
    href="<?= base_url('template/assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>"
    rel="stylesheet" />
  <?php if (
    $this->uri->segment(2) === 'inbox' || $this->uri->segment(2) ===
    'verifikasi' || $this->uri->segment(2) === 'arsip'
  ) : ?>
    <link
      href="<?= base_url('template/assets/libs/DataTables/datatables.min.css') ?>"
      rel="stylesheet" />
  <?php endif; ?> <?php if ($this->uri->segment(3) === 'cekusul') : ?>
    <link
      href="<?= base_url('template/assets/css/timeline.css') ?>"
      rel="stylesheet" />
  <?php endif; ?>
  <!-- Theme CSS -->
  <link
    rel="stylesheet"
    href="<?= base_url('template/assets/css/theme.min.css') ?>" />
  <title><?= $title ?></title>

  <style>
    /* ===== page navigation loader overlay ===== */
    #page-loader {
      position: fixed;
      inset: 0;
      z-index: 99999;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 18px;
      background: rgba(30, 30, 43, .78);
      -webkit-backdrop-filter: blur(12px) saturate(120%);
      backdrop-filter: blur(12px) saturate(120%);
      opacity: 0;
      visibility: hidden;
      /* destination state when hiding -> smooth fade-out */
      transition: opacity .45s cubic-bezier(.4, 0, .2, 1),
        visibility .45s linear;
    }

    #page-loader.is-visible {
      opacity: 1;
      visibility: visible;
      /* destination state when showing -> fast fade-in (as before) */
      transition: opacity .25s ease, visibility .25s linear;
    }

    #page-loader .loader-ring,
    #page-loader .loader-text {
      opacity: 1;
      transform: scale(1);
    }

    #page-loader:not(.is-visible) .loader-ring,
    #page-loader:not(.is-visible) .loader-text {
      opacity: 0;
      transform: scale(.94);
      transition: opacity .45s cubic-bezier(.4, 0, .2, 1),
        transform .45s cubic-bezier(.4, 0, .2, 1);
    }

    .loader-ring {
      width: 64px;
      height: 64px;
    }

    .loader-ring svg {
      width: 100%;
      height: 100%;
    }

    .loader-track {
      fill: none;
      stroke: rgba(255, 255, 255, .08);
      stroke-width: 6;
    }

    .loader-arc {
      fill: none;
      stroke-width: 6;
      stroke-linecap: round;
      stroke-dasharray: 170 251;
      transform-origin: 48px 48px;
      animation: page-spin 1s linear infinite;
      filter: drop-shadow(0 0 10px rgba(0, 237, 100, .4));
    }

    .loader-text {
      margin: 0;
      font-family: "Euclid Circular A", "Avenir Next", -apple-system,
        BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
        sans-serif;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 1.6px;
      text-transform: uppercase;
      color: #a8b3bc;
    }

    .loader-dots i {
      font-style: normal;
      opacity: 0;
      animation: page-blink 1.2s infinite;
    }

    .loader-dots i:nth-child(2) {
      animation-delay: .2s;
    }

    .loader-dots i:nth-child(3) {
      animation-delay: .4s;
    }

    @keyframes page-spin {
      to {
        transform: rotate(360deg);
      }
    }

    @keyframes page-blink {
      0%,
      60% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }
  </style>
</head>

<body class="bg-light">
  <noscript>
    <style>
      body,
      html,
      * {
        /*hides all elements inside the body*/
        display: none;
      }

      h1 {
        /* even if this h1 is inside head tags it will be first hidden, so we have to display it again after all body elements are hidden*/
        display: block;
      }
    </style>
    <h1>JavaScript is not enabled, please check your browser settings.</h1>
  </noscript>
  <!-- Page navigation loader -->
  <div id="page-loader" aria-hidden="true">
    <div class="loader-ring" aria-hidden="true">
      <svg viewBox="0 0 96 96">
        <defs>
          <linearGradient id="page-loader-grad" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#00ed64" />
            <stop offset="100%" stop-color="#00a35c" />
          </linearGradient>
        </defs>
        <circle class="loader-track" cx="48" cy="48" r="40" />
        <circle class="loader-arc" cx="48" cy="48" r="40" stroke="url(#page-loader-grad)" />
      </svg>
    </div>
    <p class="loader-text">Memuat halaman<span class="loader-dots"><i>.</i><i>.</i><i>.</i></span></p>
  </div>
  <div id="db-wrapper" class="<?= get_cookie('navbarStatus'); ?>">
    <!-- navbar vertical -->
    <!-- Sidebar -->
    <nav aria-label="navbar" class="navbar-vertical navbar nav-dashboard">
      <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand text-white fw-bold" href="<?= base_url() ?>">
          🚀 <span class="text-success">SIMPUN</span>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
          <li class="nav-item">
            <a
              class="nav-link has-arrow <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>"
              href="<?= base_url('/app/dashboard') ?>">
              <i
                data-feather="home"
                class="nav-icon icon-xs me-2 rounded"></i>
              Dashboard
            </a>
          </li>

          <!-- Nav item -->
          <li class="nav-item">
            <div class="navbar-heading text-white">MENU UTAMA</div>
          </li>
          <?php if (
            in_array($this->session->userdata('level'), ['ADMIN', 'USER'])
          ): ?>
            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(3) === 'buatusul' ? 'border-4 border-start' : '' ?>">
              <a
                class="nav-link has-arrow <?= $this->uri->segment(3) === 'buatusul' ? 'active' : '' ?>"
                href="<?= base_url('/app/pensiun/buatusul') ?>">
                <i
                  data-feather="user-plus"
                  class="nav-icon icon-xs me-2 text-primary">
                </i>
                Buat Usul
              </a>
            </li>

            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(2) === 'inbox' ? 'border-4 border-start' : '' ?>">
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'inbox' ? 'active' : '' ?>"
                href="<?= base_url('/app/inbox/usul') ?>">
                <i data-feather="inbox" class="nav-icon icon-xs me-2 text-info">
                </i>
                Inbox
              </a>
            </li>
          <?php endif; ?>
          <!-- Nav item -->
          <li
            class="nav-item <?= $this->uri->segment(3) === 'cekusul' ? 'border-4 border-start' : '' ?>">
            <a
              class="nav-link has-arrow <?= $this->uri->segment(3) === 'cekusul' ? 'active' : '' ?>"
              href="<?= base_url('/app/pensiun/cekusul') ?>">
              <i
                data-feather="check-circle"
                class="nav-icon icon-xs me-2 text-danger">
              </i>
              Monitoring Usulan
            </a>
          </li>
          <?php if (
            in_array($this->session->userdata('username'), ['putra']) ||
            in_array($this->session->userdata('nip'), ['199412242019032007', '198402052009042001'])
          ): ?>
            <!-- Nav item -->
            <li class="nav-item">
              <div class="navbar-heading text-white">VERIFIKATOR</div>
            </li>
            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(2) === 'verifikasi' ? 'border-4 border-start' : '' ?>">
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'verifikasi' ? 'active' : '' ?>"
                href="<?= base_url('/app/verifikasi/list') ?>">
                <i class="nav-icon bi bi-patch-check-fill text-primary me-2">
                </i>
                Verifikasi
              </a>
            </li>

            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(2) === 'arsip' ? 'border-4 border-start' : '' ?>">
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'arsip' ? 'active' : '' ?>"
                href="<?= base_url('/app/arsip/list') ?>">
                <i
                  data-feather="archive"
                  class="nav-icon text-warning icon-xs me-2">
                </i>
                Arsip
              </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
              <div class="navbar-heading text-white">REFERENSI</div>
            </li>
            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(3) === 'jenis_pensiun' ? 'border-4 border-start' : '' ?>">
              <a
                class="nav-link has-arrow <?= $this->uri->segment(3) === 'jenis_pensiun' ? 'active' : '' ?>"
                href="<?= base_url('/app/referensi/jenis_pensiun') ?>">
                <i
                  data-feather="git-merge"
                  class="nav-icon text-info icon-xs me-2">
                </i>
                Jenis Pensiun
              </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
              <div class="navbar-heading text-white">REPORT APLIKASI</div>
            </li>
            <!-- Nav item -->
            <!-- Nav item -->
            <li class="nav-item">
              <a
                class="nav-link has-arrow"
                href="#!"
                data-bs-toggle="collapse"
                data-bs-target="#navPages"
                aria-expanded="false"
                aria-controls="navPages">
                <i data-feather="layers" class="nav-icon icon-xs me-2"> </i>
                Laporan
              </a>

              <div
                id="navPages"
                class="collapse <?= $this->uri->segment(3) === 'usul_pensiun' || $this->uri->segment(3) === 'pengantar_usul' || $this->uri->segment(3) === 'verval_usul' || $this->uri->segment(3) === 'approve_usul' || $this->uri->segment(3) === 'trend_kesalahan_usulan' || $this->uri->segment(3) === 'tanda_terima_sk_pensiun' || $this->uri->segment(3) === 'trend_jenis_usulan' || $this->uri->segment(3) === 'trend_periode_usulan' ? 'show' : '' ?>"
                data-bs-parent="#sideNavbar">
                <ul class="nav flex-column">
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'usul_pensiun' ? 'border-4 border-start' : '' ?>">
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/usul_pensiun') ?>">
                      Usul Pensiun
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'pengantar_usul' ? 'border-4 border-start' : '' ?>">
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/pengantar_usul') ?>">
                      Pengantar Usul
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'verval_usul' ? 'border-4 border-start' : '' ?>">
                    <a
                      class="nav-link has-arrow"
                      href="<?= base_url('/app/laporan/verval_usul') ?>">
                      Verifikasi & Approve Usul
                    </a>
                  </li>

                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'tanda_terima_sk_pensiun' ? 'border-4 border-start' : '' ?>">
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/tanda_terima_sk_pensiun') ?>">
                      Tanda Terima SK Pensiun
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'trend_kesalahan_usulan' ? 'border-4 border-start' : '' ?>">
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/trend_kesalahan_usulan') ?>">
                      Trend Kesalahan Usulan
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
    <!-- Page content -->
    <div id="page-content">
      <div class="header @@classList">
        <!-- navbar -->
        <nav aria-label="navbar" class="navbar-classic navbar navbar-expand-lg">
          <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
          <!--Navbar nav -->
          <ul
            class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
            <li class="dropdown stopevent">
              <a
                class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted"
                href="#"
                role="button"
                id="dropdownNotification"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <i class="icon-xs" data-feather="bell"></i>
              </a>
              <div
                class="dropdown-menu dropdown-menu-lg dropdown-menu-end"
                aria-labelledby="dropdownNotification">
                <div>
                  <div
                    class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                    <a href="#" class="text-muted">
                      <span>
                        <i class="me-1 icon-xxs" data-feather="settings"></i>
                      </span>
                    </a>
                  </div>
                  <!-- List group -->
                  <ul
                    class="list-group list-group-flush notification-list-scroll">
                    <!-- List group item -->
                    <li class="list-group-item bg-light">
                      <a href="#" class="text-muted">
                        <h5 class="mb-1">Admin</h5>
                        <p class="mb-0">
                          Halo,
                          <strong><?= $this->session->userdata('nama_lengkap');
                                  ?></strong>
                          selamat datang di aplikasi SIMPUN Pegawai (Sistem
                          Informasi Pengelolaan Usulan Pensiun) by BKPSDM Kab.
                          Balangan
                        </p>
                      </a>
                    </li>
                  </ul>
                  <div class="border-top px-3 py-2 text-center">
                    <a href="#" class="text-inherit fw-semi-bold">
                      View all Notifications
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
              <a
                class="rounded-circle"
                href="#"
                role="button"
                id="dropdownUser"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                  <img
                    alt="avatar"
                    src="<?= base_url('template/assets/images/avatar/user-empty.png') ?>"
                    class="rounded-circle" />
                </div>
              </a>
              <div
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="dropdownUser">
                <div class="px-4 pb-0 pt-2">
                  <div class="lh-1">
                    <h5 class="mb-1">
                      <?= $this->session->userdata('nama_lengkap'); ?></h5>
                    <button
                      type="button"
                      class="btn btn-sm btn-primary text-inherit fs-6"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#offcanvasRight"
                      aria-controls="offcanvasRight">View my profile</button>
                  </div>
                  <div class="dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">
                  <li>
                    <button
                      type="button"
                      class="dropdown-item"
                      onclick="return window.location.href = 'https://silka-sso-panel.vercel.app/dashboard'">
                      <i
                        class="me-2 icon-xxs dropdown-item-icon"
                        data-feather="list"></i>Pindah Layanan
                    </button>
                  </li>
                  <li>
                    <button
                      type="button"
                      class="dropdown-item"
                      onclick="return Logout()">
                      <i
                        class="me-2 icon-xxs dropdown-item-icon"
                        data-feather="power"></i>Log Out
                    </button>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
      </div>
      <?php $this->load->view($content); ?>
    </div>
  </div>
  <!-- View Profile Off Canvas -->
  <div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel" class="fw-bold">MY ACCOUNT</h5>
      <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="avatar avatar-xl avatar-indicators avatar-online">
        <img
          alt="avatar"
          src="<?= $this->session->userdata('picture') ?? base_url('template/assets/images/avatar/user-empty.png'); ?>"
          class="rounded-circle" />
      </div>
      <ul class="list-unstyled mt-6">
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">LEVEL USER</div>
          <div class="fw-bold"><?= $this->session->userdata('level'); ?></div>
        </li>
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">NIP</div>
          <div class="fw-bold"><?= $this->session->userdata('nip'); ?></div>
        </li>
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">NAMA</div>
          <div class="fw-bold"><?= $this->session->userdata('nama_lengkap'); ?></div>
        </li>
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">JENIS KELAMIN</div>
          <div class="fw-bold"><?= strtoupper($this->session->userdata('jenkel')); ?></div>
        </li>
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">TANGGAL LAHIR</div>
          <div class="fw-bold"><?= strtoupper(date_indo($this->session->userdata('tgl_lahir')));
                                ?></div>
        </li>
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">PANGKAT</div>
          <div class="fw-bold"><?= strtoupper($this->session->userdata('pangkat')); ?></div>
        </li>
        <li class="pb-4 mb-4 border-bottom">
          <div class="fs-sm lh-1">JABATAN</div>
          <div class="fw-bold"><?= strtoupper($this->session->userdata('jabatan')); ?></div>
        </li>
        <li class="pb-4 mb-4">
          <div class="fs-sm lh-1">UNIT KERJA</div>
          <div class="fw-bold"><?= strtoupper($this->session->userdata('unker')); ?></div>
        </li>
      </ul>
    </div>
  </div>

  <!-- Scripts -->
  <!-- Libs JS -->
  <script src="<?= base_url('template/') ?>assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/feather-icons/dist/feather.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/prismjs/prism.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/dropzone/dist/min/dropzone.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/libs/jquery-toast/iziToast.min.js"></script>

  <!-- Theme JS -->
  <script src="<?= base_url('template/') ?>assets/js/theme.min.js"></script>
  <script src="<?= base_url('template/') ?>assets/js/format.js"></script>
  <script src="<?= base_url('template/') ?>assets/js/route.js"></script>
  <script src="<?= base_url('template/') ?>assets/js/logout.js"></script>

  <?php if ($this->uri->segment(3) === 'buatusul') : ?>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/parsley/dist/parsley.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap/bootstrap-maxlength.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/buatusul.js"></script>
  <?php endif; ?> <?php if ($this->uri->segment(3) === 'cekusul') : ?>
    <script src="<?= base_url('template/') ?>assets/js/cekusul.js"></script>
  <?php endif; ?> <?php if ($this->uri->segment(2) === 'dashboard') : ?>
    <script src="<?= base_url('template/') ?>assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <?php endif; ?> <?php if ($this->uri->segment(2) === 'inbox') : ?>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/inboxusul.js"></script>
  <?php endif; ?> <?php if ($this->uri->segment(2) === 'arsip') : ?>
    <script src="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/arsip.js"></script>
  <?php endif; ?> <?php if ($this->uri->segment(2) === 'verifikasi') : ?>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/parsley/dist/parsley.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datetimepicker/js/moment-with-locales.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/verifikasi.js"></script>
  <?php endif; ?> <?php if ($this->uri->segment(2) === 'referensi') : ?>
    <script src="<?= base_url('template/') ?>assets/js/ref_jenis_pensiun.js"></script>
  <?php endif; ?>
  <script>
    // ===== page navigation loader =====
    (function() {
      var loader = document.getElementById('page-loader');
      if (!loader) return;

      var shownAt = 0;
      var MIN_DISPLAY = 400; // ms, avoid flicker on fast navigations
      var safetyTimer = null;

      function show() {
        shownAt = Date.now();
        loader.classList.add('is-visible');
        loader.setAttribute('aria-hidden', 'false');
      }

      function hide() {
        var elapsed = Date.now() - shownAt;
        var wait = Math.max(0, MIN_DISPLAY - elapsed);
        setTimeout(function() {
          loader.classList.remove('is-visible');
          loader.setAttribute('aria-hidden', 'true');
        }, wait);
      }

      document.addEventListener('click', function(e) {
        var t = e.target;
        var a = t && t.closest ? t.closest('a') : null;
        if (!a) return;

        var href = a.getAttribute('href') || '';
        // skip controls that don't navigate the page
        if (a.target === '_blank' || a.hasAttribute('download') ||
          a.getAttribute('data-bs-toggle') || a.hasAttribute('data-bs-target') ||
          href === '' || href === '#' || href === '#!' ||
          /^javascript:/i.test(href)) {
          return;
        }

        show();
        clearTimeout(safetyTimer);
        safetyTimer = setTimeout(hide, 10000); // never leave the loader stuck
      });

      window.addEventListener('load', hide);
    })();
  </script></body>

</html>