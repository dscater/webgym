import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        // INICIO
        {
            path: '/',
            name: 'inicio',
            component: require('./components/Inicio.vue').default
        },

        // LOGIN
        {
            path: '/login',
            name: 'login',
            component: require('./Auth.vue').default
        },

        // USUARIOS
        {
            path: '/usuarios/perfil/:id',
            name: 'usuarios.perfil',
            component: require('./components/modulos/usuarios/perfil.vue').default,
            props: true
        },
        {
            path: '/usuarios',
            name: 'usuarios.index',
            component: require('./components/modulos/usuarios/index.vue').default
        },

        // SUCURSALES
        {
            path: '/sucursals',
            name: 'sucursals.index',
            component: require('./components/modulos/sucursals/index.vue').default,
        },

        // EMPLEADOS
        {
            path: '/empleados',
            name: 'empleados.index',
            component: require('./components/modulos/empleados/index.vue').default,
        },

        // CLIENTES
        {
            path: '/clientes',
            name: 'clientes.index',
            component: require('./components/modulos/clientes/index.vue').default,
        },

        // COBROS
        {
            path: '/cobros',
            name: 'cobros.index',
            component: require('./components/modulos/cobros/index.vue').default,
        },

        // INSCRIPCIONES
        {
            path: '/inscripcions',
            name: 'inscripcions.index',
            component: require('./components/modulos/inscripcions/index.vue').default,
        },

        // EVALUACION FISISCA
        {
            path: '/evaluacion_fisicas',
            name: 'evaluacion_fisicas.index',
            component: require('./components/modulos/evaluacion_fisicas/index.vue').default,
        },

        // ingreso productos
        {
            path: '/ingreso_productos',
            name: 'ingreso_productos.index',
            component: require('./components/modulos/ingreso_productos/index.vue').default,
        },

        // VENTAS
        {
            path: '/ventas',
            name: 'ventas.index',
            component: require('./components/modulos/ventas/index.vue').default,
        },

        // PRODUCTOS
        {
            path: '/productos',
            name: 'productos.index',
            component: require('./components/modulos/productos/index.vue').default,
        },

        // accesos
        {
            path: '/accesos',
            name: 'accesos.index',
            component: require('./components/modulos/accesos/index.vue').default,
        },

        // maquinas
        {
            path: '/maquinas',
            name: 'maquinas.index',
            component: require('./components/modulos/maquinas/index.vue').default,
        },

        // planes
        {
            path: '/plans',
            name: 'plans.index',
            component: require('./components/modulos/plans/index.vue').default,
        },

        // CONFIGURACIÓN
        {
            path: '/configuracion',
            name: 'configuracion',
            component: require('./components/modulos/configuracion/index.vue').default,
            props: true
        },

        // REPORTES
        {
            path: '/reportes/usuarios',
            name: 'reportes.usuarios',
            component: require('./components/modulos/reportes/usuarios.vue').default,
            props: true
        },

        // PÁGINA NO ENCONTRADA
        {
            path: '*',
            component: require('./components/modulos/errors/404.vue').default
        },
    ],
    mode: 'history',
    linkActiveClass: 'active'
});