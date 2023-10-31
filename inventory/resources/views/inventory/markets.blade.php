<x-app>
  <x-header></x-header>
  <x-slot name="css_link">{{ asset('/css/markets.css') }}</x-slot>
  <x-slot name="create_dialog_css">{{ asset('/css/create_markets_dialog.css') }}</x-slot>
  <x-slot name="create_dialog_js">{{ asset('/js/create_markets_dialog.js') }}</x-slot>
    <div class="market_contents">
      <div class="page_title">お店一覧</div>
      @if($query->isEmpty())
        <div class="markets_not_exist">お店が1件も登録されていません</div>
      @endif
      @foreach ($query as $market)
        <div class="market_line">
          <div class="market_name" id="market_name_{{ $market->market_id }}">{{ $market->market_name }}</div>
          <div class="market_editor_btn">
            <div class="market_update_btn" data-marketid="{{ $market->market_id }}">
              <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
              </svg>
            </div>
            <div class="market_delete_btn" data-marketid="{{ $market->market_id }}">
              <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
              </svg>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  <x-create-button></x-create-button>
  <x-markets.create></x-markets.create>
  <x-snackbar></x-snackbar>
</x-app>