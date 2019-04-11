@extends('layouts.app')

@section('content')
    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
            <div class="col-xl-9 mx-auto">
              <h1 class="mb-5 text-white" style="font-family:'Raleway';">Find the right notes for the subject of your interest.</h1>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
              <form>
                <div class="form-row">
                  <div class="col-12 col-md-10 mb-md-0">
                    <input type="text" class="form-control form-control-lg" name="query" placeholder="Enter a keyword..">
                  </div>
                  <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-block btn-lg btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </header>
    
      <!-- Icons Grid -->
      <section class="pt-5 bg-light text-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="features-icons-item mx-auto mb-lg-0 mb-lg-3">
                <div class="features-icons-icon d-flex">
                  <i class="fa fa-5x fa-book m-auto text-primary"></i>
                </div>
                <h3>Intercollege Platform</h3>
                <p class="lead mb-0">We partner with the colleges throughout Nepal to provide platform for the teachers as well as the students for sharing the knowledge.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                <div class="features-icons-icon d-flex">
                  <i class="fa fa-5x fa-user m-auto text-primary"></i>
                </div>
                <h3>Experts of the Subject</h3>
                <p class="lead mb-0">We provide platform for students to learn from the best materials by the experts of the related field.</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                <div class="features-icons-icon d-flex">
                  <i class="fa fa-5x fa-check-circle m-auto text-primary"></i>
                </div>
                <h3>Discussions</h3>
                <p class="lead mb-0">Clear your confusions by discussing the subject matter with the people studing the similar course.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    
      <!-- Image Showcases -->
      <section class="showcase">
        <div class="container-fluid p-0">
          <div class="row no-gutters">
    
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
              <h2>Fully Responsive Design</h2>
              <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
            </div>
          </div>
          <div class="row no-gutters">
            <div class="col-lg-6 text-white showcase-img" style="background-image: url('');"></div>
            <div class="col-lg-6 my-auto showcase-text">
              <h2>Updated For Bootstrap 4</h2>
              <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 4 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 4!</p>
            </div>
          </div>
          <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
              <h2>Easy to Use &amp; Customize</h2>
              <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
            </div>
          </div>
        </div>
      </section>
    
      <!-- Testimonials -->
      <section class="testimonials text-center bg-light">
        <div class="container">
          <h2 class="mb-5">What people are saying...</h2>
          <div class="row">
            <div class="col-lg-4">
              <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <img class="img-fluid rounded-circle mb-3" src="" alt="">
                <h5>Margaret E.</h5>
                <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <img class="img-fluid rounded-circle mb-3" src="" alt="">
                <h5>Fred S.</h5>
                <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <img class="img-fluid rounded-circle mb-3" src="" alt="">
                <h5>Sarah W.</h5>
                <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    
    
      <!-- Footer -->
      <footer class="footer bg-light">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
              <ul class="list-inline mb-2">
                <li class="list-inline-item">
                  <a href="#">About</a>
                </li>
                <li class="list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                  <a href="#">Contact</a>
                </li>
                <li class="list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                  <a href="#">Terms of Use</a>
                </li>
                <li class="list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                  <a href="#">Privacy Policy</a>
                </li>
              </ul>
              <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2019. All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
              <ul class="list-inline mb-0">
                <li class="list-inline-item mr-3">
                  <a href="#">
                    <i class="fa fa-facebook fa-2x fa-fw"></i>
                  </a>
                </li>
                <li class="list-inline-item mr-3">
                  <a href="#">
                    <i class="fa fa-twitter-square fa-2x fa-fw"></i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a href="#">
                    <i class="fa fa-instagram fa-2x fa-fw"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
@endsection()
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.min.css') }}"/>
    <style>
        h1,h2,h3,h4,h5,h6{
            font-family: 'Raleway' !important;
            font-weight: 200;

            color : rgba(0,0,0,0.5);
        }
    </style>
@endpush()