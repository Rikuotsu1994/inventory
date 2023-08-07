<x-app>
  <x-slot name="css_link">{{ asset('/css/login.css') }}</x-slot>

  <div class="login_form">
    <h1>在庫管理システム</h1>
    <div>
      <form method="POST" action="login" >
      @csrf
        <div>
          <label for="email" class="@if ($errors->has('login_failed')) failedlabel @endif">メールアドレス</label>
          <input type="email" name="email" class= "email @if ($errors->has('login_failed')) email_failed @endif" maxlength="256" required>
        </div>
        <div>
          <label for="password"  class="@if ($errors->has('login_failed')) failedlabel @endif">パスワード</label>
          <input type="password" name="password" class="password @if ($errors->has('login_failed')) password_failed @endif" minlength="8" maxlength="32" required>
        </div>
          @if ($errors->has('login_failed'))
            <div class="err_msg">{{ $errors->first('login_failed') }}</div>
          @endif
        <div>
          <button type="submit" class="login_btn">ログイン</button>
        </div>
      </form>
    </div>
  </div>
  <div class="password_reset">
    <a href="">パスワードをお忘れですか？</a>
  </div>
</x-app>