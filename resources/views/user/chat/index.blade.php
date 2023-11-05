<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">


    <title>{{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body{margin-top:20px;}

        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 800px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }
        .py-3 {
            padding-top: 1rem!important;
            padding-bottom: 1rem!important;
        }
        .px-4 {
            padding-right: 1.5rem!important;
            padding-left: 1.5rem!important;
        }
        .flex-grow-0 {
            flex-grow: 0!important;
        }
        .border-top {
            border-top: 1px solid #dee2e6!important;
        }
    </style>
</head>
<body>
<main class="content">
    <div class="container p-0">
        <h1 class="h3 mb-3">Messages</h1>
        <div class="card">
            <div class="row g-0">
                <div class="col-12 col-lg-5 col-xl-3 border-right">
{{--                    <div class="px-4 d-none d-md-block">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="flex-grow-1">--}}
{{--                                <input type="text" class="form-control my-3" placeholder="Search...">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if(Auth()->user()->level == "admin")--}}
{{--                        @foreach($allUserChatWithAdmin as $k => $v)--}}
{{--                            <a href="#" class="list-group-item list-group-item-action border-0">--}}
{{--                                <div class="d-flex align-items-start">--}}
{{--                                    <img src="https://ui-avatars.com/api/?name={{$v->name}}" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">--}}
{{--                                    <div class="flex-grow-1 ml-3">--}}
{{--                                        {{$v->name}}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
                    <hr class="d-block d-lg-none mt-1 mb-0">
                </div>
                <div class="col-12 col-lg-7 col-xl-9">
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 pl-3">
                                <strong>Admin</strong>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <div class="chat-messages p-4" id="chat-section">
                            <div class="chat-message-right pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">You</div>
                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                </div>
                            </div>
                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                </div>
                            </div>
                            @foreach($allChat as $k => $v)
                                @if($v->from_user_uuid == Auth::user()->uuid)
                                    <div class="chat-message-right pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">{{$v->created_at}}</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">{{$v->fromUser->name}}</div>
                                            {{$v->message}}
                                        </div>
                                    </div>
                                @elseif($v->from_user_uuid == $adminUuid && $v->to_user_uuid == Auth::user()->uuid)
                                    <div class="chat-message-left pb-4" data-uuid="{{$v->uuid}}">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">{{$v->created_at}}</div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">{{$v->fromUser->name}}</div>
                                            {{$v->message}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">
                            <input type="text" id="message-input" class="form-control" placeholder="Type your message">
                            <button id="send-button" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    function fetchMessages() {
        $.get('/chat/get-last-chat-from-admin', function (data) {

            //save uuid from last message
            var lastMessageUuid = $('.chat-message-left').last().data('uuid');
            console.log("last message from user: "+lastMessageUuid);

            //get last uuid from the data
            var lastUuid = data?.data?.uuid;
            console.log("last message from admin: "+lastUuid);

            if (lastMessageUuid === lastUuid){
                console.log('no new message');
            }else if (lastMessageUuid === undefined) {
            }else {
                console.log('new message');
                $('#chat-section').append('<div class="chat-message-left pb-4" data-uuid="'+data.data.uuid+'"><div><img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40"><div class="text-muted small text-nowrap mt-2">'+data.data.created_at+'</div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3"><div class="font-weight-bold mb-1">Admin</div>'+data.data.message+'</div></div>');
            }
        });
    }

    // Poll for new messages every 5 seconds
    setInterval(fetchMessages, 1000);

    // Handle sending messages when the "Enter" key is pressed
    $('#message-input').keypress(function (e) {
        if (e.which === 13) { // 13 is the key code for "Enter"
            e.preventDefault(); // Prevent the default behavior of a line break
            sendMessage();
        }
    });

    // Handle sending messages when the "Send" button is clicked
    $('#send-button').click(function () {
        sendMessage();
    });

    function sendMessage() {
        var message = $('#message-input').val();
        if (message.trim() !== '') { // Check if the message is not empty
            $.post('/chat/send', { message: message }, function (data) {
                // Clear the input field after sending
                $('#message-input').val('');
            });
            //append the message to the chat container
            $('#chat-section').append('<div class="chat-message-right pb-4"><div><img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40"><div class="text-muted small text-nowrap mt-2">2:33 am</div></div><div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3"><div class="font-weight-bold mb-1">You</div>'+message+'</div></div>');
        }
    }
</script>
</body>
</html>
