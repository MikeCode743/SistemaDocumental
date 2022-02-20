<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />

    <title>Stepper</title>

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
  </head>
  <body class="bg-light">
    <div class="container-fluid mt-4 px-5" x-data="stepper">
      <div class="row">
        <div class="col-12 col-md-10 offset-1">
          <nav class="nav nav-pills nav-justified py-2">
            <div
              class="nav-item nav-link"
              :class="itemHasClassActive(1)"
              @click="currentStep = 1"
            >
              Describir documento
            </div>
            <div
              class="nav-item nav-link"
              :class="itemHasClassActive(2)"
              @dblclick="currentStep = 2"
            >
              Agregar documento
            </div>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-10 offset-1">
          <div class="card bg-light mb-3">
            <form action="" @submit.prevent="handleSubmit" x-ref="formulario">
              <div class="card-body" x-show="currentStep === 1">
                <h4>📖</h4>
                <div class="row">
                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.titulo}"
                    >
                      <label for="titulo">Título del documento *</label>
                      <input
                        type="text"
                        class="form-control"
                        name="titulo"
                        id="titulo"
                        x-model.trim="formData.titulo"
                        :class="{'is-invalid' : formAlert.titulo}"
                      />
                      <small class="form-text text-muted"
                        >Nombre con que se conoce formalmente el
                        documento.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="titulo_alternativo">Título alternativo</label>
                      <input
                        type="text"
                        class="form-control"
                        name="titulo_alternativo"
                        id="titulo_alternativo"
                      />
                      <small class="form-text text-muted"
                        >Nombre alternativo al título formal.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.autor}"
                    >
                      <label for="autor">Autor/es *</label>
                      <input
                        type="text"
                        class="form-control"
                        name="autor"
                        id="autor"
                        x-model.trim="formData.autor"
                        :class="{'is-invalid' : formAlert.autor}"
                      />
                      <small class="form-text text-muted">
                        Nombre(s) de la(s) persona(s) relacionada con el
                        documento.
                      </small>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="autor">Número de sesión (acta)</label>
                      <input
                        type="text"
                        class="form-control"
                        name="autor"
                        id="autor"
                      />
                      <small class="form-text text-muted"
                        >Número relacionado a lo acordado en junta.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.fecha_publicacion}"
                    >
                      <label for="fecha_publicacion"
                        >Fecha de publicación *</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        name="fecha_publicacion"
                        id="fecha_publicacion"
                      />
                      <small class="form-text text-muted"
                        >Fecha en que se envió el documento.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.anio_gestion}"
                    >
                      <label for="anio_gestion">Año de gestión *</label>
                      <input
                        type="text"
                        class="form-control"
                        name="anio_gestion"
                        id="anio_gestion"
                      />
                      <small class="form-text text-muted"></small>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.asunto_catalogo}"
                    >
                      <label for="asunto_catalogo"
                        >Catálogo de asuntos de acuerdos*</label
                      >
                      <div>
                        <select id="asunto_catalogo" name="asunto_catalogo">
                          <template
                            x-for="tipo in catalogo"
                            :key="tipo.categoria"
                          >
                            <optgroup :label="tipo.categoria">
                              <template
                                x-for="asunto in tipo.asuntos"
                                :key="asunto"
                              >
                                <option value="asunto" x-text="asunto"></option>
                              </template>
                            </optgroup>
                          </template>
                        </select>
                      </div>
                      <small class="form-text text-muted"
                        >Tema tratado en el documento.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.tipo}"
                    >
                      <label for="anio_gestion">Tipo de documento *</label>
                      <div>
                        <select id="tipo_documento" name="tipo_documento">
                          <template x-for="tipo in tipoDocumentos" :key="tipo">
                            <option value="tipo" x-text="tipo"></option>
                          </template>
                        </select>
                      </div>
                      <small class="form-text text-muted"
                        >Describe el formato del documento.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div
                      class="form-group"
                      :class="{'text-danger' : formAlert.unidades}"
                    >
                      <label for="core_unidad">Unidades *</label>
                      <div>
                        <select id="core_unidad" name="core_unidad">
                          <template x-for="unidad in unidades" :key="unidad">
                            <option value="unidad" x-text="unidad"></option>
                          </template>
                        </select>
                      </div>
                      <small class="form-text text-muted"
                        >Nombre de la unidad de donde proviene el
                        documento.</small
                      >
                    </div>
                  </div>
                </div>
                <button
                  type="button"
                  class="btn btn-dark"
                  @click="validacionSeccionDescribir"
                >
                  Siguiente
                </button>
              </div>

              <div class="card-body pb-0" x-show="currentStep === 2">
                <h4>📂</h4>
                <div class="form-group">
                  <label for="files">Agregar archivos</label>
                  <input
                    type="file"
                    class="form-control-file"
                    id="files"
                    name="files"
                    multiple
                  />
                </div>
              </div>

              <div class="card-body mt-0 pt-0" x-show="currentStep === 2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="colaboradores" class="mb-0"
                        >Colaboradores</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        name="colaboradores"
                        id="colaboradores"
                      />
                      <!-- <small class="form-text text-muted"> Presionar Enter para agregar.</small>
                      <div>
                        <select id="colaboradores" name="colaboradores" multiple></select>
                      </div> -->
                      <small class="form-text text-muted">
                        Persona u organiazción que haya tenido constribución
                        intelectual.
                      </small>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="beneficiarios" class="mb-0"
                        >Beneficiarios</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        name="beneficiarios"
                        id="beneficiarios"
                      />
                      <!-- <small class="form-text text-muted"> Presionar Enter para agregar.</small>
                      <div>
                        <select id="beneficiarios" name="beneficiarios" multiple></select>
                      </div> -->
                      <small class="form-text text-muted">
                        Persona beneficiaria descrita en el documento (Solo
                        Estudiantes).
                      </small>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="etiquetas" class="mb-0">Palabras clave</label>
                      <small class="form-text text-muted">
                        Presionar Enter para agregar.</small
                      >
                      <div>
                        <select
                          id="etiquetas"
                          name="etiquetas"
                          multiple
                        ></select>
                      </div>
                      <small class="form-text text-muted"
                        >Palabras clave del autor o del documento.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lenguaje" class="mb-0">Idioma</label>
                      <div class="mt-4">
                        <select id="lenguaje" name="lenguaje">
                          <template
                            x-for="idioma in listadoIdioma"
                            :key="idioma"
                          >
                            <option value="idioma" x-text="idioma"></option>
                          </template>
                        </select>
                      </div>
                      <small class="form-text text-muted"
                        >El idioma del contenido intelectual.</small
                      >
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="resumen" class="mb-0">Tema</label>
                      <small class="form-text text-muted">
                        El tema del material generalmente son expresadas a
                        través de las palabras clave o frases que describen el
                        tema o contenido del material.
                      </small>
                      <textarea
                        class="form-control"
                        id="resumen"
                        name="resumen"
                        rows="3"
                      ></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="descripcion" class="mb-0">Descripción</label>
                      <small class="form-text text-muted">
                        Una descripción textual del contenido del material,
                        incluyendo resúmenes.
                      </small>
                      <textarea
                        class="form-control"
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                      ></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="derechos" class="mb-0">Derechos</label>
                      <small class="form-text text-muted">
                        Referencia sobre derecho de autor.</small
                      >
                      <textarea
                        class="form-control"
                        id="derechos"
                        name="derechos"
                        rows="3"
                      ></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="comentario" class="mb-0">Comentario</label>
                      <small class="form-text text-muted"
                        >Texto para descripbir el documento y su uso.
                      </small>
                      <textarea
                        class="form-control"
                        id="comentario"
                        name="comentario"
                        rows="3"
                      ></textarea>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  </body>

  <script>
    // 1 - titulo
    // 1 - titulo alternativo
    // 1 - autor
    // 1 - fecha publicacion (Fecha del documento)
    // 1 - numero acta
    // 1 - anio gestion
    // 1 - core unidad
    // 1 - core tipo documento
    // 1 - core asunto catalogo

    // colaboradores (select - remove)
    // beneficiarios (select - remove)
    // idioma
    // etiquetas (Palabras clave)
    // informacion adicional (Texto enriquesido)

    // resumen -> Tema Dublin Core
    // descripcion
    // derechos
    // comentarios -> Uso interno

    const catalogo = [
      {
        categoria: "Académicos-Administrativos",
        asuntos: [
          "Inscripción Extemporánea",
          "Inscripción Del PERA",
          "Recuperación Calidad Egresado",
          "Prórroga Calidad Egreso",
          "Ratificación Dictamen Equivalencia",
          "Retiro Asignaturas Extemporáneas",
          "Modificación Acdo Cambio De Carrera",
          "Ingreso General",
          "Ingreso Por Calificación Socioeconómica",
          "Ingreso Por Excelencia Académica",
          "Ingreso Empleados O Hijos De Empleados",
          "Prórroga Finalización Trabajo De Grado",
          "Ratificación Notas Parciales Y Finales Trabajo De Grado",
          "Nombramiento Tribunal Calificador Trabajo De Grado",
          "Nombramiento Docente Asesor De Trabajo De Grado",
          "Inscripción De Trabajo De Grado",
          "Ratificación De Tema Trabajo De Grado",
          "Diploma De Reconocimiento",
          "Beca Por Excelencia Académica",
          "Cuarta Matrícula",
          "Oferta Académica Y Calendarización",
          "Ampliación De Oferta Académica",
          "Revisión De Carga Académica",
          "Dejar Sin Efecto Acuerdo",
          "Cursos Académicos",
          "Eventos Académicos",
          "Otros (Casos Especiales)",
          "Nombramiento Representantes Docentes En Comité De Ingreso Universitario",
          "Revisión De Acuerdo De Junta Directiva",
        ],
      },
      {
        categoria: "Administrativo-Financieros",
        asuntos: [
          "Solicitud De Respuesta",
          "Ratificación Toma De Posesión",
          "Contratación Por Servicios Personales De Carácter Permanente Con Reserva De Plaza",
          "Contratación Por Servicios Personales De Carácter Eventual",
          "Contratación Por Servicios Personales De Carácter Temporal",
          "Contratación Por Servicios Profesionales De Carácter Eventual",
          "Contratación Servicios Profesionales No Personales A Cuarto De Tiempo",
          "Contratación Servicios Profesionales No Personales",
          "Contratación Servicios Profesionales No Personales Hora Clase",
          "Contratación En Tiempo Adicional",
          "Contratación En Tiempo Integral",
          "Pasivo Laboral",
          "Taller Y Financiamiento",
          "Ratificación Acuerdo De Decanato",
          "Congresos",
          "Revisión De Acuerdo De Junta Directiva",
          "Cursos",
          "Cancelación Deuda A Librería Universitaria",
          "Modificación De Acuerdo De JD",
        ],
      },
      {
        categoria: "Misiones Oficiales",
        asuntos: [
          "Reconsideración De Acuerdo De JD",
          "Permiso Y Misión Oficial",
          "Permiso Con Goce De Sueldo Y Misión Oficial",
          "Permiso Con Goce De Sueldo Y Misión Oficial Y Financiamiento",
          "Permiso Sin Goce De Sueldo Y Misión Oficial",
          "Permiso, Misión Oficial Y Financiamiento",
          "Misión Oficial Y Financiamiento",
          "Permiso Con Goce De Sueldo, Beca Y Trámites",
          "Toma De Posesión Del Cargo Posterior A MO",
        ],
      },
      {
        catergoria: "Funcionamiento",
        asuntos: [
          "Reconsideración De Contratación",
          "Toma De Posesión Del Cargo Posterior A MO",
          "Horarios De Permanencia Docentes",
          "Validación De Permisos Personales",
          "Horarios Académicos De Docentes",
          "Apertura De Expediente Disciplinario",
          "Informe De Evaluación Docente (CACPA)",
          "Exoneración De Cuotas",
          "Limpieza Y Oficios Varios",
          "Criterios Para Selección De Aspirantes",
          "Expediente De Investigación",
          "Expediente Identificado",
          "Investigaciones",
          "Docente Ausente En Clases",
          "Recurso De Revisión De Acuerdo De JD",
          "Resolución Conciliatoria",
          "Modificación De Acuerdo",
          "Corrección De Acuerdo De JD",
          "Recepción De Donación",
          "Descargo De Bienes",
          "Lineamientos De Planificación De Servicio Académico",
          "Medidas Habilitación De Marcaje Online",
          "Medidas Habilitación De Expediente Online",
          "Virtualización De Contenidos",
        ],
      },
      {
        categoria: "Denuncias",
        asuntos: [
          "Apertura Informativo Administrativo Disciplinario",
          "Audiencia Única",
        ],
      },
    ];

    //http://www3.uji.es/~aramburu/j42/docs/teoria/tema4.pdf
    const tipoDocumentos = [
      "Documento textual",
      "Documento no textual",
      "Documentos multimendia",
      "Hipertextos",
    ];
    const unidades = ["Junta Directiva", "Unidad Financiera"];

    const listadoIdioma = ["Español", "Inglés", "Portugués", "Ruso", "Japonés"];

    $(document).ready(function () {
      $("#asunto_catalogo").select2({ width: "100%" });
      $("#tipo_documento").select2({ width: "100%" });
      $("#core_unidad").select2({ width: "100%" });
      $("#lenguaje").select2({ width: "100%" });

      // $('#colaboradores').select2({
      //   width: '100%',
      //   tags: true,
      //   tokenSeparators: ['\n'],
      //   createTag: function (params) {
      //     const term = $.trim(params.term);

      //     if (term === '') {
      //       return null;
      //     }

      //     return {
      //       id: term,
      //       text: term,
      //       newTag: true,
      //     };
      //   },
      // });

      // $('#beneficiarios').select2({
      //   width: '100%',
      //   tags: true,
      //   tokenSeparators: ['\n'],
      //   createTag: function (params) {
      //     const term = $.trim(params.term);

      //     if (term === '') {
      //       return null;
      //     }

      //     return {
      //       id: term,
      //       text: term,
      //       newTag: true,
      //     };
      //   },
      // });

      $("#etiquetas").select2({
        width: "100%",
        tags: true,
        tokenSeparators: ["\n"],
        createTag: function (params) {
          const term = $.trim(params.term);

          if (term === "") {
            return null;
          }

          return {
            id: term,
            text: term,
            newTag: true,
          };
        },
      });

      $("#fecha_publicacion").datepicker({
        format: "dd/mm/yyyy",
        todayHighlight: true,
        autoclose: true,
        todayHighlight: true,
      });

      $("#anio_gestion").datepicker({
        format: "yyyy",
        autoclose: true,
        viewMode: "years",
        minViewMode: "years",
      });
    });

    document.addEventListener("alpine:init", () => {
      defaultAlertFirstSection = {
        titulo: false,
        autor: false,
        fecha_publicacion: false,
        anio_gestion: false,
        asunto_catalogo: false,
        tipo_documento: false,
        core_unidad: false,
      };

      defaultFormDate = {
        titulo: "",
        autor: "",
      };

      Alpine.data("stepper", () => ({
        catalogo,
        tipoDocumentos,
        unidades,
        listadoIdioma,
        currentStep: 1,
        formAlert: { ...defaultAlertFirstSection },
        formData: { ...defaultFormDate },

        itemHasClassActive(i) {
          return this.currentStep === i ? "active text-white" : "";
        },

        handleSubmit() {
          if ($("#files").val()) {
            this.$refs.formulario.submit();
          }
        },

        validacionSeccionDescribir() {
          this.formAlert = { ...defaultAlertFirstSection };
          let isValidSection = true;
          if (!this.formData.titulo) {
            isValidSection = false;
            this.formAlert.titulo = true;
          }

          if (!this.formData.autor) {
            isValidSection = false;
            this.formAlert.autor = true;
          }

          if (!$("#fecha_publicacion").val()) {
            isValidSection = false;
            this.formAlert.fecha_publicacion = true;
          }

          if (!$("#anio_gestion").val()) {
            isValidSection = false;
            this.formAlert.anio_gestion = true;
          }

          if (!$("#asunto_catalogo").val()) {
            isValidSection = false;
            this.formAlert.asunto_catalogo = true;
          }

          if (!$("#tipo_documento").val()) {
            isValidSection = false;
            this.formAlert.tipo = true;
          }

          if (!$("#core_unidad").val()) {
            isValidSection = false;
            this.formAlert.unidades = true;
          }

          if (isValidSection) {
            this.currentStep = 2;
          }
        },
      }));
    });
  </script>
</html>
