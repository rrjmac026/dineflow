<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Request;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Check if we're on a tenant domain
        if (Request::getHost() !== config('app.domain')) {
            return view('layouts.app');
        }
        
        return view('layouts.app');
    }
}
