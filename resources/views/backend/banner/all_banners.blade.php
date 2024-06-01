@extends('index.dashboard')
@section('index')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Banners</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Banners</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.banner') }}" class="btn btn-primary">Add Banner</a>
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
                            <th>Banner Title </th>
                            <th>Banner Url </th>
                            <th>Banner Image </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $key => $item)
                        <tr>
                            <td> {{ $key+1 }} </td>
                            <td>{{ $item->banner_title }}</td>
                            <td>{{ $item->banner_url }}</td>
                            <td> <img src="{{ !empty($item->banner_image) ? asset($item->banner_image) : asset('upload/no_banner.jpg') }}" style="width: 70px; height:40px;"> </td>

                            <td>
                                <!-- Edit Button -->
                                <form action="{{ route('edit.banner') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-info">Edit</button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('remove.banner') }}" id="deleteForm-{{ $item->id }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button data-id="{{ $item->id }}" type="submit" class="btn btn-danger deleteButton">Delete</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Banner Title </th>
                            <th>Banner Url </th>
                            <th>Banner Image </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



</div>




@endsection