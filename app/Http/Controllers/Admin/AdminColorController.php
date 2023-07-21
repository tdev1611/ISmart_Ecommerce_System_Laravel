<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class AdminColorController extends Controller
{
    //
    
    function create(Request $request)
    {

        $colors = Color::paginate(10);
        return view('admin.Colors.add-color',compact('colors'));
    }
    function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required'
        ], [], [
            'name' => 'Color Name'
        ]);
        $color = Color::create($input);
        return back()->with('success','Thêm thành công');
    }

}