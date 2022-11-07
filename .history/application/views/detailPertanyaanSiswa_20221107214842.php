<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url(); ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo base_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lexend Deca" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <nav id="navbar" class="navbar" style="margin-right: auto;">
        <ul>
          <li>
            <h1 class="logo me-auto">
              <a href="<?php echo base_url(''); ?>" class="logo me-auto"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="" class="img-fluid"></a>
            </h1>
          </li>
          <li><a class="nav-link" href="<?php echo base_url('Dashboard'); ?>">Home</a></li>
          <li class="nav-link"><a href="<?php echo base_url('kelasSaya'); ?>"><span>Kelas Saya</span></a>
          </li>
      </nav>

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container my-4 pt-4 px-5" style="border-color: #fff; border-style: solid; border-width: 3px; border-radius: 20px; z-index: 1; backdrop-filter: blur(16px); background-color: transparent;">
      <div class="card-deck-wrapper">
        <div class="card-deck">
          <?php
          // foreach ($Data_Pertanyaan as $rowData) : 
          ?>
          <div class="card p-4 mb-4" style="border-radius: 15px;">
            <a class="card-title mb-4" style="color: #000; font-size: 30px;" href=""><img src="<?php echo base_url(); ?>assets/img/profil-black.png" class="img-fluid" style="display: flexbox; height: 40px;  margin-right: 10px;">Anonim</a>
            <h4 class="card-title mb-4" style="color: #000; font-size: 20px;">2022-11-07 - Judul Materi</h4>
            <hr>
            <h3 class="card-text mb-4" style="color: #000;">Deskripsi Pertanyaan Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua?</h3>
            <h4 class="card-title mb-4" style="color: #000; font-size: 20px;">Hasil Jawaban :</h4>
            <?php if (!empty($Data_Jawaban)) { ?>
              <div class="p-3" style="border-radius: 15px; min-width: 500px; text-align: left; background: #D9D9D9;">
                <a class="card-title btn-get-started_c" style="font-size: 30px; margin: 0px;" href=""><img src="<?php echo base_url(); ?>assets/img/profil-black.png" class="img-fluid" style="display: flexbox; height: 40px;  margin-right: 10px;">Nama Guru</a>
                <hr>
                <h3 class="card-text mb-4" style="color: #000;">Deskripsi Jawaban Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua?</h3>
              </div>
              <div class="p-3 mt-4" style="border-radius: 15px; min-width: 500px; text-align: left; background: #D9D9D9; margin-left: 10vw;">
                <a class="card-title btn-get-started_c" style="font-size: 30px; margin: 0px;" href=""><img src="<?php echo base_url(); ?>assets/img/profil-black.png" class="img-fluid" style="display: flexbox; height: 40px;  margin-right: 10px;">Nama Guru</a>
                <hr>
                <h3 class="card-text mb-4" style="color: #000;">Deskripsi Komentar Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua?</h3>
              </div>
              <textarea name="deskripsiKomentar" id="deskripsiKomentar" cols="30" rows="10"></textarea>
            <?php } else { ?>
              <h2>Guru belum memberikan jawaban.</h2>
            <?php } ?>
          </div>
          <?php
          // endforeach; 
          ?>
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
  <script src="<?php echo base_url(); ?>assets/vendor/aos/aos.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>

</html>