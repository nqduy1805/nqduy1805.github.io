<?php
/*082120QD create Middleware
*/
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Route;

class AccessPermisson
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
        if( Auth::user()&&str_contains('admin', Auth::user()->role)){
            return $next($request);
        }
        return redirect('login');  
          }
}
