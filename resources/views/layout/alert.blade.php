@if (session()->has('message'))
<div class="alert alert-{{ session('message')['class'] }} mb-3 mt-2 alert-dismissible fade show" role="alert">
    {{ session('message')['text'] }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
