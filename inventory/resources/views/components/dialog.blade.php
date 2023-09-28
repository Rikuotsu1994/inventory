<x-slot name="dialog_css">{{ asset('/css/dialog.css') }}</x-slot>
<div class="dialog_background {{ $dialog_name }}">
  <div class="dialog">
    {{ $slot }}
  </div>
</div>
