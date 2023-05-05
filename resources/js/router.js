import { createRouter, createWebHistory} from 'vue-router';




import example from './components/ExampleComponent.vue';
import home from './components/dashboard.vue';
import listcompanies from './components/listcompanies.vue';
import addcompany from './components/addcompany.vue';
import editcompany from './components/editcompany.vue';
import showcompany from './components/showcompany.vue';
import showuser from './components/showuser.vue';
import invite from './components/invite.vue';
import listemployee from './components/listemployee.vue';
import listadmins from './components/listadmins.vue';
import addAdmin from './components/addAdmin.vue';
import editadmin from './components/editadmin.vue';
import editprofil from './components/editprofil.vue';
import showadmin from './components/showadmin.vue';
import logs from './components/logs.vue';
import company from './components/company.vue';
import colleagues from './components/colleagues.vue';
import unauthorized from './components/notfound.vue';

export const routes = [
    {
        name: 'home',
        path: '/home',
        component: home,
        meta: {
            requiresAuth: true 
        }
    },
    {
        name: 'example',
        path: '/example',
        component: example,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'companies',
        path: '/companies',
        component: listcompanies,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }

    },
    {
        name: 'addcompany',
        path: '/addcompany',
        component: addcompany,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'editcompany',
        path: '/company/:id/edit',
        component: editcompany,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'showcompany',
        path: '/company/:id/show',
        component: showcompany,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'editadmin',
        path: '/admin/:id/edit',
        component: editadmin,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'editprofil',
        path: '/myprofil',
        component: editprofil,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: 'showadmin',
        path: '/admin/:id/show',
        component: showadmin,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'showuser',
        path: '/employee/:id/show',
        component: showuser,
        meta: {
            requiresAuth: true,
        }
    },
    {
        name: 'employees',
        path: '/employees',
        component: listemployee,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'admins',
        path: '/admins',
        component: listadmins,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'addAdmin',
        path: '/addadmin',
        component: addAdmin,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'invite',
        path: '/invite',
        component: invite,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'logs',
        path: '/logs',
        component: logs,
        meta: {
            requiresAuth: true,
            role: 'admin'
        }
    },
    {
        name: 'company',
        path: '/company',
        component: company,
        meta: {
            requiresAuth: true,
            role: 'user'
        }
    },
    {
        name: 'colleagues',
        path: '/colleagues',
        component: colleagues,
        meta: {
            requiresAuth: true,
            role: 'user'
        }
    },

    {
        name: 'unauthorized',
        path: '/unauthorized',
        component: unauthorized,
        meta: {
            requiresAuth: true,
        }
    },
    
];

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    const requiresAuth = to.meta.requiresAuth;
    const role = to.meta.role;
    const rolee = localStorage.getItem('role');
    const token = localStorage.getItem('token');
  
    if (requiresAuth && !localStorage.getItem('token')) {
      next('/login');
    } else if (requiresAuth && role === 'admin' && rolee !== '1') {
      next('/unauthorized');
    } else if (requiresAuth && role === 'user' && rolee !== '2') {
      next('/unauthorized');
    } else {
      next();
    }
  });


export default router;