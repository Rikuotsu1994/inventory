<x-dialog>
  @if ($errors->has('create_dialog'))
    <x-slot name="dialog_name">create_dialog create_dialog_error</x-slot>
  @else
    <x-slot name="dialog_name">create_dialog</x-slot>
  @endif
  <div class="create_market_dialog">
    <div class="dialog_title">お店登録</div>
    <form action="create/markets" method="post">
      @csrf
      <div class="create_market_form">
        <div class="create_market_name_area">
          <label for="create_market_name">
          @if (($errors->has('create_dialog')) && ($errors->has('market_name')))
            <div class="create_market_name_label_error">店舗名</div></label>
            <input type="text" name="market_name" class="create_market_name_error" id="create_market_name" value="{{ old('market_name') }}" maxlength="50" required>
            <div class="error_message">{{ $errors->first('market_name') }}</div>
          @else
            <div class="create_market_name_label">店舗名</div></label>
            <input type="text" name="market_name" class="create_market_name" id="create_market_name" value="{{ old('market_name') }}" maxlength="50" required>
          @endif
        </div>
        <div class="form_btn">
          <input type="reset" value="キャンセル" class="create_cancel_btn">
          <input type="submit" value="登録"  class="create_submit_btn">
        </div>
      </div>
    </form>
  </div>
</x-dialog>