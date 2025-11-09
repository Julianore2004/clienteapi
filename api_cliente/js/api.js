async function buscarDocentes() {
    const search = document.getElementById('search').value;
    const token = document.getElementById('token').value;
    const resultadosDiv = document.getElementById('resultados');

    if (!search.trim()) {
        Swal.fire({
            icon: 'warning',
            title: 'Advertencia',
            text: 'Ingrese un nombre o apellido para buscar.',
            confirmButtonColor: '#667eea'
        });
        return;
    }

    resultadosDiv.innerHTML = `
        <div class="loading">
            <i class="fas fa-spinner fa-spin"></i> Buscando docentes...
        </div>
    `;

    try {
        const formData = new FormData();
        formData.append('token', token);
        formData.append('search', search);

        const response = await fetch('api_handler.php?action=buscarDocentes', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (!data.status) {
            Swal.fire({
                icon: data.type || 'error',
                title: data.type === 'error' ? 'Error' : 'Advertencia',
                text: data.msg,
                confirmButtonColor: '#667eea'
            });
            resultadosDiv.innerHTML = '';
            return;
        }

        if (data.data.length === 0) {
            resultadosDiv.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-search"></i> No se encontraron docentes con ese criterio.
                </div>
            `;
            return;
        }

        let html = '';
        data.data.forEach(docente => {
            html += `
                <div class="docente-card">
                    <h3>
                        <i class="fas fa-chalkboard-teacher"></i>
                        ${docente.nombres} ${docente.apellidos}
                    </h3>
                    <div class="carrera">
                        <i class="fas fa-graduation-cap"></i> ${docente.carrera_nombre}
                    </div>
                    <div class="especialidad">
                        <i class="fas fa-book"></i> ${docente.especialidad || 'Sin especialidad asignada'}
                    </div>
                </div>
            `;
        });

        resultadosDiv.innerHTML = html;

    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al buscar los docentes.',
            confirmButtonColor: '#667eea'
        });
        resultadosDiv.innerHTML = '';
    }
}
