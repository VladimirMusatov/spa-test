<template>
<div class="card mt-3">
  <div class="card-header">
    Create Post
  </div>
  <div class="card-body">
  <form action="#" @submit.prevent="store_post">
    <AlertSuccess :form="form" class="mt-3 mb-3" style="margin: 0 auto" :message="message" />
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
      Create
  </button>
  </form>
</div>
</div>
</template>
  
<script>
export default {
  data(){
    return {
        form: new Form({
            title: '',
            text: '',
            }),
        };
    },
    methods: {
        store_post(){
            this.form.post('/store_post')
                .then((response)=> {
                    this.message = response.data.message
                    this.form.reset();
                })
        },
    }
}
</script>