let btn_cargar = document.getElementById('btn_cargar_usuarios'),
    error_box = document.getElementById('error_box'),
    tabla = document.getElementById('tabla'),
    loader = document.getElementById('loader');

let usuario_nombre,
    usuario_edad,
    usuario_pais,
    usuario_correo;

// Lista los Usuarios
const cargarUsuarios = () => {

    tabla.innerHTML = ('<tr><th>ID</th><th>Nombre</th><th>Edad</th><th>Pais</th><th>Correo</th><th>Acciones</th></tr>');

    let peticion = new XMLHttpRequest();
    peticion.open('GET', 'php/listaUsuario.php');

    loader.classList.add('active');

    peticion.onload = () => {

        let datos = JSON.parse(peticion.responseText);
        if ( datos.error ) {

            error_box.classList.add('active');

        } else {

            for ( let i = 0; i < datos.length; i++ ) {
    
                let element = document.createElement('tr');
                element.innerHTML += ("<td>" + datos[i].id + "</td>");
                element.innerHTML += ("<td>" + datos[i].nombre + "</td>");
                element.innerHTML += ("<td>" + datos[i].edad + "</td>");
                element.innerHTML += ("<td>" + datos[i].pais + "</td>");
                element.innerHTML += ("<td>" + datos[i].correo + "</td>");
                element.innerHTML += ("<td><button onclick='verUsuarios("+datos[i].id+")'' type='button' class='btn active'><span class='user'></span></button><button onclick='bajaUsuarios("+datos[i].id+")'' type='button' class='btn active' style='background: #c40018;'><span class='close'></span></button></td>");
                tabla.appendChild(element);
    
            }

        }

    };

    peticion.onreadystatechange = () => {
        ( peticion.readyState == 4 && peticion.status == 200 ) ? loader.classList.remove('active') : '';
    }

    peticion.send();

}

// Lista los Usuarios
const verUsuarios = (id) => {

    (document.getElementById('modificar')).removeAttribute("hidden","true");

    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'php/verUsuario.php');
    
    loader.classList.add('active');
    
    let parametros = 'id='+ id;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    loader.classList.add('active');
    
    peticion.onload = () => {
        let datos = JSON.parse(peticion.responseText);
        if ( datos.error ) {
            
            error_box.classList.add('active');
            
        } else {
            
            // (document.getElementById('modificar')).setAttribute("hidden","false");;
            (document.getElementById('principal')).setAttribute("hidden","true");;
            document.getElementById('id').value = datos.id;
            document.getElementById('nombre_m').value = datos.nombre;
            document.getElementById('edad_m').value = datos.edad;
            document.getElementById('pais_m').value = datos.pais;
            document.getElementById('correo_m').value = datos.correo;            

        }

    };

    peticion.onreadystatechange = () => {
        ( peticion.readyState == 4 && peticion.status == 200 ) ? loader.classList.remove('active') : '';
    }

    peticion.send(parametros);

}


// -- ABM --

// Alta de Usuarios
const agregarUsuarios = (e) => {

    e.preventDefault();

    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'php/altaUsuario.php');

    usuario_nombre = formulario.nombre.value.trim();
    usuario_edad = parseInt(formulario.edad.value.trim());
    usuario_pais = formulario.pais.value.trim();
    usuario_correo = formulario.correo.value.trim();

    if ( usuario_edad != '' && usuario_nombre != '' && usuario_pais != '' && usuario_correo != '' ) {

        error_box.classList.remove('active');
        let parametros = 'nombre='+ usuario_nombre + '&edad='+ usuario_edad + '&pais='+ usuario_pais + '&correo='+ usuario_correo;
        
        peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        loader.classList.add('active');

        peticion.onload = () => {

            let datos = JSON.parse(peticion.responseText);

            if ( datos.error ) {

                error_box.classList.add('active');
                error_box.innerHTML = 'Por favor completa el formulario correctamente';

            } else {

                //cargo grilla
                cargarUsuarios();
                //reseteo form
                formulario.nombre.value = '';
                formulario.edad.value = '';
                formulario.pais.value = '';
                formulario.correo.value = '';

            }

        }

        peticion.onreadystatechange = () => {

            ( peticion.readyState == 4 && peticion.status == 200 ) ? loader.classList.remove('active') : '';
            
        }

        peticion.send(parametros);

    } else {

        error_box.classList.add('active');
        error_box.innerHTML = 'Por favor completa el formulario correctamente';
        
    }

}

// Baja de Usuarios
const bajaUsuarios = (id) => {

    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'php/bajaUsuario.php');
    
    loader.classList.add('active');
    
    let parametros = 'id='+ id;
    peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    loader.classList.add('active');
    
    peticion.onload = () => {

        let datos = JSON.parse(peticion.responseText);

        if ( datos.error ) {
            
            error_box.classList.add('active');
            
        } else {
            
            cargarUsuarios();

        }

    };

    peticion.onreadystatechange = () => {
        ( peticion.readyState == 4 && peticion.status == 200 ) ? loader.classList.remove('active') : '';
    }

    peticion.send(parametros);


}

// Modificación de Usuarios
const modificarUsuarios = (e) => {

    e.preventDefault();

    let peticion = new XMLHttpRequest();
    peticion.open('POST', 'php/modificarUsuario.php');
    
    let id_m =  parseInt(document.getElementById('id').value);
    let usuario_nombre_m = (document.getElementById('nombre_m').value);
    let usuario_edad_m = parseInt((document.getElementById('edad_m').value));
    let usuario_pais_m = (document.getElementById('pais_m').value);
    let usuario_correo_m = (document.getElementById('correo_m').value);

    if ( id_m != '' && usuario_edad_m != '' && usuario_nombre_m != '' && usuario_pais_m != '' && usuario_correo_m != '' ) {

        error_box.classList.remove('active');
        let parametros = 'id='+ id_m + '&nombre='+ usuario_nombre_m + '&edad='+ usuario_edad_m + '&pais='+ usuario_pais_m + '&correo='+ usuario_correo_m;

        peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        loader.classList.add('active');

        peticion.onload = () => {

            let datos = JSON.parse(peticion.responseText);

            if ( datos.error ) {

                error_box.classList.add('active');
                error_box.innerHTML = 'Por favor completa el formulario correctamente';

            } else {

                //cargo grilla
                cargarUsuarios();
                //reseteo form
                document.getElementById('id').value = '';
                document.getElementById('nombre_m').value = '';
                document.getElementById('edad_m').value = '';
                document.getElementById('pais_m').value = '';
                document.getElementById('correo_m').value = '';
                document.getElementById('principal').removeAttribute("hidden","true");
                document.getElementById('modificar').setAttribute("hidden","true");

            }

        }

        peticion.onreadystatechange = () => {
            
            ( peticion.readyState == 4 && peticion.status == 200 ) ? loader.classList.remove('active') : '';
            
        }

        peticion.send(parametros);

    } else {
        
        error_box.classList.add('active');
        error_box.innerHTML = 'Por favor completa el formulario correctamente';

    }

};

// -- BOTONES --

// Lista los Usuarios
btn_cargar.addEventListener('click', function(){
    cargarUsuarios();
});

// Submit Alta de Usuario
formulario.addEventListener('submit', function(e){
    agregarUsuarios(e);
});

// Submit Modificación de Usuarios
document.getElementById('formulario_m').addEventListener('submit', function (e){
    modificarUsuarios(e);
});



