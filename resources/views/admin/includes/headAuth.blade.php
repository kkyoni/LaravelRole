<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> {{Settings::get('application_title')}} - Login</title>
<link rel="icon" href="{{ url(\Settings::get('favicon_logo')) }}" type="{{ url(\Settings::get('favicon_logo')) }}" sizes="16x16">
<link href="{{ asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
<link href="{{ asset('assets/admin/css/style.css')}}" rel="stylesheet">
<link href="{{ asset('assets/particles/style.css')}}" rel="stylesheet">
<style>
.ui-pnotify-closer {visibility:visible !important; display:block !important;}
/*.ui-pnotify-sticker{visibility:visible !important; display:block !important;}*/
div.alert.ui-pnotify-container.alert-success.ui-pnotify-shadow{background-color: #5A8DEE !important; border-color: #5A8DEE !important; color: #FFF;}
</style>
</head>