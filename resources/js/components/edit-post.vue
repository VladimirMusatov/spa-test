<template>
    <div class="card mt-3">
      <div class="card-header">
        Edit Post
      </div>
      <div class="card-body">
      <form action="#" @submit.prevent="update_post">
        <input type="hidden" id="id" name="id" v-model="form.id"/>
        <AlertSuccess :form="form" class="mt-3  mb-3" style="margin: 0 auto"  message="The post has been successfully updated"></AlertSuccess>
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" id="title" v-model="form.title" :class="{'is-invalid': form.errors.has('title')}" class="form-control" name="title">
        <div v-if="form.errors.has('title')" class='text text-danger' v-html="form.errors.get('title')"/>
      </div>
      <div class="mb-3">
        <label  class="form-label">Text</label>
        <textarea name="text" id="text" v-model="form.text" :class="{'is-invalid': form.errors.has('text')}" class="form-control"></textarea>
        <div v-if="form.errors.has('text')" class='text text-danger' v-html="form.errors.get('text')"/>
      </div>
      <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
          Update
      </button>
      </form>
    </div>
    </div>
    </template>
      
    <script>
    export default {
        props: ['post'],
      data(){
        return {
            form: new Form({
                title: '',
                text: '',
                id: '',
                }),
            };
        },
        created() {
         // Установка начальных значений формы при создании компонента
        this.form.title = this.post.title;
        this.form.text = this.post.text;
        this.form.id = this.post.id;
        },
        methods: {
            update_post(){
                this.form.post('/update_post')
                    .then((response)=> {
                        console.log(response.data.message);
                    });
            },
        }
    }
    </script>