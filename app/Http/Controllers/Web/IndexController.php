<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function __construct(private readonly Factory $view)
    {
    }

    public function __invoke(): View
    {
        return $this->view->make('welcome');
    }
}
