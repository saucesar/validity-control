@extends('layouts.app', ['title' => 'VC - Categories', 'active' => 'categories'])

@section('content')
<div class="">
    <div class="container-fluid">
        <div class="row mt-5 text-center">
            <div class="col mt-5">
                <h1>Categorias</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                @include('components.search_form', ['route' => '#' ])
            </div>
        </div>
        <br>

        <div class="row d-flex justify-content-center">
            <div class="col-3"></div>
            <div class="col-6">
                @include('components.messages')
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                @if(isset($searchData))
                    {{ $categories->appends($searchData)->links() }}
                @else
                    {{ $categories->links() }}
                @endif
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3">
                @if(isset($categories))
                <div class="card shadow card-body mb-4">
                    <div class="row">
                        <div class="col">
                            <small><b>Resultados encontrados: {{ $categories->total() }}</b></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-6">
                <div class="card-deck">
                    @include('components.categories.categories_list', ['categories' => $categories])
                </div>
                <div>
                    @if(isset($searchData))
                        {{ $categories->appends($searchData)->links() }}
                    @else
                        {{ $categories->links() }}
                    @endif
                </div>
            </div>
            <div class="col-3">
                <div class="card shadow card-body min-card-width mb-4">
                    <div class="row d-flex justify-content-between">
                        <div class="col">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#" title="Adicionar categoria.">
                                <i class="fas fa-plus-circle"></i>
                                Add
                            </button>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection