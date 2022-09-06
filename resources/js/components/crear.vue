<template>
    <div class="col-md-12">
        <input type="hidden" name="capitulos">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#lineas" role="tab"
                    aria-selected="true">Lineas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#cliente" role="tab" aria-selected="true">Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#envio" role="tab" aria-selected="true">Envio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#archivos" role="tab" aria-selected="true">Archivos</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane  active" id="lineas" role="tabpanel" style="min-height: 500px">
                <draggable @totales="totalesCapitulos" :decimales="decimales" :ivas="ivas"></draggable>
                <div class="table-resume">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card border-classic" style="height: 83%; border-width: 2px;">
                                <div class="card-body p-0">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Impuesto</th>
                                                <th scope="col">Base</th>
                                                <th scope="col">%IVA</th>
                                                <th scope="col">IVA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Descrip</th>
                                                <td v-cloak>{{base}}</td>
                                                <td v-cloak>{{ivaPorcentaje}} %</td>
                                                <td v-cloak>{{iva}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-5">
                            <div class="card border-classic" style="border-width: 2px;">
                                <div class="card-body p-0">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col" colspan="2">Totales</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Base imponible</th>
                                                <td scope="col" v-cloak> {{baseImponible}} </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Cuota I.V.A.</th>
                                                <td scope="col" v-cloak> {{cuotaIva}} </td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Total Presupuesto</td>
                                                <td scope="col" v-cloak> {{totalPresupuesto}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
</template>
<script>
import draggable from "./draggable.vue";
export default {
    props: ['decimales','ivas'],
    components: {
        draggable  
    },
    data() {
        return {
            base: 0,
            ivaPorcentaje: 0,
            iva: 0,
            baseImponible: 0,
            cuotaIva: 0,
            totalPresupuesto: 0
        };
    },
    methods: {
        totalesCapitulos: function (data) {
            this.base = data;
        }
    }
}
</script>