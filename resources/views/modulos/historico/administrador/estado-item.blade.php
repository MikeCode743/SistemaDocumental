<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Acuerdos</title>
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
                :class="{'has-error' : formAlert.nombre_corto}"
              >
                <label class="control-label" for="nombre">Nombre corto</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre_corto"
                  x-model.trim="formData.nombre_corto"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-6">
              <div class="form-group" :class="{'has-error' : formAlert.nombre}">
                <label class="control-label" for="nombre">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  name="nombre"
                  x-model.trim="formData.nombre"
                />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-6">
              <div
                class="form-group"
                :class="{'has-error' : formAlert.is_visible}"
              >
                <label class="control-label" for="nombre">
                  Visibilidad del elemento
                </label>
                <select
                  class="form-control"
                  name="is_visible"
                  x-model="formData.is_visible"
                >
                  <option value="true">Visible</option>
                  <option value="false">Oculto</option>
                </select>
                <!-- <input type="checkbox" name="is_visible" /> -->
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col col-lg-6">
              <div class="form-group">
                <label class="control-label" for="nombre">Descripción</label>
                <textarea
                  class="form-control"
                  rows="3"
                  name="descripcion"
                  x-model="formData.descripcion"
                ></textarea>
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
                <strong x-text="formData.nombre"></strong>
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

      const response = {
        datos: [
          {
            id: 1,
            nombre: "Speothos vanaticus",
            nombre_corto: "AA",
            is_visible: true,
            descripcion: null,
          },
          {
            id: 2,
            nombre: "Sciurus vulgaris",
            nombre_corto: "AB",
            descripcion: null,
            is_visible: false,
          },
          {
            id: 3,
            nombre: "Ursus americanus",
            nombre_corto: "AC",
            descripcion: null,
            is_visible: true,
          },
          {
            id: 4,
            nombre: "Suricata suricatta",
            nombre_corto: "AD",
            descripcion: null,
            is_visible: false,
          },
          {
            id: 5,
            nombre: "Melursus ursinus",
            nombre_corto: "AE",
            descripcion: null,
            is_visible: false,
          },
        ],
      };

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

      document.addEventListener("alpine:init", () => {
        const headers = [
          { title: "ID", data: "id" },
          { title: "Nombre corto", data: "nombre_corto" },
          { title: "Nombre", data: "nombre" },
          { title: "Descripición", data: "descripcion" },
          {
            title: "Ocultar registro",
            data: "is_visible",
            render(data, type, row) {
              return data ? "Visible" : "Oculto";
            },
          },
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
          data: response.datos,
        });

        const defaultFormData = {
          id: "",
          nombre_corto: "",
          nombre: "",
          descripcion: "",
          is_visible: true,
        };
        const defaultFormAlert = { nombre_corto: false, nombre: false };

        Alpine.data("form", () => ({
          baseURLCreateOrUpdate,
          baseURLDelete,
          _token,
          isCreateOrUpdateForm: true,

          formData: { ...defaultFormData },
          formAlert: { ...defaultFormAlert },

          deleteItem(itemId) {
            this.isCreateOrUpdateForm = false;
            const datos = response.datos.find(({ id }) => id === itemId);
            this.formData = { ...datos };
          },

          updateItem(itemId) {
            this.isCreateOrUpdateForm = true;
            const datos = response.datos.find(({ id }) => id === itemId);
            this.formData = { ...datos };
          },

          handleSubmit() {
            let hasError = false;

            if (!this.formData.nombre) {
              this.formAlert.nombre = true;
              hasError = true;
            }

            if (!this.formData.nombre_corto) {
              this.formAlert.nombre_corto = true;
              hasError = true;
            }

            if (!hasError) {
              this.$refs.createForm.submit();
            }
          },

          resetAlertValidation() {
            this.isCreateOrUpdateForm = true;
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
