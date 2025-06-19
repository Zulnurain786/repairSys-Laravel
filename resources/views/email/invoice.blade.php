<html>
    <body>
        @if($repair)
            @php 
                $dateTime = new DateTime($repair->created_at);
                $readableDate = $dateTime->format('F d, Y');
            @endphp
            <div class="invoice" style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);{{$repair->status=='Completed' || $repair->status=='Paid' || $repair->status=='Collected' ? 'border-top: solid 10px green;' : 'border-top: solid 10px #233e8c;'}}">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align:left;">
                                <img style="max-width: 150px;" src="{{$repair->company->profile}}" alt="company logo">
                            </th>
                            <th style="text-align:right;font-weight:400;">{{$readableDate}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height:35px;"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                                <p style="font-size:14px;margin:0 0 6px 0;">
                                <span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span>
                                <b style="{{$repair->status=='Completed' || $repair->status=='Paid' || $repair->status=='Collected' ? 'color:green;' : 'color:#ff9400;'}} font-weight:normal;margin:0">{{$repair->status}}</b>
                                </p>
                                <p style="font-size:14px;margin:0 0 6px 0;">
                                    <span style="font-weight:bold;display:inline-block;min-width:146px">Repair ID</span> {{$repair->token}}
                                </p>
                                <p style="font-size:14px;margin:0 0 0 0;">
                                <span style="font-weight:bold;display:inline-block;min-width:146px">Total amount</span> {{$repair->status=='Completed' || $repair->status=='Paid' || $repair->status=='Collected' ? '£'.$repair->getTotalPrice() + ($repair->hours * $repair->hour_rate) : 'Price is not confirmed till marked as completed'}}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="height:35px;"></td>
                        </tr>
                        <tr>
                            <td style="width:50%;padding:20px;vertical-align:top">
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px">Name</span> {{$repair->name}}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$repair->email}}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$repair->phone}}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Prior work </span> {!! $repair->prior_work !!}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Accessories </span> {!! $repair->accessories !!}
                                </p>
                            </td>
                            <td style="width:50%;padding:20px;vertical-align:top">
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Brand</span> {{$repair->brand}}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Colour</span> {{$repair->color}}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Type </span> {{$repair->type}}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Work requested </span> {!! $repair->work_requested !!}
                                </p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                    <span style="display:block;font-weight:bold;font-size:13px;">Warranty </span> {{$repair->warranty ? 'Yes' : 'No'}}
                                </p>
                            </td>
                        </tr>
                        @if($repair->note)
                            <tr>
                                <td colspan="2" style="padding:0px 20px">
                                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                        <span style="display:block;font-weight:bold;font-size:13px;">Notes </span> {!! $repair->note !!}
                                    </p>
                                </td>
                            </tr>
                        @endif
                        @if($repair->technician_notes)
                            <tr>
                                <td colspan="2" style="padding:0px 20px">
                                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                        <span style="display:block;font-weight:bold;font-size:13px;">Technician Notes </span> {!! $repair->technician_notes !!}
                                    </p>
                                </td>
                            </tr>
                        @endif
                        @if(count($repair->materials) > 0)
                            <tr>
                                <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Materials</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:15px;">
                                    @foreach($repair->materials as $r)
                                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                                        <span style="display:block;font-size:13px;font-weight:normal;">{{$r->name}} {{$r->qty}}</span> £{{$r->price}} <b style="font-size:12px;font-weight:300;"> (Per unit £{{$r->price/$r->qty}})</b>
                                    </p>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if($repair->hours)
                            <tr>
                                <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Labour Cost</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:15px;">
                                    <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                                        <span style="display:block;font-size:13px;font-weight:normal;"></span> Total Hours : {{$repair->hours}} H <b style="font-size:12px;font-weight:300;float:right"> (Cost per hour : <strong>£{{$repair->hour_rate}}</strong>)</b>
                                    </p>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                                <strong style="display:block;margin:0 0 10px 0;"><a href="{{url('home?invoice='.$repair->token)}}">View on website</a></strong> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </body>
</html>