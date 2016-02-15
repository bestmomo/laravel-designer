<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel designer">
    <meta name="author" content="bestmomo">

    <title>Laravel Designer</title>

    {!! Html::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
    {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') !!}
    {!! Html::style('http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic') !!}
    {!! Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') !!}
    {!! Html::style('css/main.css') !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Laravel Designer</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#about">About</a>
                    </li>
                    <li>
                        <a href="#features">Features</a>
                    </li>
                    <li>
                        <a href="#go">Let's go !</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header></header>

    <section id="about" class="bg-black">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="section-heading">Customize Laravel !</h2>
                    <hr class="light">
                    <p><em>Laravel Designer alpha 0.14</em></p>
                    <hr class="light">
                    <p>You create many Laravel and you are bored to make always the same actions ?</p>
                    <p>Laravel Designer makes all that automatically for each package !</p>
                    <hr class="light">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-rocket text-primary"></i>
                        <h3>Fast</h3>
                        <p class="text-muted">A few seconds</p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-hand-pointer-o text-primary"></i>
                        <h3>Easy</h3>
                        <p class="text-muted">Only some clics</p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-calendar-check-o text-primary"></i>
                        <h3>Up to date</h3>
                        <p class="text-muted">Get the last versions</p>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-gears text-primary"></i>
                        <h3>Scalable</h3>
                        <p class="text-muted">Make it evolve</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary" id="features">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Create your own customized Laravel with some clics !</h3>
                    <br>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-gears"></i>
                        <h3>Composer</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-sitemap"></i>
                        <h3>Providers</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-copy"></i>
                        <h3>Aliases</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o"></i>
                        <h3>Views</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-database"></i>
                        <h3>Migrations</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-map-signs"></i>
                        <h3>Config</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-folder-o"></i>
                        <h3>Folders</h3>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="service-box">
                        <i class="fa fa-4x fa-puzzle-piece"></i>
                        <h3>Schema</h3>
                    </div>
                </div>
                <div class="col-xs-12">
                    <br>
                    <a id="togo" href="#go" class="btn btn-default btn-xl">Let's go now !</a>
                </div>
              </div>
        </div>
    </section>


    <section id="go" class="bg-black">
        <div class="container">
            {!! Form::open(['url' => 'make', 'id' => 'formmaker', 'class' => "row"]) !!}
                <div class="col-lg-12 text-center">
                    <h1>Let's go now !</h1>
                    <br>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                      <div class="panel-heading">Packages</div>                      
                      <div class="panel-body">
                        @foreach($packages as $package)
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('packages[]', $package) !!} {{ $package }}
                                </label>
                            </div>                            
                        @endforeach
                      </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                      <div class="panel-heading">Miscellaneous</div>                      
                      <div class="panel-body">
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('env', 'env') !!} Change <strong>.env.example</strong> => <strong>.env</strong> and set a <strong>random key</strong>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('models', 'models') !!} Create an <strong>app/Models</strong> folder and copy models inside (only <strong>User</strong> by default)
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('repositories', 'repositories') !!} Create an <strong>app/Repositories</strong> folder
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('404', '404') !!} Add an <strong>error 404 page</strong>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('composer', 'composer') !!} Add <strong>composer.phar</strong> (to use composer if it is not installed globally)
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('lsd', 'lsd') !!} Use a <a href="http://laravelsd.com/" target="_blank">Laravel Schema Designer</a> export
                            </label>
                        </div> 
                        <div class="row hidden" id="lsdcontent">
                            <div class="col-xs-offset-1 col-xs-10">
                                <div class="form-group">
                                    <label for="urllsd">Laravel Schema Designer Export Url :</label>
                                    {!! Form::text('urllsd', null, ['id' => 'urllsd', 'class' => 'form-control', 'placeholder'=> 'http://laravelsd.com/share/2nM4tV']) !!}
                                    <small class="help-block"></small>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('lsd_migrations', 'lsd_migrations') !!} Migrations
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('lsd_seeds', 'lsd_seeds') !!} Seeds
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('lsd_models', 'lsd_models') !!} Models
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('lsd_views', 'lsd_views') !!} Views
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('lsd_controllers', 'lsd_controllers') !!} Controllers
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {!! Form::checkbox('lsd_routes', 'lsd_routes') !!} Routes
                                    </label>
                                </div>      
                            </div>                           
                        </div> 
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('langs', 'langs') !!} Use caouecs/Laravel-lang
                            </label>
                        </div> 
                        <div class="row hidden" id="langcontent">
                            <div class="col-xs-offset-1 col-xs-10">
                                @foreach($langs as $lang)
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('lang[]', $lang) . ' ' . $lang !!}
                                        </label>
                                    </div>
                                @endforeach
                            </div>                           
                        </div>                           
                      </div>
                    </div>
                </div>
                <br>
                <div id="submit" class="col-md-12 text-center"> 
                    {!! Form::submit('make your own !', ['class' => 'btn btn-default btn-xl']) !!}
                </div>
            {!! Form::close() !!}
            <div id="final" class="row hidden">
                <br>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <hr class="light">
                    <h2 class="section-heading">Final step</h2>
                    <p>Unpack the file somewhere and use <strong>composer install</strong></p>
                    <p><em>Load this page again for another submission</em></p>
                    <hr class="light">
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="bg-primary">
        <div class="container">
            <div class="alert alert-info hidden">
              <a href="#" class="close" data-dismiss="alert">&times;</a>
              Thanks for your message !
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Keep in touch !</h2>
                    <hr class="primary">
                    <p>You can contact me for any question or suggestion for this site</p>
                    <p>Thanks for your participation</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <p><i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i></p>
                    <button class="btn btn-default btn-xl wow tada" data-toggle="modal" data-target="#contactForm">Contact !</button>
                </div>
            </div>
        </div>
    </section>    

    <!-- Modal -->
    <div class="modal fade" id="contactForm" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            <h4 class="modal-title" id="contactLabel">Contact me !</h4>
          </div>
          <div class="modal-body">
            {!! Form::open(['url' => 'contact', 'id' => 'formcontact', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                <div class="form-group col-lg-12">
                    <label class="control-label">E-Mail</label>
                    <input type="email" class="form-control" name="email" id="email">
                    <small class="help-block"></small>
                </div>
                <div class="form-group col-lg-12">
                    <label class="control-label">Message</label>
                    <textarea rows="4" class="form-control" name="message" id="message"></textarea>
                    <small class="help-block"></small>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!! Form::close() !!}   
          </div>
        </div>
      </div>
    </div>

    {!! Html::script('https://code.jquery.com/jquery-2.1.4.min.js') !!}
    {!! Html::script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') !!}
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js') !!}
    {!! Html::script('js/main.js') !!}
 
</body>

</html>
