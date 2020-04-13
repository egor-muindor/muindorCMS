@extends('MC.app')
@section('content')
    <input type="hidden" value="{{$token}}" name="token">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Бекапы</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($files as $file)
                                <a href="#" class="list-group-item list-group-item-action">{{ $file->getFilename() }} ({{ $format($file->getSize()) }})</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
