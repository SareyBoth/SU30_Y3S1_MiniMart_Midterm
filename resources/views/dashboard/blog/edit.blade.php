<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title>PrimeMart</title>

    @include('dashboard.components.style')
    @include('components.head.tinymce-config')
</head>

<body>
    <div class="main-wrapper">

        @include('dashboard.components.header')

        @include('dashboard.components.sidebar')
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Blog Post</h4>
                    </div>
                </div>
                <div class="">
                    <form id="blog-form" action="{{ route('dashboard.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12 offset-lg-2">
                            <div class="col-lg-8 ">

                                <div class="circular-upload" style="margin: 36px 0;">
                                    <div class="image-preview" id="image-preview"
                                        @if($blog->image)
                                        style="background-image: url('{{ asset('storage/' . $blog->image) }}'); background-size: cover; background-position: center;"
                                        @endif>
                                        <div class="label-text text-primary" id="label-text" @if($blog->image) style="opacity: 0;" @endif>
                                            Add image
                                        </div>
                                    </div>
                                    <input name="image" type="file" id="file-input" accept="image/*">
                                </div>
                                @error('image')
                                <div class="text-danger text-center">{{ $message }}</div>
                                @enderror

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input name="title" class="form-control" placeholder="Input blog title"
                                                type="text" value="{{ old('title', $blog->title) }}" required>
                                            @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Published At</label>
                                            <input name="published_at" class="form-control" type="datetime-local"
                                                value="{{ old('published_at', $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d\TH:i') : null) }}">
                                            @error('published_at')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Excerpt</label>
                                            <textarea name="excerpt" class="form-control" rows="3"
                                                placeholder="Brief summary of the blog post">{{ old('excerpt', $blog->excerpt) }}</textarea>
                                            @error('excerpt')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="display-block">Is Featured? <span
                                                    class="text-danger">*</span></label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_featured"
                                                    id="featured_yes" value="1"
                                                    {{ old('is_featured', $blog->is_featured) == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_featured"
                                                    id="featured_no" value="0"
                                                    {{ old('is_featured', $blog->is_featured) == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured_no">No</label>
                                            </div>
                                            @error('is_featured')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Meta Title</label>
                                            <input name="meta_title" class="form-control"
                                                placeholder="Input meta title for SEO" type="text"
                                                value="{{ old('meta_title', $blog->meta_title) }}">
                                            @error('meta_title')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea name="meta_description" class="form-control" rows="3"
                                                placeholder="Input meta description for SEO">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                            @error('meta_description')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>Body <span class="text-danger">*</span></label>
                                    <textarea name="body" id="mytextarea" class="form-control" style="height: 220px"
                                        placeholder="Write the full content of your blog post" required>{{ old('body', $blog->body) }}</textarea>
                                    @error('body')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
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
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/dashboard/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/chart.js') }}"></script>
    <script src="{{ asset('js/dashboard/app.js') }}"></script>

    <script>
        document.getElementById('blog-form').addEventListener('submit', function(e) {
            tinymce.triggerSave();
        });

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
        width: 100%;
        height: 400px;
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
        background-size: cover;
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