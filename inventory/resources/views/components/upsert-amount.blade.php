<x-dialog>
  @if ($errors->has('upsert_dialog'))
    <x-slot name="dialog_name">upsert_amount_dialog upsert_amount_dialog_error</x-slot>
  @else
    <x-slot name="dialog_name">upsert_amount_dialog</x-slot>
  @endif
  <div class="upsert_amount_seasoning_dialog">
    <div class="dialog_title">金額編集</div>
    <form action="amount/upsert" method="post" enctype="multipart/form-data">
      @csrf
      <div class="upsert_amount_form">
        <input type="hidden" name="seasoning_id" id="amount_seasoning_id" value="">
        <div class="amount_label">調味料名</div>
        <div class="amount_seasoning_name" id="amount_seasoning_name_display"></div>
        <input type="hidden" name="seasoning_name" class="amount_seasoning_name" id="amount_seasoning_name" value="{{ old('seasoning_name') }}">
        <input type="hidden" name="market_id" id="amount_market_id" value="">
        <div class="amount_label">お店</div>
        <div class="amount_market_name" id="amount_market_name_display"></div>
        <input type="hidden" name="market_name" class="amount_market_name" id="amount_market_name" value="{{ old('market_name') }}">
        <div class="upsert_amount_area">
          <label for="upsert_seasoning_amount">
          @if (($errors->has('upsert_dialog')) && ($errors->has('seasoning_amount')))
            <div class="amount_label_error">金額</div></label>
            <input type="number" name="seasoning_amount" class="upsert_amount_error" id="upsert_seasoning_amount" value="{{ old('seasoning_amount') }}">
            <div class="error_message">{{ $errors->first('seasoning_amount') }}</div>
          @else
            <div class="amount_label">金額</div></label>
            <input type="number" name="seasoning_amount" class="upsert_amount" id="upsert_seasoning_amount" value="{{ old('seasoning_amount') }}">
          @endif
        </div>
        <div class="amount_check_box">
          <input type="checkbox" name="not_available" class="not_available" id="not_available" value="1">
          <label for="not_available">取り扱い無し</label>
        </div>
        <div class="form_btn">
          <input type="reset" value="キャンセル" class="upsert_cancel_btn">
          <input type="submit" value="更新" class="upsert_amount_submit_btn">
        </div>
      </div>
    </form>
  </div>
</x-dialog>