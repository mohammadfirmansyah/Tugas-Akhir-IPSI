<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Lexend Deca' rel='stylesheet'>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <nav id="navbar" class="navbar" style="margin-right: auto;">
        <ul>
          <li>
            <h1 class="logo me-auto">
              <a href="<?php echo base_url(''); ?>" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
            </h1>
          </li>
          <li><a class="nav-link" href="<?php echo base_url('Dashboard'); ?>">Home</a></li>
          <li><a class="nav-link scrollto active" href="<?php echo base_url('kelasSaya'); ?>"><span>Kelas Saya</span></a>
          </li>
      </nav>

      <nav id="navbar" class="navbar" style="margin-left: auto;">
        <ul>
          <li><a class="getstarted" href="<?php echo base_url('joinKelas'); ?>">GABUNG KELAS +</a></li>
          <li><a href="<?php echo base_url('guru/' . $idGuru); ?>" class="logo me-auto nav-link" style="margin-left: 30px;"><img src="assets/img/profil.png" alt="" class="img-fluid"></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container my-4 pt-4 px-5" style="border-color: #fff; border-style: solid; border-width: 3px; border-radius: 20px; z-index: 1; backdrop-filter: blur(16px);" data-aos="fade-up" data-aos-delay="200">
      <div class="card-deck-wrapper">
        <div class="card-deck">
          <?php
          if (!empty($List_Kelas)) { ?>
            <?php
            foreach ($List_Kelas as $rowId) :
              $Detail_Kelas = $this->Kelas->getDetailKelas($rowId->idKelas);
              foreach ($Detail_Kelas as $rowDetail) : ?>
                <div class="card p-4 mb-4 dafkelhov" style="border-radius: 15px;">
                  <a class="card-block stretched-link text-decoration-none" style="text-align: left;" href="<?php echo base_url('kelas/' . $rowId->idKelas); ?>">
                    <h2 class="card-title mb-4" style="color: #000;"><?php echo $rowDetail->mataPelajaran; ?></h2>
                    <h4 class="card-title" style="color: #000; font-size: 20px;"><?php echo $rowDetail->namaGuru; ?>
                    </h4>
                    <p class="card-text" style="color: #808080;"><?php echo $rowDetail->deskripsiKelas; ?></p>
                  </a>
                </div>
            <?php
              endforeach;
            endforeach; ?>
          <?php
          } else {
          ?>
            <li>
              <h1 style="font-size: 32px; text-align: center;">Kamu belum memiliki kelas!</h1>
              <h2 style="text-align: center;">Gabung sekarang dengan menekan Gabung Kelas + yang terdapat di atas halaman.</h2>
            </li>
          <?php } ?>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>

  </section>
  <!-- End Hero -->

  <!-- ======= Footer ======= -->
  <div id="footwave">
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="#0B444A" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="#E5E5E5" style="opacity: 0.1;" />
      </g>
    </svg>
    <footer id="footer">
      <div class="container footer-bottom clearfix" id="footcopyright">
        <div class="copyright">
          Copyright &copy; 2022. <strong><span>Made by Kelompok 4 IPSI PTI 2022</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Resource <a href="https://github.com/mohammadfirmansyah/Tugas-Akhir-IPSI" target="_blank">GitHub</a>
        </div>
      </div>
    </footer>
  </div>
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>