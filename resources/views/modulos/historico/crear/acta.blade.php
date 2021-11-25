<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

    <title>Registrar Acta</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-light">
    <div class="container-fluid mt-4 px-5" x-data="crearActa">
        <div class="col-12 col-md-10 offset-1">
            <div class="card mb-3">
                <form method="POST" action="{{ route('agregar.acta') }}" x-ref="formulario"
                    @submit.prevent="handleSubmitForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h4>Agregar registro de acta 📝</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="periodo_gestion" class="mb-0">Temporada</label>
                                    <select id="periodo_gestion" name="periodo_gestion">
                                        <template x-for="c in catalogo" :key="c.temporada">
                                            <option :value="c.id" x-text="c.temporada"></option>
                                        </template>
                                    </select>
                                    <small class="form-text"
                                        :class="hasError.periodo_gestion ? 'text-danger': 'text-muted'">Temporada de
                                        gestión.</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group is-invalid">
                                    <label for="numero_acta" class="mb-0">Número de acta</label>
                                    <input type="text" class="form-control" name="numero_acta" id="numero_acta"
                                        :class="hasError.numero_acta && 'is-invalid'" x-model="numero_acta" />
                                    <small class="form-text"
                                        :class="hasError.numero_acta ? 'text-danger': 'text-muted'">El identificador del
                                        acta.</small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="archivos" :class="hasError.archivos && 'text-danger'">Seleccionar
                                        documentos</label>
                                    <input type="file" class="form-control-file" id="archivos" name="archivos[]"
                                        multiple @change="handleInputOnChange" />
                                </div>
                                <ul class="list-group list-group-flush my-3">
                                    <template x-for="(file, i) in fileList">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span x-text="file"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>

                        <button type="button" class="btn btn-dark" @click="handleResetForm">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Almacenar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="data" value="{{ json_encode($periodo_gestion) }}">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

<script>
    const errorFormulario = [{
        name: 'identificador',
        mensaje: 'No debe ser vacio'
    }];

    const catalogo = JSON.parse(document.getElementById('data').value)
    let periodoGestionSelect = undefined

    $(document).ready(function() {
        periodoGestionSelect = $('#periodo_gestion').select2({
            width: '100%',
            placeholder: 'Seleccionar una temporada'
        }).val('').trigger('change');
    });

    document.addEventListener('alpine:init', () => {

        Alpine.data('crearActa', () => ({
            catalogo,
            fileList: [],
            numero_acta: '',

            hasError: {
                numero_acta: false,
                periodo_gestion: false,
                archivos: false,
            },

            handleSubmitForm() {
                this.resetValidation()

                if (!this.numero_acta.trim()) {
                    this.hasError.numero_acta = true
                }

                if (!periodoGestionSelect.val()) {
                    this.hasError.periodo_gestion = true
                }

                if (!this.fileList.length) {
                    this.hasError.archivos = true
                }

                const isValid = !Object.values(this.hasError).includes(true)

                if (isValid) {
                    this.$refs.formulario.submit()
                }

            },

            resetValidation() {
                this.hasError = {
                    numero_acta: false,
                    periodo_gestion: false,
                    archivos: false,
                }
            },

            handleResetForm() {
                this.resetValidation()
                this.$refs.formulario.reset()
                this.fileList = []
                periodoGestionSelect.val('').trigger('change');
            },

            handleInputOnChange(e) {
                const files = e.target.files;
                this.fileList = [];
                for (let i = 0; i < files.length; i++) {
                    const file = files.item(i);
                    this.fileList.push(file.name);
                }
            },
        }));
    });
</script>

</html>
