<template>
<div class="modal" ref="createPostModal" id="create_post_modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Post</h5>
      </div>
      <div class="modal-body">
        <div v-if="loading" class="text-center d-flex justify-content-center">
          <div class="spinner-border text-primary" role="status"/>
          <span style="position: relative; top: 6px; left:6px">Loading...</span>
        </div>
        <div v-else>
          <form id="create_post" action="#" @submit.prevent="store_post">
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
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150" data-bs-dismiss="modal">Close</button>
        <button form="create_post" type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
          Create
        </button>
      </div>
    </div>
  </div>
</div>
</template>
  
<script>
export default {
  data(){
    return {
        message: null,
        loading: false,
        form: new Form({
            title: '',
            text: '',
            }),
        };
    },
    methods: {
        store_post(){
            this.loading = true;
            this.form.post('/store_post')
                .then((response)=> {
                    this.message = response.data.message;
                    this.$emit('post-created', this.message);
                    this.close_modal();
                    this.loading = false;
                    this.form.reset();
                })
                .catch((error) => {
                  this.loading = false;
                });
        },
        close_modal()
        {
          const modal = this.$refs.createPostModal;
          $(modal).modal('hide');
        }
    }
}
</script>