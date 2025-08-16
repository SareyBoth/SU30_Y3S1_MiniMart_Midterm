<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title>PrimeMart</title>

    <!--Style-->
    @include('dashboard.components.style')


</head>

<body>
    <div class="main-wrapper">

        <!-- Header -->
        @include('dashboard.components.header')

        <!-- Sidebar -->
        @include('dashboard.components.sidebar')
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Product</h4>
                    </div>
                </div>
                <form action="{{ route('dashboard.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-8 offset-lg-2">
                        <div class="col-lg-8 offset-lg-2">

                            <div class="circular-upload" style="margin: 36px 0;">
                                <div class="image-preview" id="image-preview"
                                    @if($product->image)
                                    style="background-image: url('{{ asset('storage/' . $product->image) }}'); background-size: cover; background-position: center;"
                                    @endif>
                                    <div class="label-text text-primary" id="label-text" @if($product->image) style="opacity: 0;" @endif>
                                        Add image
                                    </div>
                                </div>
                                <input name="image" type="file" id="file-input" accept="image/*">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input name="name" class="form-control" value="{{ old('name', $product->name) }}" placeholder="Input category name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="display-block">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_active" value="1"
                                                {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="2"
                                                {{ old('status', $product->status) == 2 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category-select" class="form-control">
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sub category <span class="text-danger">*</span></label>
                                        {{-- The options for this dropdown will be loaded by your JavaScript --}}
                                        <select name="sub_category_id" id="subcategory-select" class="form-control">
                                            {{-- We will populate this placeholder via JavaScript --}}
                                            <option value="">-- Select a category first --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Price <span class="text-danger">*</span></label>
                                        <input name="price" value="{{ old('name', $product->price) }}" class="form-control" placeholder="Input price" type="number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Quantity <span class="text-danger">*</span></label>
                                        <input name="stock_quantity" value="{{ old('name', $product->stock_quantity) }}" class="form-control" placeholder="Input quantity" type="number" step="1" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <label>Description </label>
                                    <textarea name="description" class="form-control" style="height: 220px" placeholder="Describe everything about the product">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Update Product</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/select2.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/dashboard/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/chart.js') }}"></script>
    <script src="{{ asset('js/dashboard/app.js') }}"></script>

    <script>
        const preview = document.getElementById('image-preview');
        const input = document.getElementById('file-input');
        const label = document.getElementById('label-text');

        preview.addEventListener('click', () => input.click());

        input.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.style.backgroundImage = `url(${e.target.result})`;
                    label.style.opacity = '0';
                };
                reader.readAsDataURL(file);
            }
        });
        $(document).ready(function() {
            console.log("Page loaded. Script is ready.");

            const categorySelect = $('#category-select');
            const subcategorySelect = $('#subcategory-select');

            const selectedSubCategoryId = "{{ $product->sub_category_id }}";

            categorySelect.on('change select2:select', function() {
                const categoryId = $(this).val();
                console.log("Category selection detected. ID:", categoryId);

                subcategorySelect.prop('disabled', true).html('<option>-- Loading... --</option>');

                if (categoryId) {
                    const url = `/get-subcategories/${categoryId}`;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            subcategorySelect.html('<option value="">-- Select Sub Category --</option>');

                            if (data.length > 0) {
                                $.each(data, function(key, subcategory) {
                                    subcategorySelect.append(`<option value="${subcategory.id}">${subcategory.name}</option>`);
                                });
                                subcategorySelect.prop('disabled', false);

                                subcategorySelect.val(selectedSubCategoryId);

                                subcategorySelect.trigger('change');

                            } else {
                                subcategorySelect.html('<option>-- No sub-categories found --</option>').prop('disabled', true);
                            }
                        },
                        error: function() {
                            console.error("AJAX call failed.");
                            subcategorySelect.html('<option>-- Error loading data --</option>').prop('disabled', true);
                        }
                    });
                } else {
                    subcategorySelect.html('<option>-- Select a category first --</option>').prop('disabled', true);
                }
            });

            if (categorySelect.val()) {
                categorySelect.trigger('change');
            }
        });
    </script>
</body>

<style>
    .circular-upload {
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .circular-upload .image-preview {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        border: 2px dashed #ccc;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        overflow: hidden;
        position: relative;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .circular-upload .image-preview:hover {
        border-color: #6BB252;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .circular-upload .label-text {
        color: #6BB252;
        font-size: 14px;
        text-align: center;
        pointer-events: none;
        transition: opacity 0.3s ease;
        padding: 10px;
        position: absolute;
    }

    .circular-upload input[type="file"] {
        display: none;
    }
</style>

</html>