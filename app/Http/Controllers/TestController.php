<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class TestController extends Controller
{
    public function welcome(){
    	//CREAMOS UNA VARIABLE DONDE RECIBIRA LOS PRODUCTOS
        $products=Product::all();

       /*PARA INYECTAR UNA VARIABLE SOBRE LA VISTA
        //compact palabra reservada lo que hace es crear un array asociativo
         Apartir de los parametros que le indicamos en este caso es la variable 
         products declarada antes
          */
        return view("welcome")->with(compact('products'));
    }
}
