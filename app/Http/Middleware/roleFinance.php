<?php

namespace App\Http\Middleware;

use App\Models\position;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class roleFinance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $position = position::all()->where('relation_id', Auth::user()->id);
        foreach($position as $position_info){
            if($position_info->position_id == "3"){
                return $next($request);
            }
        }
        return redirect('/');
    }
}
