<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card my-2">
        <div class="card-body p-0">
          <div class="text-right">
            <div class="d-flex">
              <div class="chapter-line-options position-absolute">
                <button v-on:click="addLine" type="button" class="btn btn-primary btn-sm mr-1 ml-auto">
                  <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                  Línea
                </button>
                <button
                  v-on:click="addChapter"
                  type="button"
                  class="btn btn-primary btn-sm"
                >
                  <svg
                    viewBox="0 0 24 24"
                    width="18"
                    height="18"
                    stroke="currentColor"
                    stroke-width="2"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="css-i6dzq1"
                  >
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                  Capítulo
                </button>
              </div>
            </div>
          </div>
          <table class="table table-borderless table-sm m-0">
            <thead>
              <th style="width: 18%">Referencia</th>
              <th style="width: 8%">Nombre</th>
              <th style="width: 16%">Descripción</th>
              <th style="width: 9%">Cantidadd</th>
              <th style="width: 8%">Precio</th>
              <th style="width: 3%">Dto1</th>
              <th style="width: 5%">Dto2</th>
              <th style="width: 15%">Neto linea</th>
              <th>Iva</th>
              <th></th>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-12">
          <div class="row">
            <template v-if="data.length == 0">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body text-center">
                    <h6>Hay data agregada</h6>
                  </div>
                </div>
              </div>
            </template>
            <template v-else>
              <template v-for="(chapter, index_chapter) in data">
                <div v-if="index_chapter == 0" class="col-md-12" style="margin-bottom: -10px !important">
                  <div class="card" v-bind:class=" chapter.id == chapter_active ? 'active-chapter' : '' ">
                    <div class="chapter">
                      <div class="row">
                        <div class="col-md-2">
                          <div class="d-flex">
                            <div class="custom-control custom-radio">
                              <input type="radio" :id="'customRadio' + chapter.id" name="customRadio" class="custom-control-input" v-model="chapter_active" :value="chapter.id"/>
                              <label class="custom-control-label" :for="'customRadio' + chapter.id" >General</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-10 text-right">
                          <span v-if="chapter.lineas.length > 0">
                            Subtotal: <b v-cloak>{{ chapter.subtotal | redondear }}</b>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div :chapter_id="chapter.id" :indice="index_chapter" :id="'cap_' + chapter.id" class="arrastrar" >
                        <draggable class="list-group" :list="chapter.lineas" group="people">
                          <div :id="line.id" :indice_chapter="index_chapter" :indice_line="index_line" :line_id="line.id" v-for="(line, index_line) in chapter.lineas" class="card card-arrastrable chapter-line-zone">
                            <button v-on:click="removeLine(index_chapter, index_line)" class=" btn btn-sm btn-danger position-absolute btn-circle btn-delete-chapter-line ">
                              <i class="fa fa-trash"></i>
                            </button>
                            <div class="line-item row">
                              <div class="col-2">
                                <div class="d-flex">
                                  <input type="text" v-model="line.referencia" class="form-control form-control-sm" name="" id=""/>
                                  <button class="btn btn-sm btn-info" v-on:click="articulo(index_chapter, index_line)">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                                <!-- <select autocomplete="off" v-cloak :class="'select2-'+line.id" class="form-control buscar-articulo">
                                </select> -->
                              </div>
                              <div class="col-1">
                                <input v-model="line.nombre" type="text" class="form-control form-control-sm"/>
                              </div>
                               <div class="col-2">
                                <input v-model="line.descripcion" type="text" class="form-control form-control-sm"/>
                              </div>
                              <div class="col-1">
                                <input v-model="line.cantidad" type="number" class="form-control form-control-sm"/>
                              </div>
                              <div class="col-1">
                                <input v-model="line.precio" type="number" class="form-control form-control-sm"/>
                              </div>
                              <div class="col-1">
                                <div class="d-flex">
                                  <input v-model="line.dto1" type="text" class="form-control form-control-sm"/>
                                  <input v-model="line.dto2" type="text" class="form-control form-control-sm"/>
                                </div>
                              </div>
                              <div class="col-1" v-cloak>
                                {{ line.neto_linea | redondear }}
                              </div>
                              <div class="col-2">
                                <div class="d-flex">
                                  <select v-model="line.iva_id" class="form-control form-control-sm">
                                    <option v-for="iva in ivas" :value="iva.id">
                                      {{
                                        iva.descripcion + "(" + iva.iva + ")%"
                                      }}
                                    </option>
                                  </select>
                                  <input style="width: 35%" v-model="line.iva" type="text" class="form-control form-control-sm" readonly/>
                                </div>
                              </div>
                              <div class="col-1">{{ line.subtotal | redondear }}</div>
                            </div>
                          </div>
                          <div class="position-absolute add-items-chapter">
                            <button v-if="chapter.id == chapter_active" v-on:click="addLine" class="btn btn-sm btn-primary btn-add-chapter-line">
                              <i class="fa fa-plus"></i>&nbsp;Línea
                            </button>
                            <button v-if="chapter.id == chapter_active" v-on:click="addChapter" class="btn btn-sm btn-primary btn-add-chapter-line">
                              <i class="fa fa-plus"></i>&nbsp;Capítulo
                            </button>
                          </div>
                        </draggable>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else class="col-md-12" style="margin-bottom: -10px !important">
                  <div class="card" v-bind:class=" chapter.id == chapter_active ? 'active-chapter' : ''">
                    <div class="card-header chapter">
                      <button v-if="chapter.id != chapter_active" v-on:click="removeChapter(index_chapter)" class=" btn btn-sm btn-danger position-absolute btn-circle btn-delete-chapter-line ">
                        <i class="fa fa-trash"></i>
                      </button>
                      <div class="row">
                        <div class="col-md-2">
                          <div class="d-flex">
                            <i v-if="index_chapter == 1" class="dripicons-chevron-up font-22 text-gray" style="cursor: pointer"></i>
                            <i v-else v-on:click="up(index_chapter)" :class="index_chapter == 1 ? 'text-gray' : ''" :disabled="index_chapter == 0" class="dripicons-chevron-up font-22" style="cursor: pointer"></i>
                            <i v-if="index_chapter == data.length - 1" class=" dripicons-chevron-down font-22 mr-2 text-gray " style="cursor: pointer"></i>
                            <i v-else v-on:click="down(index_chapter)" :class=" index_chapter == data.length - 1 ? 'text-gray' : '' " :disabled="index_chapter == data.length - 1" class="dripicons-chevron-down font-22 mr-2" style="cursor: pointer"></i>
                            <div class="custom-control custom-radio">
                              <input type="radio" :id="'customRadio' + chapter.id" name="customRadio" class="custom-control-input" v-model="chapter_active" :value="chapter.id"/>
                              <label class="custom-control-label" :for="'customRadio' + chapter.id">Capítulo</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <input type="text" v-model="chapter.nombre" class="form-control form-control-sm"/>
                        </div>
                        <div class="col-md-5">
                          <input type="text" v-model="chapter.descripcion" class="form-control form-control-sm"/>
                        </div>
                        <div class="col-md-3 text-right pr-4">
                          Subtotal: <b v-cloak>{{ chapter.subtotal | redondear }}</b>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-0">
                      <div :chapter_id="chapter.id" :indice="index_chapter" :id="'cap_' + chapter.id" class="arrastrar">
                        <draggable class="list-group" :list="chapter.lineas" group="people">
                          <div :id="line.id" :indice_chapter="index_chapter" :indice_line="index_line" :line_id="line.id" v-for="(line, index_line) in chapter.lineas" class="card card-arrastrable chapter-line-zone">
                            <div class="line-item row">
                              <div class="col-2">
                                <div class="d-flex">
                                  <input type="text" v-model="line.referencia" class="form-control form-control-sm" name="" id=""/>
                                  <button class="btn btn-sm btn-info" v-on:click="articulo(index_chapter, index_line)">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                                <!-- <select autocomplete="off" v-cloak :class="'select2-'+line.id" class="form-control buscar-articulo">
                                </select> -->
                              </div>
                              <div class="col-1">
                                <input v-model="line.nombre" type="text" class="form-control form-control-sm"/>
                              </div>
                               <div class="col-2">
                                <input v-model="line.descripcion" type="text" class="form-control form-control-sm"/>
                              </div>
                              <div class="col-1">
                                <input v-model="line.cantidad" type="number" class="form-control form-control-sm"/>
                              </div>
                              <div class="col-1">
                                <input v-model="line.precio" type="number" class="form-control form-control-sm"/>
                              </div>
                              <div class="col-1">
                                <div class="d-flex">
                                  <input v-model="line.dto1" type="text" class="form-control form-control-sm"/>
                                  <input v-model="line.dto2" type="text" class="form-control form-control-sm"/>
                                </div>
                              </div>
                              <div class="col-1" v-cloak>
                                {{ line.neto_linea | redondear }}
                              </div>
                              <div class="col-2">
                                <div class="d-flex">
                                  <select v-model="line.iva_id" class="form-control form-control-sm">
                                    <option v-for="iva in ivas" :value="iva.id">
                                      {{
                                        iva.descripcion + "(" + iva.iva + ")%"
                                      }}
                                    </option>
                                  </select>
                                  <input style="width: 35%" v-model="line.iva" type="text" class="form-control form-control-sm" readonly/>
                                </div>
                              </div>
                              <div class="col-1">{{ line.subtotal | redondear }}</div>
                            </div>
                            <button v-on:click="removeLine(index_chapter, index_line)" class="btn btn-sm btn-danger position-absolute btn-circle btn-delete-chapter-line">
                              <i class="fa fa-trash"></i>
                            </button>
                          </div>
                          <div class="position-absolute add-items-chapter">
                            <button v-if="chapter.id == chapter_active" v-on:click="addLine" class="btn btn-sm btn-primary btn-add-chapter-line">
                              <i class="fa fa-plus"></i>&nbsp;Línea
                            </button>
                            <button v-if="chapter.id == chapter_active" v-on:click="addChapter" class="btn btn-sm btn-primary btn-add-chapter-line">
                              <i class="fa fa-plus"></i>&nbsp;Capítulo
                            </button>
                          </div>
                        </draggable>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
            </template>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalArticulos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-0" id="exampleModalLabel">Artículos</h5>
            <!-- <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button> -->
          </div>
          <div class="modal-body">
            <a href="#"><button class="btn btn-sm btn-primary mb-2">Agregar</button></a>
            <table id="datatable" class="table table-bordered dt-responsive nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Nombre</th>
                  <th width="300" style="width: 300px !important">
                    Descripcion
                  </th>
                  <th>Precio</th>
                  <th>Iva</th>
                  <th>Recargo</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <div class="modal-footer" hidden></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
