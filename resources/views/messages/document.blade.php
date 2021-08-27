@foreach ($conversation[0]['messages'] as $line)
<!-- offer document -->
<div id="offer{{$line->id}}" class="modal fade offerModal" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rechnung</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" value="{{auth()->user()->id}}" name="user_id" id="user_id">
                <input class="fa fa-cloud-upload fa-2x" type="hidden" id="cnv1" name="conversation_id" value="">
                <input class="fa fa-cloud-upload fa-2x" type="hidden" id="susr1" name="second_user_id" value=""> --}}
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
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:none"></td>
                                            <td style="border:none"></td>
                                            <td style="border:none"></td>
                                            <td style="border:none" align="right"> Total</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>    <!-- container -->
                </div> 
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- /offer document -->