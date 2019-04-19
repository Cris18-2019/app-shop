<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\ProductImage;
use App\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //MODEL FACTORIES
       /*factory(Category::class, 5)->create(); 
       factory(Product::class, 100)->create();
       factory(ProductImage::class, 200)->create();*/

       $categories=factory(Category::class, 5)->create(); 

       $categories->each(function($category){

          $products= factory(Product::class, 20)->make();
          $category->products()->saveMany($products);   /*Se puede acceder a products gracias a que en el  Category esta definida una fucncion llamada de esa manera make no los guarda en la base de datos  solo nos devuelve el objeto*/

          //Ahora vamos a iterar sobre los productos

          $products->each(function($p){//crearemos 5 imagenes para cada producto $p
            $images= factory(ProductImage::class, 5)->make();/*aqui cambiamos el create por make para que no se guarde en la base de datos*/
            $p->images()->saveMany($images);//En esta linea ya se guarda con la instruccion save

          });
           

       });

       /* 
       The Save Method
        Eloquent provides convenient methods for adding new models to relationships. For example, perhaps you need to insert a new Comment for a Post model. Instead of manually setting the  post_id attribute on the Comment, you may insert the Comment directly from the relationship's  save method:

         $comment = new App\Comment(['message' => 'A new comment.']);

         $post = App\Post::find(1);

         $post->comments()->save($comment);

        */

          /*
           Tenga en cuenta que no hemos accedido a la commentsrelación como una propiedad dinámica. En su lugar, llamamos al commentsmétodo para obtener una instancia de la relación. El  savemétodo agregará automáticamente el post_idvalor apropiado al nuevo Commentmodelo.

           Si necesita guardar varios modelos relacionados, puede utilizar el saveManymétodo:

              $post = App\Post::find(1);

              $post->comments()->saveMany([
              new App\Comment(['message' => 'A new comment.']),
              new App\Comment(['message' => 'Another comment.']),
              ]);*/




         /*$users = factory(App\User::class, 3)
           ->create()
           ->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->make());/*este ojeto se crea sin guardarse en la base de datos
            });*/
        


    }
}
