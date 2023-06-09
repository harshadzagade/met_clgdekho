<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - Product list/gallery with filter (bootstrap4)</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">

</head>


<body>

  <!-- header -->
  <header class="">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img class="nav-img" src="images/MET_BKC_logo_red_BG_180_x_180 (1).png" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-head py-4" href="#">ADMISSIONS OPEN AT MET, MUMBAI </a>
              <p class="nav-text"> Mumbai,Maharashtra | ISO9001:2005 CERTIFIED| Affiliated To : UNIVERSITY OF MUMBAI |
                Estd: 1989</p>
            </li>
          </ul>
          <div class="text2">
            <h6>In Association With</h6>
            <img src="images/logo.webp" class="clg-dekho" alt="Responsive image" />
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- header -->

  <!-- jumbotron -->
  <div class="intro-section">
    <div class="slide-1" style="background-image: url('img/met_banner.jpg')">
      <div class="container">
        <div class="row align-items-center ">
          <div class="col-12">
            <div class="row align-items-center">
              <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                <form action="clg_Visit.php" method="post" class="form-box" id="form">
                  <h3>Apply for Admissions 2023</h3>
                  <div class="form-group">
                    <input type="text" class="form-control" name="txtFname" id="txtFname" placeholder="Name" />
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email" />
                  </div>
                  <div class="form-group mb-4">
                    <input type="text" class="form-control" name="txtMobile" id="txtMobile" placeholder="Enter Mobile No." />
                  </div>
                  <div class="form-group mb-4">
                    <input type="hidden" name="course_id" id="course_id" value="" />
                  </div>
                  <div class="form-group mb-4">
                    <input type="hidden" name="extraaedge_id" id="extraaedge_id" value="" />
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-success btn-pill" name="Apply" id="Apply" value="Apply Now" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jumbotron -->


  <!-- why -->
  <div class="container">
    <div class="row">
      <div>
        <h4>
          WHY MET MUMBAI?
        </h4>
        <ul>
          <li>
            Ranked 4th Best B School in Mumbai by the Times B School Survey
            2022.
          </li>
          <li>
            Ranked 15th in West Zone by the Times B School Survey 2022.
          </li>
          <li>
            Ranked as India's 17th Best Pvt. B-School and 18th Best B-School
            for Placements by the Times B-School Survey 2022.
          </li>
          <li>
            Ranked 28th Best B school all India by Times B School Survey
            2022.
          </li>
          <li>Excellent placement opportunities in India and overseas.</li>
          <li>
            Highest Salary Package of 15.5 Lacs P.A and Average Salary
            Package of 7.5 Lacs P.A.
          </li>
          <li>
            Best e-enabled state-of-the-art infrastructural facilities.
          </li>
          <li>Strong alumni base of over 25,000 students.</li>
          <li>
            Accredited Partner Center of NCC Education UK, an awarding
            organization and global provider of British education.
          </li>
          <li>International Internship opportunities.</li>
          <li>Ph.D. Research Centre of the University of Mumbai.</li>
          <li>
            Creates platforms for global synergy through cross-cultural
            learning and networking.
          </li>
          <li>Freeship awards for meritorious students.</li>
          <li>Expert faculty and international sharing modules.</li>
          <li>
            E-enabled libraries that dock over 64,000 books, 200
            periodicals, and 30,000 international online magazines and
            databases.
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- why -->


  <!-- course offered -->
  <div class="container">
    <div class="row">
      <div class="filter-list ">
        <h3>COURSES OFFERED</h3>
        <div class="container d-flex align-items-center">
          <button class="btn btn-default filter-button  active" data-filter="all">UG (3)</button>
          <button class="btn btn-default filter-button" data-filter="news">PG (10)</button>
          <button class="btn btn-default filter-button" data-filter="sale">Diploma Courses (1)</button>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2 product filter">
        <div class="container">
          <div class="row">
            <div class="col-12 ">
              <div class="card">
                <div class="card-body ">
                  <div class="d-flex align-items-center">
                    <h4 class="card-title">BA Business</h4>
                    <a class="btn btn-apl  ml-auto" data-id="30" data-option="231">
                      <span>Apply now</span>
                    </a>
                  </div>
                  <p class="card-text text-muted">5 Years | INR 141600.0 (Annually)</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2 product filter">
        <div class="container">
          <div class="row">
            <div class="col-12 ">
              <div class="card">
                <div class="card-body ">
                  <div class="d-flex align-items-center">
                    <h4 class="card-title">BA Business</h4>
                    <a class="btn btn-apl  ml-auto" data-id="30" onclick="courseId(this);">
                      <span>Apply now</span>
                    </a>
                  </div>
                  <p class="card-text text-muted">5 Years | INR 141600.0 (Annually)</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



    </div>
  </div>
  <!-- course offered -->


  <!-- Top companies -->
  <div class="container">
    <div class="intro">
      <h2 class="text-center">Lightbox Gallery</h2>
      <p class="text-center">Find the lightbox gallery for your project. click on any image to open gallary</p>
    </div>
    <div class="row photos">
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/zmzERpe.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/gX11Vt5.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/pZcUS2Y.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/06Ajq7f.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/zmzERpe.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/gX11Vt5.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/pZcUS2Y.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/06Ajq7f.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/zmzERpe.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/gX11Vt5.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/pZcUS2Y.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/06Ajq7f.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/zmzERpe.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/gX11Vt5.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/pZcUS2Y.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/06Ajq7f.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/zmzERpe.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/gX11Vt5.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/pZcUS2Y.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"></a></div>
      <div class="col-sm-6 col-md-4 col-lg-3 item"><a href="https://i.imgur.com/06Ajq7f.jpg" data-lightbox="photos"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"></a></div>
    </div>
  </div>
  <!-- Top companies -->

  <!-- footer -->

  <footer class="align-item-center">
    <input type="email" placeholder="Enter your email">
    <input type="email" placeholder="Enter your email">
    <input type="email" placeholder="Enter your email">
    <button type="submit">Apply Now</button>
  </footer>
  <!-- footer -->

  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>

</body>

<script>
  $(document).ready(function() {
    $(".btn-apl").on("click", function() {
      var course_id = $(this).attr("data-id");
      var extraaedge_id = $(this).attr("data-option");
      // alert("The data-id of clicked item is: " + course_id + "Extraaedge : " + extraaedge_id);

      // $("#Apply").click(function() {
      //   $.ajax({
      //     url: "clg_Visit.php",
      //     type: "POST",

      //     data: {
      //       course_id: course_id
      //     },
      //     success: function(result) {
      //       alert('success');

      //     }
      //   });
      // });

      $("#Apply").click(function() {
        $('#course_id').val(course_id);
        $('#extraaedge_id').val(extraaedge_id);
      });

    });
  });

  $(function() {
    objectFitImages()
  });
</script>

</html>