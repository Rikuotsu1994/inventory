<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>在庫管理システム</title>
  <link rel="stylesheet" href="{{ $css_link }}">
  @if (isset($header_css)) <link rel="stylesheet" href="{{ $header_css }}"> @endif
</head>
<body>
  <div>
    <main>
      {{ $slot }}
    </main>
  </div>
</body>
</html>