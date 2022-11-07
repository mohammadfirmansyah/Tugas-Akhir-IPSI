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
    <div class="container my-4 pt-4 px-5" style="border-color: #fff; border-style: solid; border-width: 3px; border-radius: 20px; z-index: 1; backdrop-filter: blur(16px); background-color: transparent;" data-aos="fade-up" data-aos-delay="200">
      <div class="card-deck-wrapper">
        <div class="card-deck">
          <?php
          foreach ($Data_Kelas as $rowData) : ?>
            <div class="card p-4 mb-4" style="border-radius: 15px;">
              <h2 class="card-title mb-4" style="color: #000;"><?php echo $rowData->mataPelajaran; ?></h2>
              <h4 class="card-title mb-4" style="color: #000; font-size: 20px;">Nama Guru &nbsp;: <?php echo $rowData->namaGuru; ?></h4>
              <h4 class="card-title" id="kodeKelas" style="color: #000; font-size: 20px;">Kode Kelas &ensp;: <?php echo $rowData->kodeKelas; ?><button type="submit" onclick="copyKodeKelas()" style="background: transparent; border: 0px;"><img src="<?php echo base_url(); ?>assets/img/salin.png"></button>
                <span style="float:right; font-size: 18px;">
                  <a href="<?php echo base_url('editDetailKelas/' . $rowData->idKelas); ?>" class="card-text btn-get-started_f"><small class="text-muted">Edit Detail Kelas</small><button type="submit" style="background: transparent; border: 0px;"><img src="<?php echo base_url(); ?>assets/img/edit.png"></button></a>
                </span>
              </h4>
              <input type="text" value="<?php echo $rowData->kodeKelas; ?>" id="myInput" style="display: none;">
              <script>
                function copyKodeKelas() {
                  // Mengambil teks
                  let copyText = document.getElementById("myInput");

                  // Memilih input teks
                  copyText.select();
                  copyText.setSelectionRange(0, 99999); // For mobile devices

                  // Menyalin value di dalam input teks
                  navigator.clipboard.writeText(copyText.value);

                  // Memberikan pesan berhasil menyalin
                  alert("Berhasil Menyalin Kode Kelas: " + copyText.value);
                }
              </script>
              <hr>
              <p class="card-text mb-4" style="color: #808080;"><?php echo $rowData->deskripsiKelas; ?></p>
              <h4 class="card-title" style="color: #000; font-size: 20px;">Anggota Kelas :</h4>
              <?php
              foreach ($Anggota_Kelas as $rowAnggota) : ?>
                <div class="d-flex justify-content-center justify-content-lg-start">
                  <a href="<?php echo base_url('profilSiswa/' . $rowAnggota->idSiswa); ?>" class="btn-get-started_c" style="border-radius: 15px; min-width: 500px; height: 60px; text-align: left; line-height : 37.5px;"><img src="<?php echo base_url(); ?>assets/img/profil-black.png" class="img-fluid imghov" style="height: 75%;  margin-right: 10px;"><?php echo $rowAnggota->namaSiswa ?>
                    <span style="float:right; font-size: 18px;">
                      <form action="<?php echo base_url('hapusAnggotaKelas_process/'. $idKelas .'/'. $$rowAnggota->idSiswa); ?>">
                        <button type="submit" style="background: transparent; border: 0px;"><img src="<?php echo base_url(); ?>assets/img/edit.png"></button></a>
                  </form>
                  </span>
                  </a>
                </div>
              <?php
              endforeach; ?>
            </div>
          <?php
          endforeach; ?>
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