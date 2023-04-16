<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TermsController extends Controller
{
    public function __construct(private readonly Factory $view)
    {
    }

    public function __invoke(): View
    {
        return $this->view->make('terms');
    }
}
