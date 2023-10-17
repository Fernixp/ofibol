<script>
    /* Inicializando un listener para la escuchar eventos del teclado */
    var listener = new window.keypress.Listener();
    /* F9 para guardar la venta */
    listener.simple_combo("f9", function() {
        /* Emitimos el evento */
        livewire.emit('guardarVenta');
    });

    listener.simple_combo("f8", function() {
        /* Limpiamos la cajja de texto y poner el foco */
        console.log('f8');
        livewire.emit('exacto');
    });

    listener.simple_combo("f4", function() {
        /* Cancelando la venta */
        console.log('f4')
        var total = parseFloat(document.getElementById('hiddenTotal').value);

        if (total > 0) {
            Confirm(0, 'clearCart', '¿DESEA ELIMINAR EL CARRITO?')
        } else {
            noty('AGREGA PRODUCTOS A LA VENTA')
        }
    });
</script>
