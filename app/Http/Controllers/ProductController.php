<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;//colocamos el namespace del que haremos uso

class ProductController extends Controller
{
    public function index(){
    	//$products=Product::all();//todos los productos
    	$products=Product::paginate(10);//para tener una paginación
	    return view('admin.products.index')->with(compact('products'));//ver listado de productos en esta vista le estamos inyectando la variable products 
    }

    public function create(){

    	return view('admin.products.create');//er formulario para cerar un nuevo registro
    }

    public function store(Request $request){//HAREMOS USO DE LA CLASE REQUEST
    	                  //Guardara el nuevo producto
        $messages=[
           'name.required'=>'Es necesario ingresar un nombre para el producto',
           'name.min'=>'El nombre del producto debe tener al menos 3 caracteres',
           'price.required'=>'Debe ingresar un numero para el precio',
           'price.numeric'=>'Ingrese un precio valido',
           'price.min'=>'El precio no puede ser negativo',
           'description.required'=>'El campo descripción requiere escribir algun detalle',
           'description.alpha'=>'El campo descripción no acepta numeros'

        ];

        //ANTES DE GUARDAR DEBEMOS VALIDAR LOS CAMPOS
        $rules=[
         'name'=> 'required|min:3',
         'description'=> 'required|alpha|max:50',
         'price'=> 'required|numeric|min:0'
        ];
        $this->validate($request,$rules,$messages);//si se encunetra que una regla no se cumple nos redirige a la pagina anterior

        //dd($request->all());Esto nos devuelve el producto 
        //1creamos una variable $product
        $product=new Product();
        $product->name=$request->input('name');//llamamos a request y le pasamos como paramero el nombre del campo input en la ista create.blade
        $product->price=$request->input('price');
        $product->description=$request->input('description');
        $product->long_description=$request->input('long_description');

        //UNA VEZ QUE YA TENEMOS NUESTRO OBJETO MANDAMOS A LLAMAR AL METODO SAVE

        $product->save();//insert

        //ya que se registro nos redireccionara

        return redirect('admin/products');

    }

    public function edit($id){
        //return "Mostrar aqui el form para el producto con id $id";
        $product=Product::find($id);//una vez encontrado el producto se lo inyectamos a la vista
        return view('admin.products.edit')->with(compact('product'));

    }

    public function update(Request $request,$id){

        $messages=[
           'name.required'=>'Es necesario ingresar un nombre para el producto',
           'name.min'=>'El nombre del producto debe tener al menos 3 caracteres',
           'price.required'=>'Debe ingresar un numero para el precio',
           'price.numeric'=>'Ingrese un precio valido',
           'price.min'=>'El precio no puede ser negativo',
           'description.required'=>'El campo descripción requiere escribir algun detalle',
           'description.alpha'=>'El campo descripción no acepta numeros'

        ];

        //ANTES DE GUARDAR DEBEMOS VALIDAR LOS CAMPOS
        $rules=[
         'name'=> 'required|min:3',
         'description'=> 'required|alpha|max:50',
         'price'=> 'required|numeric|min:0'
        ];
        $this->validate($request,$rules,$messages);//si se encunetra que una regla no se cumple nos redirige a la pagina anterior


         $product=Product::find($id);//no queremos crear un nuevo producto queremos encontrar ese producto por medio del id y editarlo

        $product->name=$request->input('name');//llamamos a request y le pasamos como paramero el nombre del campo input en la ista create.blade
        $product->price=$request->input('price');
        $product->description=$request->input('description');
        $product->long_description=$request->input('long_description');
        $product->save();//update

        return redirect('/admin/products');

    }

    public function destroy($id){

        $product=Product::find($id);//no queremos crear un nuevo producto queremos encontrar ese producto por medio del id y editarlo
        $product->delete();//borrar
        return back();

    }


}
