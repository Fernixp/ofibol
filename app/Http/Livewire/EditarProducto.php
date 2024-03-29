<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Origen;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarProducto extends Component
{
    public $producto_id; /* Nueo nombre interno para nuestro componente para no tener problemas de nombre con livewire */
    public $categoria;
    public $origen;
    public $marca;
    public $nombre;
    public $stock_minimo;
    public $descripcion;
    public $unidad_medida;
    public $cantidad_unidad;
    public $costo_actual;
    public $porcentaje_margen;
    public $precio_venta;
    public $imagen;
    public $imagen_nueva;
    public $barcode;
    use WithFileUploads;

    public function rules()
    {
        return [
            'barcode' => 'required|numeric||unique:productos,barcode,' . $this->producto_id,
            'descripcion' => 'required|string',
            'marca' => 'required|exists:marcas,id',
            'origen' => 'required|exists:origenes,id',
            'unidad_medida' => 'required|string',
            'cantidad_unidad' => 'nullable|numeric|min:0',
            'stock_minimo' => 'required|numeric|min:0',
            'costo_actual' => 'nullable|numeric|min:0',
            'porcentaje_margen' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'categoria' => 'required|exists:categorias,id',
            'imagen_nueva' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
    /* creando un ciclo de vida de producto */
    public function mount(Producto $producto)
    {
        $this->producto_id = $producto->id;
        $this->categoria = $producto->categoria_id;
        $this->origen = $producto->origen_id;
        $this->marca = $producto->marca_id;
        $this->barcode = $producto->barcode;
        $this->stock_minimo = $producto->stock_minimo;
        $this->descripcion = $producto->descripcion;
        $this->unidad_medida = $producto->unidad_medida;
        $this->cantidad_unidad = $producto->cantidad_unidad;
        $this->costo_actual = $producto->costo_actual;
        $this->porcentaje_margen = $producto->porcentaje_margen;
        $this->precio_venta = $this->costo_actual + ($this->costo_actual * $this->porcentaje_margen / 100);
        $this->imagen = $producto->imagen;
    }

    public function editarProducto()
    {
        $datos = $this->validate();
        //si hay una nueva imagen
        if ($this->imagen_nueva) {
            $imagen = $this->imagen_nueva->store('public/productos');
            /* Aca almacenamos solo el nombre de la imagen en datos */
            $datos['imagen'] = str_replace('public/productos/', '', $imagen);
        }
        

        //Encontrar el producto a editar
        $producto = Producto::find($this->producto_id);
        //Asignar los valores
        $producto->categoria_id = $datos['categoria'];
        $producto->origen_id = $datos['origen'];
        $producto->marca_id = $datos['marca'];
        $producto->barcode = $datos['barcode'];
        $producto->stock_minimo = $datos['stock_minimo'];
        $producto->descripcion = $datos['descripcion'];
        $producto->unidad_medida = $datos['unidad_medida'];
        $producto->cantidad_unidad = $datos['cantidad_unidad'];
        $producto->costo_actual = $datos['costo_actual'];
        $producto->porcentaje_margen = $datos['porcentaje_margen'];
        $producto->precio_venta = $datos['costo_actual']*($datos['porcentaje_margen']/100) + $datos['costo_actual'];
       
        /* Aca reescribimos, pero comprobamos si el usuario subio una nueva imagen asignamos el valor de producto y si no la misma imagen que tiene almacenada */
        $producto->imagen = $datos['imagen'] ?? $producto->imagen;
        //Guardar la vacante
        $producto->save();
        //Crear un mensaje
        session()->flash('mensaje', 'El producto se actualizó correctamente');
        //Redireccionar al usuario
        return redirect()->route('productos.index');
    }



     public function updated($field)
    {
        if ($field === 'costo_actual' || $field === 'porcentaje_margen') {
            $this->calcularPrecioVenta();
        }
    }

    public function calcularPrecioVenta()
    {
        if ($this->costo_actual && $this->porcentaje_margen) {
            $this->precio_venta = $this->costo_actual + ($this->costo_actual * $this->porcentaje_margen / 100);
        }
    }
    public function generarBarcode(){
        // Generar un número aleatorio como código de barras (puedes ajustarlo según tus necesidades)
        $codigoGenerado = rand(100000000, 999999999);
    
        // Mostrar el código de barras generado
        $this->barcode = $codigoGenerado;
    }
    public function render()
    {

        /* Consultar BD*/
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $origenes = Origen::all();
        $almacenes = Almacen::all();
        return view('livewire.editar-producto', [
            'categorias' => $categorias,
            'marcas' => $marcas,
            'origenes' => $origenes,
            'almacenes' => $almacenes
        ]);
    }
}
