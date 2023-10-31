<x-dialog>
  @if ($errors->has('update_dialog'))
    <x-slot name="dialog_name">update_dialog update_dialog_error</x-slot>
  @else
    <x-slot name="dialog_name">update_dialog</x-slot>
  @endif
  <div class="update_market_dialog">
    <div class="dialog_title">お店編集</div>
    <form action="update/markets" method="post">
      @csrf
      <div class="update_market_form">
        <input type="hidden" name="market_id" id="update_market_id" value="">
        <div class="update_market_name_area">
          <label for="update_market_name">
          @if (($errors->has('update_dialog')) && ($errors->has('market_name')))
            <div class="update_market_name_label_error">店舗名</div></label>
            <input type="text" name="market_name" class="update_market_name_error" id="update_market_name" value="{{ old('market_name') }}" maxlength="50" required>
            <div class="error_message">{{ $errors->first('market_name') }}</div>
          @else
            <div class="update_market_name_label">店舗名</div></label>
            <input type="text" name="market_name" class="update_market_name" id="update_market_name" value="{{ old('market_name') }}" maxlength="50" required>
          @endif
        </div>
        <div class="form_btn">
          <input type="reset" value="キャンセル" class="update_cancel_btn">
          <input type="submit" value="更新"  class="update_submit_btn">
        </div>
      </div>
    </form>
  </div>
</x-dialog>