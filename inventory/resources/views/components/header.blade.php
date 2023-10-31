<header>
  <x-slot name="header_css">{{ asset('/css/header.css') }}</x-slot>
  <x-slot name="header_js">{{ asset('/js/header.js') }}</x-slot>
  <div class="nav_link">
    <ul class="nav_wrapper">
      <li class="nav_item">
        <a href="{{ route('index') }}">
          <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48" fill="#FFFFFF">
            <path d="M260-140h440v-120h-80v-260h-80v-60h160v-120H260v120h80v260h80v60H260v120Zm0 60q-24.75 0-42.375-17.625T200-140v-120q0-24.75 17.625-42.375T260-320h20v-200h-20q-24.75 0-42.375-17.625T200-580v-120q0-24.75 17.625-42.375T260-760h150v-60h-50v-60h240v60h-50v60h150q24.75 0 42.375 17.625T760-700v120q0 24.75-17.625 42.375T700-520h-20v200h20q24.75 0 42.375 17.625T760-260v120q0 24.75-17.625 42.375T700-80H260Zm220-340Z"/>
          </svg>
          <div class="link_name @if(Request::is('inventory')) under_lin @endif">seasonings</div>
        </a>
      </li>
      <li class="nav_item">
        <a href="{{ route('markets') }}">
          <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px" fill="#FFFFFF">
            <path d="M0 0h24v24H0z" fill="none"/><path d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 4H6v-4h6v4z"/>
          </svg>
          <div class="link_name @if(Request::is('market')) under_lin @endif">markets</div>
        </a>
      </li>
    </ul>
    <details class="user_link">
      <summary>
        <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px" fill="#FFFFFF">
          <path d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
        </svg>
        <div class="link_name @if(Request::is('user')) under_lin @endif">user</div>
      </summary>
      <div class="user_list">
        <div class="dropdown_lists">
          <div class="dropdown_list"><a href="" class="user_menu">利用者管理</a></div>
          <div class="dropdown_list"><a href="{{ route('logout') }}" class="user_menu">ログアウト</a></div>
        </div>
      </div>
    </details>
  </div>
</header>