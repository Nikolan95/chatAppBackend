<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATEV</title>
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
    <link href="{{asset('metrica/css/bootstrap.min.css" rel="stylesheet" type="text/css')}}"/>
    <link href="{{asset('metrica/css/jquery-ui.min.css" rel="stylesheet')}}">
    <link href="{{asset('metrica/css/icons.min.css" rel="stylesheet" type="text/css')}}"/>
    <link href="{{asset('metrica/css/metisMenu.min.css" rel="stylesheet" type="text/css')}}"/>
    <link href="{{asset('metrica/css/app.css" rel="stylesheet" type="text/css')}}"/>

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
                                <img src="{{asset('images/logo-atev-white.png')}}" class="header_image img-fluid"
                                     alt="">
                            </a>
                        </div>
                        <ul class="header-action mt-4">
                            <li>
                                <a href="#" data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h ellipse_header"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right header_drop_icon">
                                    <!-- Account Management -->
                                    <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                                               :active="request()->routeIs('profile.show')"
                                                               class="dropdown-item">
                                        {{ __('Profil') }}
                                    </x-jet-responsive-nav-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                                                   onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="dropdown-item">
                                            {{ __('Ausloggen') }}
                                        </x-jet-responsive-nav-link>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav nav-tabs chat-tabs mt-4">
                        <li class="nav-item">
                            <a class="nav-link active" id="plaudern">Kunden</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="promotion">Promotion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gruppe">Gruppen</a>
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
                </div>
            </div>
            <!-- / Chats sidebar -->
        </div>
        <!-- /Sidebar group -->

        <!-- Chat -->
        <div class="chat" id="middle">
            <div class="hiddenchatheader">
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
                            <img src="{{asset('/images/avatar-2.jpg')}}" class="rounded-circle chatImg" alt="image"
                                style="display: none;">
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
                            <!--<li class="list-inline-item">
                                <a class="btn btn-outline-light" href="#" data-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item dream_profile_menu">Profile</a>
                                    <a href="#" class="dropdown-item">Delete</a>
                                </div>
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chat-body">
            </div>
            <div class="hidechatfooter">
                <div class="chat-footer">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div style="display: flex">
                        <input type="text" class="form-control chat_form input" placeholder="Nachricht verfassen ..." name="body"
                            id="body" class="submit"/>

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
        </div>
        <!-- /Chat -->

        <!-- Right sidebar -->
        <div class="hidesidebar">
            <div class="right-sidebar right_sidebar_profile" id="middle1">
                <div class="right-sidebar-wrap active">
                    <div style="margin-top: 40px !important" class="contact-close_call mr-4 mt-4 text-right">
                        <!--<a href="#"
                        class="btn btn-outline-light close_profile close_profile4">
                            <i class="fas fa-times close_icon"></i>
                        </a>-->
                    </div>
                    <div class="sidebar-body">
                        <div class="pl-4 pr-4 mt-0 right_sidebar_logo">
                            <div class="text-center mb-3">
                                <figure class="avatar avatar-xl mb-3">
                                    <img src="{{asset('images/profile.png')}}" class="rounded-circle" alt="image">
                                </figure>
                                <div class="sidebarprofilename">

                                </div>
                            </div>
                            <div>

                                <div class="accordion-col">
                                    <div class="accordion-title">
                                        <h6 class="primary-title">Medien <i
                                                class="fas fa-chevron-right float-right"></i></h6>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="sidebarmedia">

                                        </div>
                                    </div>
                                    <div class="accordion-title">
                                        <h6 class="primary-title">Kunde<i
                                                class="fas fa-chevron-right float-right"></i></h6>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="mt-2 text-left">
                                            <div class="sidebarkundedata">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-title">
                                        <h6 class="primary-title">Fahrzeuginformationen<i
                                                class="fas fa-chevron-right float-right"></i></h6>
                                    </div>
                                    <div class="accordion-content">
                                        <div class="mt-2 text-left">
                                            <div class="sidebarcardata">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-title">
                                        <h6 class="primary-title">Einstellungen <i class="fas fa-chevron-right float-right"></i>
                                        </h6>
                                    </div>
                                    <div class="accordion-content">
                                        <ul class="contact-action">
                                            <li class="block-user mt-1">
                                                <a href=""><i class="fas fa-ban mr-2 text-muted"></i>Kunden blockieren</a>
                                            </li>
                                            <li class="archieve-chat">
                                                <a href=""><i class="fas fa-archive mr-2"></i>Chat archivieren</a>
                                            </li>
                                            <li class="delete-chat">
                                                <a href=""><i class="fas fa-trash-alt mr-2"></i>Chat l??schen</a>
                                            </li>
                                        </ul>
                                        <br>
                                        <form action="{{ route('group.create') }}" method="POST" id="creategroups">
                                            @csrf
                                            <input type="hidden" id="groupUserId" name="contact">
                                            <div class="form-group">
                                                <label>Kunden zu Gruppe hinzuf??gen</label>
                                                <select class="form-control" name="group" id="group">
                                                    <option value=""></option>
                                                    @foreach($groups as $group)
                                                    <option value="{{ $group->id }}"> {{ $group->name }}</option>
                                                    @endforeach
                                                    <select>
                                                        <span class="text-danger error-text group_error"></span>
                                            </div>
                                            <div class="form-row profile_form mt-3 mb-1">
                                                <button type="submit" class="btn btn-block newgroup_create mb-0">
                                                    Hinzuf??gen
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
        </div>
        <!-- Right sidebar -->

    </div>
    <!-- /Content -->

</div>
@include('modals')

<!-- jQuery -->
<script src="{{asset('/js/jquery-3.4.1.min.js')}}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('/js/popper.min.js')}}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>

<!-- Custom Scroll JS -->
<script src="{{asset('/js/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('/plugins/mcustomscroll/jquery.mCustomScrollbar.js')}}"></script>

<script src="{{asset('/js/custom.js')}}"></script>

<script src="{{asset('/js/images.js')}}"></script>

<script src="{{asset('/js/accounting.js')}}"></script>

<script src="{{asset('/js/offerform.js')}}"></script>

<!-- Custom JS -->
<script src="{{asset('/js/script.js')}}"></script>

</body>

</html>
