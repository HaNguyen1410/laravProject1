<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
//                return redirect()->guest('auth/login');
                return redirect()->guest('dangnhap');
            }
        }
        if ($request->is('giangvien/*')) {
            if(\Auth::user()->quyen != 'gv')
                return redirect()->guest('dangnhap');
        }
        
        if ($request->is('quantri/*')) {
            if(\Auth::user()->quyen != 'qt')
                return redirect()->guest('dangnhap');
        }
        
        if ($request->is('sinhvien/*')) {
            if(\Auth::user()->quyen != 'sv')
                return redirect()->guest('dangnhap');
        }
        /* $action = $request->route()->getActionName();
        echo $action; */
        
        return $next($request);
    }
}
