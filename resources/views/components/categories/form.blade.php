<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                @include('components.inputs.input_text', ['name' => 'name', 'label' => 'Nome', 'value' => $category->name ?? old('name')])
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <label for="emails[]">Enviar para:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10" id="emails-col">
                        <input type="email" class="form-control" name="emails[]"><br>
                        @if(isset($category))
                            @foreach($category->emails as $emailcat)
                            <input type="email" class="form-control" name="emails[]" value="{{ $emailcat->email }}"><br>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success" type="button" onclick="addEmail()" id="btnAddEmail">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <script>
                var colunm = document.getElementById('emails-col');
                var element = '<input type="email" class="form-control" name="emails[]"><br>';
                function addEmail() {
                    //colunm.append(element);
                    $(colunm).prepend(element)
                }

                function checkInputArray(inputName) {
                    var input = document.getElementsByName(inputName);
                    var allFilled = true;

                    for (var i = 0; i < input.length; i++) {
                        if (input[i].value == '') {
                            allFilled = false;
                            break;
                        }
                    }

                    return allFilled;
                }

                function checkEmails() {
                var button = document.getElementById('btnAddEmail');
                    button.disabled = !(checkInputArray("emails[]"));
                }

                setInterval(checkEmails, 100);
            </script>
        </div>
    </div>
</div>
