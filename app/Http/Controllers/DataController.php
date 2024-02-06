<?php

namespace App\Http\Controllers;

use App\Models\Merch;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getMerch() {
		return Merch::isadmin()->get();
    }
}
