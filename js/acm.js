const url = 'http://lb.cercalia.com/services/json?';
var map;
var marker;
var baseLayer;
var propiedades = null;

function init() {
    var myPosition = new cercalia.LonLat( -0.0000000,00.0000);
    map = new cercalia.Map({
        target:'map',
        controls: [],
        center: myPosition,
        zoom: 17
    });
    var arrayMarkers = [];
    var myMarker = new cercalia.Marker({
        position: myPosition
    });
    //Añadimos markers al mapa
    map.addMarkers(arrayMarkers);
    map.enableClustering();
}

$('#btn_buscar').click((ev)=>{

    if (document.querySelector('#ciudad').value == ''){
        document.querySelector('#ciudad').focus();
        return mostrarAlerta('Ciudad Obligatoria');
    }

    // Fiiltros
    let operacion = document.querySelector('#operacion').value;
    let tipo = document.querySelector('#tipo').value;

    // Keywords
    let keywords = [];
    let getkeywords = document.querySelectorAll('.keywords:checked');
    for (let i = 0; i < getkeywords.length; i++) {
        keywords.push(getkeywords[i].value);
    }

    let filtros = {
        operacion,tipo,keywords
    };

    // Localizacion
    let ctryc = 'esp';
    let ctn = document.querySelector('#ciudad').value;
    let pcode = document.querySelector('#cp').value;
    let adr = document.querySelector('#calle').value;

    let localizacion = {
        ctryc, ctn, pcode, adr
    };
    ocultarPropiedades();
    getDatos(localizacion, filtros);
});

async function getDatos(localizacion, filtros){
    let coordenadas = await getCoordenadas(localizacion.ctryc, localizacion.ctn, localizacion.pcode, localizacion.adr);
    coord = getCercaliaCoordenadas(coordenadas);
    let prop = await getPropiedades(coord, filtros);
    map.setCenter(new cercalia.LonLat(coord.x,coord.y));
    if (prop.estado == 'ok'){
        propiedades = prop.response.response.listings;
        mostrarPropiedades();
    }
    if(prop.estado == 'error'){
        console.log(prop.mensaje)
    }
}

function getPropiedades(coordenadas, filtros){
    let data = {
        coordenadas: coordenadas,
        filtros
    };
    return $.get('getPropiedades.php',data);
}

function getCercaliaCoordenadas(coordenadas){
    if (coordenadas.cercalia.candidates && coordenadas.cercalia.candidates.candidate) {
        var candidate = coordenadas.cercalia.candidates.candidate[0];
        document.querySelector('#mapa-detalle').innerHTML = candidate.desc;
        return candidate.ge.coord;
    }
}

function getCoordenadas(ctryc, ctn, pcode, adr) {
    if (adr.length > 0 || ctn.length > 0 || pcode.length > 0) {
        var params = {
            key: 'xxxxxxxxxxxxxxx',
            cmd: 'cand',
            detcand: 1,
            mode: 1,
            ctryc: ctryc,
            ctn: ctn,
            pcode: pcode,
            adr: adr
        };
        return $.ajax({url: url, data: params});
    }
}

function mostrarPropiedades(){
    var arrayMarkers = [];
    for (p of propiedades){
        arrayMarkers.push(crearMarker(p));
    }
    map.addMarkers(arrayMarkers);
}

function ocultarPropiedades() {
    map.removeAllMarkers();
}

function crearMarker(p){
    return new cercalia.Marker({
        id: p.cod_ofer,
        position: new cercalia.LonLat( p.longitude,p.latitude)
    })
}

function mostrarAlerta(texto){
    document.querySelector('#mensaje-alerta div').textContent = texto;
    document.querySelector('#mensaje-alerta').style.display = 'block';
}

