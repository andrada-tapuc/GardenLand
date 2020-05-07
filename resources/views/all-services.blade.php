<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GardenLand - Servicii</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
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
                <a class="navbar-brand pull-right title-page" href="#">Garden Land</a>
                <p class="navbar-subtitle">Din generație în generație, cu eleganță și încredere!</p>
            </nav>
        </div>
        <div class="xs-menu-cont">
            <a id="menutoggle"><i class="fa fa-align-justify"></i> </a>
            <nav class="xs-menu displaynone">
                <ul>
                    <li>
                        <a class="home-link" href="/">Acasă</a>
                    </li>
                    <li class="active">
                        <a href="/services">Servicii</a>
                    </li>
                    <li>
                        <a class="products-link" href="#">Produse</a>
                    </li>
                    <li>
                        <a class="portofolio-link" href="#portofoliu">Portofoliul</a>
                    </li>
                    <li>
                        <a class="contact-link-serv"  href="#contact" >Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
        <nav class="menu">
            <ul>
                <li>
                    <a class="home-link" href="/">Acasă</a>
                </li>
                <li class="drop-down">
                    <a href="#">Servicii</a>
                    <div class="mega-menu fadeIn animated">
                        @foreach($allCat as $cat)
                            <div class="mm-3column">
                                <span class="categories-list">
                                    <ul>
                                        <a href="#" id="{{$cat->id}}" data-name="{{$cat->name_category}}" class="category-click-service"><span>{{$cat->name_category}}</span></a>
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
                    <a class="products-link" href="#">Produse</a>
                </li>
                <li>
                    <a class="portofolio-link" href="#portofoliu">Portofoliu</a>
                </li>
                <li>
                    <a class="contact-link-serv"  href="#contact" >Contact</a>
                </li>
            </ul>
        </nav>
    </header>
</div>
<section class="sec-services">
    <div id="sidebar-main" class="sidebar sidebar-default sidebar-separate sidebar-fixed">
        <div class="sidebar-content">
            <div class="sidebar-category sidebar-default">
                <div class="sidebar-user">
                    <div class="category-content">
                        <h6>Serviciile noastre</h6>
                    </div>
                </div>
            </div>
            <a href="#link" class="btn btn-default btn-dark btn-all-services" role="button">Afișați toate serviciile</a>
            @foreach($allCat as $cat)
                <div class="sidebar-category sidebar-default">
                    <div class="category-title" id="{{$cat->id}}">
                        <a href="#" id="{{$cat->id}}" data-name="{{$cat->name_category}}" class="category-click-service nav-link"><span>{{$cat->name_category}}</span></a>
                    </div>
                    <div class="category-content">
                        <ul id="" class="nav flex-column">
                            @foreach($allServices as $serv)
                                @if($serv->category_id === $cat->id)
                                    <li class="nav-item">
                                        <i class="fa fa-eercast" aria-hidden="true"></i>
                                        <button type="button" class="btn" data-toggle="modal" data-target="#modal{{$serv->id}}">{{$serv->name}}</button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
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


    <!-- /main sidebar -->
    <div class="content-wrapper">
        <h1>Serviciile oferite </h1>
        <hr />
        <div class="row clearfix">
            <div class="cards">
                @foreach($allServices as $serv)
                    <div class="card card-service" id="{{$serv->id}}" data-category="{{$serv->category->id}}">
                        <div class="card__image-holder">
                            <img class="card__image" src="{{asset('storage/services/'.$serv->image->last()->name)}}" alt="wave" />
                        </div>
                        <div class="card-title">
                            <a href="#" class="toggle-info btn">
                                <span class="left"></span>
                                <span class="right"></span>
                            </a>
                            <h2>
                                {{$serv->name}}
                                <small>{{$serv->price}}</small>
                             </h2>
                        </div>
                        <div class="card-flap flap1">
                            <div class="card-description">
                                <h6>Timp de execuție: <b>{{$serv->time_exec}}</b></h6>
                                <h6>Categorie: <b>{{$serv->category->name_category}}</b></h6>
                                <button type="button" class="btn btn-primary modal-button" data-toggle="modal" data-target="#modal{{$serv->id}}">Vezi tot</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> <!-- end content-wrapper -->
</section>

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
<footer class="container-fluid">
    <div class="row"><span class="copy">@Copyright GardenLand</span></div>
</footer>
<script>

</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" ></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script type="application/javascript" src="js/script.js"></script>
</body>
</html>
