<template>
    <div class="login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card mb-2">
                <div class="card-body text-center">
                    <b class="text-xl text-primary" v-text="empresa"></b>
                    <img :src="logo" alt="Logo" class="logo" />
                </div>
            </div>

            <div class="card border border-primary">
                <div class="card-body">
                    <p class="login-box-msg text-success font-weight-bold">
                        INGRESA TU CÓDIGO RFID
                    </p>

                    <div>
                        <div class="input-group mb-3">
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Código RFID"
                                v-model="rfid"
                                @keypress.enter="enviaRfid()"
                                ref="input_rfid"
                                autofocus
                            />
                            <div class="input-group-append">
                                <div class="input-group-text bg-success">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="error">
                            <div class="col-12">
                                <div class="callout callout-danger">
                                    <h5>¡Error!</h5>
                                    <p>
                                        El código ingresado no se encuentra en
                                        nuestros registros
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button
                                    type="button"
                                    class="btn btn-success btn-block btn-flat font-weight-bold"
                                    @click.prevent="enviaRfid"
                                    v-loading.fullscreen.lock="
                                        fullscreenLoading
                                    "
                                >
                                    Enviar código
                                </button>
                            </div>
                            <!-- /.col -->
                            <div class="col-12 mt-2">
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-block btn-flat font-weight-bold"
                                    @click.prevent="vistaInicio"
                                >
                                    Volver
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
export default {
    props: {
        empresa: { String, default: "Nombre Empresa" },
        logo: {
            String,
            default:
                "https://www.logodesign.net/logo/eye-and-house-5806ld.png?size=2&industry=All",
        },
        configuracion: {
            String,
            default: "",
        },
    },
    data() {
        return {
            rfid: "",
            error: false,
            fullscreenLoading: false,
        };
    },
    mounted() {
        this.$refs.input_rfid.focus();
    },
    methods: {
        enviaRfid() {
            if (this.rfid != "") {
                axios
                    .post("/admin/accesos", {
                        rfid: this.rfid,
                    })
                    .then((response) => {
                        if (response.data.sw) {
                            Swal.fire({
                                icon: "success",
                                title: response.data.accion,
                                html: `${response.data.img} <br/> ${response.data.msj}`,
                                showConfirmButton: false,
                                timer: 2500,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.data.msj,
                                showConfirmButton: false,
                                timer: 3500,
                            });
                        }
                        this.rfid = "";
                        this.$refs.input_rfid.focus();
                    });
            } else {
            }
        },
        vistaInicio() {
            window.location = "/";
        },
    },
};
</script>

<style>
.login-page {
    background: #111111;
}

.login-page .card {
    border-radius: 0px;
    box-shadow: 0px 5px 20px 18px var(--secundario);
}
.login-page .card-header {
    border-bottom: solid 1px var(--principal);
}

.logo {
    max-width: 100%;
}

.swal2-html-container img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
}
</style>
