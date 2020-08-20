@php $v=  config('app.css_js_version', '?v=72')  ; @endphp
<link rel="stylesheet" href="{{ asset('css/uikit/uikit.css?v='.$v) }}">
<link rel="stylesheet" href="{{ mix('/css/admin.css?v='.$v) }}">
