<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-xl-4">
        <h2 data-aos="fade-up">Hello {{ Auth::check() ? Auth::user()->name : 'Example People!' }}</h2>
        <blockquote data-aos="fade-up" data-aos-delay="100">
          <p>{{ $description ?? 'Welcome to example News. Do want to be a contributor writer?'}}</p>
        </blockquote>
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="{{ $action_home ?? '' }}" class="btn-get-started"> {{ $button_action ?? 'Register Contributor' }}</a>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Section -->