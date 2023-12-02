import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import dashboard from './components/dashboard.vue';
import CreatePost from './components/create-post.vue';
import Edit from './components/edit-post.vue';
import Delete from './components/delete-post.vue';
import LoginOrRegister from './components/login_or_register.vue';
import Show from './components/show-post.vue';
import NotFound from './components/not-found.vue';
import dashboardLink from './components/dashboard-link.vue';


import Form from 'vform';
import { AlertSuccess } from 'vform/src/components/bootstrap5';

const app = createApp({
  mounted() {
    console.log('Vue.js приложение успешно смонтировано');
  },
});

app.component(AlertSuccess.name, AlertSuccess);
app.component('create-post', CreatePost);
app.component('dashboard', dashboard);
app.component('edit-post', Edit);
app.component('delete-post', Delete);
app.component('login-or-register', LoginOrRegister);
app.component('show-post', Show);
app.component('dashboard-link', dashboardLink);

window.axios = axios;
window.Form = Form;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const router = createRouter({
  history: createWebHistory(),
  base: '/',
  routes: [
    {
      path: '/post/:id',
      name: 'post',
      component: Show,
      props: true,
    },
    {
      path: '/dashboard/',
      name: 'dashboard',
      component: dashboard,
    },
    {
      path: '/:catchAll(.*)',
      name: 'not-found',
      component: NotFound,
    },
  ],
});

app.use(router);


app.mount('#app');