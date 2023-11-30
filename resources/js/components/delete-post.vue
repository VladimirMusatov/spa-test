<template>
    <div class="modal" :id="'delete_post_modal_' + post_id" ref="modalDelete" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Delete post</h5>
            </div>
            <div class="modal-body">
                <div v-if="loading" class="text-center d-flex justify-content-center">
                    <div class="spinner-border text-primary" role="status"/>
                    <span style="position: relative; top: 6px; left:6px">Loading...</span>
                </div>
                <div v-else>
                    <p>Are you sure you want to delete this post?</p>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" data-bs-dismiss="modal" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                Close
            </button>
            <button type="button" @click="deletePost(post_id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                Delete
            </button>
            </div>
        </div>
        </div>
    </div>
</template>

<script>

export default {
  data() {
    return {
      post_id: null,
      message: null,
      loading: false,
    };
  },
    props: {
        postId: {
            type: Number,
            required: true,
        },
    },

    mounted() {
      this.post_id = this.postId;
    },

  methods: {
    deletePost(postId) {
      fetch(`/delete_post/${postId}`)
        .then(response => response.json())
        .then(data => {
          this.loading = true;
          this.message = data.message;
          console.log(data.message);
          this.$emit('post-deleted', this.message);
          this.close_modal(postId);
        });
    },
    close_modal(postId)
        {
          var modalDelete =  document.getElementById("delete_post_modal_" + postId);;
          $(modalDelete).modal('hide');
        }
  },

};
</script>
