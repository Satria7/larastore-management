@extends('layouts.master')

@section('title')
    Edit Order Status
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("orders.update", [$order->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="text" class="form-control" name="invoice_number" id="invoice_number" disabled value="{{ $order->invoice_number }}">
                        </div>
                        <div class="form-group">
                            <label for="buyer">Buyer</label>
                            <input type="text" class="form-control" name="buyer" id="buyer" disabled value="{{ $order->user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="created_at">Order Date</label>
                            <input type="text" class="form-control" name="order_date" id="orer_date" disabled value="{{ $order->created_at }}">
                        </div>
                        <div class="form-group">
                            <label for="">Books {{ $order->totalQuantity }}</label>
                            <ul>
                                @foreach ($order->books as $book)
                                <li>{{ $book->title }} <b>({{ $order->totalQuantity }})</b></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="price">Total Price</label>
                            <input type="text" class="form-control" name="price" id="price" disabled value="{{ $order->total_price }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status Order</label>
                            <select name="status" id="status" class="form-control">
                                <option {{$order->status == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                                <option {{$order->status == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                                <option {{$order->status == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                                <option {{$order->status == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
                            </select>
                        </div>
                        <hr>
                        <div class="form-action">
                            <button type="submit" class="btn btn-primary">Update Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
