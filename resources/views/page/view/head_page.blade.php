<!-- Header -->
<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h1>CỘNG ĐỒNG <span id="js-rotating">KÝ TÚC XÁ, SINH VIÊN, VIỆT - HÀN</span></h1>
                        <p class="p-heading p-large">An toàn - Sạch sẽ - Tiện nghi </p>
                        @if (Auth::guard('sinh_vien')->check() && Auth::guard('sinh_vien')->user()->id_giuong > 0)
                            <a class="btn-solid-lg page-scroll" href="{{url('sinh-vien')}}">Nhà của tôi</a>
                            @else
                        <a class="btn-solid-lg page-scroll" href="{{url('dang-ki')}}">Đăng kí ngay</a>

                        @endif
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->
<!-- end of header -->