var modal_index_article = null;
var modal_index_line = null;
let vue = null;
import draggable from "vuedraggable";
export default {
  name: "two-lists",
  display: "Two Lists",
  order: 1,
  props: ["decimales", "ivas"],
  components: {
    draggable,
  },
  data() {
    return {
      chapter_active: 0,
      data: [
        {
          id: 0,
          nombre: "",
          descripcion: "",
          subtotal: 0,
          lineas: [],
        },
      ],
      total: 0,
      iva: 0,
      base: 0,
      ivaPorcentaje: 0,
      baseImponible: 0,
      cuotaIva: 0,
      totalPresupuesto: 0,
    };
  },
  methods: {
    addChapter: function () {
      let length_data = this.data.length;
      let id = this.generateUUID();

      if (length_data == 0) {
        this.chapter_active = id;
      }
      this.data.push({
        id: id,
        nombre: "",
        descripcion: "",
        subtotal: 0,
        lineas: [],
      });
      this.chapter_active = id;
    },
    addLine: function () {
      let item = this.data.findIndex(
        (chapter) => chapter.id === this.chapter_active
      );
      let id = this.generateUUID();
      let index =
        this.data[item].lineas.push({
          id: id,
          articulo_id: 0,
          referencia: "",
          nombre: "",
          descripcion: "",
          cantidad: 1,
          precio: 0,
          dto1: 0,
          dto2: 0,
          neto_linea: 0,
          iva: 0,
          iva_id: 0,
          iva_porcentaje: 0,
          subtotal: 0,
        }) - 1;

      let self = this;
      vue = self;
      // setTimeout(() => {
      //   $(".select2-" + id)
      //     .select2({
      //       placeholder: "Buscar ...",
      //       allowClear: true,
      //       ajax: {
      //         url: "/buscar/",
      //         data: function (params) {
      //           var query = {
      //             search: params.term,
      //             type: "public",
      //           };
      //           return query;
      //         },
      //       },
      //     })
      //     .on("select2:select", function () {
      //       let value = $(".select2-" + id).select2("data");
      //       // self.data[item].lineas[index].descripcion = [value[0].id, value[0].text];
      //       self.data[item].lineas[index].descripcion = value[0].desc_adicional;
      //       self.data[item].lineas[index].cantidad = 1;
      //       self.data[item].lineas[index].precio = value[0].preciobase;
      //       self.data[item].lineas[index].iva_porcentaje = value[0].iva;
      //       self.data[item].lineas[index].iva_id = value[0].iva_id;
      //     })
      //     .on("select2-blur", function () {
      //       setTimeout(function () {
      //         var active = $("#s2id_test").hasClass("select2-container-active");
      //         if (active) {
      //           return false;
      //         }
      //         log("Blur");
      //       }, 300);
      //     });
      // }, 300);
    },
    removeChapter: function (chapter_index) {
      this.data.splice(chapter_index, 1);
    },
    removeLine: function (chapter_index, line_index) {
      this.data[chapter_index].lineas.splice(line_index, 1);
    },
    up: function (chapter_index) {
      let temp = this.data[chapter_index];
      this.data[chapter_index] = this.data[chapter_index - 1];
      this.data[chapter_index - 1] = temp;

      this.$forceUpdate();
    },
    down: function (chapter_index) {
      let temp = this.data[chapter_index];

      this.data[chapter_index] = this.data[chapter_index + 1];
      this.data[chapter_index + 1] = temp;
      this.$forceUpdate();
    },
    generateUUID: function () {
      var d = new Date().getTime(); //Timestamp
      var d2 =
        (typeof performance !== "undefined" &&
          performance.now &&
          performance.now() * 1000) ||
        0; //Time in microseconds since page-load or 0 if unsupported
      return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
        /[xy]/g,
        function (c) {
          var r = Math.random() * 16; //random number between 0 and 16
          if (d > 0) {
            //Use timestamp until depleted
            r = (d + r) % 16 | 0;
            d = Math.floor(d / 16);
          } else {
            //Use microseconds since page-load if supported
            r = (d2 + r) % 16 | 0;
            d2 = Math.floor(d2 / 16);
          }
          return (c === "x" ? r : (r & 0x3) | 0x8).toString(16);
        }
      );
    },
    articulo: function (capitulo, linea) {
      modal_index_article = capitulo;
      modal_index_line = linea;
      $("#modalArticulos").modal("show");
    },
    addArticle: function (article) {
      console.log('article: ', article);

      this.data[modal_index_article].lineas[modal_index_line].descripcion =
        article.desc_adicional;
      this.data[modal_index_article].lineas[modal_index_line].cantidad = 1;
      this.data[modal_index_article].lineas[modal_index_line].precio =
        article.preciobase;
      this.data[modal_index_article].lineas[modal_index_line].iva_porcentaje =
        article.iva;
      this.data[modal_index_article].lineas[modal_index_line].iva_id =
        article.iva_id;
    },
  },
  watch: {
    data: {
      handler(capitulos) {
        let totalPrecio = 0;
        capitulos.forEach((capitulo, index) => {
          let subtotal = 0;
          capitulo.lineas.forEach((linea, indexl) => {
            let netoLinea = parseFloat(linea.cantidad * linea.precio);
            netoLinea = netoLinea - netoLinea * (linea.dto1 / 100);
            netoLinea = netoLinea - netoLinea * (linea.dto2 / 100);
            netoLinea = netoLinea - netoLinea * (linea.dto2 / 100);
            this.data[index].lineas[indexl].neto_linea = netoLinea;

            let key_iva = this.ivas.find((iv) => iv.id === linea.iva_id);

            this.data[index].lineas[indexl].iva_porcentaje =
              key_iva == undefined ? 0 : key_iva.iva;

            this.data[index].lineas[indexl].iva =
              netoLinea *
              (this.data[index].lineas[indexl].iva_porcentaje / 100);
            let subtotal_linea = netoLinea + parseFloat(linea.iva);
            this.data[index].lineas[indexl].subtotal = subtotal_linea;
            subtotal += parseFloat(subtotal_linea);
          });

          this.data[index].subtotal = subtotal;
          totalPrecio += parseFloat(subtotal);
        });

        this.base = totalPrecio;
        this.$emit("totales", totalPrecio);
      },
      deep: true,
    },
  },
  filters: {
    redondear: function (val) {
      return val.toFixed(2);
    },
  },
};

$(document).ready(function () {
  $("#datatable").DataTable({
    destroy: true,
    ajax: {
      url: "/articulos",
    },
    deferRender: true,
    retrieve: true,
    processing: true,
    responsive: true,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
});

$(document).on("click", ".agregarArticulo", function (e) {
  let data = JSON.parse($(this).attr("data-click"))
  console.log('data: ', data);

  vue.data[modal_index_article].lineas[modal_index_line].articulo_id = data.id;
  vue.data[modal_index_article].lineas[modal_index_line].referencia = data.referencia;
  vue.data[modal_index_article].lineas[modal_index_line].nombre = data.nombre;
  vue.data[modal_index_article].lineas[modal_index_line].descripcion = data.desc_adicional;
  vue.data[modal_index_article].lineas[modal_index_line].precio = data.preciobase;
  vue.data[modal_index_article].lineas[modal_index_line].iva_porcentaje = data.iva;
  vue.data[modal_index_article].lineas[modal_index_line].iva_id = data.iva_id;
  $("#modalArticulos").modal("hide");
  // var modal_index_article = null;
  // var modal_index_line = null;
});
</script>