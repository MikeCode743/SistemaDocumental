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
        categoria: 'Acad??micos Administrativos',
        asuntos: [
          'Inscripci??n Extempor??nea',
          'Inscripci??n Del PERA',
          'Recuperaci??n Calidad Egresado',
          'Pr??rroga Calidad Egreso',
          'Ratificaci??n Dictamen Equivalencia',
          'Retiro Asignaturas Extempor??neas',
          'Modificaci??n Acdo Cambio De Carrera',
          'Ingreso General',
          'Ingreso Por Calificaci??n Socioecon??mica',
          'Ingreso Por Excelencia Acad??mica',
          'Ingreso Empleados O Hijos De Empleados',
          'Pr??rroga Finalizaci??n Trabajo De Grado',
          'Ratificaci??n Notas Parciales Y Finales Trabajo De Grado',
          'Nombramiento Tribunal Calificador Trabajo De Grado',
          'Nombramiento Docente Asesor De Trabajo De Grado',
          'Inscripci??n De Trabajo De Grado',
          'Ratificaci??n De Tema Trabajo De Grado',
          'Diploma De Reconocimiento',
          'Beca Por Excelencia Acad??mica',
          'Cuarta Matr??cula',
          'Oferta Acad??mica Y Calendarizaci??n',
          'Ampliaci??n De Oferta Acad??mica',
          'Revisi??n De Carga Acad??mica',
          'Dejar Sin Efecto Acuerdo',
          'Cursos Acad??micos',
          'Eventos Acad??micos',
          'Otros (Casos Especiales)',
          'Nombramiento Representantes Docentes En Comit?? De Ingreso Universitario',
          'Revisi??n De Acuerdo De Junta Directiva',
        ],
      },
      {
        categoria: 'Administrativo Financieros',
        asuntos: [
          'Solicitud De Respuesta',
          'Ratificaci??n Toma De Posesi??n',
          'Contrataci??n Por Servicios Personales De Car??cter Permanente Con Reserva De Plaza',
          'Contrataci??n Por Servicios Personales De Car??cter Eventual',
          'Contrataci??n Por Servicios Personales De Car??cter Temporal',
          'Contrataci??n Por Servicios Profesionales De Car??cter Eventual',
          'Contrataci??n Servicios Profesionales No Personales A Cuarto De Tiempo',
          'Contrataci??n Servicios Profesionales No Personales',
          'Contrataci??n Servicios Profesionales No Personales Hora Clase',
          'Contrataci??n En Tiempo Adicional',
          'Contrataci??n En Tiempo Integral',
          'Pasivo Laboral',
          'Taller Y Financiamiento',
          'Ratificaci??n Acuerdo De Decanato',
          'Congresos',
          'Revisi??n De Acuerdo De Junta Directiva',
          'Cursos',
          'Cancelaci??n Deuda A Librer??a Universitaria',
          'Modificaci??n De Acuerdo De JD',
        ],
      },
      {
        categoria: 'Misiones Oficiales',
        asuntos: [
          'Reconsideraci??n De Acuerdo De JD',
          'Permiso Y Misi??n Oficial',
          'Permiso Con Goce De Sueldo Y Misi??n Oficial',
          'Permiso Con Goce De Sueldo Y Misi??n Oficial Y Financiamiento',
          'Permiso Sin Goce De Sueldo Y Misi??n Oficial',
          'Permiso, Misi??n Oficial Y Financiamiento',
          'Misi??n Oficial Y Financiamiento',
          'Permiso Con Goce De Sueldo, Beca Y Tr??mites',
          'Toma De Posesi??n Del Cargo Posterior A MO',
        ],
      },
      {
        categoria: 'Funcionamiento',
        asuntos: [
          'Reconsideraci??n De Contrataci??n',
          'Toma De Posesi??n Del Cargo Posterior A MO',
          'Horarios De Permanencia Docentes',
          'Validaci??n De Permisos Personales',
          'Horarios Acad??micos De Docentes',
          'Apertura De Expediente Disciplinario',
          'Informe De Evaluaci??n Docente (CACPA)',
          'Exoneraci??n De Cuotas',
          'Limpieza Y Oficios Varios',
          'Criterios Para Selecci??n De Aspirantes',
          'Expediente De Investigaci??n',
          'Expediente Identificado',
          'Investigaciones',
          'Docente Ausente En Clases',
          'Recurso De Revisi??n De Acuerdo De JD',
          'Resoluci??n Conciliatoria',
          'Modificaci??n De Acuerdo',
          'Correcci??n De Acuerdo De JD',
          'Recepci??n De Donaci??n',
          'Descargo De Bienes',
          'Lineamientos De Planificaci??n De Servicio Acad??mico',
          'Medidas Habilitaci??n De Marcaje Online',
          'Medidas Habilitaci??n De Expediente Online',
          'Virtualizaci??n De Contenidos',
        ],
      },
      {
        categoria: 'Denuncias',
        asuntos: [
          'Apertura Informativo Administrativo Disciplinario',
          'Audiencia ??nica',
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
