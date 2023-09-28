<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>在庫管理システム</title>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="{{ $css_link }}">
  @if (isset($header_css)) <link rel="stylesheet" href="{{ $header_css }}"> @endif
  @if (isset($snackbar_css)) <link rel="stylesheet" href="{{ $snackbar_css }}"> @endif
  @if (isset($dialog_css)) <link rel="stylesheet" href="{{ $dialog_css }}"> @endif
  @if (isset($create_btn_css)) <link rel="stylesheet" href="{{ $create_btn_css }}"> @endif
  @if (isset($create_dialog_css)) <link rel="stylesheet" href="{{ $create_dialog_css }}"> @endif
  @if (isset($create_dialog_js)) <script src="{{ $create_dialog_js }}" defer></script>@endif
</head>
<body>
  <div>
    <main>
      {{ $slot }}
    </main>
  </div>
</body>
</html>