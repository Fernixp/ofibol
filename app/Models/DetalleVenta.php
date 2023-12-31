<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';
    protected $fillable = [
        'precio',
        'cantidad',
        'producto_id',
        'venta_id',
    ];


    //Relaciones
    public function venta()
    {
        //pertenece a
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        //pertenece a
        return $this->belongsTo(Producto::class);
    }
}
