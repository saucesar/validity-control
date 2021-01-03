@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
    <button class="close alert-dismissible btn btn-link" data-dismiss="alert">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif