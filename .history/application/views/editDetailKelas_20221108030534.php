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
  <link href='https://fonts.googleapis.com/css?family=Lexend Deca' rel='stylesheet'>

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

      <h1 class="logo me-auto">
        <a href="<?php echo base_url(); ?>" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </h1>

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card" style="background: transparent; border-color: transparent;" data-aos="fade-up" data-aos-delay="200">
            <div class="card-body p-5 text-center">
              <h1 class="pb-3">Edit Detail</h1>
              <h1 class="pb-3">Kelas</h1>
              <h2 class="mb-4" style="font-size: 15px;">Buat Kelas Baru Untuk Siswa Anda</h2>
              <form enctype="multipart/form-data" action="<?php echo base_url('saveDetail/'.$Data_Kelas->idKelas); ?>" method="post">
                <?php if ($this->session->flashdata('error')) { ?>
                <?php echo $this->session->flashdata('error');
                } ?>
                <div class="form-outline mb-4">
                  <input type="text" id="mataPelajaran" name="mataPelajaran" class="form-control form-control-lg" placeholder="Mata Pelajaran*" style="background: #224957; border-color: #224957; color: #fff;" value="<?= $Data_Kelas->mataPelajaran ?>" />
                </div>
                <div class="form-outline mb-4">
                  <textarea id="deskripsiKelas" name="deskripsiKelas" class="form-control form-control-lg" placeholder="Deskripsi Kelas*" style="background: #224957; border-color: #224957; color: #fff; min-height: 200px; resize: none;"></textarea>
                </div>
                <button class="btn-get-started_a btn-lg btn-block" type="submit" style="border-radius: 10px; width: 100%; height: 60px; text-align: center; line-height : 35px; border-color: transparent;">Tambahkan Sekarang</button>
              </form>
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