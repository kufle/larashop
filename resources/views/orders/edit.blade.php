@extends("layouts.global")

@section('title')| Edit Order @endsection

@section('pageTitle')Edit Order @endsection

@section('content')
@if(session('status'))
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>x</span>
        </button>
        {{session('status')}}
    </div>
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
            <form action="{{route('orders.update',['id'=>$order->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" class="form-control" value="{{$order->invoice_number}}" disabled>
                </div>

                <div class="form-group">
                    <label for="buyer">Buyer</label>
                    <input type="text" class="form-control" value="{{$order->user->name}}" disabled>
                </div>

                <div class="form-group">
                    <label for="order_date">Order Date</label>
                    <input type="text" class="form-control" value="{{$order->created_at}}" disabled>
                </div>

                <div class="form-group">
                    <label for="books">Books ({{$order->totalQuantity}})</label>
                    <ul>
                    @foreach($order->books as $book)
                        <li>{{$book->title}} <b>({{$book->pivot->quantity}})</b></li>
                    @endforeach
                    </ul>                    
                </div>

                <div class="form-group">
                    <label for="order_date">Total Price</label>
                    <input type="text" class="form-control" value="{{$order->total_price}}" disabled>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option {{$order->status=='SUBMIT' ? 'selected' : '' }} value="SUBMIT">SUBMIT</option>
                        <option {{$order->status=='PROCESS' ? 'selected' : '' }} value="PROCESS">PROCESS</option>
                        <option {{$order->status=='FINISH' ? 'selected' : '' }} value="FINISH">FINISH</option>
                        <option {{$order->status=='CANCEL' ? 'selected' : '' }} value="CANCEL">CANCEL</option>
                    </select>
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection