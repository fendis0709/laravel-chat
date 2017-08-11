@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar pengguna aplikasi</div>

                <div class="panel-body">
                    <h5>Pilih nama pengguna untuk memulai percakapan: </h5>
                    @if(count($usersList) != 0)
                        @foreach($usersList as $index => $user)
                            <ol>
                                <li>
                                    <a href="{{ url('/chat/private/'.$user->id) }}" title="Chat with {{ $user->name }}">{{ $user->name }}</a>
                                </li>
                            </ol>
                        @endforeach
                    @else
                        <p style="font-weight: bold;">Tidak ada pengguna</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
