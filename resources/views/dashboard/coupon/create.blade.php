<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title>PrimeMart - Add Coupon</title>

    @include('dashboard.components.style')

</head>

<body>
    <div class="main-wrapper">

        @include('dashboard.components.header')

        @include('dashboard.components.sidebar')
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Coupon</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{ route('dashboard.coupon.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Coupon Code <span class="text-danger">*</span></label>
                                        <div class="input-group"> <input name="code" id="coupon_code" class="form-control" placeholder="e.g., SUMMER25" type="text" required>
                                            <div class="input-group-append">
                                                <button type="button" id="generate_code_btn" class="btn btn-outline-secondary">Generate</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discount Type <span class="text-danger">*</span></label>
                                        <select name="discount_type" class="form-control" required>
                                            <option value="percent">Percentage (%)</option>
                                            <option value="fixed">Fixed Amount ($)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Discount Value <span class="text-danger">*</span></label>
                                        <input name="discount_value" class="form-control" placeholder="e.g., 25 or 10.50" type="number" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Minimum Purchase ($)</label>
                                        <input name="minimum_purchase" class="form-control" placeholder="e.g., 50.00" type="number" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Valid From</label>
                                        <input name="valid_from" class="form-control" type="datetime-local">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Valid Until</label>
                                        <input name="valid_until" class="form-control" type="datetime-local">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" style="height: 120px" placeholder="Describe the coupon and its terms"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="display-block">Status</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="coupon_active" value="1" checked>
                                            <label class="form-check-label" for="coupon_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="is_active" id="coupon_inactive" value="0">
                                            <label class="form-check-label" for="coupon_inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Create Coupon</button>
                            </div>
                        </form>
                    </div>
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
        document.getElementById('generate_code_btn').addEventListener('click', function() {
            const chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const codeLength = 12;
            let randomCode = '';

            for (let i = 0; i < codeLength; i++) {
                const randomIndex = Math.floor(Math.random() * chars.length);
                randomCode += chars[randomIndex];
            }
            document.getElementById('coupon_code').value = randomCode;
        });
    </script>
</body>

</html>