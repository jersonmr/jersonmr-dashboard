<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    public function __invoke(string $locale): RedirectResponse
    {
        set_locale_session($locale);

        return redirect()->route("home");
    }
}
