<x-dialog>
  <x-slot name="dialog_name">delete_dialog</x-slot>
  <div class="delete_seasoning_dialog">
    <div class="dialog_title">
      <svg xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48" fill="#FF0000">
        <path d="m40-120 440-760 440 760H40Zm138-80h604L480-720 178-200Zm302-40q17 0 28.5-11.5T520-280q0-17-11.5-28.5T480-320q-17 0-28.5 11.5T440-280q0 17 11.5 28.5T480-240Zm-40-120h80v-200h-80v200Zm40-100Z"/>
      </svg>
      <div class="caution_title_text">調味料削除</div>
    </div>
    <form action="delete" method="post">
      @csrf
      <div class="delete_seasoning_form">
        <div class="delete_seasoning_message">
          <input type="hidden" name="seasoning_id" id="delete_seasoning_id" value="">
          <div>この調味料と関連する金額データも削除されます。</div>
          <div>削除したデータは復元できません。</div>
          <div class="delete_seasoning_name" id="delete_seasoning_name"></div>
          <div>を削除しますか。</div>
        </div>
      </div>
      <div class="form_btn">
        <input type="reset" value="キャンセル" class="delete_cancel_btn">
        <input type="submit" value="削除"  class="delete_submit_btn">
      </div>
    </form>
  </div>
</x-dialog>