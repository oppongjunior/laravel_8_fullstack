@extends('frontend.layout.layout')

@section('content')

<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">
            @foreach ($sliders as $key => $slider)
            <div class="carousel-item {{ $key == 0 ?'active':'' }}" style="background-image: url('{{ asset($slider->image) }}');">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{ $slider->title }}</h2>
                        <p>{{ $slider->description }}</p>
                        <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section>
<main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About Us</strong></h2>
            </div>

            <div class="row content">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2>{{ $about->title }}</h2>
                    <h3>{{ $about->short_description }}</h3>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                    <p>{{ $about->long_description }}</p>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</strong></h2>
                <p>Laborum repudiandae omnis voluptatum consequatur mollitia ea est voluptas ut</p>
            </div>

            <div class="row">
                @foreach ($services as $service )
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box iconbox-blue">
                        <div class="icon">
                            <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                            </svg>
                            <i class="bx bxl-dribbble"></i>
                        </div>
                        <h4><a href="">{{ $service->title }}</a></h4>
                        <p>{{ $service->description }} Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, quas. </p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-graphical_design">Graphic Design</li>
                        <li data-filter=".filter-website">Web</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up">
                @foreach ($portfolio as $item )
                <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $item->category }}">
                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->category }}</p>
                        <a href="{{ asset($item->image) }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $item->category }}"><i class="bx bx-plus"></i></a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Clients</h2>
            </div>

            <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">
                @foreach ($clients as $client )
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                        <img src="{{ asset($client->brand_image) }}" class="img-fluid" alt="" style="width: 100%; height:250px">
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Our Clients Section -->

</main><!-- End #main -->

@endsection
