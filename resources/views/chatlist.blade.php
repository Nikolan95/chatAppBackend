<ul class="user-list">
    @foreach($conversations as $conversation)
    <li class="user-list-item conversation" id="{{$conversation['id']}}"
        value="{{$conversation['user']->name }}"
        email="{{ $conversation['user']->email }}"
        address="{{ $conversation['user']->street }} {{ $conversation['user']->city }}"
        telefon="{{ $conversation['user']->phoneNumber }}"
        itemid="{{$conversation['user']->id}}"
        >
        <?php $pos=0 ?>
        @foreach ($conversation['messages'] as $item)

            @if($item->user_id != auth()->id() && $item->read == 0)
                <?php  $pos++ ?>

            @endif
        @endforeach
        @if($pos != 0)
        <output class="pending{{$conversation['id']}}" id="pendingcss">{{$pos}}</output>
        @else
        <output class="pending{{$conversation['id']}}" ></output>
        @endif
        <div class="avatar avatar-online">
            <img src="{{asset('images/avatar-8.jpg')}}" class="rounded-circle" alt="image">
        </div>
        <div class="users-list-body">
            <div>
                <h5>{{$conversation['user']->name }}</h5>
                @if($conversation['messages']->last()->body == 'just_img_no_text')
                    <output class="lastmessage{{$conversation['id']}}">Bild</output>
                @elseif($conversation['messages']->last()->body == 'just_pdf_no_text')
                    <output class="lastmessage{{$conversation['id']}}">PDF</output>
                @elseif($conversation['messages']->last()->body == 'just_offer_no_text')
                    <output class="lastmessage{{$conversation['id']}}">Angebot</output>
                @else
                    <output style="text-overflow: ellipsis !important;
                                       overflow: hidden !important;
                                       width: 160px !important;
                                       height: 1.2em !important;
                                       white-space: nowrap !important;" class="lastmessage{{$conversation['id']}}">{{ $conversation['messages']->last()->body }}</output>
                @endif
            </div>
            <div class="last-chat-time">
                <small class="text-muted"><output class="lasttime{{$conversation['id']}}">{{
                    Carbon\Carbon::parse($conversation['messages']->last()->created_at)->diffForHumans()}}</output></small>
                <div class="chat-toggle mt-1">
                    <div class="dropdown">
                        <a data-toggle="dropdown" href="#">
                            <i class="fas fa-ellipsis-h ellipse_header"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item">Open</a>
                            <a href="#" class="dropdown-item dream_profile_menu">Profile</a>
                            <a href="#" class="dropdown-item">Add to archive</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
