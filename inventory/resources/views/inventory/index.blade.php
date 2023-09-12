<x-app>
  <x-header></x-header>
  <x-slot name="css_link">{{ asset('/css/index.css') }}</x-slot>
    <div class="inventory_contents">
      @if($query->isEmpty())
        <div class="seasonings_not_exist">データが登録されていません</div>
      @endif
      @php
        $seasoning_id = App\Models\Seasonings::checking_duplicate_id;
        $amount_flag = 0;
      @endphp
      @foreach ($query as $seasoning)
        @if($seasoning_id != ($seasoning->seasoning_id))
          @if($amount_flag != 0)
            </details> 
            @php
              $amount_flag = 0;
            @endphp
          @endif
          <div class="seasoning_chart">
            <div class="seasoning_picture_line">
              @if(isset($seasoning->seasoning_image))
                <div class="seasoning_picture">{{ $seasoning->seasoning_image }}</div>
              @else
                <div class="seasoning_picture_space"></div>
              @endif
              <div class="seasoning_line">
                <div class="seasoning_first_line">
                  <div class="seasoning_name">{{ $seasoning->seasoning_name }}</div>
                  <div class="seasoning_editor_btn">
                    <div class="seasoning_update_btn">
                      <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                          <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
                        </svg>
                      </a>
                    </div>
                    <div class="seasoning_delete_btn">
                      <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                          <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                        </svg>
                      </a>
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
                      <div class="number_of_seasoning">{{ $seasoning->number_of_seasoning }}</div>
                    @else 
                      <div class="number_of_seasoning">0</div>
                    @endif
                  </div>
                </div>
                <div class="seasoning_third_line">
                  <div>メモ:
                    {{ $seasoning->seasonings_remark }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <details class="amount_chart">
            <summary>金額比較表</summary>
        @endif
          <div class="market_line">
            <div class="market_name">{{ $seasoning->market_name }}</div>
            @if(isset($seasoning->seasoning_amount))
              <div class="market_amount @if($market_min_amount == ($seasoning->seasoning_amount)) market_min_amount @endif">&yen;{{ $seasoning->seasoning_amount }}</div>
            @else 
              <div class="market_amount">取扱い無し</div>
            @endif
            <div class="amount_update_btn">
              <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32">
                  <path d="M200-200h56l345-345-56-56-345 345v56Zm572-403L602-771l56-56q23-23 56.5-23t56.5 23l56 56q23 23 24 55.5T829-660l-57 57Zm-58 59L290-120H120v-170l424-424 170 170Zm-141-29-28-28 56 56-28-28Z"/>
                </svg>
              </a>
            </div>
          </div>
              @php
                $seasoning_id = ($seasoning->seasoning_id);
                $amount_flag = 1;
              @endphp
      @endforeach
    </div>
    <x-create-button>
      <x-slot name="create_link">#</x-slot>
    </x-create-button>
</x-app>