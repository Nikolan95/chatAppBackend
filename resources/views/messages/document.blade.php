@foreach ($conversation[0]['messages'] as $line)
<!-- offer document -->
<div id="offer{{$line->id}}" class="modal fade offerModal" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rechnung</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {{-- <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-body">           				
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Article number</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody >
                                        @foreach ($line->offeritems as $item)
                                        <tr>
                                            <td>{{ $item->articleNumber }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ number_format($item->price, 2, ',', '.') }} €</td>
                                            <td>{{ number_format($item->total, 2, ',', '.') }} €</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:none"></td>
                                            <td style="border:none"></td>
                                            <td style="border:none"></td>
                                            <td style="border:none" align="right"> Total</td>
                                            <td>{{ number_format($line->offeritems->sum('total'), 2, ',', '.') }} €</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>    <!-- container -->
                </div> 
            </div> --}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body invoice-head"> 
                                <div class="row">
                                    <div class="col-md-4 align-self-center">                                                
                                        <img src="{{('images/logo.png')}}" alt="logo-small" class="logo-sm mr-2" height="35">
                                        <p class="mt-2 mb-0 text-muted">If account is not paid within 7 days the credits details supplied as confirmation.</p>                                             
                                    </div><!--end col-->    
                                    <div class="col-md-8">
                                            
                                        <ul class="list-inline mb-0 contact-detail float-right">                                                   
                                            <li class="list-inline-item">
                                                <div class="pl-3">
                                                    <i class="mdi mdi-web"></i>
                                                    <p class="text-muted mb-0">www.abcdefghijklmno.com</p>
                                                    <p class="text-muted mb-0">www.qrstuvwxyz.com</p>
                                                </div>                                                
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="pl-3">
                                                    <i class="mdi mdi-phone"></i>
                                                    <p class="text-muted mb-0">+123 123456789</p>
                                                    <p class="text-muted mb-0">+123 123456789</p>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="pl-3">
                                                    <i class="mdi mdi-map-marker"></i>
                                                    <p class="text-muted mb-0">2821 Kensington Road,</p>
                                                    <p class="text-muted mb-0">Avondale Estates, GA 30002 USA.</p>
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
                                            <h6 class="mb-0"><b>Order Date :</b> {{ \Carbon\Carbon::parse($line->created_at)->format('d/m/Y')}}</h6>
                                            <h6><b>Order ID :</b> # 23654789</h6>
                                        </div>
                                    </div><!--end col--> 
                                    <div class="col-md-3">                                            
                                        <div class="float-left">
                                            <address class="font-13">
                                                <strong class="font-14">Billed To :</strong><br>
                                                    {{ $conversation[0]['user']->name }}<br>
                                                    {{ $conversation[0]['user']->street }}<br>
                                                    {{ $conversation[0]['user']->city }}<br>
                                                    <abbr title="Phone">Tel:</abbr> {{ $conversation[0]['user']->phoneNumber }}
                                            </address>
                                        </div>
                                    </div><!--end col--> 
                                    <div class="col-md-3">
                                        <div class="">
                                            <address class="font-13">
                                                <strong class="font-14">Shipped To:</strong><br>
                                                {{$conversation[0]['user']->name}}<br>
                                                {{ $conversation[0]['user']->street }}<br>
                                                {{ $conversation[0]['user']->city }}<br>
                                                <abbr title="Phone">Tel:</abbr> {{ $conversation[0]['user']->phoneNumber }}
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
                                                        <th>Name</th>
                                                        <th>Qty</th>
                                                        <th>Price</th> 
                                                        <th>Total</th>
                                                    </tr><!--end tr-->
                                                </thead>
                                                <tbody>
                                                    @foreach ($line->offeritems as $item)
                                                    <tr>
                                                        <td>
                                                            <h5 class="mt-0 mb-1">{{ $item->name }}</h5>
                                                        </td>
                                                        <td>{{ $item->amount }}</td>
                                                        <td>{{ number_format($item->price, 2, ',', '.') }} €</td>
                                                        <td>{{ number_format($item->total, 2, ',', '.') }} €</td>
                                                    </tr><!--end tr-->        
                                                    @endforeach                                                       
                                                    <tr> 
                                                        <td colspan="2" class="border-0"></td>
                                                        <td class="border-0 font-14 text-dark"><b>Sub Total</b></td>
                                                        <td class="border-0 font-14 text-dark"><b>{{ number_format($line->offeritems->sum('total'), 2, ',', '.') }} €</b></td>
                                                    </tr><!--end tr-->
                                                    <tr>
                                                        <th colspan="2" class="border-0"></th>                                                        
                                                        <td class="border-0 font-14 text-dark"><b>Tax Rate</b></td>
                                                        <td class="border-0 font-14 text-dark"><b>$0.00%</b></td>
                                                    </tr><!--end tr-->
                                                    <tr class="bg-black">
                                                        <th colspan="2" class="border-0"></th>                                                        
                                                        <td class="border-0 font-14"><b>Total</b></td>
                                                        <td class="border-0 font-14"><b>{{ number_format($line->offeritems->sum('total'), 2, ',', '.') }} €</b></td>
                                                    </tr><!--end tr-->
                                                </tbody>
                                            </table><!--end table-->
                                        </div>  <!--end /div-->                                          
                                    </div>  <!--end col-->                                      
                                </div><!--end row-->

                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <h5 class="mt-4">Terms And Condition :</h5>
                                        <ul class="pl-3">
                                            @foreach ($line->termsandconditions as $line)
                                                <li><small class="font-12">{{ $line->body }}</small></li>
                                            @endforeach
                                        </ul>
                                    </div> <!--end col-->                                       
                                    <div class="col-lg-6 align-self-end">
                                        <div class="w-25 float-right">
                                            <small>Account Manager</small>
                                            <img src="../assets/images/signature.png" alt="" class="" height="48">
                                            <p class="border-top">Signature</p>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                        <div class="text-center"><small class="font-12">Thank you very much for doing business with us.</small></div>
                                    </div><!--end col-->
                                    <div class="col-lg-12 col-xl-4">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-gradient-info"><i class="fa fa-print"></i></a>
                                            <a href="#" class="btn btn-gradient-primary">Submit</a>
                                            <a href="#" class="btn btn-gradient-danger">Cancel</a>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- /offer document -->