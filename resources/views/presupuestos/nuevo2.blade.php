@extends('layouts.core')
@section('add-head')
    <link href="{{ asset('plugins/dragula/dragula.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .table-xs th,
        .table-xs td {
            padding: .1rem;
        }

        .active-chapter {
            border: 1px solid #2ddab5;
        }

        .chapter {
            padding: 0.3rem;
        }

        .chapter-line-options {
            right: 0px;
            top: -30px;
        }

        .chapter-line-options>.btn-sm {
            line-height: 1;
        }

        .btn-delete-chapter-line {
            top: -7px;
            right: -5px;
            width: 19px !important;
            height: 19px !important;
            z-index: 1010;
        }

        .buscar-articulo {
            z-index: 999999;
        }
        .add-items-chapter{
            bottom: -10px;
            right: 50%;
            z-index: 1010;
        }
        
        .btn-add-chapter-line {
            height: 19px !important;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .arrastrar {
            padding: 0.3rem;
        }

        .chapter-line-zone {
            background-color: #bbd3de;
            margin-bottom: 4px !important;
        }

        .line-item {
            padding: 4px 10px !important;
        }

        .table-resume {
            position: sticky;
            bottom: 0px;
            z-index: 1000;
        }
    </style>
@endsection
@section('contenido')
    <div class="container-fluid" id="app">
        <h4 class="page-title">Presupuesto venta</h4>
        <div class="row mt-2">
            <div class="col-md-6 ">
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-3" style="padding-top:5px !important; padding-bottom: 6px !important;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="needs-validation" novalidate id="nuevoPresupuesto" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id_presupuesto">
                                            <div class="row">
                                                <div class="col-md-12 text-right mb-1">
                                                    <small style="opacity: 0">.</small>
                                                </div>
                                                <div class="col-md-3 mb-3 text-right">
                                                    <h6 class="mr-2 ">Presupuesto: </h6>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <input type="text" class="form-control" value="Presupuestos"
                                                        readonly>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <select name="identificador" class="form-control" id="identificador">
                                                        @foreach ($referencias as $referencia)
                                                            @php
                                                                $selected = '';
                                                                if ($referencia->favorito) {
                                                                    $selected = 'selected';
                                                                }
                                                            @endphp
                                                            <option {{ $selected }} value="{{ $referencia->id }}">
                                                                {{ $referencia->identificador }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-2 mb-3">
                                                    <input type="text" name="referencia_tres"
                                                        class="form-control form-control-sm" required>
                                                </div>

                                                <div class="col-md-3 mb-3 text-right">
                                                    <h6 class="mr-2">Cliente: </h6>
                                                </div>

                                                <div class="col-md-9 mb-3">
                                                    <select name="cliente" class="form-control" id="cliente"></select>
                                                </div>
                                                <div class="col-md-3 mb-1 text-right">

                                                    <h6 style="font-size: 0.79rem;">Nombre comercial: </h6>
                                                </div>
                                                <div class="col-md-9 mb-1">
                                                    <input type="text" name="nombre_comercial" id="nombre_comercial"
                                                        class="form-control form-control-sm" required>
                                                </div>
                                                {{-- <div class="col-md-12 text-right">
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        id="registrarPresupuesto">Guardar</button>
                                                </div> --}}
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
                    <div class="card-body p-3" style="padding-top: 5px !important;padding-bottom: 6px !important;">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="needs-validation" novalidate id="nuevaVersion" method="post">
                                    @csrf
                                    <input type="hidden" name="presupuesto_id" id="presupuesto_id">
                                    <input type="hidden" name="id" id="id_version">
                                    <div class="row">
                                        <div class="col-md-12 text-right mb-1">
                                            <small>{{ date('Y-m-d H:i:s') }} </small>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <h6 class="mr-2 text-right">Versión: </h6>
                                        </div>
                                        <div class="col-md-10 mb-3">
                                            <input type="text" class="form-control" readonly>
                                        </div>

                                        <div class="col-md-2 mb-3 text-right">
                                            <h6 class="mr-2">Fecha: </h6>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <input type="date" id="fecha" name="fecha"
                                                class="form-control form-control-sm" readonly>
                                        </div>

                                        <div class="col-md-2 mb-3 text-right">
                                            <h6 class="mr-2">Estado: </h6>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <select name="estado" class="form-control" required>
                                                <option value="activo">Activo</option>
                                                <option value="inactivo">Inactivo</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <h6 class="mr-2 text-right">Titulo: </h6>
                                        </div>
                                        <div class="col-md-10 mb-1">
                                            <input type="text" id="titulo" name="titulo"
                                                class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <crear :ivas="{{ $ivas }}" :decimales="{{ session('decimales') }}"></crear>
        </div>
    </div>
   
@endsection
@section('add-scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2es.min.js') }}"></script>
    <script>
        $("#cliente").select2({
            placeholder: 'Buscar ...',
            allowClear: true,
            ajax: {
                url: '/clientes/',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                }
            }
        }).on('select2:select', function() {
            let value = $("#cliente").select2('data');
            $.ajax({
                type: "get",
                url: "clientes/" + value[0].id,
                dataType: "json",
                success: function(response) {
                    $("#nombre_comercial").val(response.nombre_comercial);
                }
            });

        });

        $("#nuevoPresupuesto").submit(function(e) {
            e.preventDefault();
            $('#nuevoPresupuesto').addClass('was-validated');
            if ($('#nuevoPresupuesto')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ route('presupuestos.store') }}",
                    data: new FormData($('#nuevoPresupuesto')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarPresupuesto").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Registrando...</span>Registrando..."
                        );
                        $("#registrarPresupuesto").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarPresupuesto").html("Guardar");
                        $("#registrarPresupuesto").removeAttr("disabled");
                        if (data.status == "success") {
                            $('#nuevoPresupuesto').removeClass('was-validated');
                            $("#id_presupuesto").val(data.data);
                            $("#presupuesto_id").val(data.data);
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message
                        });
                    }
                });
            }
        });

        $(document).on("change", "#versiones", function() {
            if ($(this).val() == 0) {
                $("#registrarVersion").html("Crear");
                $("#eliminarVersion").attr("hidden", true)
                $("#id_version").val('');
                $("#fecha").val('');
                $("#estado").val('');
                $("#titulo").val('');
            } else {
                $("#id_version").val($(this).val());
                $("#registrarVersion").html("Actualizar");
                $("#eliminarVersion").removeAttr("hidden");

                $.ajax({
                    type: "get",
                    url: "/versiones/id/" + $(this).val(),
                    dataType: "json",
                    success: function(response) {
                        let data = response[0];
                        $("#fecha").val(data.fecha);
                        $("#estado").val(data.estado);
                        $("#titulo").val(data.titulo);
                    }
                });
            }
        })

        $(document).on("change", "#referencia", function() {
            $.ajax({
                type: "get",
                url: "/referencia/" + $(this).val(),
                dataType: "json",
                success: function(response) {
                    console.log('response: ', response);
                }
            });
        })


        // $(document).ready(function() {
        //     cargarVersiones();
        // })
    </script>
@endsection
