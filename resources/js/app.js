import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: false,
    //dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    //Sirve para ejecutar una funcion una vez se haya creado dropzone
    init: function(){
        /*
            Si el path de la imagen existe pero no se muestra la imagen
            busca en el servidor para luego mostrarlo a la vista
        */
        if( document.querySelector('[name="imagen"]').value.trim() ) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call( this, imagenPublicada );
            this.options.thumbnail.call( this, imagenPublicada, `/uploads/${imagenPublicada.name}` );
            
            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }

});

dropzone.on('success', function(file, response){
    //console.log(response.imagen);
    document.querySelector('[name="imagen"]').value  = response.imagen;
});

dropzone.on('removedfile', function(){
    //Pasarle vacio como valor al campo
    document.querySelector('[name="imagen"]').value  = " ";
 });