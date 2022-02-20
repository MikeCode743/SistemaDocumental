<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Temporada</title>
    <link
      rel="stylesheet"
      href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
    />

    <script
      defer
      src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/v/bs/jq-3.6.0/dt-1.11.3/r-2.2.9/datatables.min.css"
    />

    <script
      type="text/javascript"
      src="https://cdn.datatables.net/v/bs/jq-3.6.0/dt-1.11.3/r-2.2.9/datatables.min.js"
    ></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
      integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
      integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>

  <body>
    <div class="container" x-data="form">
      <div style="margin-top: 10px">
        <div class="row">
          <div class="col-lg-12">
            <h4 x-html="accionDelFormulario"></h4>
          </div>
        </div>

        <form
          :action="baseURLCreateOrUpdate"
          x-show="isCreateOrUpdateForm"
          @submit.prevent="handleSubmit"
          x-ref="createForm"
        >
          <input type="hidden" name="_token" x-model="_token" />
          <input type="hidden" name="id" x-model="formData.id" />

          <div class="row">
            <div class="col col-lg-6">
              <div
                class="form-group"
                :class="{'has-error' : formAlert.nombre_rector}"
              >
                <label class="control-label" for="nombre_rector">
                  Nombre del rector
                </label>
                <input
                  id="nombre_rector"
                  type="text"
                  class="form-control"
                  name="nombre_rector"
                  x-model.trim="formData.nombre_rector"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-6">
              <div
                class="form-group"
                :class="{'has-error' : formAlert.anio_inicio}"
              >
                <label class="control-label" for="anio_inicio">
                  Inicio de temporada
                </label>
                <input
                  id="anio_inicio"
                  type="text"
                  class="form-control"
                  name="anio_inicio"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-6">
              <div
                class="form-group"
                :class="{'has-error' : formAlert.anio_finalizacion}"
              >
                <label class="control-label" for="anio_finalizacion">
                  Finalización de la temporada
                </label>
                <input
                  id="anio_finalizacion"
                  type="text"
                  class="form-control"
                  name="anio_finalizacion"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <button
                type="reset"
                class="btn btn-default"
                @click="resetAlertValidation"
              >
                Cancelar
              </button>
              <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
          </div>
        </form>

        <form
          :action="baseURLDelete"
          style="margin-top: 20px"
          x-show="!isCreateOrUpdateForm"
        >
          <input type="hidden" name="_token" x-model="_token" />
          <input type="hidden" name="id" x-model="formData.id" />

          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-danger" role="alert">
                Confirmación para eliminar el registro
                <strong x-text="formData.nombre_rector"></strong>
              </div>
            </div>
            <div class="col-lg-6">
              <button
                type="button"
                class="btn btn-default"
                @click="resetAlertValidation"
              >
                Cancelar
              </button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
          </div>
        </form>
      </div>
      <div style="margin-top: 20px">
        <table
          id="table"
          class="table table-striped table-bordered dt-responsive nowrap"
          style="width: 100%"
        ></table>
      </div>
    </div>

    <script>
      const _token = "";
      const baseURLCreateOrUpdate = "";
      const baseURLDelete = "";

      const datos = [
        {
          id: 555,
          anio_inicio: 2000,
          anio_finalizacion: 2004,
          nombre_rector: "veniam",
        },
        {
          id: 57136,
          anio_inicio: 2005,
          anio_finalizacion: 2009,
          nombre_rector: "et",
        },
        {
          id: 5227,
          anio_inicio: 2010,
          anio_finalizacion: 2014,
          nombre_rector: "voluptas",
        },
        {
          id: 78062,
          anio_inicio: 2015,
          anio_finalizacion: 2019,
          nombre_rector: "enim",
        },
        {
          id: 55833,
          anio_inicio: 2020,
          anio_finalizacion: 2024,
          nombre_rector: "pariatur",
        },
      ];
      function initialConfigDataTable(headers) {
        const columns = [];
        const columnDefs = [];

        headers.forEach((column, index) => {
          const { orderable = true, searchable = true, ...others } = column;
          columns.push({ ...others });

          if (!orderable || !searchable) {
            columnDefs.push({ targets: [index], searchable, orderable });
          }
        });

        return [columns, columnDefs];
      }

      $(document).ready(function () {
        $("#anio_inicio").datepicker({
          format: "yyyy",
          viewMode: "years",
          minViewMode: "years",
        });

        $("#anio_finalizacion").datepicker({
          format: "yyyy",
          viewMode: "years",
          minViewMode: "years",
        });
      });

      document.addEventListener("alpine:init", () => {
        const headers = [
          { title: "ID", data: "id" },
          { title: "Nombre del Rector", data: "nombre_rector" },
          { title: "Inicio de temporada", data: "anio_inicio" },
          { title: "Finalización de temporada", data: "anio_finalizacion" },
          {
            title: "Acciones",
            data: "id",
            render(data, type, row) {
              const editBtn = `<button class="btn  btn-default btn-sm" type="button"
                    @click="updateItem(${data})">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      </button>`;
              const deleteBtn = `<button class="btn btn-danger btn-sm" style="margin-left : 5px" type="button"
                    @click="deleteItem(${data})">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>`;
              return editBtn + deleteBtn;
            },
          },
        ];

        const [columns, columnDefs] = initialConfigDataTable(headers);

        new DataTable("#table", {
          processing: true,
          deferRender: true,
          columns,
          columnDefs,
          data: datos,
        });

        const defaultFormData = {
          id: "",
          nombre_rector: "",
        };

        const defaultFormAlert = {
          anio_inicio: false,
          anio_finalizacion: false,
          nombre_rector: false,
        };

        Alpine.data("form", () => ({
          baseURLCreateOrUpdate,
          baseURLDelete,
          _token,
          isCreateOrUpdateForm: true,

          formData: { ...defaultFormData },
          formAlert: { ...defaultFormAlert },

          deleteItem(itemId) {
            this.isCreateOrUpdateForm = false;
            this.setValuesFormData(itemId);
          },

          updateItem(itemId) {
            this.isCreateOrUpdateForm = true;
            this.setValuesFormData(itemId);
          },

          handleSubmit() {
            this.formAlert = { ...defaultFormAlert };
            const selectedId = $("#anio_inicio").val().length;
            let hasError = false;

            if (!this.formData.nombre_rector) {
              hasError = true;
              this.formAlert.nombre_rector = true;
            }

            if (!$("#anio_inicio").datepicker("getDate")) {
              hasError = true;
              this.formAlert.anio_inicio = true;
            }

            if (!$("#anio_finalizacion").datepicker("getDate")) {
              hasError = true;
              this.formAlert.anio_finalizacion = true;
            }

            if (!hasError) {
              this.$refs.createForm.submit();
            }
          },

          setValuesFormData(itemId) {
            const { id, nombre_rector, anio_inicio, anio_finalizacion } =
              datos.find(({ id }) => id === itemId);
            this.formData = { id, nombre_rector };
            $("#anio_inicio").datepicker("update", anio_inicio + "");
            $("#anio_finalizacion").datepicker(
              "update",
              anio_finalizacion + ""
            );
          },

          resetAlertValidation() {
            this.isCreateOrUpdateForm = true;
            $("#anio_inicio").val("").trigger("change");
            this.formData = { ...defaultFormData };
            this.formAlert = { ...defaultFormAlert };
          },

          accionDelFormulario() {
            if (!this.isCreateOrUpdateForm) {
              return "Eliminado registro";
            }
            return this.formData.id === ""
              ? "Agregando registro"
              : "Editando registro";
          },
        }));
      });
    </script>
  </body>
</html>
