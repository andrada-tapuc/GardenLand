<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GardenLand</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Nunito+Sans:300,300i,400,400i,600,600i,700,700i&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Sintony:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="flex-center position-ref full-height">
    <header class="container-fluid site-header">
        <div class="contact-header">
            <b>  Amenajări exterioare - crează-ți paradisul în grădina ta!</b>
            <span class="phone-number"><i class="fa fa-phone" aria-hidden="true"></i> 0753675454</span>
            <span class="phone-number"><i class="fa fa-phone" aria-hidden="true"></i> 0753675454</span>
            <a href="#" class="fb-contact"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
            <a href="#" class="insta-contact"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </div>
        <div class="container p-0">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand pull-right" href="#">Garden Land</a>
                <p class="navbar-subtitle">Din generație în generație, cu eleganță și încredere!</p>
            </nav>
        </div>
        <div class="xs-menu-cont">
            <a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
            <nav class="xs-menu displaynone">
                <ul>
                    <li class="active">
                        <a class="home-link" href="/">Acasă</a>
                    </li>
                    <li>
                        <a class="services-link" href="/services">Servicii</a>
                    </li>
                    <li>
                        <a class="products-link" href="#">Produse</a>
                    </li>
                    <li>
                        <a class="portofolio-link" href="#portofoliu" >Portofoliul</a>
                    </li>
                    <li>
                        <a class="contact-link"  href="#contact" >Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
        <nav class="menu">
            <ul>
                <li class="active">
                    <a class="home-link" href="/">Acasă</a>
                </li>
                <li class="drop-down">
                    <a class="services-link" href="#">Servicii</a>
                    <div class="mega-menu fadeIn animated">
                        @foreach($allCat as $cat)
                            <div class="mm-3column">
                                <span class="categories-list">
                                    <ul>
                                        <span>{{$cat->name_category}}</span>
                                        @foreach($allServices as $serv)
                                            @if($serv->category_id === $cat->id)
                                                <a><li><button type="button" class="btn" data-toggle="modal" data-target="#modal{{$serv->id}}">{{$serv->name}}</button></li></a>
                                            @endif
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </li>
                <li>
{{--                <li  class="drop-down-2">--}}
                    <a class="products-link" href="#">Produse</a>
{{--                    <div class="mega-menu-2 fadeIn animated">--}}
{{--                    @foreach($allProdCat as $categ)--}}
{{--                        <div class="mm-3column">--}}
{{--                                <span class="categories-list">--}}
{{--                                    <ul>--}}
{{--                                        <span>{{$categ->name_category}}</span>--}}
{{--                                    </ul>--}}
{{--                                </span>--}}
{{--                        </div>--}}
{{--                     @endforeach--}}
{{--            </div>--}}
                </li>
                <li>
                    <a class="portofolio-link"  href="#portofoliu" >Portofoliu</a>
                </li>
                <li>
                    <a class="contact-link"  href="#contact" >Contact</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item item1 active"></div>
            <div class="carousel-item item2"></div>
            <div class="carousel-item item3"></div>
            <div class="carousel-item item4"></div>
            <div class="carousel-item item5"></div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    @foreach($allServices as $serv)
        <div class="modal fade" id="modal{{$serv->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-7">
                                <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active" data-id="{{$serv->image->first()->id}}">
                                            <img class="slider-modal-img" src="{{asset('storage/services/'. $serv->image->first()->name)}}" alt="" title="Imagine">
                                            <h2 class="h2-slide-title">{{$serv->image->first()->title}}</h2>
                                        </div>
                                        @foreach($serv->image->skip(1) as $img)
                                            <div class="carousel-item" data-id="{{$img->id}}">
                                                <img class="slider-modal-img" src="{{asset('storage/services/'. $img->name)}}" alt="Second slide">
                                                <h2 class="h2-slide-title">{{$serv->image->first()->title}}</h2>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <h2 class="h2-responsive product-name">
                                    <strong>{{$serv->name}}</strong>
                                </h2>
                                <hr/>
                                <h4 class="h4-responsive">
                                    <h5 class="data-modal">Prețul serviciului: <strong>{{$serv->price}}</strong></h5>
                                    <h5 class="data-modal">Timpul de executare: <strong>{{$serv->time_exec}}</strong></h5>
                                    <h5 class="data-modal">Categoria: <strong>{{$serv->category->name_category}}</strong></h5>
                                </h4>
                                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                                    <div class="card modal-card">
                                        <div class="card-header" role="tab" id="headingOne1">
                                            <a class="link-title-card" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1" data-id="{{$serv->image->first()->id}}">
                                                <h5 class="mb-0">
                                                    {{$serv->image->first()->title}}
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                                            <div class="card-body">
                                                {{$serv->image->first()->description}}
                                            </div>
                                        </div>
                                    </div>

                                    @foreach($serv->image->skip(1) as $img)
                                        <div class="card modal-card">
                                            <div class="card-header" role="tab" id="headingTwo2">
                                                <a class="collapsed link-title-card" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2" data-id="{{$img->id}}">
                                                    <h5 class="mb-0">
                                                        {{$img->title}}
                                                    </h5>
                                                </a>
                                            </div>
                                            <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                                                 data-parent="#accordionEx">
                                                <div class="card-body">
                                                    {{$img->description}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <div class="text-center close-btn-modal">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <section id="services" class="sec-serv">
        <div class="container">
            <h1>Servicii oferite</h1>
            <hr />
            <div class="row sec-serv-text">
                <div class="col-sm-6 col-sm-offset-3">
                    <p>Hi, my name is Alex Devero and I am a Web Designer & Developer based in Prague. I love crafting beautiful web pages in HTML5, CSS3 and JavaScript or jQuery. My other skills include WordPress, Photoshop, Illustrator. You can grab my CV in
                        <a href="#">English</a> or <a href="#">Czech</a> version. If you want to hire me or just to talk, <a class="js-connect" href="#footer">connect</a> with me.</p>
                </div>
            </div>
        </div>
    </section>
    <div>
        <ul class="card-list">
            @foreach($allCat as $cat)
            <li class="card">
                <a class="card-image card-supercategory" href="" target="_blank" data-name ="{{ $cat->name_category }}" data-category="{{$cat->id}}" style="background-image: url{{asset('storage/categories/'.$cat->image->name)}});" data-image-full="{{asset('storage/categories/'.$cat->image->name)}}">
                    <img src="{{asset('storage/categories/'.$cat->image->name)}}" alt={{$cat->name_category}} />
                </a>
                <a class="card-description" target="_blank">
                    <h2>{{$cat->name_category}}</h2>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="col text-center button-all-services">
            <a href="#link" class="btn btn-default btn-dark services-link" role="button">Toate serviciile</a>
        </div>
    </div>

    <section id="products" class="sec-products">
        <div class="container">
            <h1>Produsele noastre</h1>
            <hr />
            <div class="row sec-prod-text">
                <div class="col-sm-6 col-sm-offset-3">
                    <p>Hi, my name is Alex Devero and I am a Web Designer & Developer based in Prague. I love crafting beautiful web pages in HTML5, CSS3 and JavaScript or jQuery. My other skills include WordPress, Photoshop, Illustrator. You can grab my CV in
                        <a href="#">English</a> or <a href="#">Czech</a> version. If you want to hire me or just to talk, <a class="js-connect" href="#footer">connect</a> with me.</p>
                </div>
            </div>
        </div>
    <div id="productsCarousel" class="carousel slide mb-5" data-ride="carousel" data-interval="false">
        <div class="carousel-inner carousel-products mx-auto">
            <div class="carousel-item active">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-lg-4">
                    @foreach($firstProd as $prod)
                    <div class="col">
                        <div class="card card-prod">
                            <img class="card-img-top" src="{{asset('storage/products/'.$prod->image->first()->name)}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$prod->name}}</h5>
                                <p class="card-text">Prețul: {{$prod->price}}</p>
                                <p class="card-text">Categoria: {{$prod->category->name_category}}</p>
                                <p class="card-text">Timp de execuție: {{$prod->time_exec}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="carousel-item">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-lg-4">
                    @foreach($nextProd as $prod)
                        <div class="col">
                            <div class="card card-prod">
                                <img class="card-img-top" src="{{asset('storage/products/'.$prod->image->first()->name)}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$prod->name}}</h5>
                                    <p class="card-text">Prețul: {{$prod->price}}</p>
                                    <p class="card-text">Categoria: {{$prod->category->name_category}}</p>
                                    <p class="card-text">Timp de execuție: {{$prod->time_exec}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#productsCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#productsCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <div class="col text-center btn-products">
            <a href="#" class="btn btn-default btn-dark" role="button">Toate produsele</a>
        </div>
    </div>
    </section>
    <section id="portofoliu" class="sec-portofolio" name="portofoliu">
        <div class="container">
            <h1>Portofoliu</h1>
            <hr />
        </div>
    </section>
    <div class="gallery">
        @foreach($images as $img)
            <div class="img-w">
                <img src="{{asset('storage/categories/'.$img->name)}}" alt="{{$img->name}}"/>
            </div>
        @endforeach
    </div>


    <section id="testimonials" class="sec-testimonials">
        <div class="container">
            <h1>Clienți mulțumiți</h1>

            <hr />

            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">"Alex did great job when designing our website. It was pleasure to work with him and I'm sure we will hire him again."</p>

                    <p class="text-right">&mdash; Marc Andressen</p>
                </div>

                <div class="col-sm-4">
                    <p class="text-center">"Alex proved to be truly creative designer who is able to create just stunning design I immediately fell in love with!"</p>

                    <p class="text-right">&mdash; Emily Cooper</p>
                </div>

                <div class="col-sm-4">
                    <p class="text-center">"I have worked with several different people and it always seemed like a pain—luckily I found Alex Devero. Thank you Alex!"</p>

                    <p class="text-right">&mdash; Scott Grubber</p>
                </div>
            </div>
        </div>
    </section>
{{--    <section id="about" class="sec-about">--}}
{{--        <div class="container">--}}
{{--            <h1>Echipa noastră</h1>--}}
{{--            <hr />--}}
{{--            <div class="row sec-about-text">--}}
{{--                <div class="col-sm-6 col-sm-offset-3">--}}
{{--                    <p>Hi, my name is Alex Devero and I am a Web Designer & Developer based in Prague. I love crafting beautiful web pages in HTML5, CSS3 and JavaScript or jQuery. My other skills include WordPress, Photoshop, Illustrator. You can grab my CV in--}}
{{--                        <a href="#">English</a> or <a href="#">Czech</a> version. If you want to hire me or just to talk, <a class="js-connect" href="#footer">connect</a> with me.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section id="contact" class="sec-contact">
        <div class=" container contact-section" id="contact-section">
                <h1>Contactează-ne </h1>

                <hr />

                <div class="row">
                    @if(count($errors) > 0 )
                        <div class="form-group form-row">
                            <div class="alert alert-danger" role="alert" hidden>
                                @lang('messages.message-errorsend')
                            </div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                     @if($message = Session::get('success'))
                    <div class="form-group form-row" style="display: none">
                        <div class="alert alert-success" role="alert">
                            Mesajul tău a fost trimis cu succes. Te vom contacta în cel mai scurt timp. Mulțumim!
                        </div>
                    </div>
                      @endif
                    <div class="form-group form-row">
                        <div class="alert alert-danger" role="alert"  style="display: none">
                            Mesajul nu s-a trimis, te rugam sa incerci din nou.
                        </div>
                    </div>
                    <form method="post" action="{{ route('send') }}" class="col col-sm-8 offset-ms-2 col-lg-6 offset-lg-3 contact-form">
                        {{ csrf_field() }}
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Nume și prenume:</label>
                                <input type="text" class="form-control" name="name" placeholder="Nume și prenume">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Adresa de email:</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Număr de telefon:</label>
                                <input type="number" class="form-control" name="phone" placeholder="Telefon">
                            </div>
                        </div>

                        <div class="form-group form-row">
                            <div class="col">
                                <label>Mesajul tău:</label>
                                <textarea type="text" class="form-control" name="message" placeholder="Scrieți mesajul dumneavoastră..."></textarea>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary" name="send"  value="Trimite Mesajul">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <div class="row">
        <div class="col-lg-5 contact-card">
            <div class="text-contact-card">
                <p><i class="fa fa-phone"></i> <u>Telefon de contact:</u> 0751644839 / 0738372732</p>
                <p><i class="fa fa-map-marker"></i> <u>Adresa:</u> Strada blablabla Nr.11</p>
                <p><i class="fa fa-envelope"></i> <u>Email:</u> siteulnostru@yahoo.com</p>
            </div>
            <h1 class="social-icons"><i class="fa fa-facebook-official"></i>  <i class="fa fa-instagram"></i></h1>
        </div>
        <div class="col-lg-7">
            <iframe class="map-contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d43589.38525555599!2d26.339485223589037!3d46.93542361901205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47355449968fa865%3A0x52d3dedb49e2d0b8!2sPiatra%20Neam%C8%9B!5e0!3m2!1sro!2sro!4v1588603786005!5m2!1sro!2sro" width="600" height="450" frameborder="0"  aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>

</div>
<footer class="container-fluid">
    <div class="row">
        <span class="copy">Garden Land</span>
        <span class="copy">@2020 All Rights Reserved / Terms of Use and Privacy Policy</span>
    </div>
</footer>
<script>

</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="application/javascript" src="js/script.js"></script>
</body>
</html>
