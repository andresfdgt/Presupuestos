@extends('layouts.core')
@section('add-head')
    <link href="{{ asset('plugins/dragula/dragula.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .table-xs th,
        .table-xs td {
            padding: .1rem;
        }

        .active-chapter {
            border: 1px solid #2ddab5
        }
    </style>
@endsection
@section('contenido')
    <div class="container-fluid" id="recetas_app">
        <!-- Page-Title -->
        <!-- end page title end breadcrumb -->
        <h4 class="page-title">Presupuesto venta</h4>
        <div class="row mt-2">
            <div class="col-md-6 ">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-3" style="padding-top: 5px !important;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="needs-validation" novalidate id="nuevaReceta" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 text-right mb-1">
                                                    <small style="opacity: 0">.</small>
                                                </div>
                                                <div class="col-md-3 mb-3 text-right">
                                                    <h6 class="mr-2 ">Presupuesto: </h6>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <input type="text" id="nombre" name="nombre"
                                                        class="form-control form-control-sm" required>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <input type="text" id="nombre" name="nombre"
                                                        class="form-control form-control-sm" required>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <input type="text" id="nombre" name="nombre"
                                                        class="form-control form-control-sm" required>
                                                </div>

                                                <div class="col-md-3 mb-3 text-right">
                                                    <h6 class="mr-2">Cliente: </h6>
                                                </div>

                                                <div class="col-md-9 mb-3">

                                                    <input type="text" id="nombre" name="nombre"
                                                        class="form-control form-control-sm" required>
                                                </div>
                                                <div class="col-md-3 mb-1 text-right">

                                                    <h6 style="font-size: 0.79rem;">Nombre comercial: </h6>
                                                </div>
                                                <div class="col-md-9 mb-1">
                                                    <input type="text" id="nombre" name="nombre"
                                                        class="form-control form-control-sm" required>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body p-3" style="padding-top: 5px !important;">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="needs-validation" novalidate id="nuevaReceta" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 text-right mb-1">
                                            <small>{{ date('Y-m-d H:i:s') }} </small>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <h6 class="mr-2 text-right">Versión: </h6>
                                        </div>
                                        <div class="col-md-10 mb-3">
                                            <input type="text" id="nombre" name="nombre"
                                                class="form-control form-control-sm" required>
                                        </div>

                                        <div class="col-md-2 mb-3 text-right">
                                            <h6 class="mr-2">Fecha: </h6>
                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <input type="date" name="fecha" class="form-control form-control-sm"
                                                required>
                                        </div>
                                        <div class="col-md-2 mb-3 text-right">
                                            <h6 class="mr-2">Estado: </h6>
                                        </div>

                                        <div class="col-md-4 mb-3">

                                            <input type="text" name="estado" class="form-control form-control-sm"
                                                required>
                                        </div>
                                        <div class="col-md-2 mb-1">

                                            <h6 class="mr-2 text-right">Titulo: </h6>
                                        </div>
                                        <div class="col-md-10 mb-1">
                                            <input type="text" id="nombre" name="nombre"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#lineas" role="tab"
                            aria-selected="true">Lineas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#cliente" role="tab"
                            aria-selected="true">Cliente</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#envio" role="tab"
                            aria-selected="true">Envio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#archivos" role="tab"
                            aria-selected="true">Archivos</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane  active" id="lineas" role="tabpanel">
                        <div class="card">
                            <div class="card-body" style="padding-top: 5px !important">
                                <div class="text-right">
                                    <div class="d-flex">
                                        <button v-on:click="addLine" type="button"
                                            class="btn btn-primary btn-sm mr-1 ml-auto"><i
                                                class="mdi mdi-plus-outline"></i>Linea</button>
                                        <button v-on:click="addChapter" type="button" class="btn btn-primary btn-sm"><i
                                                class="mdi mdi-plus-outline"></i>Capítulo</button>
                                    </div>
                                </div>
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <th>Referencia</th>
                                        <th>Descripción</th>
                                        <th>Cantidadd</th>
                                        <th>Precio</th>
                                        <th>Dto1</th>
                                        <th>Dto2</th>
                                        <th>Neto linea</th>
                                        <th>Iva</th>
                                        <th></th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <template v-if="chapters.length == 0">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h6>Hay data agregada</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div v-for="(chapter, index_chapter) in chapters" class="col-md-12"
                                            style="margin-bottom: -10px !important;">
                                            <div class="card"
                                                v-bind:class="chapter.id==chapter_active?'active-chapter':''">
                                                <div class="card-header">
                                                    <button v-if="chapter.id!=chapter_active"
                                                        v-on:click="removeChapter(index_chapter)"
                                                        class="btn btn-sm btn-danger position-absolute btn-circle"
                                                        style="top: -5px;left: -5px;width: 19px !important;height:19px !important ;">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="d-flex">
                                                                <i v-if="index_chapter==0"
                                                                    class="dripicons-chevron-up font-22 text-gray"
                                                                    style="cursor: pointer"></i>
                                                                <i v-else v-on:click="up(index_chapter)"
                                                                    :class="index_chapter == 0 ? 'text-gray' : ''"
                                                                    :disabled="index_chapter == 0"
                                                                    class="dripicons-chevron-up font-22"
                                                                    style="cursor: pointer"></i>
                                                                <i v-if="index_chapter==chapters.length-1"
                                                                    class="dripicons-chevron-down font-22 mr-2 text-gray"
                                                                    style="cursor: pointer"></i>
                                                                <i v-else v-on:click="down(index_chapter)"
                                                                    :class="index_chapter == chapters.length - 1 ? 'text-gray' :
                                                                        ''"
                                                                    :disabled="index_chapter == chapters.length - 1"
                                                                    class="dripicons-chevron-down font-22 mr-2"
                                                                    style="cursor: pointer"></i>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" :id="'customRadio' + chapter.id"
                                                                        name="customRadio" class="custom-control-input"
                                                                        v-model="chapter_active" :value="chapter.id">
                                                                    <label class="custom-control-label"
                                                                        :for="'customRadio' + chapter.id">Capitulo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2"><input type="text"
                                                                v-model="chapter.nombre"
                                                                class="form-control form-control-sm"></div>
                                                        <div class="col-md-5"><input type="text"
                                                                v-model="chapter.descripcion"
                                                                class="form-control form-control-sm"></div>
                                                        <div class="col-md-3 text-right"> Subtotal: <b>x,xxx.xxxx</b></div>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="padding: 0px !important">
                                                    <div :chapter_id="chapter.id" :indice="index_chapter"
                                                        :id="'cap_' + chapter.id" class="arrastrar"
                                                        style="padding: 1rem;">
                                                        <div :id="line.id" :indice_chapter="index_chapter"
                                                            :indice_line="index_line" :line_id="line.id"
                                                            v-for="(line, index_line) in chapter.lineas"
                                                            class="card card-arrastrable"
                                                            style="background-color: #bbd3de; margin-bottom: 10px !important">
                                                            <button v-on:click="removeLine(index_chapter,index_line)"
                                                                class="btn btn-sm btn-danger position-absolute btn-circle"
                                                                style="top: -5px;left: -5px;width: 19px !important;height:19px !important ;">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                            <div class="card-body row" style="padding: 10px !important">
                                                                <div class="col-2">
                                                                    <input v-model="line.refencia" type="text"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-3">
                                                                    <input v-model="line.descripcion" type="text"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-1">
                                                                    <input v-model="line.cantidad" type="number"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-1">
                                                                    <input v-model="line.precio" type="number"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-1">
                                                                    <input v-model="line.dto1" type="text"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-1">
                                                                    <input v-model="line.dto2" type="text"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-1">
                                                                    x,xxx.xxx
                                                                </div>
                                                                <div class="col-1">
                                                                    <input v-model="line.iva" type="text"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-1">

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end project-list-left-->
                                            </div>
                                            <!--end /div-->
                                        </div>
                                    </template>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end col-->
                        </div>

                    </div>

                    <div class="tab-pane" id="cliente" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="envio" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="archivos" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- container -->
