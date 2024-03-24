<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('template/') ?>assets/images/favicon/favicon.ico">

    <!-- Libs CSS -->
    <link href="<?= base_url('template/') ?>assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="<?= base_url('template/') ?>assets/libs/jquery-toast/iziToast.min.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/prismjs/themes/prism-okaidia.min.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <?php if ($this->uri->segment(2) === 'inbox' || $this->uri->segment(2) === 'verifikasi' || $this->uri->segment(2) === 'arsip') : ?>
    <link href="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.css" rel="stylesheet">
    <?php endif; ?>
    <?php if ($this->uri->segment(3) === 'cekusul') : ?>
    <link href="<?= base_url('template/') ?>assets/css/timeline.css" rel="stylesheet">
    <?php endif; ?>
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/css/theme.min.css">
    <title><?= $title ?></title>
</head>

<body class="bg-light">
    <?php $toggled = $this->uri->segment(3) === 'buatusul' || $this->uri->segment(3) === 'usul' ? 'toggled' : ''; ?>
    <div id="db-wrapper" class="<?= $toggled ?>">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar nav-dashboard">
            <div class="nav-scroller">
                <!-- Brand logo -->
                <a class="navbar-brand text-white fw-bold" href="<?= base_url() ?>">
                    <span class="text-primary">e</span>Pensiun ASN
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    <li class="nav-item">
                        <a class="nav-link has-arrow <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('/app/dashboard') ?>">
                            <i data-feather="home" class="nav-icon icon-xs me-2 rounded "></i> Dashboard
                        </a>
                    </li>

                    <!-- Nav item -->
                    <li class="nav-item">
                        <div class="navbar-heading text-white">Mainmenu</div>
                    </li>
                    <?php if($this->session->userdata('level') === 'ADMIN' || $this->session->userdata('level') === 'USER'): ?>
                    <!-- Nav item -->
                    <li class="nav-item <?= $this->uri->segment(3) === 'buatusul' ? 'border-4 border-start' : '' ?>">
                        <a class="nav-link has-arrow <?= $this->uri->segment(3) === 'buatusul' ? 'active' : '' ?>" href="<?= base_url('/app/pensiun/buatusul') ?>">
                            <i data-feather="user-plus" class="nav-icon icon-xs me-2 text-primary">
                            </i> Buat Usul
                        </a>
                    </li>

                    <!-- Nav item -->
                    <li class="nav-item <?= $this->uri->segment(2) === 'inbox' ? 'border-4 border-start' : '' ?>">
                        <a class="nav-link has-arrow  <?= $this->uri->segment(2) === 'inbox' ? 'active' : '' ?>" href="<?= base_url('/app/inbox/usul') ?>">
                            <i data-feather="inbox" class="nav-icon icon-xs me-2 text-info">
                            </i> Inbox
                        </a>
                    </li>
                    <?php endif; ?>
                    <!-- Nav item -->
                    <li class="nav-item <?= $this->uri->segment(3) === 'cekusul' ? 'border-4 border-start' : '' ?>">
                        <a class="nav-link has-arrow  <?= $this->uri->segment(3) === 'cekusul' ? 'active' : '' ?>" href="<?= base_url('/app/pensiun/cekusul') ?>">
                            <i data-feather="check-circle" class="nav-icon icon-xs me-2 text-danger">
                            </i> Monitoring Usulan
                        </a>
                    </li>
                    <?php if($this->session->userdata('username') === 'putra'): ?>
                    <!-- Nav item -->
                    <li class="nav-item">
                        <div class="navbar-heading text-white">BKPSDM ONLY</div>
                    </li>
                    <!-- Nav item -->
                    <li class="nav-item <?= $this->uri->segment(2) === 'verifikasi' ? 'border-4 border-start' : '' ?>">
                        <a class="nav-link has-arrow  <?= $this->uri->segment(2) === 'verifikasi' ? 'active' : '' ?>" href="<?= base_url('/app/verifikasi/list') ?>">
                            <i class="nav-icon bi bi-patch-check-fill text-primary me-2">
                            </i> Verifikasi Usul
                        </a>
                    </li>

                    <!-- Nav item -->
                    <li class="nav-item <?= $this->uri->segment(2) === 'arsip' ? 'border-4 border-start' : '' ?>">
                        <a class="nav-link has-arrow  <?= $this->uri->segment(2) === 'arsip' ? 'active' : '' ?>" href="<?= base_url('/app/arsip/list') ?>">
                            <i data-feather="archive" class="nav-icon text-warning icon-xs me-2">
                            </i> Arsip
                        </a>
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
                    <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                    <!--Navbar nav -->
                    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                        <li class="dropdown stopevent">
                            <a class="btn btn-light btn-icon rounded-circle indicator
          indicator-primary text-muted" href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-xs" data-feather="bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                                <div>
                                    <div class="border-bottom px-3 pt-2 pb-3 d-flex
              justify-content-between align-items-center">
                                        <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                                        <a href="#" class="text-muted">
                                            <span>
                                                <i class="me-1 icon-xxs" data-feather="settings"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush notification-list-scroll">
                                        <!-- List group item -->
                                        <li class="list-group-item bg-light">
                                            <a href="#" class="text-muted">
                                                <h5 class=" mb-1">Admin</h5>
                                                <p class="mb-0">
                                                    Halo, <strong><?= $this->session->userdata('nama_lengkap'); ?></strong> selamat datang di ePensiun BKPSDM.
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
                            <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-md avatar-indicators avatar-online">
                                    <img alt="avatar" src="<?= $this->session->userdata('picture'); ?>" class="rounded-circle" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <div class="px-4 pb-0 pt-2">
                                    <div class="lh-1">
                                        <h5 class="mb-1"> <?= $this->session->userdata('nama_lengkap'); ?></h5>
                                        <button type="button" class="btn btn-sm btn-primary text-inherit fs-6" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">View my profile</button>
                                    </div>
                                    <div class=" dropdown-divider mt-3 mb-2"></div>
                                </div>

                                <ul class="list-unstyled">
                                    <li>
                                        <button type="button" class="dropdown-item" onclick="return Logout()">
                                            <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Log Out
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
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel" class="fw-bold">MY ACCOUNT</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="avatar avatar-xl avatar-indicators avatar-online">
                <img alt="avatar" src="<?= $this->session->userdata('picture'); ?>" class="rounded-circle" />
            </div>
            <ul class="list-unstyled mt-6">
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">LEVEL USER</div>
                    <div class="fw-bold "><?= $this->session->userdata('level'); ?></div>
                </li>
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">NIP</div>
                    <div class="fw-bold "><?= $this->session->userdata('nip'); ?></div>
                </li>
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">NAMA</div>
                    <div class="fw-bold "><?= $this->session->userdata('nama_lengkap'); ?></div>
                </li>
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">JENIS KELAMIN</div>
                    <div class="fw-bold "><?= strtoupper($this->session->userdata('jenkel')); ?></div>
                </li>
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">TANGGAL LAHIR</div>
                    <div class="fw-bold "><?= strtoupper(date_indo($this->session->userdata('tgl_lahir'))); ?></div>
                </li>
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">PANGKAT</div>
                    <div class="fw-bold "><?= strtoupper($this->session->userdata('pangkat')); ?></div>
                </li>
                <li class="pb-4 mb-4 border-bottom">
                    <div class="fs-sm lh-1">JABATAN</div>
                    <div class="fw-bold "><?= strtoupper($this->session->userdata('jabatan')); ?></div>
                </li>
                <li class="pb-4 mb-4">
                    <div class="fs-sm lh-1">UNIT KERJA</div>
                    <div class="fw-bold "><?= strtoupper($this->session->userdata('unker')); ?></div>
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
        <script src="<?= base_url('template/') ?>assets/js/buatusul.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(3) === 'cekusul') : ?>
        <script src="<?= base_url('template/') ?>assets/js/cekusul.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) === 'dashboard') : ?>
        <script src="<?= base_url('template/') ?>assets/js/dashboard.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) === 'inbox') : ?>
        <script src="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/js/inboxusul.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) === 'arsip') : ?>
        <script src="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/js/arsip.js"></script>
    <?php endif; ?>

    <?php if ($this->uri->segment(2) === 'verifikasi') : ?>
        <script src="<?= base_url('template/') ?>assets/libs/jquery-confirm/jquery-confirm.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/libs/parsley/dist/parsley.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/libs/DataTables/datatables.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datetimepicker/js/moment-with-locales.js"></script>
        <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?= base_url('template/') ?>assets/js/verifikasi.js"></script>
    <?php endif; ?>
</body>

</html>