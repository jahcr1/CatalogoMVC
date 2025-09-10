<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // obtenemos listado de marcas desde el model Marca::
        // $marcas = Marca::all();
        // $marcas = Marca::all()->sortByDesc('idMarca');
        // $marcas = Marca::orderBy('idMarca')->get();
        $marcas = Marca::orderByDesc('idMarca')->paginate(6);

        return view('marcas', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('marca-create');
    }

    private function validar(Request $request): void
    {
        $request->validate(
            // [ 'campo' => 'regla1|regla2' ],
            // [ 'campo.regla1' => 'mensaje regla1' ]
            [
                'mkNombre' => 'required|unique:marcas,mkNombre|min:2|max:45'
            ],
            [
                'mkNombre.required' => 'El campo "Nombre de la marca" es obligatorio',
                'mkNombre.unique' => 'Ya existe una marca con ese nombre',
                'mkNombre.min' => 'El campo "Nombre de la marca" debe tener al menos 2 caractéres',
                'mkNombre.max' => 'El campo "Nombre de la marca" debe tener 45 caractéres como máximo'
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $mkNombre = $request->mkNombre;

        // Validación
        $this->validar($request);
        try {
            $marca = new Marca; // instanciamos el modelo Marca y creamos el objeto $marca
            $marca->mkNombre = $mkNombre; // asignamos el valor del campo del formulario al atributo del objeto
            $marca->save(); // este metodo save() hace un INSERT en la tabla marcas

            return redirect('/marcas')
                ->with(
                    [
                        'mensaje' => "Marca: $mkNombre creada correctamente",
                        'css' => 'green'
                    ]);
        } catch ( \throwable $th) {
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'No se pudo registrar la marca: '.$mkNombre,
                        'css'=>'red'
                    ]
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // obtenemos los datos de una marca por su id
        $marca = Marca::find($id);

        return view('marca-edit', ['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $idMarca = $id;
        // $idMarca = $request->idMarca; // viene oculto en el formulario, esta es otra forma de obtenerlo
        $mkNombre = $request->mkNombre;

        // Validación
        $this->validar($request);

        try {

            $marca = Marca::find($idMarca); // obtenemos el objeto marca desde la BD
            $marca->mkNombre = $mkNombre; // asignamos el valor del campo del formulario al atributo del objeto
            $marca->save(); // este metodo save() hace un UPDATE en la tabla marcas

            return redirect('/marcas')
                ->with(
                    [
                        'mensaje' => "Marca: $mkNombre actualizada correctamente",
                        'css' => 'green'
                    ]);

        }catch( \Throwable $th )
        {
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'No se pudo actualizar la marca: '.$mkNombre,
                        'css'=>'red'
                    ]
                );

          }

    }

    /**
     * Esta comprobacion no se hace acá, sino deberiamos hacerla en el modelo Producto para que sea MVC, pero podriamos usarlo alguna vez a la interaccion desde un controlador. esto checkea si hay productos asociados a la marca antes de borrar
     */
    private function checkProdxMarca( int $idMarca )
    {
        // obj || null
        // Si lo hacemos por Query Builder con first() devuelve un objeto o null y vemos sus datos con dd()

        /*$check = DB::table('productos')
                        ->where('idMarca', $idMarca)->first(); */

        // Tambien podemos usar count() que nos devuelve un int o sea 0 o 1 al checkear si existe algun producto con esa marca

        $check = DB::table('productos')
                        ->where('idMarca', $idMarca)->count();
        return $check;

    }


    /**
     * Creamos un metodo nuevo confirm para mostrar una vista de confirmación antes de eliminar
     */
    public function confirm( string $id)
    {
        //dd( $this->checkProdxMarca( $id ) );
        dd(Producto::checkProductoXMarca( $id ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
