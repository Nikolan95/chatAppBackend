<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dreams Chat - Html Template</title>
	
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/favicon.png')}}">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
	
    <!-- Custom scroll CSS -->
    <link rel="stylesheet" href="{{asset('plugins/mcustomscroll/jquery.mCustomScrollbar.css')}}">
	
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
	
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">	
        <!-- content -->
        <div class="content main_content">	
            <!-- sidebar group -->
            <div class="sidebar-group left-sidebar chat_sidebar">
                <!-- Chats sidebar -->
                <div id="chats" class="left-sidebar-wrap sidebar active">
                    <div class="header">
                        <div class="header-top">
                            <div class="logo ml-2 mt-3">
                                <a href="index.html">
                                    <img src="{{asset('images/logo-atev-white.png')}}" class="header_image img-fluid" alt="">
                                </a>
                            </div>
                            <ul class="header-action mt-4">
                                <li>
                                    <a href="#" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h ellipse_header"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right header_drop_icon">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#profile_modal">Profil</a>
                                        <a class="dropdown-item" data-toggle="modal"
                                            data-target="#settings_modal">Einstellungen</a>
                                        <a href="/logout" class="dropdown-item">Ausloggen</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav nav-tabs chat-tabs mt-4">
                            <li class="nav-item">
                                <a class="nav-link active" id="plaudern" >Plaudern</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="gruppe" >Gruppe</a>
                            </li>
                        </ul>
                        <button type="button" class="float-right btn btn-circle btn-sm header_button startConversation"
                            data-toggle="modal" data-target="#chat-new">
                            <i class="fas fa-plus button_plus"></i>
                        </button>
                    </div>
                    <div class="search_chat has-search">
                        <span class="fas fa-search form-control-feedback"></span>
                        <input class="form-control chat_input" id="search-contact" type="text" placeholder="">
                    </div>
                    <div class="sidebar-body" id="chatsidebar">
                        <ul class="user-list">
                            @foreach($conversations as $conversation)
                            <li class="user-list-item conversation" id="{{$conversation['id']}}" value="{{$conversation['user']->name }}" itemid="{{$conversation['user']->id}}" itemprop="{{$conversation['car']->manufacturer_and_brand}}">
                                <span class="pending{{$conversation['id']}}"></span>
                                <div class="avatar avatar-online">
                                    <img src="{{asset('images/avatar-8.jpg')}}" class="rounded-circle" alt="image">
                                </div>
                                <div class="users-list-body">
                                    <div>
                                        <h5>{{$conversation['user']->name }}</h5>
                                        <p>{{ $conversation['messages']->last()->body }}</p>
                                    </div>
                                    <div class="last-chat-time">
                                        <small class="text-muted">{{ Carbon\Carbon::parse($conversation['messages']->last()->created_at)->diffForHumans()}}</small>
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
                    </div>
                </div>
                <!-- / Chats sidebar -->
            </div>
            <!-- /Sidebar group -->
        
            <!-- Chat -->
            <div class="chat" id="middle">
                <div class="chat-header">
                    <div class="user-details">
                        <div class="d-lg-none ml-2">
                            <ul class="list-inline mt-2 mr-2">
                                <li class="list-inline-item">
                                    <a class="text-muted px-0 left_side" href="#" data-chat="open">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <figure class="avatar ml-1 Slika">
                            <img src="{{asset('/images/avatar-2.jpg')}}" class="rounded-circle chatImg" alt="image" style="display: none;">
                        </figure>
                        <div class="mt-1">
                            <h5 class="mb-1 chatName"></h5>
                            <small class="text-muted mb-2">
                            </small>
                        </div>
                    </div>
                    <div class="chat-options">
                        <ul class="list-inline">
                            <li class="list-inline-item" data-toggle="tooltip" title=""
                                data-original-title="Voice call">
                                <a href="javascript:void(0)" class="btn btn-outline-light" data-toggle="modal"
                                    data-target="#voice_call">
                                    <i class="fas fa-phone-alt voice_chat_phone"></i>
                                </a>
                            </li>
                            <li class="list-inline-item" data-toggle="tooltip" title=""
                                data-original-title="Video call">
                                <a href="javascript:void(0)" class="btn btn-outline-light" data-toggle="modal"
                                    data-target="#video_call">
                                    <i class="fas fa-video"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn btn-outline-light" href="#" data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item dream_profile_menu">Profile</a>
                                    <a href="#" class="dropdown-item">Delete</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="chat-body">
                </div>
                <div class="chat-footer">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div style="display: flex">
                        <input type="text" class="form-control chat_form input" placeholder="Write a message." name="body" id="body" class="submit" /> 
                        
                            <button class="btn" type="button">
                                <i class="far fa-smile"></i>
                            </button>
                            <button class="btn" type="button" data-toggle="modal" data-target="#drag_files">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            <button class="btn" type="button">
                                <i class="fas fa-microphone-alt"></i>
                            </button>
                            <button class="btn send-btn" type="button">
                                <i class="fab fa-telegram-plane"></i>
                            </button>
                        
                    </div>
                </div>
            </div>
            <!-- /Chat -->

            <!-- Upload Documents -->
            <div id="drag_files" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Drag and drop files upload</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/sendImage" id="sendImage" enctype="multipart/form-data">
                                @csrf
                                <div class="upload-drop-zone" id="drop-zone">
                                    <input type="hidden" value="{{auth()->user()->id}}" name="user_id" id="user_id">
                                    <input class="fa fa-cloud-upload fa-2x image" type="file" name="image">
                                    <input class="fa fa-cloud-upload fa-2x" type="hidden" id="cnv" name="conversation_id" value="">
                                    <input class="fa fa-cloud-upload fa-2x" type="hidden" id="susr" name="second_user_id" value="">
                                </div>
                                <div class="text-center mt-0">
                                    <button class="btn newgroup_create m-0" type="submit">Add to upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Upload Documents -->


            <!-- Chat New Modal -->
            <div class="modal fade" id="chat-new">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Neue Konversation
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times close_icon"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Card -->
                            <form action="{{ route('conversation.create') }}" method="POST" id="createconversation">
                                @csrf
                                <div class="form-group">
                                    <label>Benutzer</label>
                                    <select class="form-control" name="contact" id="contact">
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}"> {{ $contact->name }} </option>
                                        @endforeach    
                                    <select>
                                </div>
                                <div class="form-group">
                                    <label>Nachricht</label>
                                    <textarea class="form-control" rows="5" name="message" id="message"></textarea>
                                </div>
                                <div class="form-row profile_form mt-3 mb-1">
                                    <button type="submit" class="btn btn-block newgroup_create mb-0">
                                        Schaffen
                                    </button>
                                </div>
                            </form>
                        </div>       
                    </div>
                </div>
            </div>
            <!-- /Group New Modal -->

            <div class="modal fade" id="group-new">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Neue Gruppe
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times close_icon"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Card -->
                            <form action="{{ route('group.create') }}" method="POST" id="creategroup">
                                @csrf
                                <div class="form-group">
                                    <label>Benutzer</label>
                                    <select class="form-control" name="contact" id="contact">
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}"> {{ $contact->name }} </option>
                                        @endforeach    
                                    <select>
                                        <span class="text-danger error-text contact_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>wähle die Gruppe</label>
                                    <select class="form-control" name="group" id="group">
                                        <option value=""> </option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                        @endforeach    
                                    <select>
                                    <span class="text-danger error-text group_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>oder gründe eine neue Gruppe</label>
                                    <input class="form-control" type="text" name="newgroup">
                                    <span class="text-danger error-text newgroup_error"></span>
                                </div>
                                <div class="form-row profile_form mt-3 mb-1">
                                    <button type="submit" class="btn btn-block newgroup_create mb-0">
                                        Schaffen
                                    </button>
                                </div>
                            </form>
                        </div>       
                    </div>
                </div>
            </div>
            <!-- /Group New Modal -->

            

            <!-- Profile Modal -->
            <div class="modal fade" id="profile_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Profil
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times close_icon"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Card -->
                            <div class="card mb-6 profile_Card">
                                <div class="card-body">
                                    <div class="text-center py-6">
                                        <!-- Photo -->
                                        <div class="avatar avatar-xl mb-3">
                                            @if(!empty($user->picture->path))
                                            <img class="avatar-img rounded-circle mCS_img_loaded"  src="http://localhost/atevapplication//atevChatApp//storage//app//public//{{$user->picture->path}}" alt="">
                                            @else
                                            <img class="avatar-img rounded-circle mCS_img_loaded"  src="https://media.defense.gov/2020/Feb/19/2002251686/700/465/0/200219-A-QY194-002.JPG" alt="">
                                            @endif
                                        </div>
                                        <h5>{{$user->name}}</h5>
                                        <p class="text-muted m-0">Zuletzt gesehen: Heute</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card -->
                            <!-- Card -->
                            <form action="#" class="mt-3">
                                <div class="form-group">
                                    <label>PLZ, Ort</label>
                                    <input class="form-control form-control-lg group_formcontrol" name="new-chat-title" type="text" placeholder="{{$user->city}}">
                                </div>
                                <div class="form-group">
                                    <label>Telefon</label>
                                    <input class="form-control form-control-lg group_formcontrol" name="new-chat-title" type="text" placeholder="{{$user->telefon}}">
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input class="form-control form-control-lg group_formcontrol" name="new-chat-title" type="email" placeholder="{{$user->email}}">
                                </div>
                            </form>
                            <!-- Card -->
                            <div class="form-row profile_form mt-3 mb-1">
                                <!-- Button -->
                                <button type="button" class="btn btn-block newgroup_create mb-0" data-dismiss="modal">
                                    Profil aktualisieren
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profile Modal -->

            <!-- Settings Modal -->
            <div class="modal fade" id="settings_modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Settings
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times close_icon"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-header position-relative account_details">
                                <a href="#" class="text-reset d-block stretched-link collapsed">
                                    <div class="row no-gutters align-items-center">
                                        <!-- Title -->
                                        <div class="col">
                                            <h5>Account</h5>
                                            <p class="m-0">Update your profile details.</p>
                                        </div>
                                        <!-- Icon -->
                                        <div class="col-auto">
                                            <i class="text-muted icon-md fas fa-user"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-header position-relative mt-3 security_details">
                                <a href="#" class="text-reset d-block stretched-link collapsed">
                                    <div class="row no-gutters align-items-center">
                                        <!-- Title -->
                                        <div class="col">
                                            <h5>Security</h5>
                                            <p class="m-0">Update your profile details.</p>
                                        </div>
                                        <!-- Icon -->
                                        <div class="col-auto">
                                            <i class="text-muted icon-md fas fa-crosshairs"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-3">
                                <label for="profile-name">Name</label>
                                <input class="form-control form-control-lg profile_input group_formcontrol" name="profile-name" id="profile-name" type="text" placeholder="{{$user->name}}">
                            </div>
                            <div class="mt-4">
                                <label for="profile-name">Current Password</label>
                                <input class="form-control form-control-lg group_formcontrol" name="profile-name" id="profile-name_pswd" type="text" placeholder="Current Password">
                            </div>
                            <div class="mt-4">
                                <label for="profile-name">New Password</label>
                                <input class="form-control form-control-lg group_formcontrol" name="profile-name" id="profile-name_new" type="text" placeholder="New Password">
                            </div>
                            <div class="mt-4">
                                <label for="profile-name">Verify Password</label>
                                <input class="form-control form-control-lg group_formcontrol" name="profile-name" id="profile-name_prfname" type="text" placeholder="Verify Password">
                            </div>
                            <div class="mt-3 text-center">
                                <button class="btn btn-block newgroup_create mb-0" type="submit" data-dismiss="modal">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Settings Modal -->

            <!-- Right sidebar -->
            <div class="right-sidebar right_sidebar_profile" id="middle1">
                <div class="right-sidebar-wrap active">
                    <div class="contact-close_call mr-4 mt-4 text-right">
                        <a href="#"
                            class="btn btn-outline-light close_profile close_profile4">
                            <i class="fas fa-times close_icon"></i>
                        </a>
                    </div>
                    <div class="sidebar-body">
                        <div class="pl-4 pr-4 mt-0 right_sidebar_logo">
                            <div class="text-center mb-3">
                                <figure class="avatar avatar-xl mb-3">
                                    <img src="{{asset('images/avatar-2.jpg')}}" class="rounded-circle" alt="image">
                                </figure>
                                <h5 class="profile-name"></h5>
                            </div>
                            <div>

                                <div class="accordion-col">
                                    <div class="accordion-title">
                                        <h6 class="primary-title">Media (31) <i class="fas fa-chevron-right float-right"></i></h6>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="media-lists">
                                            <div class="media-image">
                                                <img src="{{asset('images/media1.jpg')}}" alt="">
                                            </div>
                                            <div class="media-image">
                                                <img src="{{asset('images/media2.jpg')}}" alt="">
                                            </div>
                                            <div class="media-image">
                                                <img src="{{asset('images/media3.jpg')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-title">
                                        <h6 class="primary-title">About and phone number <i class="fas fa-chevron-right float-right"></i></h6>
                                    </div>
                                    <div class="accordion-content">
                                        <p class="text-muted text-center mt-1">Help people to build websites and apps + grow
                                            awareness in social media 🔥</p>
                                        <div class="mt-2 text-center">
                                            <h6>Phone: <span class="text-muted ml-2">+(33 1) 45 55 01 10</span></h6>
                                        </div>
                                    </div>
                                    <div class="accordion-title">
                                        <h6 class="primary-title">Settings <i class="fas fa-chevron-right float-right"></i></h6>
                                    </div>
                                    <div class="accordion-content">
                                        <ul class="contact-action">
                                            <li class="block-user mt-1">
                                                <a href=""><i class="fas fa-ban mr-2 text-muted"></i>Block</a>
                                            </li>
                                            <li class="report-contact">
                                                <a href=""><i class="fas fa-thumbs-down mr-2"></i> Report Contact</a>
                                            </li>
                                            <li class="delete-chat">
                                                <a href=""><i class="fas fa-trash-alt mr-2"></i> Delete Chat</a>
                                            </li>
                                        </ul>
                                        <form action="{{ route('group.create') }}" method="POST" id="creategroups">
                                            @csrf
                                            <input type="hidden" id="groupUserId" name="contact">
                                            <div class="form-group">
                                                <label>wähle die Gruppe</label>
                                                <select class="form-control" name="group" id="group">
                                                    <option value=""> </option>
                                                    @foreach($groups as $group)
                                                        <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                                    @endforeach    
                                                <select>
                                                <span class="text-danger error-text group_error"></span>
                                            </div>
                                            <div class="form-row profile_form mt-3 mb-1">
                                                <button type="submit" class="btn btn-block newgroup_create mb-0">
                                                    Schaffen
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right sidebar -->

        </div> 
        <!-- /Content -->
		
    </div>
    <!-- /Main Wrapper -->
	
	<!-- jQuery -->
    <script src="{{asset("/js/jquery-3.4.1.min.js")}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
	
	<!-- Bootstrap Core JS -->
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
	
	<!-- Custom Scroll JS -->
    <script src="{{asset('/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('/plugins/mcustomscroll/jquery.mCustomScrollbar.js')}}"></script>

    <script src="{{asset('/js/custom.js')}}"></script>

    <script src="{{asset('/js/images.js')}}"></script>

    <script src="{{asset('/js/chatgroup.js')}}"></script>
	
	<!-- Custom JS -->
    <script src="{{asset('/js/script.js')}}"></script>
   
 
</body>

</html>