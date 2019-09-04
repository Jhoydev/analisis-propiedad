<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Analisis de propiedad</title>
    <link rel="stylesheet" href="css/utilidades.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container">
        <main>
            <h1>Analisis de Propiedad</h1>
            <div class="busqueda-parametros">
                <div id="mensaje-alerta">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <div></div>
                </div>
                <div class="d-flex">
                    <div class="grupo-input">
                        <label for="tipo">Tipo Propiedad</label>
                        <label class="input-select" for="tipo">
                            <select id="tipo">
                                <option value="piso">Piso</option>
                                <option value="apartamento">Apartamento</option>
                            </select>
                        </label>
                    </div>
                    <div class="grupo-input">
                        <label for="operacion">Operacion</label>
                        <label class="input-select" for="operacion">
                            <select id="operacion">
                                <option value="buy">Venta</option>
                                <option value="rent">Alquiler</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="d-flex busqueda-localizacion">
                    <div class="grupo-input">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" id="ciudad">
                    </div>
                    <div class="grupo-input">
                        <label for="calle">Calle</label>
                        <input type="text" id="calle" placeholder="Calle y numero">
                    </div>
                    <div class="grupo-input">
                        <label for="cp">Codigo Postal</label>
                        <input type="text" id="cp">
                    </div>
                </div>
            </div>
            <div class="busqueda-opciones">
                <div class="busqueda-origen">
                    <p>Origen de datos</p>
                    <div>
                        <input type="checkbox" value="externas" id="externas">
                        <label for="externas">Propiedades Externas</label>
                    </div>
                    <div>
                        <input type="checkbox" value="mis_propiedades" id="mis_propiedades" disabled>
                        <label for="mis_propiedades">Mis propiedades</label>
                    </div>
                    <div>
                        <input type="checkbox" value="mls" id="mls" disabled>
                        <label for="mls">MLS</label>
                    </div>
                </div>
                <div class="busqueda-filtros">
                    <p>Filtros</p>
                    <div>
                        <input class="keywords" type="checkbox" value="ascensor" id="ascensor">
                        <label for="ascensor">Ascensor</label>
                    </div>
                    <div>
                        <input class="keywords" type="checkbox" value="balcony" id="balcon">
                        <label for="balcon">Balcon</label>
                    </div>
                </div>
            </div>
            <div>
                <button id="btn_buscar" type="button" class="btn btn-azul">Cargar</button>
            </div>
            <p id="mapa-detalle"></p>
            <div id="map"></div>
        </main>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="https://maps.cercalia.com/maps/loader.js?key=07de1b67aa00baf5f1284298f88132e3914e4fb380fce9d91c815aa372fe67c4&v=5&lang=es&theme=1976d2"></script>
    <script src="js/acm.js"></script>
    <script>
        document.addEventListener('cercalia-ready', init);
    </script>
</body>
</html>