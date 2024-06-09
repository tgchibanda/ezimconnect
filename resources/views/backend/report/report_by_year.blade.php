@extends('index.dashboard')
@section('index')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Orders By Year Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Orders By Year Report</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h3> Seach By Year : {{ $year }}</h3>
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Date </th>
                            <th>Invoice </th>
                            <th>Amount </th>
                            <th>Payment </th>
                            <th>State </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $item)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->order_date }}</td>
                            <td>{{ $item->invoice_no }}</td>
                            <td>${{ $item->amount }}</td>
                            <td>{{ $item->payment_method }}</td>
                            <td> <span class="badge rounded-pill bg-success"> {{ $item->status }}</span></td>

                            <td>
                                <!-- View Button -->
                                <form action="{{ route('admin.order.details') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-info"><i class="fa fa-eye"></i></button>
                                </form>

                                
                                <!-- Download Button -->
                                <form action="{{ route('admin.invoice.download') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-danger" title="Invoice Pdf"><i class="fa fa-download"></i> </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Date </th>
                            <th>Invoice </th>
                            <th>Amount </th>
                            <th>Payment </th>
                            <th>State </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>




@endsection