import './bootstrap'
import { createApp } from 'vue'
import CreatePost from './components/create-post.vue'
import dashboard from './components/dashboard.vue'
import Edit from './components/edit-post.vue'

import  Form  from 'vform'
import { AlertSuccess } from 'vform/src/components/bootstrap5'

const app = createApp({
  mounted() {
      console.log('Vue.js приложение успешно смонтировано');
  },
});

app.component(AlertSuccess.name, AlertSuccess)

app.component('create-post', CreatePost)
app.component('dashboard', dashboard)
app.component('edit-post', Edit)


window.axios = axios;
window.Form = Form;

import Alpine from 'alpinejs'

window.Alpine = Alpine;

Alpine.start();

app.mount('#app')