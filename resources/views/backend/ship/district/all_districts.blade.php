@extends('index.dashboard')

@section('index')




<div class="page-content">

    <!--breadcrumb-->

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="breadcrumb-title pe-3">All Districts </div>

        <div class="ps-3">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb mb-0 p-0">

                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>

                    </li>

                    <li class="breadcrumb-item active" aria-current="page">All Districts</li>

                </ol>

            </nav>

        </div>

        <div class="ms-auto">

            <div class="btn-group">

                <a href="{{ route('add.district') }}" class="btn btn-primary">Add Town</a>

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

                            <th>Province Name </th>

                            <th>Town Name </th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($districts as $key => $item)

                        <tr>

                            <td> {{ $key+1 }} </td>

                            <td> {{ $item['division']['division_name'] }}</td>

                            <td> {{ $item->district_name }}</td>

                            <td>

                               <!-- Edit Button -->
                               <form action="{{ route('edit.district') }}" method="post" style="display:inline;">
                                    @csrf
                                    <input type="text" hidden name="id" value="{{ $item->id }}" />
                                    <button type="submit" class="btn btn-info">Edit</button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('remove.district') }}" id="deleteForm-{{ $item->id }}" method="post" style="display:inline;">
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

                            <th>Province Name </th>

                            <th>Town Name </th>

                            <th>Action</th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>










</div>













@endsection