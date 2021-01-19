<div class="card card-sized shadow min-card-width">
    <div class="card-header">
        <i class="fas fa-user"></i>
        <b>Usuários permitidos</b>
    </div>
    <div class="card-body overflow-auto">
        <table class="table">
            <thead>
                <th><small>Nome</small></th>
                <th><small>Email</small></th>
                <th><small>Ações</small></th>
            </thead>
            <tbody>
                @foreach($users as $granted)
                <tr>
                    <td><small>{{ $granted->name }}</small></td>
                    <td><small>{{ $granted->email }}</small></td>
                    <td>
                        <a class="btn btn-sm btn-danger" href="{{ route('users.accessRequest', [$granted, 'denied']) }}"
                            style="zoom: 75%;" title="Revogar acesso.">
                            <i class="fas fa-minus-circle"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        Total: {{ count($users) }}
    </div>
</div>