<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;
use App\Models\SinhVien;
use App\Models\VerifySV;
class regisSV
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::guard('sinh_vien')->check()) {
            # code...
            if ( Auth::guard('sinh_vien')->user()->verified == 1) {
                # code...
                return $next($request);
            }else {
                # code...
               return redirect('email')->with('loi', 'Hãy xác nhận email của bạn, chúng tôi đã gửi nó cho bạn hoặc bạn có thể yêu cầu gửi lại');
            }
        }else {
            # code...
            return redirect('dang-nhap')->with('nologin', 'Bạn chưa đăng nhập');
        }
    }
}
