@extends('index.dashboard')

@section('styles')
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        
        .preview, .gallery1-preview {
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

@section('index')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Edit Product</h5>
            <hr />

            <form id="myForm" method="post" action="{{ route('update.product') }}">
                @csrf

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">


                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Name</label>
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="text" name="product_name" required class="form-control" id="inputProductTitle" value="{{ $product->product_name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                                    <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_tags }}">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Size</label>
                                    <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_size }} ">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label">Product Color</label>
                                    <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_color }}">
                                </div>



                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea name="short_descp" class="form-control" required id="inputProductDescription" rows="3">{{ $product->short_descp }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Long Description</label>
                                    <textarea name="long_descp" class="form-control" rows="6" required>{{ $product->long_descp }}</textarea>
                                    <!-- <textarea id="mytextarea" name="long_descp">{!! $product->long_descp !!}</textarea> -->
                                </div>






                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">

                                    <div class="form-group col-md-6">
                                        <label for="inputPrice" class="form-label">Product Price</label>
                                        <input type="text" name="selling_price" required class="form-control" id="inputPrice" value="{{ $product->selling_price }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price </label>
                                        <input type="text" name="discount_price" class="form-control" id="inputCompareatprice" value="{{ $product->discount_price }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                        <input type="text" name="product_code" required class="form-control" id="inputCostPerPrice" value="{{ $product->product_code }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputStarPoints" class="form-label" >Product Quantity</label>
                                        <input type="text" name="product_qty" class="form-control" required id="inputStarPoints" value="{{ $product->product_qty }}">
                                    </div>


                                    <div class="form-group col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select name="brand_id" class="form-select" id="inputProductType" required>
                                            <option></option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="inputVendor" class="form-label">Product Category</label>
                                        <select name="category_id" class="form-select" id="inputVendor" required>
                                            <option></option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="inputCollection" class="form-label">Product SubCategory</label>
                                        <select name="subcategory_id" class="form-select" id="inputCollection" required>
                                            <option></option>
                                            @foreach($subcategory as $subcat)
                                            <option value="{{ $subcat->id }}" {{ $subcat->id == $product->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>


                                    <div class="form-group col-12" @if($userData->role == 'vendor') hidden @endif>
                                        <label for="inputCollection" class="form-label">Select Shop</label>
                                        <select name="vendor_id" class="form-select" id="inputCollection" required>
                                            <option></option>
                                            @foreach($activeVendors as $vendor)
                                            <option value="{{ $vendor->id }}" {{ $vendor->id == $product->vendor_id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-12">

                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault"> Hot Deals</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault" {{ $product->featured == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                                </div>
                                            </div>




                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="flexCheckDefault" {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $product->special_deals == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                                                </div>
                                            </div>



                                        </div> <!-- // end row  -->

                                    </div>

                                    <hr>


                                    <div class="col-12">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
        </div>

        </form>

    </div>
</div>


<div class="page-content">
    <h6 class="mb-0 text-uppercase">Update Thumbnail and Gallery Images</h6>
    <hr>
    <div class="card">
    <div class="row">

<div class="col-6">
        <form method="post" action="{{ route('update.product.thumbnail') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Choose Thumbnail Image (800x800)px</label>
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="old_image" value="{{ $product->product_thumbnail }}">
                    <input type="hidden" name="image_base64" />
                    <input type="file" required name="product_thumbnail" class="image form-control" id="product_thumbnail" accept=".jpg,.jpeg,.png">

                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label"></label>
                    <img id="mainThmb" src="{{ asset($product->product_thumbnail)   }}" alt="Admin" class="show-image" style="width:100px; height: 100px;">
                </div>
                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
            </div>
        </form>
</div>
<div class="col-6">
    <form method="post" action="{{ route('update.product.addgallery') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
<div class="row">
            <div class="mb-3">
                <label for="inputProductTitle" class="form-label">Add Gallery Image 1 (800x800)px</label>
                    <input type="file" name="product_gallery1" class="gallery1-image form-control" id="product_gallery1" accept=".jpg,.jpeg,.png" required>
                    <input type="hidden" name="gallery_image1_base64" />
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label"></label>
                <img src="" id="mainGallery1" style="width: 100px;" class="show-gallery1-image" />
            </div>

</div>
<div class="row">
<div class="mb-3">
     <label for="inputProductTitle" class="form-label">Galery Image 2 (800x800)px</label>
                                            <input type="file" name="product_gallery2" class="gallery2-image form-control" id="product_gallery2" accept=".jpg,.jpeg,.png">
                                            <input type="hidden" name="gallery_image2_base64" />
                                        </div>
                                        <div class="mb-3">
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <img src="" id="mainGallery2" style="width: 100px;" class="show-gallery2-image" />
                                        </div>
                                        </div>
</div>
            <input type="submit" class="btn btn-primary px-4" value="Add To Gallery" /> 

        </div>
    </form>                             
</div>

    </div>
    </div>
</div>

<div class="page-content">
    <h6 class="mb-0 text-uppercase">Update Gallery Images </h6>
    <hr>
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">#Sl</th>
                        <th scope="col">Image</th>
                        <th scope="col">Change Image </th>
                        <th scope="col">
                            <centre>Action</centre>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <form id="imageForm" method="post" action="" enctype="multipart/form-data">
                        @csrf

                        @foreach($multiImages as $key => $img)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>
                                <img id="multi-{{ $key }}" src="{{ asset($img->photo_name) }}" alt="Admin" style="width:70px; height: 70px;">
                            </td>
                            <td>
                                <input type="file" class="form-group" name="multi_img[{{ $img->id }}]" onChange="mainImagesUrl(this, {{ $key }})">
                            </td>
                            <td>
                                <input type="checkbox" name="image_ids[]" value="{{ $img->id }}">
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td align="right"><button id="updateButton" type="button" class="btn btn-primary px-4">Update Images</button></td>
                            <td><button id="deleteButton" type="button" class="btn btn-danger">Delete Selected</button></td>

                        </tr>

                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Thumbnail Modal for Cropping -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-50 text-center" id="modalLabel">Crop Thumbnail Image Before Upload</h5>
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
    <!-- End Thumbnail Modal for Cropping -->
     <!-- Modal for Cropping Gallery 1-->
    <div class="modal fade" id="gallery1modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-50 text-center" id="gallery1modalLabel">Crop Gallery 1 Image Before Upload</h5>
                    <button type="button" class="gallery1-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times" style="color: #ff0000;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="gallery1image" class="img-fluid" alt="Image" />
                            </div>
                            <div class="col-md-4">
                                <div class="gallery1-preview">
                                    <img id="gallery1preview-image" src="" class="img-fluid" alt="gallery1-preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary gallery1-close" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="gallery1_crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for Cropping Gallery 1-->
<!-- Modal for Cropping Gallery 2-->
<div class="modal fade" id="gallery2modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-50 text-center" id="gallery2modalLabel">Crop Gallery 2 Image Before Upload</h5>
                    <button type="button" class="gallery2-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times" style="color: #ff0000;"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="gallery2image" class="img-fluid" alt="Image" />
                            </div>
                            <div class="col-md-4">
                                <div class="gallery2-preview">
                                    <img id="gallery2preview-image" src="" class="img-fluid" alt="gallery2-preview" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary gallery2-close" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="gallery2_crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal for Cropping Gallery 2-->

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
                aspectRatio: 1,
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
            $('#product_thumbnail').val('');
            $modal1.modal('hide');
        });

</script>

<script type="text/javascript">
    
document.getElementById('updateButton').addEventListener('click', function() {
    let form = document.getElementById('imageForm');
    form.action = '{{ route('update.product.multiimages') }}';
    form.submit();
});

document.getElementById('deleteButton').addEventListener('click', function() {
    let form = document.getElementById('imageForm');
    form.action = '{{ route('remove.product.images') }}';
    form.submit();
});

</script>

<script type="text/javascript">
    function mainImagesUrl(input, key) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#multi-' + key).attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                product_name: {
                    required: true,
                },
                short_descp: {
                    required: true,
                },
                product_thumbnail: {
                    required: true,
                },
                multi_img: {
                    required: true,
                },
                selling_price: {
                    required: true,
                },
                product_code: {
                    required: true,
                },
                product_qty: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                },
            },
            messages: {
                product_name: {
                    required: 'Please Enter Product Name',
                },
                short_descp: {
                    required: 'Please Enter Short Description',
                },
                product_thumbnail: {
                    required: 'Please Select Product Thumbnail Image',
                },
                multi_img: {
                    required: 'Please Select Product Multi Image',
                },
                selling_price: {
                    required: 'Please Enter Selling Price',
                },
                product_code: {
                    required: 'Please Enter Product Code',
                },
                product_qty: {
                    required: 'Please Enter Product Quantity',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script>
   // Gallery 1 Modal
var $gallery1modal = $('#gallery1modal');
var gallery1image = document.getElementById('gallery1image');
var cropper1; // Unique cropper for Gallery 1

$('body').on('change', '.gallery1-image', function (e) {
    var files1 = e.target.files; // Unique files variable for Gallery 1
    var done1 = function (url) { // Unique done function for Gallery 1
        gallery1image.src = url;
        $gallery1modal.modal('show');
    };

    var reader1;
    var file1;

    if (files1 && files1.length > 0) {
        file1 = files1[0];

        if (URL) {
            done1(URL.createObjectURL(file1));
        } else if (FileReader) {
            reader1 = new FileReader();
            reader1.onload = function (e) {
                done1(reader1.result);
            };
            reader1.readAsDataURL(file1);
        }
    }
});

$gallery1modal.on('shown.bs.modal', function () {
    cropper1 = new Cropper(gallery1image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.gallery1-preview',
    });
}).on('hidden.bs.modal', function () {
    cropper1.destroy();
    cropper1 = null;
});

$('#gallery1_crop').click(function () {
    var canvas1 = cropper1.getCroppedCanvas({
        width: 800,
        height: 800,
    });
    canvas1.toBlob(function (blob) {
        var reader1 = new FileReader();
        reader1.readAsDataURL(blob);
        reader1.onloadend = function () {
            var base64data1 = reader1.result;
            $("input[name='gallery_image1_base64']").val(base64data1);
            $('.show-gallery1-image').show();
            $('.show-gallery1-image').attr('src', base64data1);
            
        };
    });
    $gallery1modal.modal('hide');
});


    // Cancel Button Click Event
    $('.gallery1-close').click(function () {
        $('#product_gallery1').val('');
        $gallery1modal.modal('hide');
    });
</script>


<script>
    // Gallery 2 Modal
var $gallery2modal = $('#gallery2modal');
var gallery2image = document.getElementById('gallery2image');
var cropper2; // Unique cropper for Gallery 2

$('body').on('change', '.gallery2-image', function (e) {
    var files2 = e.target.files; // Unique files variable for Gallery 2
    var done2 = function (url) { // Unique done function for Gallery 2
        gallery2image.src = url;
        $gallery2modal.modal('show');
    };

    var reader2;
    var file2;

    if (files2 && files2.length > 0) {
        file2 = files2[0];

        if (URL) {
            done2(URL.createObjectURL(file2));
        } else if (FileReader) {
            reader2 = new FileReader();
            reader2.onload = function (e) {
                done2(reader2.result);
            };
            reader2.readAsDataURL(file2);
        }
    }
});

$gallery2modal.on('shown.bs.modal', function () {
    cropper2 = new Cropper(gallery2image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.gallery2-preview',
    });
}).on('hidden.bs.modal', function () {
    cropper2.destroy();
    cropper2 = null;
});

$('#gallery2_crop').click(function () {
    var canvas2 = cropper2.getCroppedCanvas({
        width: 800,
        height: 800,
    });
    canvas2.toBlob(function (blob) {
        var reader2 = new FileReader();
        reader2.readAsDataURL(blob);
        reader2.onloadend = function () {
            var base64data2 = reader2.result;
            $("input[name='gallery_image2_base64']").val(base64data2);
            $('.show-gallery2-image').show();
            $('.show-gallery2-image').attr('src', base64data2);
        };
    });
    $gallery2modal.modal('hide');
});
    // Cancel Button Click Event
    $('.gallery2-close').click(function () {
        $('#product_gallery2').val('');
        $gallery2modal.modal('hide');
    });
</script>

<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                    .height(80); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>
@endsection