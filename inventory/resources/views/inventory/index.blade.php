<x-app>
  <x-header></x-header>
  <x-slot name="css_link">{{ asset('/css/index.css') }}</x-slot>
  <x-slot name="create_dialog_css">{{ asset('/css/create_seasoning_dialog.css') }}</x-slot>
  <x-slot name="create_dialog_js">{{ asset('/js/create_dialog.js') }}</x-slot>
  <x-slot name="update_dialog_css">{{ asset('/css/update_seasoning_dialog.css') }}</x-slot>
  <x-slot name="update_dialog_js">{{ asset('/js/update_seasoning_dialog.js') }}</x-slot>
  <x-slot name="delete_dialog_css">{{ asset('/css/delete_seasoning_dialog.css') }}</x-slot>
  <x-slot name="delete_dialog_js">{{ asset('/js/delete_dialog.js') }}</x-slot>
  <x-slot name="upsert_amount_dialog_css">{{ asset('/css/upsert_amount_dialog.css') }}</x-slot>
  <x-slot name="upsert_amount_dialog_js">{{ asset('/js/upsert_amount_dialog.js') }}</x-slot>
    <div class="inventory_contents">
      @if($query->isEmpty())
        <div class="seasonings_not_exist">データが登録されていません</div>
      @endif
      @php
        $seasoning_id = App\Models\Seasonings::checking_duplicate_id;
        $amount_flag = App\Models\Amounts::default_amount_flag;
      @endphp
      @foreach ($query as $seasoning)
        @if($seasoning_id != ($seasoning->seasoning_id))
          @if($amount_flag != 0)
            </details>
            @php
              $amount_flag = App\Models\Amounts::default_amount_flag;
            @endphp
          @endif
          <div class="seasoning_chart">
            <div class="seasoning_picture_line">
              @if(isset($seasoning->seasoning_image))
                <div class="seasoning_picture"><img src="{{ asset('storage/' . $seasoning->seasoning_image) }}" id="seasoning_picture_{{ $seasoning->seasoning_id }}"></div>
              @else
                <div class="seasoning_picture_space"></div>
              @endif
              <div class="seasoning_line">
                <div class="seasoning_first_line">
                  <div class="seasoning_name" id="seasoning_name_{{ $seasoning->seasoning_id }}">{{ $seasoning->seasoning_name }}</div>
                  <div class="seasoning_editor_btn">
                    <div class="seasoning_update_btn" data-seasoningid="{{ $seasoning->seasoning_id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                        <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
                      </svg>
                    </div>
                    <div class="seasoning_delete_btn" data-seasoningid="{{ $seasoning->seasoning_id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="seasoning_second_line">
                  @if(isset($seasoning->seasoning_amount))
                    <div class="seasoning_amount">
                      <div>最安値</div>
                      <div class="min_amount">&yen;{{ $seasoning->seasoning_amount }}</div>
                      @php
                        $market_min_amount = ($seasoning->seasoning_amount);
                      @endphp
                    </div>
                  @else 
                    <div>販売無し</div>
                  @endif
                  <div class="seasoning_inventory">
                    <div>在庫数</div>
                    @if(isset($seasoning->number_of_seasoning))
                      <div class="number_of_seasoning" id="number_of_seasoning_{{ $seasoning->seasoning_id }}">{{ $seasoning->number_of_seasoning }}</div>
                    @else 
                      <div class="number_of_seasoning" id="number_of_seasoning_{{ $seasoning->seasoning_id }}">0</div>
                    @endif
                  </div>
                </div>
                <div class="seasoning_third_line">
                  <div class="seasoning_remarks" id="seasoning_remarks_{{ $seasoning->seasoning_id }}">メモ:{{ $seasoning->seasonings_remark }}</div>
                </div>
              </div>
            </div>
          </div>
          <details class="amount_chart">
            <summary>金額比較表</summary>
        @endif
        @if(isset($seasoning->market_name))
          <div class="market_line">
            <div class="market_name" id="market_name_{{ $seasoning->seasoning_id }}_{{ $seasoning->market_id }}">{{ $seasoning->market_name }}</div>
              @if(isset($seasoning->seasoning_amount))
                <div class="market_amount @if($market_min_amount == ($seasoning->seasoning_amount)) market_min_amount @endif" id="market_amount_{{ $seasoning->seasoning_id }}_{{ $seasoning->market_id }}">&yen;{{ $seasoning->seasoning_amount }}</div>
              @else 
                <div class="market_amount" id="market_amount_{{ $seasoning->seasoning_id }}_{{ $seasoning->market_id }}">取扱い無し</div>
              @endif
              <div class="amount_upsert_btn" data-seasoningid="{{ $seasoning->seasoning_id }}" data-marketid="{{ $seasoning->market_id }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                  <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
                </svg>
              </div>
            </div>
            @php
              $seasoning_id = ($seasoning->seasoning_id);
              $amount_flag = App\Models\Amounts::checking_amount_flag;
            @endphp
        @else
          <div class="market_line">
            <div>お店が1件も登録されていません</div>
          </div>
          </details>
        @endif
      @endforeach
    </div>
  <x-create-button></x-create-button>
  <x-seasonings.create></x-seasonings.create>
  <x-seasonings.update-seasoning></x-seasonings.update-seasoning>
  <x-seasonings.upsert-amount></x-seasonings.upsert-amount>
  <x-seasonings.delete></x-seasonings.delete>
  <x-snackbar></x-snackbar>
</x-app>