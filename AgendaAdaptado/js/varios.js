function evalua(oNombre, oApePat, rbSexo, oFecha){
var sErr="";
var bRet = false;

	if (oNombre.disabled==false && oNombre.value=="")
		sErr= sErr + "\n Falta nombre";

	if (oApePat.disabled==false && oApePat.value=="")
		sErr= sErr + "\n Falta apellido paterno";

	if (rbSexo[0].checked==false && rbSexo[1].checked==false)
		sErr= sErr + "\n Falta indicar sexo";

	if (oFecha.disabled==false && oFecha.value=="")
		sErr= sErr + "\n Falta fecha de nacimiento";
	
	if (sErr == "")
		bRet = true;
	else
		alert(sErr);
	
	return bRet;
}

function mostrarPopup(accion, callbackAceptar) {
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(70, 69, 69, 0.6)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;
    

    const popup = document.createElement('div');
    popup.style.background = 'linear-gradient(135deg,rgb(52, 50, 50), #f0f0f0)';
    popup.style.padding = '30px';
    
    popup.style.borderRadius = '15px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.3)';
    popup.style.width = '400px';
    popup.style.fontFamily = '"Segoe UI", Tahoma, Geneva, Verdana, sans-serif';

    const message = document.createElement('p');
    message.style.fontSize = '18px';
    message.style.marginBottom = '20px';
    message.style.color = '#ffffff';
    message.style.fontWeight = 'bold';
    message.style.backgroundColor = '#d07225';
    message.style.borderRadius = '15px';

    if (accion === 'eliminar') {
        message.textContent = '¿Estás seguro de que deseas eliminar este contacto?';
    } else if (accion === 'actualizar') {
        message.textContent = '¿Estás seguro de que deseas modificar este contacto?';
    } else {
        message.textContent = '¿Estás seguro de realizar esta acción?';
    }

    const imagen = document.createElement('img');
    imagen.src = 'img/agenda1.png';
    imagen.alt = 'confirmación';
    imagen.width = 150;
    imagen.style.marginBottom = '15px';
    imagen.style.borderRadius = '10px';

    const buttonContainer = document.createElement('div');
    buttonContainer.style.display = 'flex';
    buttonContainer.style.justifyContent = 'center';
    buttonContainer.style.gap = '20px';

    const buttonAceptar = document.createElement('button');
    buttonAceptar.textContent = 'Confirmar';
    buttonAceptar.style.backgroundColor = '#d07225';
    buttonAceptar.style.color = '#fff';
    buttonAceptar.style.border = 'none';
    buttonAceptar.style.padding = '10px 20px';
    buttonAceptar.style.borderRadius = '8px';
    buttonAceptar.style.cursor = 'pointer';
	buttonAceptar.style.marginRight = '20px'; // Espacio entre botones
    buttonAceptar.style.fontSize = '16px';

    const buttonCancelar = document.createElement('button');
    buttonCancelar.textContent = 'Cancelar';
    buttonCancelar.style.backgroundColor = '#f44336';
    buttonCancelar.style.color = '#fff';
    buttonCancelar.style.border = 'none';
    buttonCancelar.style.padding = '10px 20px';
    buttonCancelar.style.borderRadius = '8px';
    buttonCancelar.style.cursor = 'pointer';
    buttonCancelar.style.fontSize = '16px';

    // Evento para aceptar: ejecuta el callback
    buttonAceptar.addEventListener('click', function () {
        document.body.removeChild(overlay);
        if (typeof callbackAceptar === 'function') {
            callbackAceptar();
        }
    });

    // Evento para cancelar: solo cierra el popup
    buttonCancelar.addEventListener('click', function () {
        document.body.removeChild(overlay);
    });

    popup.appendChild(imagen);
    popup.appendChild(message);
    popup.appendChild(buttonAceptar);
    popup.appendChild(buttonCancelar);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
}
function confirmarAccion(id, operacion) {
    let accion = '';
    if (operacion === 'b') {
        accion = 'eliminar';
    } else if (operacion === 'm') {
        accion = 'actualizar';
    } else {
        accion = 'accion';
    }

    mostrarPopup(accion, function () {
        document.formTablaGral.txtClave.value = id;
        document.formTablaGral.txtOpe.value = operacion;
        document.formTablaGral.submit();
    });
}