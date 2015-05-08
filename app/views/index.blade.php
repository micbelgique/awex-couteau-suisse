<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>MeaWeb.com - AWEX Couteau suisse</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <base href="http://php54.meaweb.com/awex-devcamp/public/">

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- CSS
  ================================================== -->
  {{ HTML::style('stylesheets/base.css'); }}
  {{ HTML::style('stylesheets/skeleton.css'); }}
  {{ HTML::style('stylesheets/layout.css'); }}
  {{ HTML::style('stylesheets/ribbon.css'); }}
  {{ HTML::style('stylesheets/font-awesome/css/font-awesome.css'); }}

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Favicons
  ================================================== -->
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>

<!-- Primary Page Layout
  ================================================== -->

@if (Auth::check())

    <div class="supercontainer header-main">
      <div class="container">
        <div class="sixteen columns">
          <a href="{{ URL::to('/') }}" style="color:#FFFFFF;"><div class="left header-logo"><i class="fa fa-check-square-o"></i> <span style="font-family: 'Pacifico', cursive;">Checklist</span></div></a>
          <!--left logo-->
          <div class="right header-btn"> 

          @if (isBack())
            <a href="{{ URL::to('/') }}" style="color:#FFFFFF;"><div class="left btn-gestionnaire-back"><i class="fa fa-arrow-circle-o-left"></i></div><!--left btn-user--></a>
          @endif

            <div style="cursor:pointer;" class="left btn-notifications-desktop open-notif">Notification <span style="padding:7px; background-color:#009900; font-weight:700;">0</span></div>
            <!--left btn-notifications-desktop-->

            <div class="left btn-notifications-mobile open-notif"><i class="fa fa-bell" style="font-size:13px; margin-right:3px;"></i> <span style="padding:7px; background-color:#009900; font-weight:700;">0</span></div>
            <!--left btn-notificaitons-mobile-->

             <a href="{{ URL::to('logout'); }}" style="color:#FFFFFF;">
            <div class="left btn-deconnexion"><i class="fa fa-power-off"></i></div>
            <!--left btn-deconnexion--></a> 

            <br class="clear">
          </div>
          <!--right header-btn--> 
          <br class="clear">
        </div>
        <!--sixteen--> 
      </div>
      <!--container--> 
    </div>
    <!--supercontainer header-main-->

  <?php $open=false; ?>
  @if (Session::has('success'))
    <?php $open=true; ?>
    <?php $message=Session::get('success') ?>
  @elseif (Session::has('error'))
    <?php $open=true; ?>
    <?php $message=Session::get('error') ?>
  @endif

  <div class="supercontainer notifications-panel" @if($open) style="height:110px;" @endif>
    <div class="container" style="margin:10px auto;">
    <div class="sixteen columns"><a href="#" class="open-notif" style="display:inline-block; right: 0; background-color:#006500; padding:10px; font-size:12px; margin:10px 0; font-weight:700;">X FERMER</a></div>
    <div class="sixteen columns">
    @if(!empty($message))
    <a href="#">&bull; {{ $message }}</a>
    @endif
    </div><!--sixteen-->

    </div><!--container-->
  </div><!--supercontainer notifications-panel-->

@endif

  <!-- Primary Page Layout
  ================================================== -->
  @yield('content', $content)


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
{{ HTML::script('js/script.js') }}

<!-- End Document
================================================== -->
</body>
</html>