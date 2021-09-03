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


            <!-- METRICA css -->
            <link href="{{asset('metrica/css/bootstrap.min.css" rel="stylesheet" type="text/css')}}" />
            <link href="{{asset('metrica/css/jquery-ui.min.css" rel="stylesheet')}}">
            <link href="{{asset('metrica/css/icons.min.css" rel="stylesheet" type="text/css')}}" />
            <link href="{{asset('metrica/css/metisMenu.min.css" rel="stylesheet" type="text/css')}}" />
            <link href="{{asset('metrica/css/app.css" rel="stylesheet" type="text/css')}}" />
            {{-- end metrica --}}
	
    <!-- App styles -->
    <link rel="stylesheet" href="{{asset('css/appold.css')}}">
	
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
                                        <a href="{{route('logout')}}"  class="dropdown-item">Ausloggen</a>
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
                    
                            <button class="btn" type="button" data-toggle="modal" data-target="#drag_files">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            <button class="btn send-btn" type="button" data-toggle="modal" data-target="#offer_form" id="target">
                                <i class="fas fa-file"></i>
                            </button>
                            &nbsp;&nbsp;
                            <button class="btn send-btn" type="button">
                                <i class="fab fa-telegram-plane"></i>
                            </button>
                        
                    </div>
                </div>
            </div>
            <!-- /Chat -->

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
    @include('modals')
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

    <script src="{{asset('/js/accounting.js')}}"></script>

    <script src="{{asset('/js/offerform.js')}}"></script>

            {{-- METRICA --}}
            <script src="{{asset('metrica/js/jquery.min.js')}}"></script>
            <script src="{{asset('metrica/js/jquery-ui.min.js')}}"></script>
            <script src="{{asset('metrica/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('metrica/js/metismenu.min.js')}}"></script>
            <script src="{{asset('metrica/js/waves.js')}}"></script>
            <script src="{{asset('metrica/js/feather.min.js')}}"></script>
            <script src="{{asset('metrica/js/jquery.slimscroll.min.js')}}"></script>
            <script src="{{asset('metrica/js/plugins/apexcharts/apexcharts.min.js')}}"></script> 
            
            <!-- App js -->
            <script src="{{asset('metrica/js/app.js')}}"></script>
            {{-- endmetrica --}}
	
	<!-- Custom JS -->
    <script src="{{asset('/js/script.js')}}"></script>
   
 
</body>

</html>