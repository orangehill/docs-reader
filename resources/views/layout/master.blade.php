<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            {{ Config::get('docs.title', 'Documentation') }}
            @if(!empty($title))
                : {{ $title }}
            @endif
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
        <link rel="stylesheet" href="/docs.min.css" >
        <script src="{{ url('js/vendor/modernizr-2.6.2.min.js') }}"></script>
    </head>
    <body>
        <div class="bs-docs-header" id="content" tabindex="-1">
      <div class="container">
        <h1>{{ Config::get('docs.title', 'Documentation') }}</h1>
        <p>{{ Config::get('docs.description', 'v.1.0') }}</p>
      </div>
    </div>
        <div class="container bs-docs-container">
            <div class="row">
                <div class="col-md-3" role="complementary">
                    @yield('sidebar')
                </div>
                <div class="col-md-9" role="main">
                    @yield('content')
                    <br/>
                    <nav class="pull-right">
                        <ul class="pagination">
                            <li>
                            @if($prev)
                                <a href="{{ $prev['URI'] }}"  aria-label="Previous" title="Previous: {{ $prev['title'] }}">
                                    <span aria-hidden="true">← {{ $prev['title'] }}</span>
                                </a>
                            @endif
                            </li>
                            <li>
                            @if($next)
                                <a href="{{ $next['URI'] }}"  aria-label="Next" title="Previous: {{ $next['title'] }}">
                                    <span aria-hidden="true">{{ $next['title'] }} →</span>
                                </a>
                            @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <footer class="bs-docs-footer" role="contentinfo">
            <p>
                <a href="http://github.com/orangehill/docs-reader" title="Documentation reader by Tihomir Opacic inspired by Dayle Rees' Docs Reader.">Docs reader</a> by <a href="http://tihomiropacic.com" title="Tihomir Opacic">Tihomir Opacic</a> inspired by <a href="http://daylerees.com" title="Dayle Rees">Dayle Rees</a>' <a href="http://github.com/daylerees/docs-reader" title="Documentation reader by Dayle Rees.">Docs reader</a>.
            </p>
        </footer>
    </body>
</html>
