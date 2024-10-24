@extends('index.dashboard')
@section('index')
@php
$titleAndFolderPath = $userData->getTitleAndFolderPath();
$folderPath = $titleAndFolderPath['folderPath'];
$title = $titleAndFolderPath['title'];
@endphp

@section('styles')
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        
        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
        .modal-lg {
            max-width: 1000px !important;
        }
    </style>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ $title }} Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }} Profile</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ !empty($userData->photo) ? asset($userData->photo) : asset('upload/no_image.jpg') }}" alt="{{ $title }}" class="p-1 bg-primary" height="100" width="200">
                                <div class="mt-3">
                                    <h4>{{ $userData->name }}</h4>
                                    <p class="text-secondary mb-1">{{ $userData->email }}</p>
                                    <p class="text-muted font-size-sm">{{ $userData->address }}</p>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                        </svg>Website</h6>
                                    <span class="text-secondary">{{ (!empty($userData->website)) ? $userData->website : 'Not available' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>Instagram</h6>
                                    <span class="text-secondary">{{ (!empty($userData->instagram)) ? $userData->instagram : 'Not available' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                        </svg>Facebook</h6>
                                    <span class="text-secondary">{{ (!empty($userData->facebook)) ? $userData->facebook : 'Not available' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <form method="post" action="{{ route('index.profile.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Shop Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control" value="{{ $userData->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">UserName</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input disabled type="text" class="form-control" value="{{ $userData->username }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        @if($title == 'Shop')
                                        <h6 class="mb-0">Shop Email</h6>
                                        @else
                                        <h6 class="mb-0">Name</h6>
                                        @endif
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control" value="{{ $userData->email }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control" value="{{ $userData->phone }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="mobile" class="form-control" value="{{ $userData->mobile }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control" value="{{ $userData->address }}" />
                                    </div>
                                </div>
                                @if($title == 'Shop')
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Joined Year</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select disabled name="vendor_join" class="form-select mb-3" aria-label="vendor_join">
                                            <option selected="">Select Year</option>
                                            <option value="2024" {{ $userData->vendor_join == 2024 ? 'selected' : '' }}>2024</option>
                                            <option value="2024" {{ $userData->vendor_join == 2025 ? 'selected' : '' }}>2025</option>
                                            <option value="2025" {{ $userData->vendor_join == 2026 ? 'selected' : '' }}>2026</option>
                                            <option value="2026" {{ $userData->vendor_join == 2027 ? 'selected' : '' }}>2027</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short Info</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea class="form-control" id="vendor_short_info" name="vendor_short_info" placeholder="Address..." rows="3">{{ $userData->vendor_short_info }}</textarea>
                                    </div>
                                </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Website</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="website" class="form-control" value="{{ $userData->website }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Instagram</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="instagram" class="form-control" value="{{ $userData->instagram }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Facebook</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="facebook" type="text" class="form-control" value="{{ $userData->facebook }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Logo</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="hidden" name="old_image" value="{{ $userData->photo }}">
                                        <input type="hidden" name="image_base64" />
                                        <input type="file" required name="logo_thumbnail" class="image form-control" id="logo_thumbnail" accept=".jpg,.jpeg,.png">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        @if($title == 'Shop')
                                        <h6 class="mb-0">Logo</h6>
                                        @else
                                        <h6 class="mb-0">Photo</h6>
                                        @endif
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="mainThmb" src="{{ !empty($userData->photo) ? asset($userData->photo) : asset('upload/no_image.jpg') }}" alt="{{ $title }}" class="show-image p-1 bg-primary" height="100" width="200">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
       
</div>
<!-- Logo Thumbnail Modal for Cropping -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-50 text-center" id="modalLabel">Crop Logo Image Before Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times" style="color: #ff0000;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" class="img-fluid" alt="Image" />
                            </div>
                            <div class="col-md-4">
                                <div class="preview">
                                    <img id="preview-image" src="" class="img-fluid" alt="Preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Logo Thumbnail Modal for Cropping -->




@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script>
        // Thumbnail Modal
        var $modal1 = $('#modal');
        var image1 = document.getElementById('image');
        var cropper1;

        // Image Change Event
        $('body').on('change', '.image', function (e) {
            var files = e.target.files;
            var done = function (url) {
                image1.src = url;
                $modal1.modal('show');
            };

            var reader;
            var file;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Show Modal Event
        $modal1.on('shown.bs.modal', function () {
            cropper1 = new Cropper(image1, {
                aspectRatio: 16 / 9,
                viewMode: 3,
                preview: '.preview',
            });
        }).on('hidden.bs.modal', function () {
            cropper1.destroy();
            cropper1 = null;
        });

        // Crop Button Click Event
        $('#crop').click(function () {
            var canvas = cropper1.getCroppedCanvas({
                width: 800,
                height: 800,
            });
            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    $("input[name='image_base64']").val(base64data);
                    $('.show-image').show();
                    $('.show-image').attr('src', base64data);
                    
                };
            });
            $modal1.modal('hide');
        });

        // Cancel Button Click Event
        $('.close').click(function () {
            $('#logo_thumbnail').val('');
            $modal1.modal('hide');
        });

</script>
@endsection