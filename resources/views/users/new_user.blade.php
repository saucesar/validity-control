<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <title>{{$title ?? 'Promoter Manager'}}</title>
</head>

<body style="background-color: rgba(0, 0, 250, 0.5);">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-lg-10">
                <div class="container-fluid">
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">VC</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Novo Usuário</h6>
                            <br>
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                @include('components/messages')
                                <input type="hidden" name="webmode" value="true">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="password">Seu Nome</label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="col">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="company">Nome da sua Empresa</label>
                                    <input type="text" class="form-control" name="company" value="{{ old('company') }}" required>
                                    <small>Para ingressar em uma empresa existente, coloque aqui o id da empresa.</small>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="password">Senha</label>
                                            <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                        </div>
                                        <div class="col">
                                            <label for="password_confirm">Confirme Senha</label>
                                            <input type="password" class="form-control" name="password_confirm" value="{{ old('password_confirm') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

</body>

</html>