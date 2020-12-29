<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChangeLang extends Controller
{
    /**
     * @param $lang
     *
     * @return RedirectResponse
     */
    public function change_lang($lang): RedirectResponse
    {
        if(in_array($lang,['en','nl'])){
            session(['locale'=> $lang]);
        }
        if(back()->getTargetUrl() == url("/lang/en") || back()->getTargetUrl() == url("/lang/nl"))
        {
            return redirect('/');
        }
        return back();
    }
}
