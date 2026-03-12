<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * Redirection standard après une action réussie
     */
    protected function redirectSuccess(string $route, string $message)
    {
        return redirect()->route($route)->with('success', $message);
    }

    /**
     * Validation générique réutilisable
     */
    protected function validateRequest(Request $request, array $rules)
    {
        return $request->validate($rules);
    }
}

