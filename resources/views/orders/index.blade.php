@extends('layouts.master')

@section('title')
    List Orders
@endsection

@section('content')

<div class="card">
        <div class="card-header">
        <form action="{{ route("orders.index") }}" class="d-sm-inline-block form-inline">
            <div class="form-group">
              <input type="text" class="form-control mr-1" placeholder="Filter email..." name="buyer_email" value="{{ Request::get("buyer_email") }}">
              <select name="status" id="status" class="form-control mr-1">
                    <option value="">All</option>
                    <option {{Request::get('status') == "SUBMIT" ? "selected" : ""}} value="SUBMIT">SUBMIT</option>
                    <option {{Request::get('status') == "PROCESS" ? "selected" : ""}} value="PROCESS">PROCESS</option>
                    <option {{Request::get('status') == "FINISH" ? "selected" : ""}} value="FINISH">FINISH</option>
                    <option {{Request::get('status') == "CANCEL" ? "selected" : ""}} value="CANCEL">CANCEL</option>
              </select>
              <button type="submit" class="btn btn-primary">Filter Order</button>
            </div>
          </form>
    </div>
    <div class="card-body">
        @if (session("status"))
            <div class="alert alert-success">
                {{ session("status") }}
            </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Inovice Number</th>
                    <th>Status</th>
                    <th>Buyer</th>
                    <th>Total Quantity</th>
                    <th>Order Data</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->invoice_number }}</td>
                        <td>
                            @if ($order->status == "SUBMIT")
                                <span class="badge badge-primary text-light">{{ $order->status }}</span>
                            @elseif($order->status == "PROCESS")
                                <span class="badge badge-warning text-light">{{ $order->status }}</span>
                            @elseif($order->status == "FINISH")
                                <span class="badge badge-success text-light">{{ $order->status }}</span>
                            @elseif($order->status == "CANCEL")
                                <span class="badge badge-danger text-light">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $order->user->name }}
                            <br>
                            <small>{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->totalQuantity }} pc (s)</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>
                            <a href="{{ route("orders.edit", [$order->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="pagination mt-3">
    {{$orders->appends(Request::all())->links()}}
</div>

@endsection
