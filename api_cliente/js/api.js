let timeout = null;

async function buscarDocentes() {
    const search = document.getElementById('search').value.trim();
    const token = document.getElementById('token').value;
    const resultadosDiv = document.getElementById('resultados');

    // Limpiar resultados si el campo está vacío
    if (!search) {
        resultadosDiv.innerHTML = '';
        return;
    }

    // Mostrar loading
    resultadosDiv.innerHTML = `
        <div class="loading">
            <i class="fas fa-spinner fa-spin"></i> Buscando docentes...
        </div>
    `;

    // Cancelar la búsqueda anterior si existe
    if (timeout) {
        clearTimeout(timeout);
    }

    // Esperar 500ms después de que el usuario deje de escribir
    timeout = setTimeout(async () => {
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
                        <i class="fas fa-search"></i> No se encontraron docentes con el criterio: "<strong>${search}</strong>"
                    </div>
                `;
                return;
            }

            let html = '';
            data.data.forEach(docente => {
                // Resaltar las coincidencias en los resultados
                const highlight = (text) => {
                    if (!text) return '';
                    const regex = new RegExp(search, 'gi');
                    return text.replace(regex, match => `<mark>${match}</mark>`);
                };

                html += `
                    <div class="docente-card">
                        <h3>
                            <i class="fas fa-chalkboard-teacher"></i>
                            ${highlight(docente.nombres)} ${highlight(docente.apellidos)}
                        </h3>
                        <div class="carrera">
                            <i class="fas fa-graduation-cap"></i> ${docente.carrera_nombre}
                        </div>
                        <div class="especialidad">
                            <i class="fas fa-book"></i> ${highlight(docente.especialidad || 'Sin especialidad asignada')}
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
    }, 500); // Esperar 500ms
}
