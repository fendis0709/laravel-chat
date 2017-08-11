@extends('layouts.app')

@section('custom_css')
    <style type="text/css">
        .fit-to-content{
            display: inline-block;
        }
        .input-danger{
            border-color: #a94442;
        }
        .row-chat{
            width: 100%;
        }
        .me{
            text-align: right;
        }
        .opponent{
            text-align: left;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" id="chat-header" data-chat-id="{{ $chatId !== false ? $chatId : null }}" data-from-id="{{ Auth::user()->id }}" data-to-id="{{ $userData->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <span>Mulai percakapan dengan <b>{{ $userData->name }}</b></span>
                            <span class="pull-right">
                                <a href="{{ url('/chat') }}">
                                    <i class="fa fa-arrow-left"></i> Daftar pengguna
                                </a>
                                <button class="btn btn-default btn-sm" id="chat-message-load" data-title="Muat ulang percakapan" data-placement="top" data-toggle="tooltip" style="margin-left: 15px;">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="panel-body" id="conversation-box" style="height: 400px; overflow-y: scroll;">
                    @if($chatId !== false)
                        @if($conversationData !== null)
                            @foreach($conversationData as $key => $value)
                                @if($value->user_id !== Auth::user()->id)
                                    <div class="row-chat opponent">
                                        <div class="alert alert-success text-left fit-to-content opponent-message" data-chat-message-id="{{ $value->id }}">
                                            {{ $value->message }}
                                        </div>
                                    </div>
                                @else
                                    <div class="row-chat me">
                                        <div class="alert alert-info text-right fit-to-content my-message" data-chat-message-id="{{ $value->id }}">
                                            {{ $value->message }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @else
                        <div class="text-center">
                            <p>Tidak ada data percakapan</p>
                        </div>
                    @endif
                </div>

                <div class="panel-footer">
                    <form id="chat-message-form" action="{{ url('chat/private/send') }}" method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="chat_type" value="{{ \App\Models\ChatModel::PRIVATE }}">
                                <input type="hidden" name="from" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="to" value="{{ $userData->id }}">
                                <input id="chat-message-box" name="message" type="text" class="form-control" placeholder="Masukkan pesan Anda untuk {{ $userData->name }}" autocomplete="false" autofocus>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" title="Kirim pesan">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </span>
                            </div>
                            <small class="form-text text-muted" id="chat-message-info">Tekan <code>enter</code> untuk mengirim pesan.</small>
                            <small class="form-text hidden text-danger" id="chat-message-feedback">Oops, sepertinya pesan Anda tidak dapat terkirim, mohon coba lagi.</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            var siteUrl     = $('meta[name="site-url"]').attr('content');
            var chatHeader  = $('#chat-header');

            $("#conversation-box").scrollTop($("#conversation-box")[0].scrollHeight);

            var loadConversation = function(){
                if(!(chatHeader.attr('data-chat-id') === null || chatHeader.attr('data-chat-id') === '')){
                    $.ajax({
                        url     : siteUrl + '/chat/private/load-conversation',
                        data    : {
                            from    : chatHeader.attr('data-from-id'),
                            to      : chatHeader.attr('data-to-id')
                        },
                        success : function(response){
                            console.log(response);
                            swal('success');
                        },
                        error   : function(error){
                            console.log(error);
                            swal('Oops, sepertinya terjadi kesalahan saat mengambil data', 'Mohon coba sekali lagi', 'error');
                        }
                    });
                } else {
                    swal('Tidak ada pesan dalam percakapan ini', '', 'info');
                }
            };

            var sendMessage = function(_this){
                $.ajax({
                    url     : _this.attr('action'),
                    type    : _this.attr('method'),
                    data    : new FormData(_this[0]),
                    processData : false,
                    contentType : false,
                    success : function(response){
                        console.log(response);
                        console.log(_this.attr('action'));
                        $('#chat-message-info').removeClass('hidden');
                        $('#chat-message-feedback').addClass('hidden');
                        $('#chat-message-box').removeClass('input-danger');

                        $('#conversation-box').append('' +
                            '<div class="row-chat me">\n' +
                            '   <div class="alert alert-info text-right fit-to-content my-message" data-chat-message-id="' + response.message_id + '">\n' +
                            '       '+ response.message +'\n' +
                            '   </div>\n' +
                            '</div>' +
                            '');
                        $("#conversation-box").scrollTop($("#conversation-box")[0].scrollHeight);
                        $('#chat-message-box').val('');
                    },
                    error   : function(error){
                        console.log(error);
                        $('#chat-message-info').addClass('hidden');
                        $('#chat-message-feedback').removeClass('hidden');
                        $('#chat-message-box').addClass('input-danger');
                    }
                });
            };

            $('#chat-message-load').on('click', function(event){
                event.preventDefault();
                loadConversation();
            });

            $('#chat-message-form').on('submit', function(event){
                event.preventDefault();
                sendMessage($(this));
            });
        });
    </script>
@endsection
