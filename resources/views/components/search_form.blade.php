<div class="d-flex justify-content-center">
    <form class="form-inline" action="{{ $route }}" method="POST">
        @csrf
        <div class="input-group">
            <input class="form-control form-control" type="search" name="search" placeholder="{{__('Buscando algo?')}}">

            <div class="input-group-append">
                <button class="btn btn-success btn-sm my-2 my-sm-0" type="submit">{{__('Buscar')}}</button>
            </div>
        </div>
    </form>
</div>