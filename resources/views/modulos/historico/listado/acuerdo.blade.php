<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous" />

    <title>Repositorio Acuerdo</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" />
      <script
      defer
      src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
    <style>
      .maxsize {
        height: 95vh;
        overflow-y: scroll;
      }
      .hover-info:hover {
        cursor: pointer;
        color: rgb(55, 172, 180);
      }
    </style>
  </head>
  <body class="bg-light" x-data="repositorio">
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-6 col-md-4 border-right maxsize">
          <input
            type="text"
            class="form-control mt-1"
            placeholder="Buscar"
            x-model="inputBusqueda" />

          <template x-for="c in catalogoFiltrado">
            <div class="card mt-2">
              <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center"
                @click="c.isOpen = !c.isOpen">
                <p x-text="c.categoria" class="my-0"></p>
                <i
                  :class="c.isOpen ? 'bi bi-chevron-compact-up':'bi bi-chevron-compact-down'"></i>
              </div>
              <ul
                class="list-group list-group-flush"
                x-show="c.isOpen"
                x-transition>
                <template x-for="asunto in c.detalle" :key="asunto.nombre">
                  <li
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    x-html="asunto.html"
                    @click="cargarContenedor(asunto.nombre)"></li>
                </template>
              </ul>
            </div>
          </template>
        </div>

        <div class="col-6 col-sm-6 col-md-8">
          <div class="progress" x-show="isLoading">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
          </div>
          <p class="h3" x-text="idCategoria"></p>
          <div id="contenedor">
          </div>
        </div>

      </div>

      <div
        id="modalItemInfo"
        class="modal fade bd-example-modal-lg"
        tabindex="-1"
        role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Identificador de documento</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body"></div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script>
    let catalogo = [
      {
        categoria: 'Académicos Administrativos',
        asuntos: [
          'Inscripción Extemporánea',
          'Inscripción Del PERA',
          'Recuperación Calidad Egresado',
          'Prórroga Calidad Egreso',
          'Ratificación Dictamen Equivalencia',
          'Retiro Asignaturas Extemporáneas',
          'Modificación Acdo Cambio De Carrera',
          'Ingreso General',
          'Ingreso Por Calificación Socioeconómica',
          'Ingreso Por Excelencia Académica',
          'Ingreso Empleados O Hijos De Empleados',
          'Prórroga Finalización Trabajo De Grado',
          'Ratificación Notas Parciales Y Finales Trabajo De Grado',
          'Nombramiento Tribunal Calificador Trabajo De Grado',
          'Nombramiento Docente Asesor De Trabajo De Grado',
          'Inscripción De Trabajo De Grado',
          'Ratificación De Tema Trabajo De Grado',
          'Diploma De Reconocimiento',
          'Beca Por Excelencia Académica',
          'Cuarta Matrícula',
          'Oferta Académica Y Calendarización',
          'Ampliación De Oferta Académica',
          'Revisión De Carga Académica',
          'Dejar Sin Efecto Acuerdo',
          'Cursos Académicos',
          'Eventos Académicos',
          'Otros (Casos Especiales)',
          'Nombramiento Representantes Docentes En Comité De Ingreso Universitario',
          'Revisión De Acuerdo De Junta Directiva',
        ],
      },
      {
        categoria: 'Administrativo Financieros',
        asuntos: [
          'Solicitud De Respuesta',
          'Ratificación Toma De Posesión',
          'Contratación Por Servicios Personales De Carácter Permanente Con Reserva De Plaza',
          'Contratación Por Servicios Personales De Carácter Eventual',
          'Contratación Por Servicios Personales De Carácter Temporal',
          'Contratación Por Servicios Profesionales De Carácter Eventual',
          'Contratación Servicios Profesionales No Personales A Cuarto De Tiempo',
          'Contratación Servicios Profesionales No Personales',
          'Contratación Servicios Profesionales No Personales Hora Clase',
          'Contratación En Tiempo Adicional',
          'Contratación En Tiempo Integral',
          'Pasivo Laboral',
          'Taller Y Financiamiento',
          'Ratificación Acuerdo De Decanato',
          'Congresos',
          'Revisión De Acuerdo De Junta Directiva',
          'Cursos',
          'Cancelación Deuda A Librería Universitaria',
          'Modificación De Acuerdo De JD',
        ],
      },
      {
        categoria: 'Misiones Oficiales',
        asuntos: [
          'Reconsideración De Acuerdo De JD',
          'Permiso Y Misión Oficial',
          'Permiso Con Goce De Sueldo Y Misión Oficial',
          'Permiso Con Goce De Sueldo Y Misión Oficial Y Financiamiento',
          'Permiso Sin Goce De Sueldo Y Misión Oficial',
          'Permiso, Misión Oficial Y Financiamiento',
          'Misión Oficial Y Financiamiento',
          'Permiso Con Goce De Sueldo, Beca Y Trámites',
          'Toma De Posesión Del Cargo Posterior A MO',
        ],
      },
      {
        categoria: 'Funcionamiento',
        asuntos: [
          'Reconsideración De Contratación',
          'Toma De Posesión Del Cargo Posterior A MO',
          'Horarios De Permanencia Docentes',
          'Validación De Permisos Personales',
          'Horarios Académicos De Docentes',
          'Apertura De Expediente Disciplinario',
          'Informe De Evaluación Docente (CACPA)',
          'Exoneración De Cuotas',
          'Limpieza Y Oficios Varios',
          'Criterios Para Selección De Aspirantes',
          'Expediente De Investigación',
          'Expediente Identificado',
          'Investigaciones',
          'Docente Ausente En Clases',
          'Recurso De Revisión De Acuerdo De JD',
          'Resolución Conciliatoria',
          'Modificación De Acuerdo',
          'Corrección De Acuerdo De JD',
          'Recepción De Donación',
          'Descargo De Bienes',
          'Lineamientos De Planificación De Servicio Académico',
          'Medidas Habilitación De Marcaje Online',
          'Medidas Habilitación De Expediente Online',
          'Virtualización De Contenidos',
        ],
      },
      {
        categoria: 'Denuncias',
        asuntos: [
          'Apertura Informativo Administrativo Disciplinario',
          'Audiencia Única',
        ],
      },
    ];

    catalogo = catalogo.map(({ categoria, asuntos }) => {
      const detalle = asuntos.map((a, i) => {
        return {
          nombre: a,
          cantidad: i,
          html: `${a} <span class='badge badge-dark badge-pill'>${i}</span>`,
        };
      });
      return { categoria, isOpen: false, detalle };
    });

    document.addEventListener('alpine:init', () => {
      Alpine.data('repositorio', () => ({
        catalogo,
        inputBusqueda: '',
        idCategoria: '',
        isLoading: false,

        cargarContenedor(value) {
          this.idCategoria = value;
          this.isLoading= true;
          const param = encodeURIComponent(value)
          $("#contenedor").load(window.location.href+"/detalle/"+param, () => {
            this.isLoading = false;
          });
        },

        cargarTablaModal() {
          $('#modalItemInfo').modal('show');
          $('#modal-body').load(window.location.href+"/detalle-archivo/1");

          // fetch('http://127.0.0.1:8080/pages/components/detalleAcuerdo.html')
          //   .then((response) => {
          //     return response.text();
          //   })
          //   .then((html) => {
          //     // this.dataTable = html;
          //   });
        },

        get catalogoFiltrado() {
          const input = this.inputBusqueda.trim();

          if (!input) {
            return this.catalogo.map((e) => ({ ...e, isOpen: false }));
          }

          const categoriaFiltrada = [];
          this.catalogo.forEach(({ categoria, detalle }) => {
            const matchCatalogo = detalle.filter(({ nombre }) =>
              nombre.match(new RegExp(input, 'i'))
            );
            if (matchCatalogo.length) {
              categoriaFiltrada.push({
                categoria,
                isOpen: true,
                detalle: matchCatalogo,
              });
            }
          });

          return categoriaFiltrada;
        },

        abrirEnlace() {
          console.log('Click');
        },
      }));
    });
  </script>
</html>
