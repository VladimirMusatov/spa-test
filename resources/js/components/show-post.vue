<template>
    <div v-if="this.loading">
      <div class="d-flex align-items-center justify-content-center" style="min-height: 90vh;">
        <div class="spinner-border text-primary" role="status"/>
        <span style="position: relative; top: 6px; left:6px">Loading...</span>
      </div>
  </div>
    <div v-else>
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary mt-3">
            <div class="col-lg-12 px-0">
                <h1 class="display-4 fst-italic"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ post.title }}</font></font></h1>
                <p class="lead my-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ post.text }}</font></font></p>
                <div class="d-flex justify-content-between">
                    <span>{{ formatDateTime(post.created_at) }}</span>
                </div>
            </div>
        </div>
  </div>

</template>
  
<script>
  import dayjs from 'dayjs';
  export default {
    data() {
      return {
        loading: false,
        post: [],
        postId: null,

      };
    },
    methods: {
        async getPost(postId) {
            try {
            const response = await fetch(`/get_post/${postId}`);
            const data = await response.json();

            this.post = data;
            } catch (error) {
            console.error('Ошибка при получении данных поста', error);
            }
            this.loading = false;
        },
        formatDateTime(dateTime) {
        return dayjs(dateTime).format('YYYY.MM.DD HH:mm');
      },
    },
    created() {
        this.loading = true;
        const postId = this.$route.params.id;
        if (postId) {
            console.log('post id = ' + postId);
            // Если параметр id существует, выполните ваш запрос или логику
            this.getPost(postId);
        } else {
            console.error('ID поста не передан в URL');
        }
  }
  };
</script>