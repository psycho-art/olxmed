@extends('layouts.user')

@section('content-header')
<section class="content-header">
  <h1>
    Product | Edit Product
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('user.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Product</li>
    <li class="active">Edit Product</li>
  </ol>
</section>
@endsection

@section('content')
@error('category_id')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
@enderror
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Product</h3>
        </div>
        <form action="{{ route('user.product.update', $product->id) }}" enctype="multipart/form-data" method="post" id="addProductForm">
            @csrf
            <div class="box-body">

                {{-- <div class="form-group first_cat common">
                    <label class="choose_category" for="choose_category">Choose Category</label>
                    <select data-index="0" name="category_id[0]" id="category_id" class="form-control category_id">
                        <option value="">Choose Category</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div> --}}

                @php $cat = \DB::table('categories')->where('id', $product->category_id)->first(); @endphp
                <div class="category-popup" style="margin-bottom: 1em;">
                    <button class="btn btn-primary btn-md choose_category" type="button" data-toggle="modal" data-target="#exampleModalCenter">{{ "Selected Category: ".$cat->name }}</button>
                    <input type="hidden" name="category" value="{{ $cat->id }}" class="category">
                    <div class="cat_error">

                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Your title" value="{{ old('title') ? old('title') : $product->title }}">
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="8" name="description" id="description" class="form-control" placeholder="Enter Description">{{ old('description') ? old('description') : $product->description  }}</textarea>
                    @error('description')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="condition" class="control-label text-right">Condition</label>
                    <div>
                        <div class="input-group">
                            <div id="radioBtn" class="btn-group">
                                <a class="btn btn-primary btn-sm {{ $product->condition == 'new' ? 'active' : 'notActive' }}" data-toggle="condition" data-title="N">New</a>
                                <a class="btn btn-primary btn-sm {{ $product->condition == 'used' ? 'active' : 'notActive' }}" data-toggle="condition" data-title="U">Used</a>
                            </div>
                            <input type="hidden" name="condition" id="condition" value="{{ $product->condition == "used" ? 'U' : 'N'  }}">
                            @error('condition')
                                <small id="condition-error" class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="price">Set a price</label>
                    <input type="text" class="form-control" name="price" id="price" value="{{ old('price') ? old('price') : $product->price }}" placeholder="Set a price">

                    @error('price')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row">
                        <?php for($i = 0; $i < 10; $i++) { ?>
                            <div class="col-md-2">
                                <div class="slim" data-label="Click or Drop your image here" data-force-size="550,650" data-ratio="1:1" data-max-file-size="1" data-will-crop-initial="determineInitialCropRect" style="max-width:200px;max-height:200px;">
                                    <input type="file" name="product_images[]" id="image" accept="image/jpeg,image/png,image/gif,image/jpg">  
                                    @if (array_key_exists($i, $productImages))
                                        <img src="{{ asset('storage/'.$productImages[$i]->image) }}"/>
                                    @endif
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    @error('product_images')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                </div> 

                <div class="form-group">
                    <label>Number</label>
                    <input type="text" name="number" value="{{ old('number') ? old('number') : $product->number }}" class="form-control" placeholder="Enter Your Number">
                </div>

                <div class="form-group">
                    <label for="state">Location</label>
                    <select name="state" id="state" class="form-control">
                        <option value="" >Choose Location</option>
                        <option {{ $product->state == 'Balochistan' ? 'selected' : '' }}  value="Balochistan">Balochistan</option>
                        <option {{ $product->state == 'Islamabad Capital Territory' ? 'selected' : '' }} value="Islamabad Capital Territory" >Islamabad Capital Territory</option>
                        <option {{ $product->state == 'Khyber PakhtunKhwa' ? 'selected' : '' }} value="Khyber PakhtunKhwa" >Khyber PakhtunKhwa</option>
                        <option {{ $product->state == 'Punjab' ? 'selected' : '' }} value="Punjab">Punjab</option>
                        <option {{ $product->state == 'Sindh' ? 'selected' : '' }} value="Sindh">Sindh</option>
                    </select>

                    @error('state')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                @php $cities = \DB::table('cities')->where('state', $product->state)->get(); @endphp
                <div class="form-group" id="cityContainer">
                    <label for="city">City</label>
                    <select name="city" id="city" class="form-control">
                        <option value="">Choose City</option>
                        @foreach ($cities as $item)
                            <option {{ $product->city_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('city')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group" id="neighbourhoodContainer">
                    <label for="neighbourhood">Neighbourhood</label>
                    <input type="text" name="neighbourhood" value="{{ old('neighbourhood') ? old('neighbourhood') : $product->neighbourhood }}" id="neighbourhood" class="form-control">

                    @error('neighbourhood')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
    
                {{-- @if (!empty($slider_imgs))
                    @foreach ($slider_imgs as $img)
                        <div class="form-group">
                            <img style="width: 30%" src="{{ asset('storage'.'/'.$img->value) }}">
                            <div>
                                <a href="{{ route('admin.deleteImage', ['id' => $img->id]) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    @endforeach
                @endif --}}

                <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="show_number">Feature the product</label>
                    <div>
                        <label class="switch">
                            <input name="featured" {{ $product->featured == 'yes' ? 'checked' : '' }} type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label style="display: block;">Status</label>
                    <select name="status" class="form-control">
                        <option {{ $product->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                        <option {{ $product->status == 'inactive' ? 'selected' : '' }} value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="font-size: 1.5em;" id="exampleModalLongTitle">Choose Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @foreach($category as $c)
                <p data-id="{{ $c->id }}" class="cat_p" style="padding: 0.8em; font-size: 1.2em; cursor: pointer;">{{ ucfirst($c->name) }}</p>
            @endforeach
        </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/css/slim.min.css') }}">
<script src="{{ asset('backend/editor/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('backend/editor/ckfinder/ckfinder.js') }}"></script>
<style>
    .text-danger {
        font-size: 1.1em;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    label.error {
        color: red;
        font-weight: normal;
    }
    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }

    #condition-error {
        display: block;
    }
    .cat_p:hover {
        background: #f2f2f2;
    }

    .slim {
        margin-bottom: 1em;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
<script src="{{ asset('backend/js/slim.multiple.js') }}" ></script>
<script src="{{ asset('backend/editor/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('backend/editor/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('backend/js/plugins/jquery-validate/jquery.validate.min.js') }}"></script>
<script>
    $(function() {

        $("#price").on('keyup', function() {
            var val = $(this).val();
            val = val.replace(/,/g, '');
            console.log(val);
            var formatted = val.replace(/\d+/g, n => Number(n).toLocaleString("en-IN"))
            // console.log(val.toLocaleString('en-IN'));
            // if(formatted) 
            // console.log(formatted);
            console.log(formatted);
                $(this).val(formatted);

            
        })

        jQuery.validator.setDefaults({ ignore: '' });
        jQuery.validator.setDefaults({ ignore: '' });
        $("#addProductForm").validate({
            rules: {
                title: 'required',
                description: 'required',
                state: 'required',
                city: 'required',
                price: {
                    required: true,
                    number: true
                },
                number: {
                    required: true,
                    number: true,
                },
                condition: 'required',
                category: 'required',
                neighbourhood: {
                    required: true,
                    maxlength: 110
                },
            },
            messages: {
                title: 'The Title field is required',
                description: "The Description field is required",
                state: "The Location is required",
                city: "The City field is required",
                price: {
                    required: "The Price field is required",
                    number: "The price field must be in number"
                },
                condition: 'The Condition field is required',
                category: "Please Choose Category",
                neighbourhood: {
                    required: "Please enter your location",
                    maxlength: "Maximum length cannot be greater then 110 characters"
                },
                number: {
                    required: "The Number field is required",
                    number: "This field must be in numbers"
                }
            },
            errorPlacement: function(error, element) 
            {
                if (element.attr("name") == "category") 
                {
                    error.appendTo(".cat_error");
                } else {
                    error.insertAfter(element);
                }
            }
        })

        $("#state").on('change', function() {
            var state = $(this).val();
            if(state == '') {
                $("#cityContainer").hide();
            } else {
                $.ajax({
                    type: 'get',
                    url: "{{ route('user.product.getCities') }}",
                    data: {state: state},
                    success: function(response) {
                        // var decode = $.parseJSON(response.cities);
                        // var cities = JSON.parse(response.cities);
                        var json = JSON.stringify(response.cities);
                        var decode = $.parseJSON(json);
                        if(decode) {
                            $("#city").empty();
                            $("#cityContainer").show();
                            $("#city").append("<option value=''>Choose City</option>")
                            $(decode).each(function(index, element) {
                                $("#city").append('<option value='+element.id+'>'+element.name+'</option>');
                            });
                        } else {
                            $("#city").empty();
                        }
                        
                    }
                });
            }
        })

        $(document).on('click', '.cat_p', function() {
            console.log('here');
            var id = $(this).attr('data-id');
            var text = $(this).text();

            $.ajax({
                type: 'get',
                url: '{{ route("user.product.getCategory") }}',
                data: {id: id},
                success: function(response) {
                    var json = JSON.stringify(response);
                    var decode = $.parseJSON(json);
                    if(decode.html == 'true') {
                        $(".modal-body").empty();
                        $(".modal-body").append(decode.data);
                    } else {
                        $(".choose_category").text("Selected Category: "+text);
                        $(".modal-body").empty();
                        $(".modal-body").append(decode.data);
                        $(".modal").modal('hide');
                        $('.category').val(id);
                        $('.category').valid();
                    }
                }
            })
        })

        $('input, textarea, select').on('focusout keyup change', function() {
            $(this).valid();
        });

        $('#radioBtn a').on('click', function(){
            var sel = $(this).data('title');
            var tog = $(this).data('toggle');
            $('#'+tog).prop('value', sel);
            $("#condition").valid();
            
            $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
            $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
        })

        $(".choose_category").on('click', function() {
            var parhtml = "{!! $html !!}";

            $(".modal-body").empty();
            $(".modal-body").append(parhtml);
        })
    });

</script>
@endpush