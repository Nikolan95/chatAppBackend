
<div class="messages">
    <div id="load_data"></div>
    <div id="load_data_message"></div>
    @foreach($conversation[0]['messages'] as $line)
    @if($line->user_id != auth()->id())
    <div class="chats">
        <div class="chat-avatar">
            <img src="{{asset('images/avatar-2.jpg')}}" class="rounded-circle dreams_chat" alt="image">
        </div>
        <div class="chat-content">
            <div class="message-content">
                @if($line->body != null)
                {{$line->body}}
                @elseif($line->image != null)
                    <img src="data:image/png;base64,{{ chunk_split(base64_encode($line->image)) }}" alt="" class="d-block mx-auto my-4 img" id="img" height="130">
                @elseif($line->body == null && $line->image == null)
                    <a href="#">document</a>
                @endif
            </div>
            <div class="chat-time">
                <div>
                    <div class="time">{{ Carbon\Carbon::parse($line->created_at)->diffForHumans()}}</div>
                </div>
            </div>
        </div>
    </div>
    @elseif($line->user_id == auth()->id())
    <div class="chats chats-right" id="rightChatId">
        <div class="chat-content">
            <div class="message-content">
                @if($line->body != null)
                {{$line->body}}
                @elseif($line->image != null)
                <a href="javascript:void(0)" onclick="openImage('{{$line->image}}')">
                    <input type="hidden" id="blob" value="{{$line->image}}">
                    <img src="data:image/png;base64,{{ chunk_split($line->image) }}" alt="" class="d-block mx-auto my-4 img" id="img" height="130">
                </a>
                @elseif($line->body == null && $line->image == null)
                    <button class="btn send-btn" type="button" data-toggle="modal" data-target="#offer{{$line->id}}" data-id="{{$line->id}}" id="documentModal">
                        <i class="fas fa-file"></i>
                    </button>
                @endif
            </div>
            <div class="chat-time">
                <div>
                    <div class="time">{{ Carbon\Carbon::parse($line->created_at)->diffForHumans()}}<i><img src="assets/img/double-tick.png" alt=""></i></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <input type="hidden" value="{{auth()->user()->id}}" name="user_id" id="user_id">
    <input type="hidden" value="{{$conversation[0]['user']->id}}" name="second_user_id" id="second_user_id">
    <input type="hidden" value="{{$conversation[0]['id']}}" name="conversation_id" id="conversation_id">
</div>

@include('messages.document')





