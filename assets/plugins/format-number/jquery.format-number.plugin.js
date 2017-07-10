/*
 * Da formato a un número para su visualización
 *
 * numero (Number o String) - Número que se mostrará
 * decimales (Number, opcional) - Nº de decimales (por defecto, auto)
 * separador_decimal (String, opcional) - Separador decimal (por defecto, coma)
 * separador_miles (String, opcional) - Separador de miles (por defecto, ninguno)
 */
(function($){
    $.fn.formatNumber = function(options){
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            decimal: 2,
            decimal_separator : ".",
            miles_sepatator : ","
        }, options );
        
        this.each(function(){
            $this = $(this);
            var number = $this.text();
            number = parseFloat(number);
            if(isNaN(number)){
                $this.text('0');
            }else{
                number=number.toFixed(settings.decimal);
                // Convertimos el punto en separador_decimal
                number=number.toString().replace(".", settings.decimal_separator!==undefined ? settings.decimal_separator : ",");
                if(settings.miles_sepatator){
                    // Añadimos los separadores de miles
                    var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
                    while(miles.test(number)) {
                        number=number.replace(miles, "$1" + settings.miles_sepatator + "$2");
                    }
                }
                $this.text(number);
            }                
        });
    }
})(jQuery)