<x-app>
  <x-header></x-header>
  <x-slot name="css_link">{{ asset('/css/user.css') }}</x-slot>
    <div class="user_contents">
      <div class="page_title">ユーザ情報</div>
      @if($query->isEmpty())
        <div class="user_not_exist">ユーザ情報の取得に失敗しました</div>
      @endif
      @foreach ($query as $user)
        <div class="user_first_line">
          <div class="line_text">登録者情報</div>
          <div class="user_editor_btn">
            <div class="user_update_btn">
              <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF">
                <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
              </svg>
            </div>
            <div class="password_change_btn">
              <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF">
                <path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/>
              </svg>
            </div>
            <div class="user_delete_btn">
              <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32" fill="#FFFFFF">
                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
              </svg>
            </div>
          </div>
        </div>
        <div class="user_second_line">
          <div class="user_name" id="user_name">{{ $user->name }}</div>
        </div>
        <div class="user_third_line">
          <div class="user_email" id="user_email">{{ $user->email }}</div>
        </div>
      @endforeach
    </div>
  <x-snackbar></x-snackbar>
</x-app>