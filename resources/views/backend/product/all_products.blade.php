@extends('index.dashboard')
@section('index')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Products <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.product') }}" class="btn btn-primary">Add Products</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>Price </th>
                            <th>QTY </th>
                            <th>Discount </th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $item)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td> <img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height:40px;"> </td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->selling_price }}</td>
                            <td>{{ $item->product_qty }}</td>
                            <td>
                                @if($item->discount_price == NULL)
                                <span class="badge rounded-pill bg-info">No Discount</span>
                                @else
                                @php
                                $amount = $item->selling_price - $item->discount_price;
                                $discount = ($amount/$item->selling_price) * 100;
                                @endphp
                                <span class="badge rounded-pill bg-danger"> {{ round($discount) }}%</span>
                                @endif
                            </td>



                            <td> @if($item->status == 1)
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">InActive</span>
                                @endif
                            </td>

                            <td>
                                <!-- Edit Button -->
                                <form action="{{ route('edit.product') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-info" title="Edit Data">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('remove.product') }}" id="deleteForm-{{ $item->id }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button data-id="{{ $item->id }}" type="submit" class="btn btn-danger deleteButton" id="deleteButton" title="Delete Data"><i class="fa fa-trash"></i></button>
                                </form>


                                <!-- Details Button -->
                                <form action="{{ route('edit.category') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-warning" title="Details Product">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </form>

                               
                                <!-- Product Status -->
                                <form action="{{ route('change.product.status') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    @if($item->status == 1)
                                    <button type="submit" class="btn btn-danger" title="Inactive">
                                    De-Activate
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-success" title="Active">
                                    Activate
                                    </button>
                                    @endif
                                </form>
                               
                        
                                











                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Image </th>
                            <th>Product Name </th>
                            <th>Price </th>
                            <th>QTY </th>
                            <th>Discount </th>
                            <th>Status </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>




@endsection