<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Maquinas</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div
                                class="card-header"
                                v-if="permisos.includes('maquinas.create')"
                            >
                                <div class="row">
                                    <div class="col-md-3">
                                        <button
                                            class="btn btn-outline-primary bg-lightblue btn-flat btn-block"
                                            @click="
                                                abreModal('nuevo');
                                                limpiaMaquina();
                                            "
                                        >
                                            <i class="fa fa-plus"></i>
                                            Nuevo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <b-col lg="10" class="my-1">
                                        <b-form-group
                                            label="Buscar"
                                            label-for="filter-input"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                            label-size="sm"
                                            class="mb-0"
                                        >
                                            <b-input-group size="sm">
                                                <b-form-input
                                                    id="filter-input"
                                                    v-model="filter"
                                                    type="search"
                                                    placeholder="Buscar"
                                                ></b-form-input>

                                                <b-input-group-append>
                                                    <b-button
                                                        class="bg-lightblue"
                                                        variant="primary"
                                                        :disabled="!filter"
                                                        @click="filter = ''"
                                                        >Borrar</b-button
                                                    >
                                                </b-input-group-append>
                                            </b-input-group>
                                        </b-form-group>
                                    </b-col>
                                    <div class="col-md-12">
                                        <b-overlay
                                            :show="showOverlay"
                                            rounded="sm"
                                        >
                                            <b-table
                                                :fields="fields"
                                                :items="listRegistros"
                                                show-empty
                                                stacked="md"
                                                responsive
                                                :current-page="currentPage"
                                                :per-page="perPage"
                                                @filtered="onFiltered"
                                                empty-text="Sin resultados"
                                                empty-filtered-text="Sin resultados"
                                                :filter="filter"
                                            >
                                                <template #cell(foto)="row">
                                                    <b-avatar
                                                        :src="
                                                            row.item.path_image
                                                        "
                                                        size="3rem"
                                                    ></b-avatar>
                                                </template>

                                                <template
                                                    #cell(fecha_incorporacion)="row"
                                                >
                                                    <span
                                                        v-if="
                                                            row.item
                                                                .fecha_incorporacion
                                                        "
                                                    >
                                                        {{
                                                            formatoFecha(
                                                                row.item
                                                                    .fecha_incorporacion
                                                            )
                                                        }}
                                                    </span>
                                                </template>
                                                <template
                                                    #cell(fecha_registro)="row"
                                                >
                                                    {{
                                                        formatoFecha(
                                                            row.item
                                                                .fecha_registro
                                                        )
                                                    }}
                                                </template>

                                                <template #cell(accion)="row">
                                                    <div
                                                        class="row justify-content-center flex-column"
                                                    >
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-warning"
                                                            class="btn-flat mb-1"
                                                            title="Editar registro"
                                                            @click="
                                                                editarRegistro(
                                                                    row.item
                                                                )
                                                            "
                                                            v-if="
                                                                permisos.includes(
                                                                    'maquinas.edit'
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-edit"
                                                            ></i>
                                                        </b-button>
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-danger"
                                                            class="btn-flat"
                                                            title="Eliminar registro"
                                                            @click="
                                                                eliminaMaquina(
                                                                    row.item.id,
                                                                    row.item
                                                                        .nombre
                                                                )
                                                            "
                                                            v-if="
                                                                permisos.includes(
                                                                    'maquinas.destroy'
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-trash"
                                                            ></i>
                                                        </b-button>
                                                    </div>
                                                </template>
                                            </b-table>
                                        </b-overlay>
                                        <div class="row">
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="ml-auto my-1"
                                            >
                                                <b-form-select
                                                    align="right"
                                                    id="per-page-select"
                                                    v-model="perPage"
                                                    :options="pageOptions"
                                                    size="sm"
                                                ></b-form-select>
                                            </b-col>
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="my-1 mr-auto"
                                                v-if="perPage"
                                            >
                                                <b-pagination
                                                    v-model="currentPage"
                                                    :total-rows="totalRows"
                                                    :per-page="perPage"
                                                    align="left"
                                                ></b-pagination>
                                            </b-col>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Nuevo
            :muestra_modal="muestra_modal"
            :accion="modal_accion"
            :maquina="oMaquina"
            @close="muestra_modal = false"
            @envioModal="getMaquinas"
        ></Nuevo>
    </div>
</template>

<script>
import Nuevo from "./Nuevo.vue";
export default {
    components: {
        Nuevo,
    },
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            search: "",
            listRegistros: [],
            showOverlay: false,
            fields: [
                {
                    key: "codigo",
                    label: "Código",
                    sortable: true,
                },
                {
                    key: "nombre",
                    label: "Nombre",
                    sortable: true,
                },
                { key: "categoria.nombre", label: "Categoría", sortable: true },
                { key: "descripcion", label: "Descripción", sortable: true },
                { key: "sucursal.nombre", label: "Sucursal", sortable: true },
                {
                    key: "fecha_incorporacion",
                    label: "Fecha de incorporación",
                    sortable: true,
                },
                { key: "cantidad", label: "Cantidad", sortable: true },
                { key: "foto", label: "Foto", sortable: true },
                { key: "estado", label: "Estado", sortable: true },
                {
                    key: "fecha_registro",
                    label: "Fecha de registro",
                    sortable: true,
                },
                { key: "accion", label: "Acción" },
            ],
            loading: true,
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            muestra_modal: false,
            modal_accion: "nuevo",
            oMaquina: {
                id: 0,
                codigo: "",
                nombre: "",
                categoria_id: "",
                descripcion: "",
                sucursal_id: "",
                fecha_incorporacion: "",
                cantidad: "",
                foto: null,
                estado: "INACTIVO",
            },
            currentPage: 1,
            perPage: 5,
            pageOptions: [
                { value: 5, text: "Mostrar 5 Registros" },
                { value: 10, text: "Mostrar 10 Registros" },
                { value: 25, text: "Mostrar 25 Registros" },
                { value: 50, text: "Mostrar 50 Registros" },
                { value: 100, text: "Mostrar 100 Registros" },
                { value: this.totalRows, text: "Mostrar Todo" },
            ],
            totalRows: 10,
            filter: null,
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getMaquinas();
    },
    methods: {
        // Seleccionar Opciones de Tabla
        editarRegistro(item) {
            this.oMaquina.id = item.id;
            this.oMaquina.codigo = item.codigo ? item.codigo : "";
            this.oMaquina.nombre = item.nombre ? item.nombre : "";
            this.oMaquina.categoria_id = item.categoria_id
                ? item.categoria_id
                : "";
            this.oMaquina.descripcion = item.descripcion
                ? item.descripcion
                : "";
            this.oMaquina.sucursal_id = item.sucursal_id
                ? item.sucursal_id
                : "";
            this.oMaquina.fecha_incorporacion = item.fecha_incorporacion
                ? item.fecha_incorporacion
                : "";
            this.oMaquina.cantidad = item.cantidad ? item.cantidad : "";
            this.oMaquina.foto = item.foto ? item.foto : "";
            this.oMaquina.estado = item.estado ? item.estado : "";

            this.modal_accion = "edit";
            this.muestra_modal = true;
        },

        // Listar Maquinas
        getMaquinas() {
            this.showOverlay = true;
            this.muestra_modal = false;
            let url = "/admin/maquinas";
            if (this.pagina != 0) {
                url += "?page=" + this.pagina;
            }
            axios
                .get(url, {
                    params: { per_page: this.per_page },
                })
                .then((res) => {
                    this.showOverlay = false;
                    this.listRegistros = res.data.maquinas;
                    this.totalRows = res.data.total;
                });
        },
        eliminaMaquina(id, descripcion) {
            Swal.fire({
                title: "¿Quierés eliminar este registro?",
                html: `<strong>${descripcion}</strong>`,
                showCancelButton: true,
                confirmButtonColor: "#05568e",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "No, cancelar",
                denyButtonText: `No, cancelar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .post("/admin/maquinas/" + id, {
                            _method: "DELETE",
                        })
                        .then((res) => {
                            this.getMaquinas();
                            this.filter = "";
                            Swal.fire({
                                icon: "success",
                                title: res.data.msj,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            });
        },
        abreModal(tipo_accion = "nuevo", maquina = null) {
            this.muestra_modal = true;
            this.modal_accion = tipo_accion;
            if (maquina) {
                this.oMaquina = maquina;
            }
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        limpiaMaquina() {
            this.oMaquina.codigo = "";
            this.oMaquina.nombre = "";
            this.oMaquina.categoria_id = "";
            this.oMaquina.descripcion = "";
            this.oMaquina.sucursal_id = "";
            this.oMaquina.fecha_incorporacion = "";
            this.oMaquina.cantidad = "";
            this.oMaquina.foto = null;
            this.oMaquina.estado = "INACTIVO";
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
    },
};
</script>

<style></style>
