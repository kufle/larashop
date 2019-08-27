@extends("layouts.global")

@section('title')| List Orders @endsection
@section('pageTitle')List Order @endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <div class="float-right">
                    <form action="{{route('orders.index')}}">
                        @csrf
                        <div class="input-group">
                        <select name="status" class="form-control mr-2">
                            <option value="">ANY</option>
                            <option value="SUBMIT">SUBMIT</option>
                            <option value="PROCESS">PROCESS</option>
                            <option value="FINISH">FINISH</option>
                            <option value="CANCEL">CANCEL</option>
                        </select>
                        <input type="text" name="buyer_email" value="{{Request::get('buyer_email')}}" class="form-control" placeholder="Search by Buyer Email">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="clearfix mb-3"></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th><b>Status</b></th>
                            <th><b>Buyer</b></th>
                            <th><b>Total Quantity</b></th>
                            <th><b>Order date</b></th>
                            <th><b>Total Price</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->invoice_number}}</td>
                            <td>@if($order->status=="SUBMIT")
                                <span class="badge bg-warning text-light">{{$order->status}}</span>
                                @elseif($order->status == "PROCESS")
                                <span class="badge bg-info text-light">{{$order->status}}</span>
                                @elseif($order->status == "FINISH")
                                <span class="badge bg-success text-light">{{$order->status}}</span>
                                @elseif($order->status == "CANCEL")
                                <span class="badge bg-dark text-light">{{$order->status}}</span>
                                @endif
                            </td>
                            <td>
                                {{$order->user->name}} <br>
                                <small>{{$order->user->email}}</small>
                            </td>
                            <td>{{$order->totalQuantity}} pc(s)</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route('orders.edit',['id'=> $order->id])}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="table-responsive">
            </div>
        </div>
    </div>
</div>
@endsection