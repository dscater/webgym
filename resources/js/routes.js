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

        // VISTA CONTROL
        {
            path: '/acceso/control',
            name: 'vista_control',
            component: require('./Control.vue').default
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
        {
            path: '/evaluacion_fisicas/create',
            name: 'evaluacion_fisicas.create',
            component: require('./components/modulos/evaluacion_fisicas/create.vue').default,
        },
        {
            path: '/evaluacion_fisicas/edit/:id',
            name: 'evaluacion_fisicas.edit',
            props: true,
            component: require('./components/modulos/evaluacion_fisicas/edit.vue').default,
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
        {
            path: '/ventas/create',
            name: 'ventas.create',
            component: require('./components/modulos/ventas/create.vue').default,
        },
        {
            path: '/ventas/edit/:id',
            name: 'ventas.edit',
            props: true,
            component: require('./components/modulos/ventas/edit.vue').default,
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

        // categorias
        {
            path: '/categorias',
            name: 'categorias.index',
            component: require('./components/modulos/categorias/index.vue').default,
        },

        // maquinas
        {
            path: '/maquinas',
            name: 'maquinas.index',
            component: require('./components/modulos/maquinas/index.vue').default,
        },

        // mantenimiento_maquinas
        {
            path: '/mantenimiento_maquinas',
            name: 'mantenimiento_maquinas.index',
            component: require('./components/modulos/mantenimiento_maquinas/index.vue').default,
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