 @extends('layouts.master')
    @section('content')
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="page-content">
                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                {!! Form::open(['method'=>'GET', 'url'=>'individual','class'=>'form-horizontal']) !!}
                                    <div class="row">
                                        <div class="col-md-11 item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                {!! Form::select('client_id', $clients, $client_id,['class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'placeholder'=>'Select client...']);!!}
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                {!! Form::text('range', $input_fm.'-'.$input_tm, [ 'id'=>'range', 'class'=>'form-control col-md-7 col-xs-12', 'required'=>'required', 'readonly'=>'readonly', 'placeholder'=>'From...']);!!}
                                            </div>
                                        </div>
                                        <div class="col-md-1 packages-buttons">
                                            <button id="send" type="submit" class="btn btn-success btn-sm package-btn pull-right">Filter</button>
                                        </div>
                                    </div>
                                {!! Form::close()!!}
                                <table id="billingall" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                    <tr class="headings">
                                        <th>
                                            <input type="checkbox" class="tableflat">
                                        </th>
                                        <th>ID </th>
                                        <th>Client Details </th>
                                        <th>Month </th>
                                        <th>Amount </th>
                                        <th>Cumulative </th>
                                        <th>Paid</th>
                                        <th>Total</th>
                                        <th>Due </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($billings as $billing)
                                            @if ($billing->id % 2 == 0)
                                                <tr class="even pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="tableflat">
                                                    </td>
                                                    <td class=" ">{{sprintf("%'.05d\n", $billing->id)}}</td>
                                                    <td class=" ">
                                                        {{$billing->clientDetails->name}}
                                                        <span class="client-details">Client ID: {{$billing->clientDetails->client_id}}</span>
                                                    </td>
                                                    <td class=" ">{{date('F Y', strtotime($billing->month))}}</td>
                                                    <td class=" ">{{$billing->bill_amount}} &#2547;</td>
                                                    <td class=" ">
                                                    {{
                                                        $bill_cum = DB::table('billings')
                                                        ->where('client_id', '=', $billing->client_id)
                                                        ->where('id', '<=', $billing->id)
                                                        ->sum('bill_amount')
                                                    }}
                                                    &#2547;
                                                    </td>
                                                    <td class=" ">
                                                    {{
                                                        DB::table('payments')
                                                        ->where('client_id', '=', $billing->client_id)
                                                        ->where('billing_id', '=', $billing->id)
                                                        ->sum('paid_amount')
                                                    }}
                                                    &#2547;
                                                    </td>
                                                    <td class=" ">
                                                    {{
                                                        $paid_cum = DB::table('payments')
                                                        ->where('client_id', '=', $billing->client_id)
                                                        ->where('billing_id', '<=', $billing->id)
                                                        ->sum('paid_amount')
                                                    }}
                                                    &#2547;
                                                    </td>
                                                    <td class=" ">
                                                    {{ $bill_cum - $paid_cum }}
                                                    &#2547;
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="odd pointer">
                                                    <td class="a-center ">
                                                        <input type="checkbox" class="tableflat">
                                                    </td>
                                                    <td class=" ">{{sprintf("%'.05d\n", $billing->id)}}</td>
                                                    <td class=" ">
                                                        {{$billing->clientDetails->name}}
                                                        <span class="client-details">Client ID: {{$billing->clientDetails->client_id}}</span>
                                                    </td>
                                                    <td class=" ">{{date('F Y', strtotime($billing->month))}}</td>
                                                    <td class=" ">{{$billing->bill_amount}} &#2547;</td>
                                                    <td class=" ">
                                                    {{
                                                        $bill_cum = DB::table('billings')
                                                        ->where('client_id', '=', $billing->client_id)
                                                        ->where('id', '<=', $billing->id)
                                                        ->sum('bill_amount')
                                                    }}
                                                    &#2547;
                                                    </td>
                                                    <td class=" ">
                                                    {{
                                                        DB::table('payments')
                                                        ->where('client_id', '=', $billing->client_id)
                                                        ->where('billing_id', '=', $billing->id)
                                                        ->sum('paid_amount')
                                                    }}
                                                    &#2547;
                                                    </td>
                                                    <td class=" ">
                                                    {{
                                                        $paid_cum = DB::table('payments')
                                                        ->where('client_id', '=', $billing->client_id)
                                                        ->where('billing_id', '<=', $billing->id)
                                                        ->sum('paid_amount')
                                                    }}
                                                    &#2547;
                                                    </td>
                                                    <td class=" ">
                                                    {{ $bill_cum - $paid_cum }}
                                                    &#2547;
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $billings->render() !!}
                            </div>
                        </div>
                    </div>

                    <br />
                    <br />
                    <br />

                </div>
            </div>
            <!-- footer content -->
            <footer>
                <div class="">
                    <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                        <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
                    </p>
                </div>
                <div class="clearfix"></div>
                <script type="text/javascript" charset="utf-8" async defer>
                    jQuery(document).ready(function($) {
                        var oTable = $('#billingall').DataTable({
                            "oLanguage": {
                                "sSearch": "Search all columns:"
                            },
                            "aoColumnDefs": [
                                {
                                    'bSortable': false,
                                    'aTargets': [0, 1, 2, 3, 4, 5, 6, 7, 8]
                                }, //disables sorting for column one
                                {
                                    'sWidth': '10%',
                                    'aTargets': [7]
                                },

                            ],
                            "bPaginate": false,
                            // 'iDisplayLength': 12,
                            // "sPaginationType": "full_numbers"
                        });
                    });
                    $(function() {
                        $('#range').daterangepicker({
                            opens:'left',
                            format:'MMMM D, YY'
                        });
                    });
                </script>
            </footer>
            <!-- /footer content -->

        </div>
        <!-- /page content -->
    @endsection