@endsection
@section('add-scripts')
    <script src="{{ asset('plugins/dragula/dragula.min.js') }}"></script>
    <script>
        // var drake = dragula({});
        // var iconTochange;

        var drake = dragula({});


        var vue_app = new Vue({
            el: "#lineas",
            data: {
                decimales: {{ session('decimales') }},
                chapter_active: 0,
                chapters: [

                ]
            },
            methods: {
                addChapter: function() {
                    let length_chapters = this.chapters.length;
                    let id = generateUUID();

                    if (length_chapters == 0) {
                        this.chapter_active = id;
                    }
                    this.chapters.push({
                        id: id,
                        nombre: "",
                        descripcion: "",
                        subtotal: 0,
                        lineas: [

                        ]
                    })
                    this.chapter_active = id;
                    // console.log("cap"+id);
                    // drake.containers.push(document.getElementById("cap123"));
                },

                addLine: function() {
                    const item = this.chapters.findIndex(chapter => chapter.id === this.chapter_active);
                    let id = generateUUID();
                    this.chapters[item].lineas.push({
                        id: id,
                        refencia: "",
                        descripcion: "",
                        cantidad: 0,
                        precio: 0,
                        dto1: 0,
                        dto2: 0,
                        neto_linea: 0,
                        iva: 0,
                        subtotal: 0
                    });

                    setTimeout(() => {
                        drake.containers.push($('.arrastrar').last().get(0));
                    }, 250);
                },
                removeChapter: function(chapter_index) {
                    this.chapters.splice(chapter_index, 1)
                },
                removeLine: function(chapter_index, line_index) {
                    this.chapters[chapter_index].lineas.splice(line_index, 1)
                },
                up: function(chapter_index) {
                    let temp = this.chapters[chapter_index];
                    this.chapters[chapter_index] = this.chapters[chapter_index - 1]
                    this.chapters[chapter_index - 1] = temp

                    this.$forceUpdate();
                },
                down: function(chapter_index) {

                    let temp = this.chapters[chapter_index];

                    this.chapters[chapter_index] = this.chapters[chapter_index + 1]
                    this.chapters[chapter_index + 1] = temp
                    this.$forceUpdate();
                }
            },
            filters: {
                redondear: function(val) {
                    return val.toFixed(vue_app.decimales);
                }
            }

        });

        const generateUUID = () => { // Public Domain/MIT
            var d = new Date().getTime(); //Timestamp
            var d2 = ((typeof performance !== 'undefined') && performance.now && (performance.now() * 1000)) ||
                0; //Time in microseconds since page-load or 0 if unsupported
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 16; //random number between 0 and 16
                if (d > 0) { //Use timestamp until depleted
                    r = (d + r) % 16 | 0;
                    d = Math.floor(d / 16);
                } else { //Use microseconds since page-load if supported
                    r = (d2 + r) % 16 | 0;
                    d2 = Math.floor(d2 / 16);
                }
                return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
        }

        drake.on('drop', function(el, source) {

            let chapter_id = $(source).attr("chapter_id");
            let line_id = $(el).attr("line_id");

            let chapter_index_end = vue_app.chapters.findIndex(chapter => chapter.id === chapter_id);
            var chapter_index_start = null;
            var line_index = null;
            
            vue_app.chapters.forEach(function(element_chapter, index_chapter) {
                element_chapter.lineas.forEach(function(element_line, index_line) {
                    if (element_line.id == line_id) {
                      chapter_index_start = index_chapter;
                      line_index = index_line;

                    }
                });
            });

            let line_temp = vue_app.chapters[chapter_index_start].lineas[line_index];
            vue_app.chapters[chapter_index_start].lineas.splice(line_index, 1);
            $.each($(source).children('.card-arrastrable'), function(indexInArray, valueOfElement) {
                if ($(valueOfElement).attr("line_id") == line_id) {
                  vue_app.chapters[chapter_index_end].lineas.splice(indexInArray, 0, line_temp);
                  // vue_app.$forceUpdate();
                }
            });
        });
    </script>
@endsection
