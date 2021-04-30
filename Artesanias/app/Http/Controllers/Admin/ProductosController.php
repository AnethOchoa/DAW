<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Product;
use File;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $datos=\DB::table('products')
       ->select('products.*')
       ->orderBy('id','DESC')
       ->get();
       return view('admin.productos')->with('productos',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'nombre' => 'required|max:255|min:1',
        'descripcion' => 'required|max:255|min:1',
        'stock' => 'required|max:255|min:1|numeric',
        'precio' => 'required|max:255|min:1|numeric',
        'imagen' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        if($validator->fails()){
            return back()
            ->withInput()
            ->with('errorInsert', 'Favor de llenar todos los campos.')
            ->withErrors($validator);
            
        }else{
            $imagen=$request->file('imagen');
            $nombre=time().'.'.$imagen->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->imagen->move($destino, $nombre);
            $producto = Product::create([
                'name'=>$request->nombre,
                'description'=>$request->descripcion,
                'stock'=>$request->stock,
                'price'=>$request->precio,
                'image'=>$nombre,
                'slug'=>'',
            ]);
            $producto->save();
            return back()->with("Listo", "Se ha insertado correctamente");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:255|min:1',
            'descripcion' => 'required|max:255|min:1',
            'stock' => 'required|max:255|min:1|numeric',
            'precio' => 'required|max:255|min:1|numeric',
           
            ]);
            if($validator->fails()){
                return back()
                ->withInput()
                ->with('errorEdit', 'Favor de llenar todos los campos.')
                ->withErrors($validator);
                
            }else{
                $producto=Product::find($request->id);
                $producto->name=$request->nombre;
                $producto->description=$request->descripcion;
                $producto->stock=$request->stock;
                $producto->price=$request->precio;
                $validator2 = Validator::make($request->all(),[
                    'imagen' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
                ]);

                if(!$validator2->fails()){
                    $imagen=$request->file('imagen');
                    $nombre=time().'.'.$imagen->getClientOriginalExtension();
                    $destino = public_path('img/productos');
                    $request->imagen->move($destino, $nombre);
                    if(File::exists(public_path('img/productos/'.$producto->image))){
                        unlink(public_path('img/productos/' .$producto->image));
                    }
                    $producto->image=$nombre;
                }
                
                $producto->save();
                return back()->with('Listo', 'Se ha actualizado correctamente');
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto=Product::find($id);
        if(File::exists(public_path('img/productos/'.$producto->image))){
            unlink(public_path('img/productos/' .$producto->image));
        }
        $producto->delete();
        return back()->with('Listo', 'Se ha eliminado correctamente');
    }
}
