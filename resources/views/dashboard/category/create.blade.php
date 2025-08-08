<!DOCTYPE html>
<html lang="en">


<!-- index22:59-->

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
                        <h4 class="page-title">Add Category</h4>
                    </div>
                </div>
                <div class="row">
                    <form action="{{ route('dashboard.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8 offset-lg-2">
                            <form>
                                <div class="circular-upload" style="margin: 36px 0;">
                                    <div class="image-preview " id="image-preview">
                                        <div class="label-text text-primary" id="label-text">Add image</div>
                                    </div>
                                    <input name="image" type="file" id="file-input" accept="image/*">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input name="name" class="form-control" placeholder="Input category name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="display-block">Status</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="doctor_active" value="option1" checked>
                                                <label class="form-check-label" for="doctor_active">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="option2">
                                                <label class="form-check-label" for="doctor_inactive">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label>Description </label>
                                        <textarea name="description" class="form-control" style="height: 220px" type="text" placeholder="Describe everything about the category"></textarea>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" class="btn btn-primary submit-btn">Create Category</button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
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