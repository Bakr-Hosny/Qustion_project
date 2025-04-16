<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Emails;

class HomeController extends Controller
{

    public function index()
    {

        // return redirect(adminUrl('books'));
        return view(pathPrefix() . 'home');
    }
}
