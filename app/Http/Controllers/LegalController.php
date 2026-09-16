<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function privacyPolicy()
    {
        return view('legal.privacy-policy');
    }

    public function termsOfUse()
    {
        return view('legal.terms-of-use');
    }
}
