<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
        /* El middelwire solo se aplica en el index */
        $this->middleware('can:categorias.index')->only('index');
        $this->middleware('can:categorias.edit')->only('edit','update');
        $this->middleware('can:categorias.create')->only('create','store');
        $this->middleware('can:categorias.destroy')->only('destroy');
    }
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('texto'));
            $categorias = DB::table('categorias')
                ->where('nombre', 'LIKE', '%' . $query . '%')
                ->orWhere('descripcion', 'LIKE', '%' . $query . '%')  // Línea agregada
                ->orderBy('id', 'desc')
                ->paginate(7);
            return view('categorias.index', ["categorias" => $categorias, "texto" => $query]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:255'],
        ]);
        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'La categoría se registró correctamente');
        return redirect()->route('categorias.index');
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
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', [
            'categoria' => $categoria
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validar datos
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);
        // 2. Buscar categoría
        $categoria = Categoria::find($id);
        // 3. Actualizar campos
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
        // 4. Guardar cambios
        $categoria->save();
        // Redireccionar con mensaje de éxito
        session()->flash('mensaje', 'La categoría se actualizó correctamente');
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categoria::find($id)->delete();
        return redirect()->route('categorias.index');

        /* en el caso de cambiar el estado seria: */
        /*
        $categoria = Categoria::find($id);
        $categoria->estado = 0;
        $categoria->save();
         */
    }
}
