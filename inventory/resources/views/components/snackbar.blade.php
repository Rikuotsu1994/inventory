<x-slot name="snackbar_css">{{ asset('/css/snackbar.css') }}</x-slot>
@if (Session::has('message'))
  <div class="snackbar_window">
    <div class="session_masage">
      {{ session('message') }}
    </div>
  </div>
@endif