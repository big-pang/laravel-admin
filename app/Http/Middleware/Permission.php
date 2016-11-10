<?php namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class Permission
{
    
    protected $except = [
        'admin/index'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permits = $this->getPermission($request);
        if (\Gate::check($permits)) {
            return $next($request);
        }
        return redirect('admin/index')->withErrors('您没有该操作权限！');
    }

    // 获取当前路由需要的权限
    public function getPermission($request)
    {
        $actions = $request->route()->getAction();
        return $actions['as'];
    }

    
}