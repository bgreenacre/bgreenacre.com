<head>
	<meta charset="utf-8">
	<title>@yield('page.title', 'bgreenacre')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('page.description', '')">
    <meta name="author" content="bgreenacre">
    <meta name="keywords" content="@yield('page.tags', '')">

    <link rel="shortcut icon" href="/favicon.png">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" />

	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>