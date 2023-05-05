
import './bootstrap';
import { createApp,inject } from 'vue';
import router from './router.js';



import login from './components/auth/login.vue';
import notfound from './components/notfound.vue';
import invitation from './components/auth/invitation.vue';
// app.component('example-component', ExampleComponent);
const app = createApp({    components: {
    login,
    invitation,
    notfound
}});

app.use(router);
app.mount("#app");

// createApp({
//     components: {
//         example,
//     }
// }).use(router).mount('#app');
// createApp().use(router).mount('#app');
