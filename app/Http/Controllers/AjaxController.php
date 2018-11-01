<?php

namespace App\Http\Controllers;

use App\bt_book;
use App\bt_type;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getBooktype($id, $typeid)
    {
        $booktype = bt_type::where('category_id',$id)->get();
        foreach ($booktype as $tp)
        {
            if($tp->type_id == $typeid )
            {
                echo "<option selected value ='".$tp->type_id."'>".$tp->type_name."</option>";
            }
            else
            {
                echo "<option value ='".$tp->type_id."'>".$tp->type_name."</option>";
            }

        }
    }
    public function getBooktypeadd($id)
    {
        $booktype = bt_type::where('category_id',$id)->get();
        foreach ($booktype as $tp)
        {
                echo "<option value ='".$tp->type_id."'>".$tp->type_name."</option>";
        }
    }
}
