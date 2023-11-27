<template>
    <div class="card mt-3">
      <div class="card-header">
        Edit Post
      </div>
      <div class="card-body">
      <form action="#" @submit.prevent="update_post">
        <input type="hidden" id="id" name="id" v-model="form.id"/>
        <div v-if="message !== null">
        <div class="alert alert-success alert-dismissible fade show" role="alert">{{ message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">                
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></button>
        </div>
    </div>
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
            message: null,
            form: new Form({
                title: '',
                text: '',
                id: '',
                }),
            };
        },
        created() { 
        this.form.title = this.post.title;
        this.form.text = this.post.text;
        this.form.id = this.post.id;
        },
        methods: {
            update_post(){
                this.form.post('/update_post')
                    .then((response)=> {
                        this.message = response.data.message
                        console.log(response.data.message);
                    });
            },
        }
    }
    </script>