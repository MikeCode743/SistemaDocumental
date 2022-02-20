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

    <title>Repositorio Acta</title>
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

          <template x-for="temporada in catalogoFiltrado">
            <div class="card mt-2">
              <div
                class="card-header bg-dark text-white d-flex justify-content-between align-items-center"
                @click="temporada.isOpen = !temporada.isOpen">
                <p x-text="temporada.temporada" class="my-0"></p>
                <i
                  :class="temporada.isOpen ? 'bi bi-chevron-compact-up':'bi bi-chevron-compact-down'"></i>
              </div>
              <ul
                class="list-group list-group-flush"
                x-show="temporada.isOpen"
                x-transition>
                <template x-for="acta in temporada.actas" :key="acta">
                  <li
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                    x-text="acta"
                    @click="cargarContenedor(acta)"></li>
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
          <div id="contenedor-listado-detalle"></div>
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
            <div class="modal-body"></div>
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
        temporada: '2012-2014',
        actas: ['qwe', 'rty', 'uio'],
        isOpen: false,
      },
      {
        temporada: '2015-2017',
        actas: ['asd', 'fgh', 'jkl'],
        isOpen: false,
      },
      {
        temporada: '2018-2020',
        actas: ['zxc', 'vbn', 'nm'],
        isOpen: false,
      },
    ];

    document.addEventListener('alpine:init', () => {
      Alpine.data('repositorio', () => ({
        catalogo,
        inputBusqueda: '',
        idCategoria: '',
        isLoading : false,

        cargarContenedor(value) {
          this.idCategoria = value;
          this.isLoading= true;
          $("#contenedor-listado-detalle").empty().load( window.location.href+"/detalle/"+value, () => {
            this.isLoading = false;
          });
        },

        get catalogoFiltrado() {
          const input = this.inputBusqueda.trim();

          if (!input) {
            return this.catalogo.map((e) => ({ ...e, isOpen: false }));
          }

          const categoriaFiltrada = [];
          this.catalogo.forEach(({ temporada, actas }) => {
            const matchCatalogo = actas.filter((nombre) =>
              nombre.match(new RegExp(input, 'i'))
            );
            if (matchCatalogo.length) {
              categoriaFiltrada.push({
                temporada,
                isOpen: true,
                actas: matchCatalogo,
              });
            }
          });

          return categoriaFiltrada;
        },
      }));
    });
  </script>
</html>
