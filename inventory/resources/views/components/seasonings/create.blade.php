<x-dialog>
  @if ($errors->has('dialog_name'))
    <x-slot name="dialog_name">create_dialog create_dialog_error</x-slot>
  @else
    <x-slot name="dialog_name">create_dialog</x-slot>
  @endif
  <div class="create_seasoning_dialog">
    <div class="dialog_title">調味料登録</div>
    <form action="create" method="post" enctype="multipart/form-data">
      @csrf
      <div class="create_seasoning_form">
        <div class="create_seasoning_name_area">
          <label for="create_seasoning_name">
          @if (($errors->has('dialog_name')) && ($errors->has('seasoning_name')))
            <div class="create_seasoning_name_label_error">調味料名</div></label>
            <input type="text" name="seasoning_name" class="create_seasoning_name_error" id="create_seasoning_name" value="{{ old('seasoning_name') }}" maxlength="50" required>
            <div class="error_message">{{ $errors->first('seasoning_name') }}</div>
          @else
            <div class="create_seasoning_name_label">調味料名</div></label>
            <input type="text" name="seasoning_name" class="create_seasoning_name" id="create_seasoning_name" value="{{ old('seasoning_name') }}" maxlength="50" required>
          @endif
        </div>
        <div class="create_seasoning_inventory_area">
          <label for="create_seasoning_inventory">
          @if (($errors->has('dialog_name')) && ($errors->has('seasoning_inventory')))
            <div class="create_seasoning_inventory_label_error">在庫数</div></label>
            <input type="number" name="seasoning_inventory" class="create_seasoning_inventory_error" id="create_seasoning_inventory" value="{{ old('seasoning_inventory') }}" min="0" max="99" oninput="digitcontrol(this, 2)">
            <div class="error_message">{{ $errors->first('seasoning_inventory') }}</div>
          @else
            <div class="create_seasoning_inventory_label">在庫数</div></label>
            <input type="number" name="seasoning_inventory" class="create_seasoning_inventory" id="create_seasoning_inventory" value="{{ old('seasoning_inventory') }}" min="0" max="99" oninput="digitcontrol(this, 2)">
          @endif
        </div>
        <div class="create_seasoning_remarks_area">
          <label for="create_seasoning_remarks">
          @if (($errors->has('dialog_name')) && ($errors->has('remarks')))
            <div class="create_remarks_label_error">メモ</div></label>
            <textarea name="remarks" maxlength="100" class="create_seasoning_remarks_error" id="create_seasoning_remarks" value="{{ old('remarks') }}"></textarea >
            <div class="error_message">{{ $errors->first('remarks') }}</div>
          @else
            <div class="create_remarks_label">メモ</div></label>
            <textarea name="remarks" maxlength="100" class="create_seasoning_remarks" id="create_seasoning_remarks" value="{{ old('remarks') }}"></textarea >
          @endif
        </div>
        <div class="create_seasoning_image_area">
          <label for="create_seasoning_image">
            <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30" fill="#707070">
              <path d="M460-80q-92 0-156-64t-64-156v-420q0-66 47-113t113-47q66 0 113 47t47 113v380q0 42-29 71t-71 29q-42 0-71-29t-29-71v-380h60v380q0 17 11.5 28.5T460-300q17 0 28.5-11.5T500-340v-380q0-42-29-71t-71-29q-42 0-71 29t-29 71v420q0 66 47 113t113 47q66 0 113-47t47-113v-420h60v420q0 92-64 156T460-80Z"/>
            </svg>
            <div class="image_annotation">画像は1MBまで</div>
            <div class="image_extension">(対応形式jpeg・jpg・png)</div>
            <input type="file" name="seasoning_image" class="create_seasoning_image" id="create_seasoning_image" accept=".jpg,.jpeg,.png">
          </label>
          @if (($errors->has('dialog_name')) && ($errors->has('seasoning_image')))
            <div class="error_message">{{ $errors->first('seasoning_image') }}</div>
          @endif
        </div>
        <div class="preview_annotation">画像プレビュー</div>
        <div class="image_area">
          <div class="create_img_preview" id="create_img_preview"></div>
        </div>
        <div class="form_btn">
          <input type="reset" value="キャンセル" class="create_cancel_btn">
          <input type="submit" value="登録"  class="create_submit_btn">
        </div>
      </div>
    </form>
  </div>
</x-dialog>