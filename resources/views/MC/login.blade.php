@extends('MC.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Авторизация</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mc-backup.login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control"
                                           name="password" required>
                                </div>
                            </div>
                            <button class="btn btn-primary">Auth</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

