@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
    <button class="close alert-dismissible btn btn-link" data-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif