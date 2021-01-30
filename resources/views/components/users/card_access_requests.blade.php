<div class="card card-sized shadow">
    <div class="card-header">
        <i class="fas fa-user-plus"></i>
        <b>Solicitações de Acesso</b>
    </div>
    <div class="card-body overflow-auto">
        <table class="table">
            <thead>
                <th><small>Nome</small></th>
                <th><small>Ações</small></th>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td><small>{{ $request->name }}</small></td>
                    <td>
                        <a class="btn btn-sm btn-success"
                            href="{{ route('users.accessRequest', [$request, 'granted']) }}" style="zoom: 75%;"
                            title="Aprovar acesso.">
                            <i class="far fa-thumbs-up"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="{{ route('users.accessRequest', [$request, 'denied']) }}"
                            style="zoom: 75%;" title="Negar acesso.">
                            <i class="far fa-thumbs-down"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        Total: {{ count($requests) }}
    </div>
</div>