const barras = document.querySelectorAll('.barra-minecraft');

barras.forEach(barra => {

    const nivel = barra.dataset.xp;

    for(let i = 1; i <= 10; i++){

        const bloque = document.createElement('span');

        bloque.classList.add('xp');

        if(i <= nivel){
            bloque.classList.add('activo');
        }

        barra.appendChild(bloque);

    }

});