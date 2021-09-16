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
                    Neuer Chat
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
                        <label>Benutzer auswählen</label>
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
                            Chat starten
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

<!-- formular -->
@foreach($conversations as $line)
<div id="offer_form{{$line['id']}}" class="modal fade offerModal angebot" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Angebot erstellen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <form method="POST" action="/sendOffer" id="offerForm" >
                            {{ csrf_field() }}
                            <input type="hidden" value="{{auth()->user()->id}}" name="user_id" id="user_id">
                            <input class="fa fa-cloud-upload fa-2x" type="hidden" id="cnv1" name="conversation_id" value="">
                            <input class="fa fa-cloud-upload fa-2x" type="hidden" id="susr1" name="second_user_id" value="">
                            <div class="card">
                                <div class="card-body invoice-head">
                                    <div class="row">
                                        <div class="col-md-4 align-self-center">
                                            <img src="{{('images/logo.png')}}" alt="logo-small" class="logo-sm mr-2" height="35">
                                            <p class="mt-2 mb-0 text-muted">Wenn die Rechnung nicht innerhalb von 7 Tagen bezahlt wird, werden die Kreditdaten als Bestätigung geliefert.</p>
                                        </div><!--end col-->
                                        <div class="col-md-8">

                                            <ul class="list-inline mb-0 contact-detail float-right">
                                                <li class="list-inline-item">
                                                    <div class="pl-3">
                                                        <i class="mdi mdi-web"></i>
                                                        <p class="text-muted mb-0">www.atev.de</p>
                                                        <!--<p class="text-muted mb-0">www.qrstuvwxyz.com</p>->>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="pl-3">
                                                        <i class="mdi mdi-phone"></i>
                                                        <p class="text-muted mb-0">+49 7141 899340</p>
                                                        <!--<p class="text-muted mb-0">+123 123456789</p>-->
                                                    </div>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="pl-3">
                                                        <i class="mdi mdi-map-marker"></i>
                                                        <p class="text-muted mb-0">Monreposstraße 57</p>
                                                        <p class="text-muted mb-0">71634 Ludwigsburg, Deutschland</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="">
                                                <h6 class="mb-0"><b>Bestelldatum:</b> {{ \Carbon\Carbon::now()->format('d/m/Y')}}</h6>
                                                <h6><b>Bestell Nr.:</b> # 23654789</h6>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-3">
                                            <div class="float-left">
                                                <address class="font-13">
                                                    <strong class="font-14">Rechnungsadresse:</strong><br>
                                                        {{$line['user']->name}}<br>
                                                        {{$line['user']->street}}<br>
                                                        {{$line['user']->city}}<br>
                                                        <abbr title="Phone">Tel: {{$line['user']->phoneNumber}}</abbr>
                                                </address>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-md-3">
                                            <div class="">
                                                <address class="font-13">
                                                    <strong class="font-14">Lieferadresse:</strong><br>
                                                    {{$line['user']->name}}<br>
                                                    {{$line['user']->street}}<br>
                                                    {{$line['user']->city}}<br>
                                                    <abbr title="Phone">Tel: {{$line['user']->phoneNumber}}</abbr>
                                                </address>
                                            </div>
                                        </div> <!--end col-->
                                    </div><!--end row-->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive project-invoice">
                                                <table class="table table-bordered mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Artikel Nr.</th>
                                                            <th>Name</th>
                                                            <th>Stk.</th>
                                                            <th>Preis</th>
                                                            <th>Gesamt</th>
                                                            <th style="text-align:center;background:#eee"><a href="#" class="addRow" id="addRow"><i class="fas fa-plus"></i></a></th>
                                                        </tr><!--end tr-->
                                                    </thead>
                                                    <tbody id="dynamic_field">
                                                        <tr>
                                                            <td><input type="text" name="items[0][article]"  class="form-control desc"></td>
                                                            <td><input type="text" name="items[0][name]"  class="form-control desc"></td>
                                                            <td><input type="text" name="items[0][amount]"  class="form-control amount" > </td>
                                                            <td><input type="text" name="items[0][price]" class="form-control input-sm price"> </td>
                                                            <td><input type="text" class="form-control input-sm totalRow" name="items[0][total]" id="total" readonly>
                                                                <input type="hidden" class="totalFlat" name="items[0][totalFlat]" id="totalFlat"></td>
                                                            <td></td>
                                                        </tr><!--end tr-->
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="border-0"></td>
                                                            <td colspan="2" class="border-0"></td>
                                                            <td class="border-0 font-14 text-dark"><b>Zwischensumme</b></td>
                                                            <td class="border-0 font-14 text-dark"><b><output class="total" name="result" readonly id="result"></b></td>
                                                        </tr><!--end tr-->
                                                        <tr>
                                                            <th class="border-0"></th>
                                                            <th colspan="2" class="border-0"></th>
                                                            <td class="border-0 font-14 text-dark"><b>MwSt.</b></td>
                                                            <td class="border-0 font-14 text-dark"><b>€0.00%</b></td>
                                                        </tr><!--end tr-->
                                                        <tr class="bg-black">
                                                            <th class="border-0"></th>
                                                            <th colspan="2" class="border-0"></th>
                                                            <td class="border-0 font-14"><b>Gesamtsumme</b></td>
                                                            <td class="border-0 font-14"><b><output class="total" name="result" readonly id="result2"></b></td>
                                                        </tr><!--end tr-->
                                                    </tfoot>
                                                </table><!--end table-->
                                            </div>  <!--end /div-->
                                        </div>  <!--end col-->
                                         <div class="col-lg-6">
                                                                                    <table class="table table-bordered">
                                                                                        <thead>
                                                                                            <th>Liefer &amp; Zahlungsbedingungen</th>
                                                                                            <th style="text-align:center;background:#eee"><a href="#" class="addRowTerms" id="addRowTerms"><i class="fas fa-plus"></i></a></th>
                                                                                        </thead>
                                                                                        <tbody id="terms_field">
                                                                                            <tr>
                                                                                                <td style="width: 96.5%"><input type="text" name="terms[0][body]"  class="form-control body"> </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div> <!--end col-->
                                    </div><!--end row-->

                                    <div class="row justify-content-center">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-12 col-xl-12 ml-auto align-self-center">
                                            <div class="text-center"><small class="font-12">Vielen Dank, für Ihr Vertrauen!</small></div>
                                        </div><!--end col-->
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="float-right d-print-none">
                                                <a href="javascript:window.print()" class="btn btn-gradient-info"><i class="fa fa-print"></i></a>
                                                <a href="#" style="background-color: darkred" class="btn btn-block newgroup_create mb-0">Abbrechen</a>
                                                <button type="submit" class="btn btn-block newgroup_create mb-0">Bestätigen</button>

                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </form>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- /formular -->

@foreach($conversations as $line)
<div id="send_pdf{{$line['id']}}" class="modal fade offerModal" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Fill out the form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@endforeach
