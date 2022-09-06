@extends('layouts.core')
@section('add-head')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .hexagono {
            position: relative;
            width: 3rem;
            height: 4rem;
            margin: auto;
            background-color: peachpuff;
        }

        .hexagono:before {
            content: '';
            display: block;
            position: absolute;
            width: 0;
            height: 0;
            right: 3rem;
            border-width: 2rem 1rem;
            border-style: solid;
            border-color: transparent peachpuff transparent transparent;
        }

        .hexagono:after {
            content: '';
            display: block;
            position: absolute;
            width: 0;
            height: 0;
            left: 3rem;
            border-width: 2rem 1rem;
            border-style: solid;
            border-color: transparent transparent transparent peachpuff;
            top: 0;
        }

        .table-xs th,
        .table-xs td {
            padding: .1rem;
        }

    </style>
@endsection
@section('contenido')
    <div class="container-fluid" id="recetas_app">
        <!-- Page-Title -->
        <!-- end page title end breadcrumb -->
        {{-- <div class="card-header">
            <h5>Información general</h5>
        </div> --}}
        <div class="row mt-2">
            <div class="col-md-6 ">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <form class="needs-validation" novalidate id="nuevaReceta" method="post">
                                            @csrf
                                            <div class="input-group">
                                                <h6 class="mr-2">Receta: </h6>
                                                <div class="invalid-feedback">
                                                    ¡El nombre es obligatorio!
                                                </div>
                                                <input type="text" id="nombre" name="nombre"
                                                    class="form-control form-control-sm" placeholder="Nombre" required
                                                    readonly value="{{ $receta->nombre }}">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                                <form class="needs-validation" novalidate id="nuevaVersion" method="post">
                                    <div class="row">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <h6 class="mr-2">Versión:</h6>
                                                <input type="text" id="nombre_version" name="nombre"
                                                    class="form-control form-control-sm" placeholder="Nombre" required>

                                            </div>
                                            <input type="hidden" name="receta" v-model="receta">
                                            <div class="invalid-feedback">
                                                ¡El nombre es obligatorio!
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">

                                                <h6 class="mr-2">Peso deseado:</h6>
                                                <input type="number" id="peso_deseado" name="peso_deseado"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <div class="invalid-feedback">
                                                ¡El peso deseado es obligatorio!
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-sm btn-gradient-primary"
                                                v-bind:disabled="receta==0 ? true : false">Crear</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body p-3">
                        <table class="table table-xs table-bordered mb-0">
                            <thead>
                                <th>#</th>
                                <th>Vesión</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr v-if="versiones.length==0">
                                    <td colspan="3" class="text-center">No hay versiones en el momento</td>
                                </tr>
                                <template v-else>
                                    <tr v-for="vers,index in versiones">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ vers.nombre }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-warning seleccionar" type="button"
                                                @click="selectVersion(vers.id,index)"
                                                v-if="vers.seleccion==0">Seleccionar</button>
                                            <button class="btn btn-sm btn-success" type="button"
                                                v-else>Seleccionado</button>
                                            <button class="btn btn-sm btn-primary" @click="datosGenerales(vers.id)"
                                                type="button">Datos generales</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-4">
                                <form class="needs-validation" novalidate id="nuevoIngrediente" method="post">
                                    @csrf
                                    <input type="hidden" name="receta" v-model="receta">
                                    <input type="hidden" name="version" v-model="version">
                                    <div class="d-flex">
                                        <select class="select2 mb-3 w-75" id="ingrediente" name="ingrediente"
                                            data-placeholder="Buscar ingrediente" required>

                                        </select>
                                        <div class="invalid-feedback">
                                            ¡El ingrediente esta vacio!
                                        </div>
                                        <span class="input-group-append" style="height: 28px;">
                                            <button class="btn btn-sm btn-gradient-primary"
                                                v-bind:disabled="version==0 ? true : false" type="submit">Agregar</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <h6 class="mr-2">Alérgenos:</h6>
                                    <template v-for="alergeno,index in alergenos">
                                        <div>
                                            <span class="badge badge-danger mt-2 mr-1">@{{ alergeno }}</span>
                                        </div>
                                    </template>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-xs table-bordered mb-0 font-12">
                                        <thead>
                                            <th></th>
                                            <th>Ingrediente</th>
                                            <th>Top</th>
                                            <th style="width:10%">Peso</th>
                                            <th>%</th>
                                            <th>Deseado</th>
                                            <th>AZ</th>
                                            <th>MGL</th>
                                            <th>OG</th>
                                            <th>SLNG</th>
                                            <th>PROT</th>
                                            <th>LACT</th>
                                            <th>OS</th>
                                            <th>ST</th>
                                            <th>KCAL</th>
                                            <th>VISCO</th>
                                            <th>PACPM</th>
                                            <th>Precio</th>
                                        </thead>
                                        <tbody>
                                            <tr v-if="ingredientes.length==0">
                                                <td colspan="20" class="text-center">No hay ingredientes agregados</td>
                                            </tr>
                                            <template v-else>
                                                <tr v-for="ingrediente,index in ingredientes" class="text-right">
                                                    <td class="text-center"><i class="fa fa-trash text-danger"
                                                            @click="eliminar(ingrediente, index)"></i></td>
                                                    <td class="text-left">@{{ ingrediente.nombre }}</td>
                                                    <td>
                                                        <div>
                                                            <div class="checkbox checkbox-success form-check-inline">
                                                                <input type="checkbox" v-model="ingrediente.topping"
                                                                    @change="changeArrayItem(ingrediente)">
                                                                <label> </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="number" @blur="changeArrayItem(ingrediente)"
                                                            v-model="ingrediente.peso" style="height: 22.5px; width: 100%;"
                                                            class="form-control form-control-sm">
                                                    </td>
                                                    <td>@{{ ingrediente.porcentaje }}</td>
                                                    <td>@{{ ingrediente.deseado }}</td>
                                                    <td>@{{ ingrediente.azucares }}</td>
                                                    <td>@{{ ingrediente.materia_grasa_lactea }}</td>
                                                    <td>@{{ ingrediente.materia_grasa_no_lactea }}</td>
                                                    <td>@{{ ingrediente.slng }}</td>
                                                    <td>@{{ ingrediente.proteinas_lacteas }}</td>
                                                    <td>@{{ ingrediente.lactosa }}</td>
                                                    <td>@{{ ingrediente.otros_solidos }}</td>
                                                    <td>@{{ ingrediente.solidos_totales }}</td>
                                                    <td>@{{ ingrediente.energia_kcal }}</td>
                                                    <td>@{{ ingrediente.visco }}</td>
                                                    <td>@{{ ingrediente.pacpm }}</td>
                                                    <td>@{{ ingrediente.precio_base }}</td>
                                                </tr>
                                                <tr class="bg-soft-dark text-right">
                                                    <td></td>
                                                    <td class="text-left"><b>Totales</b></td>
                                                    <td></td>
                                                    <td><b>@{{ suma.peso | redondear }}</b></td>
                                                    <td><b>@{{ suma.porcentaje | redondear }}</b></td>
                                                    <td><b>@{{ suma.deseado | redondear }}</b></td>
                                                    <td><b>@{{ suma.azucares | redondear }}</b></td>
                                                    <td><b>@{{ suma.mgl | redondear }}</b></td>
                                                    <td><b>@{{ suma.otras_grasas | redondear }}</b></td>
                                                    <td><b>@{{ suma.slng | redondear }}</b></td>
                                                    <td><b>@{{ suma.prot | redondear }}</b></td>
                                                    <td><b>@{{ suma.lact | redondear }}</b></td>
                                                    <td><b>@{{ suma.otros_solidos | redondear }}</b></td>
                                                    <td><b>@{{ suma.st | redondear }}</b></td>
                                                    <td><b>@{{ suma.kcal | redondear }}</b></td>
                                                    <td><b>@{{ suma.visco | redondear }}</b></td>
                                                    <td><b>@{{ suma.pacpm | redondear }}</b></td>
                                                    <td><b>@{{ suma.precio | redondear }}</b></td>
                                                </tr>
                                                <tr class="bg-soft-dark">
                                                    <td colspan="7" class="text-right"><b>Grasas totales: </b></td>
                                                    <td colspan="2" class="text-center"><b>@{{ (suma.mgl + suma.otras_grasas) | redondear }}</b>
                                                    </td>
                                                    <td colspan="9"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body p-3">
                        <table class="table table-xs table-bordered mb-0 font-12">
                            <thead>
                                <th>Información nutricional</th>
                                <th>Por 100 g</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Valor Energético</td>
                                    <td class="text-right"><span>@{{ informacion_nutricional.kcal || 0 }} kcal @{{ informacion_nutricional.kj || 0 }}
                                            kj</span></td>
                                </tr>
                                <tr>
                                    <td>Grasas</td>
                                    <td class="text-right">@{{ informacion_nutricional.gt || 0 }} g</td>
                                </tr>
                                <tr>
                                    <td>Grasas saturadas</td>
                                    <td class="text-right">@{{ informacion_nutricional.gs || 0 }} g</td>
                                </tr>
                                <tr>
                                    <td>Hidratos de carburo</td>
                                    <td class="text-right">@{{ informacion_nutricional.hc || 0 }} g</td>
                                </tr>
                                <tr>
                                    <td>Hidratos de carburo azucares</td>
                                    <td class="text-right">@{{ informacion_nutricional.az || 0 }} g</td>
                                </tr>
                                <tr>
                                    <td>Fibra alimentaria</td>
                                    <td class="text-right">@{{ informacion_nutricional.fibra || 0 }} g</td>
                                </tr>
                                <tr>
                                    <td>Proteína</td>
                                    <td class="text-right">@{{ informacion_nutricional.prot || 0 }} g</td>
                                </tr>
                                <tr>
                                    <td>Sal</td>
                                    <td class="text-right">@{{ informacion_nutricional.sales || 0 }} g</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <label class="card-header bg-success text-white mt-0 text-center">Poder anticongelante
                                (PAC)</label>
                            <div class="card-body" style="padding: 0.7rem;">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <h5 class="text-success text-center"
                                            v-if="indicativos.poder_anticongelante >= -16 && indicativos.poder_anticongelante<=-8">
                                            <i class="fas fa-check"></i>
                                        </h5>
                                        <h5 class="text-danger text-center" v-else><i class="fas fa-times"></i></h5>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h5>@{{ indicativos.poder_anticongelante || 0 }}</h5>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <label class="card-header bg-pink text-white mt-0 text-center">Dulzor relativo (POD)</label>
                            <div class="card-body" style="padding: 0.7rem;">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <h5 class="text-success text-center"
                                            v-if="indicativos.dulzor_relativo >= 16 && indicativos.dulzor_relativo<=25"><i
                                                class="fas fa-check"></i></h5>
                                        <h5 class="text-danger text-center" v-else><i class="fas fa-times"></i></h5>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h5>@{{ indicativos.dulzor_relativo || 0 }}</h5>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <label class="card-header bg-warning text-white mt-0">Viscosidad</label>
                            <div class="card-body text-center" style="padding: 0.7rem;">
                                <h5>@{{ indicativos.viscosidad || 0 }}</h5>
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <label class="card-header bg-secondary text-white mt-0">PAC PM</label>
                            <div class="card-body" style="padding: 0.7rem;">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <h5 class="text-success text-center"
                                            v-if="indicativos.pac_pm >= -16 && indicativos.pac_pm<=-8"><i
                                                class="fas fa-check"></i></h5>
                                        <h5 class="text-danger text-center" v-else><i class="fas fa-times"></i></h5>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h5>@{{ indicativos.pac_pm || 0 }}</h5>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <label class="card-header bg-primary text-white mt-0 font-12">Lactosa absoluta</label>
                            <div class="card-body text-center" style="padding: 0.7rem;">
                                <h5>@{{ indicativos.lactosa_absoluta || 0 }}</h5>
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-4 offset-md-4 pr-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="hexagono text-center">
                                    <b class="font-18">SLNG</b>
                                    <br>
                                    <span class="font-16 text-success" v-if="suma.slng >= 6.5 && suma.slng <= 10.5"><i
                                            class="fas fa-check"></i></span>
                                    <span class="font-16 text-success" v-if="suma.slng < 6.5"><i
                                            class="fas fa-arrow-up"></i></span>
                                    <span class="font-16 text-danger" v-if="suma.slng > 10.5"><i
                                            class="fas fa-arrow-down"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-2 pr-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="hexagono text-center">
                                    <b class="font-18">GR</b>
                                    <br>
                                    <span class="font-16 text-success"
                                        v-if="suma.slng >= (suma.otras_grasas + suma.mgl)"><i
                                            class="fas fa-check"></i></span>
                                    <span class="font-16 text-success" v-else><i class="fas fa-arrow-up"></i></span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pr-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="hexagono text-center">
                                    <b class="font-18">ST</b>
                                    <br>
                                    <span class="font-16 text-success"
                                        v-if="suma.slng <= ((100-suma.st + suma.slng)/7,25)"><i
                                            class="fas fa-check"></i></span>
                                    <span class="font-16 text-danger" v-else><i class="fas fa-arrow-down"></i></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- container -->
