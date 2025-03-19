<?php

namespace App\Http\Middleware;
use App\Models\applications;
use Illuminate\Http\Response;

use Closure;
use App\Models\tblapplicationModel;

class sessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $type = $request->input("type");
        if($type != "API"){
            $user_id = $request->session()->get('user_id');
            if(empty($user_id)){
                return redirect(route('common-login'));
            }
        }
        return $next($request);
    }
}
