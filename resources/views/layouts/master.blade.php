<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTG:</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="/css/flatly/bootstrap.min.css" rel="stylesheet">
    <link href="/css/htg.css" rel="stylesheet">
</head>
<body>

    <div class="bs-component">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">HTG: Starter</a>
                </div>

                <div class="collapse navbar-collapse"
                     id="bs-example-navbar-collapse-1">
                        {{--
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>

                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input class="form-control" placeholder="Search"
                                   type="text">
                        </div>
                        <button type="submit" class="btn btn-default">Submit
                        </button>
                    </form>

                        --}}
                </div>
            </div>
        </nav>
        <div style="display: none;" id="source-button"
             class="btn btn-primary btn-xs">&lt; &gt;</div>
    </div>



    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>





<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>