@endsection
@section('add-scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2es.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                language: "es",
                ajax: {
                    url: '/recetas/ingredientes',
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                }
            });
        })

        var vue_app = new Vue({
            el: "#recetas_app",
            data: {
                decimales: {{ session('decimales') }},
                receta: "{{ $receta->id }}",
                version: 0,
                versiones: @json($versiones),
                ingredientes: [],
                alergenos: [],
                informacion_nutricional: Object,
                indicativos: Object,
                suma: {
                    peso: 0,
                    porcentaje: 0,
                    deseado: 0,
                    azucares: 0,
                    mgl: 0,
                    otras_grasas: 0,
                    slng: 0,
                    prot: 0,
                    lact: 0,
                    otros_solidos: 0,
                    st: 0,
                    kcal: 0,
                    visco: 0,
                    pacpm: 0,
                    precio: 0
                }
            },
            methods: {
                selectVersion: function(id, index) {
                    axios.get("/recetas/ingrediente/" + id)
                        .then(response => {
                            this.versiones.forEach((element, index) => {
                                this.versiones[index].seleccion = 0;
                            });
                            this.versiones[index].seleccion = 1;
                            this.version = id;
                            vue_app.alergenos = response.data.alergenos;
                            vue_app.informacion_nutricional = response.data.informacion_nutricional;
                            vue_app.indicativos = response.data.indicativos;
                            vue_app.ingredientes = response.data.datos;
                            sumatoria();
                        })

                },
                changeArrayItem: function(item) {
                    axios.put("/recetas/ingrediente", {
                            version: this.version,
                            id: item.id,
                            peso: item.peso,
                            topping: item.topping,
                        })
                        .then(response => {
                            var data = response.data
                            vue_app.informacion_nutricional = data.data.informacion_nutricional;
                            vue_app.indicativos = data.data.indicativos;
                            vue_app.ingredientes = data.data.datos;
                            sumatoria();
                        })
                },
                eliminar: function(item, index) {
                    Swal.fire({
                        title: "Esta seguro de eliminar este ingrediente",
                        text: "¡Si no lo está puede cancelar la acción!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Si, Eliminar!'
                    }).then((result) => {
                        if (result.value) {
                            axios.delete("/recetas/ingrediente", {
                                    data: {
                                        version: this.version,
                                        id: item.id
                                    }
                                })
                                .then(response => {
                                    console.log(index);
                                    vue_app.ingredientes.slice(index, 1);
                                    var data = response.data;
                                    vue_app.alergenos = data.data.alergenos;
                                    vue_app.informacion_nutricional = data.data
                                        .informacion_nutricional;
                                    vue_app.indicativos = data.data.indicativos;
                                    vue_app.ingredientes = data.data.datos;
                                    sumatoria();
                                })
                        }
                    })

                },
                datosGenerales: function(version_id) {
                  window.open("/recetas/versiones/datos_generales/"+version_id, '_blank');
                }
            },
            filters: {
                redondear: function(val) {
                    return val.toFixed(vue_app.decimales);
                }
            }

        });
        $("#nuevaReceta").submit(function(e) {
            e.preventDefault();
            $('#nuevaReceta').addClass('was-validated');
            if ($('#nuevaReceta')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "/recetas",
                    data: new FormData($('#nuevaReceta')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarReceta").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Creando...</span>Creando..."
                        );
                        $("#registrarReceta").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarReceta").html("Crear");
                        $("#registrarReceta").removeAttr("disabled");
                        if (data.status == "success") {
                            $('#nuevaReceta').removeClass('was-validated');
                            vue_app.receta = data.data;
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message,
                            confirmButtonText: 'OK',
                        });
                    }
                });
            }
        });

        $("#nuevaVersion").submit(function(e) {
            e.preventDefault();
            $('#nuevaVersion').addClass('was-validated');
            if ($('#nuevaVersion')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "/recetas/version",
                    data: new FormData($('#nuevaVersion')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarVersion").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Creando...</span>Creando..."
                        );
                        $("#registrarVersion").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarVersion").html("Crear");
                        $("#registrarVersion").removeAttr("disabled");
                        if (data.status == "success") {
                            $('#nuevaVersion').removeClass('was-validated');
                            vue_app.version = data.data;
                            vue_app.versiones.forEach(element => {
                                element.seleccion = 0;
                            });
                            vue_app.versiones.push({
                                id: data.data,
                                nombre: $("#nombre_version").val(),
                                seleccion: 1
                            })
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message,
                            confirmButtonText: 'OK',
                        });
                    }
                });
            }
        });

        $("#nuevoIngrediente").submit(function(e) {
            e.preventDefault();
            $('#nuevoIngrediente').addClass('was-validated');
            if ($('#nuevoIngrediente')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                const resultado = vue_app.ingredientes.find(ingrediente => ingrediente.ingrediente_id == $(
                    "#ingrediente").val());
                if (resultado) {
                    Swal.fire({
                        icon: "error",
                        title: "Duplicidad",
                        text: "El ingrediente ya esta agregado",
                    });
                    return;
                }
                $.ajax({
                    type: "post",
                    url: "/recetas/ingrediente",
                    data: new FormData($('#nuevoIngrediente')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarVersion").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Creando...</span>Creando..."
                        );
                        $("#registrarVersion").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarVersion").html("Crear");
                        $("#registrarVersion").removeAttr("disabled");
                        if (data.status == "success") {
                            vue_app.informacion_nutricional = data.data.informacion_nutricional;
                            vue_app.indicativos = data.data.indicativos;
                            vue_app.alergenos = data.data.alergenos;
                            $('#nuevoIngrediente').removeClass('was-validated');
                            vue_app.ingredientes = data.data.datos;
                            sumatoria();
                        }
                    }
                });
            }
        });

        function sumatoria() {
            resetSumatoria();
            vue_app.ingredientes.forEach(element => {
                vue_app.suma.peso += parseFloat(element.peso);
                vue_app.suma.porcentaje += parseFloat(element.porcentaje);
                vue_app.suma.deseado += parseFloat(element.deseado);
                vue_app.suma.azucares += parseFloat(element.azucares);
                vue_app.suma.mgl += parseFloat(element.materia_grasa_lactea);
                vue_app.suma.otras_grasas += parseFloat(element.materia_grasa_no_lactea);
                vue_app.suma.slng += parseFloat(element.slng);
                vue_app.suma.prot += parseFloat(element.proteinas_lacteas);
                vue_app.suma.lact += parseFloat(element.lactosa);
                vue_app.suma.otros_solidos += parseFloat(element.otros_solidos);
                vue_app.suma.st += parseFloat(element.solidos_totales);
                vue_app.suma.kcal += parseFloat(element.energia_kcal);
                vue_app.suma.visco += parseFloat(element.visco);
                vue_app.suma.pacpm += parseFloat(element.pacpm);
                vue_app.suma.precio += parseFloat(element.precio_base);
            });

            if (vue_app.suma.porcentaje >= 99) vue_app.suma.porcentaje = 100;
        }

        function resetSumatoria() {
            vue_app.suma.peso = 0;
            vue_app.suma.porcentaje = 0;
            vue_app.suma.deseado = 0;
            vue_app.suma.azucares = 0;
            vue_app.suma.mgl = 0;
            vue_app.suma.otras_grasas = 0;
            vue_app.suma.slng = 0;
            vue_app.suma.prot = 0;
            vue_app.suma.lact = 0;
            vue_app.suma.otros_solidos = 0;
            vue_app.suma.st = 0;
            vue_app.suma.kcal = 0;
            vue_app.suma.visco = 0;
            vue_app.suma.pacpm = 0;
            vue_app.suma.precio = 0;
        }
    </script>
@endsection
