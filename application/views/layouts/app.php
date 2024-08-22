<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Favicon icon-->
    <link
      rel="shortcut icon"
      type="image/png"
      href="<?= base_url('template/') ?>assets/images/approve.png"
    />

    <!-- Libs CSS -->
    <link
      href="<?= base_url('template/') ?>assets/libs/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/dropzone/dist/dropzone.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/@mdi/font/css/materialdesignicons.min.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/jquery-toast/iziToast.min.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/prismjs/themes/prism-okaidia.min.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
      rel="stylesheet"
    />
    <link
      href="<?= base_url('template/') ?>assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
      rel="stylesheet"
    />
    <?php if ($this->uri->segment(2) === 'inbox' || $this->uri->segment(2) ===
    'verifikasi' || $this->uri->segment(2) === 'arsip') : ?>
    <link
      href="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.css"
      rel="stylesheet"
    />
    <?php endif; ?> <?php if ($this->uri->segment(3) === 'cekusul') : ?>
    <link
      href="<?= base_url('template/') ?>assets/css/timeline.css"
      rel="stylesheet"
    />
    <?php endif; ?>
    <!-- Theme CSS -->
    <link
      rel="stylesheet"
      href="<?= base_url('template/') ?>assets/css/theme.min.css"
    />
    <title><?= $title ?></title>
  </head>

  <body class="bg-light">
    <div id="db-wrapper" class="<?= get_cookie('navbarStatus'); ?>">
      <!-- navbar vertical -->
      <!-- Sidebar -->
      <nav class="navbar-vertical navbar nav-dashboard">
        <div class="nav-scroller">
          <!-- Brand logo -->
          <a class="navbar-brand text-white fw-bold" href="<?= base_url() ?>">
            🚀 <span class="text-primary">SIMPUN</span> Pegawai
          </a>
          <!-- Navbar nav -->
          <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>"
                href="<?= base_url('/app/dashboard') ?>"
              >
                <i
                  data-feather="home"
                  class="nav-icon icon-xs me-2 rounded"
                ></i>
                Dashboard
              </a>
            </li>

            <!-- Nav item -->
            <li class="nav-item">
              <div class="navbar-heading text-white">MENU UTAMA</div>
            </li>
            <?php if ($this->session->userdata('level') === 'ADMIN' ||
            $this->session->userdata('level') === 'USER'): ?>
            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(3) === 'buatusul' ? 'border-4 border-start' : '' ?>"
            >
              <a
                class="nav-link has-arrow <?= $this->uri->segment(3) === 'buatusul' ? 'active' : '' ?>"
                href="<?= base_url('/app/pensiun/buatusul') ?>"
              >
                <i
                  data-feather="user-plus"
                  class="nav-icon icon-xs me-2 text-primary"
                >
                </i>
                Buat Usul
              </a>
            </li>

            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(2) === 'inbox' ? 'border-4 border-start' : '' ?>"
            >
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'inbox' ? 'active' : '' ?>"
                href="<?= base_url('/app/inbox/usul') ?>"
              >
                <i data-feather="inbox" class="nav-icon icon-xs me-2 text-info">
                </i>
                Inbox
              </a>
            </li>
            <?php endif; ?>
            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(3) === 'cekusul' ? 'border-4 border-start' : '' ?>"
            >
              <a
                class="nav-link has-arrow <?= $this->uri->segment(3) === 'cekusul' ? 'active' : '' ?>"
                href="<?= base_url('/app/pensiun/cekusul') ?>"
              >
                <i
                  data-feather="check-circle"
                  class="nav-icon icon-xs me-2 text-danger"
                >
                </i>
                Monitoring Usulan
              </a>
            </li>
            <?php if ($this->session->userdata('username') === 'putra' ||
            $this->session->userdata('nip') === '199412242019032007'): ?>
            <!-- Nav item -->
            <li class="nav-item">
              <div class="navbar-heading text-white">VERIFIKATOR</div>
            </li>
            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(2) === 'verifikasi' ? 'border-4 border-start' : '' ?>"
            >
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'verifikasi' ? 'active' : '' ?>"
                href="<?= base_url('/app/verifikasi/list') ?>"
              >
                <i class="nav-icon bi bi-patch-check-fill text-primary me-2">
                </i>
                Verifikasi Usul
              </a>
            </li>

            <!-- Nav item -->
            <li
              class="nav-item <?= $this->uri->segment(2) === 'arsip' ? 'border-4 border-start' : '' ?>"
            >
              <a
                class="nav-link has-arrow <?= $this->uri->segment(2) === 'arsip' ? 'active' : '' ?>"
                href="<?= base_url('/app/arsip/list') ?>"
              >
                <i
                  data-feather="archive"
                  class="nav-icon text-warning icon-xs me-2"
                >
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
              class="nav-item <?= $this->uri->segment(3) === 'jenis_pensiun' ? 'border-4 border-start' : '' ?>"
            >
              <a
                class="nav-link has-arrow <?= $this->uri->segment(3) === 'jenis_pensiun' ? 'active' : '' ?>"
                href="<?= base_url('/app/referensi/jenis_pensiun') ?>"
              >
                <i
                  data-feather="git-merge"
                  class="nav-icon text-info icon-xs me-2"
                >
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
                class="collapse <?= $this->uri->segment(3) === 'usul_pensiun' || $this->uri->segment(3) === 'pengantar_usul' || $this->uri->segment(3) === 'verifikasi_usul' || $this->uri->segment(3) === 'approve_usul' || $this->uri->segment(3) === 'trend_kesalahan_usulan' || $this->uri->segment(3) === 'tanda_terima_sk_pensiun' || $this->uri->segment(3) === 'trend_jenis_usulan' || $this->uri->segment(3) === 'trend_periode_usulan' ? 'show' : '' ?>"
                data-bs-parent="#sideNavbar">
                <ul class="nav flex-column">
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'usul_pensiun' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/usul_pensiun') ?>"
                    >
                      Usul Pensiun
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'pengantar_usul' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/pengantar_usul') ?>"
                    >
                      Pengantar Usul
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'verifikasi_usul' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link has-arrow"
                      href="<?= base_url('/app/laporan/verifikasi_usul') ?>"
                    >
                      Verifikasi Usul
                    </a>
                  </li>

                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'approve_usul' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/approve_usul') ?>"
                    >
                      Approve Usul
                    </a>
                  </li>

                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'trend_kesalahan_usulan' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/trend_kesalahan_usulan') ?>"
                    >
                      Trend Kesalahan Usulan
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'tanda_terima_sk_pensiun' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/tanda_terima_sk_pensiun') ?>"
                    >
                      Tanda Terima SK Pensiun
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'trend_jenis_usulan' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/trend_jenis_usulan') ?>"
                    >
                      Trend Jenis Usulan
                    </a>
                  </li>
                  <li
                    class="nav-item <?= $this->uri->segment(3) === 'trend_periode_usulan' ? 'border-4 border-start' : '' ?>"
                  >
                    <a
                      class="nav-link"
                      href="<?= base_url('/app/laporan/trend_periode_usulan') ?>"
                    >
                      Trend Periode Usulan
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
          <nav class="navbar-classic navbar navbar-expand-lg">
            <a id="nav-toggle" href="#"
              ><i data-feather="menu" class="nav-icon me-2 icon-xs"></i
            ></a>
            <!--Navbar nav -->
            <ul
              class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap"
            >
              <li class="dropdown stopevent">
                <a
                  class="btn btn-light btn-icon rounded-circle indicator indicator-primary text-muted"
                  href="#"
                  role="button"
                  id="dropdownNotification"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="icon-xs" data-feather="bell"></i>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-lg dropdown-menu-end"
                  aria-labelledby="dropdownNotification"
                >
                  <div>
                    <div
                      class="border-bottom px-3 pt-2 pb-3 d-flex justify-content-between align-items-center"
                    >
                      <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                      <a href="#" class="text-muted">
                        <span>
                          <i class="me-1 icon-xxs" data-feather="settings"></i>
                        </span>
                      </a>
                    </div>
                    <!-- List group -->
                    <ul
                      class="list-group list-group-flush notification-list-scroll"
                    >
                      <!-- List group item -->
                      <li class="list-group-item bg-light">
                        <a href="#" class="text-muted">
                          <h5 class="mb-1">Admin</h5>
                          <p class="mb-0">
                            Halo,
                            <strong
                              ><?= $this->session->userdata('nama_lengkap');
                              ?></strong
                            >
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
                  aria-expanded="false"
                >
                  <div class="avatar avatar-md avatar-indicators avatar-online">
                    <img
                      alt="avatar"
                      src="<?= $this->session->userdata('picture'); ?>"
                      class="rounded-circle"
                    />
                  </div>
                </a>
                <div
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="dropdownUser"
                >
                  <div class="px-4 pb-0 pt-2">
                    <div class="lh-1">
                      <h5 class="mb-1">
                        <?= $this->session->userdata('nama_lengkap'); ?></h5
                      >
                      <button
                        type="button"
                        class="btn btn-sm btn-primary text-inherit fs-6"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight"
                        >View my profile</button
                      >
                    </div>
                    <div class="dropdown-divider mt-3 mb-2"></div>
                  </div>

                  <ul class="list-unstyled">
                    <li>
                      <button
                        type="button"
                        class="dropdown-item"
                        onclick="return Logout()"
                      >
                        <i
                          class="me-2 icon-xxs dropdown-item-icon"
                          data-feather="power"
                        ></i
                        >Log Out
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
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel" class="fw-bold">MY ACCOUNT</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div class="avatar avatar-xl avatar-indicators avatar-online">
          <img
            alt="avatar"
            src="<?= $this->session->userdata('picture'); ?>"
            class="rounded-circle"
          />
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
            <div class="fw-bold"
              ><?= $this->session->userdata('nama_lengkap'); ?></div
            >
          </li>
          <li class="pb-4 mb-4 border-bottom">
            <div class="fs-sm lh-1">JENIS KELAMIN</div>
            <div class="fw-bold"
              ><?= strtoupper($this->session->userdata('jenkel')); ?></div
            >
          </li>
          <li class="pb-4 mb-4 border-bottom">
            <div class="fs-sm lh-1">TANGGAL LAHIR</div>
            <div class="fw-bold"
              ><?= strtoupper(date_indo($this->session->userdata('tgl_lahir')));
              ?></div
            >
          </li>
          <li class="pb-4 mb-4 border-bottom">
            <div class="fs-sm lh-1">PANGKAT</div>
            <div class="fw-bold"
              ><?= strtoupper($this->session->userdata('pangkat')); ?></div
            >
          </li>
          <li class="pb-4 mb-4 border-bottom">
            <div class="fs-sm lh-1">JABATAN</div>
            <div class="fw-bold"
              ><?= strtoupper($this->session->userdata('jabatan')); ?></div
            >
          </li>
          <li class="pb-4 mb-4">
            <div class="fs-sm lh-1">UNIT KERJA</div>
            <div class="fw-bold"
              ><?= strtoupper($this->session->userdata('unker')); ?></div
            >
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
  </body>
</html>
