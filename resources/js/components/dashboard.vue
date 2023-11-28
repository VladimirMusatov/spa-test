<template>
    <div class="mt-3">
      <div v-if="message !== null">
            <div class="alert alert-success alert-dismissible fade show" role="alert">{{ message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">                
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></button>
            </div>
        </div>
      <div v-if="loading" class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <!--  -->
    <div v-else>
      <div v-for="post in paginatedPosts" :key="post.id" class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col  p-4 d-flex flex-column position-static">
          <div class="d-flex justify-content-between">
            <strong class="d-inline-block mb-2 text-success-emphasis">{{ post.title }}</strong>
            <div>{{ formatDateTime(post.created_at) }}</div>
          </div>
          <p class="mb-auto">{{ post.text }}</p>
          <div class="mt-3 d-flex">
            <a @click="deletePost(post.id)"  style="margin-right: 5px; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                </svg>
            </a>
            <a @click="editPost(post.id)" style="margin-right: 5px; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </a>
            <a @click="showPost(post.id)" style="cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                    <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <nav class="mt-3" aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                <a class="page-link" @click="changePage(currentPage - 1)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item" v-for="pageNumber in totalPages" :key="pageNumber" :class="{ active: pageNumber === currentPage }">
                <a class="page-link" @click="changePage(pageNumber)">{{ pageNumber }}</a>
            </li>
            <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                <a class="page-link" @click="changePage(currentPage + 1)" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    </div>
  </template>
  
  <script>
  import dayjs from 'dayjs';
  
  export default {
    data() {
      return {
        posts: [],
        paginatedPosts: [],
        message: null,
        currentPage: 1,
        itemsPerPage: 5,
        totalPosts: 0,
        loading: false,
      };
    },
  
    methods: {
      deletePost(postId) {
        fetch(`/delete_post/${postId}`)
          .then(response => response.json())
          .then(data => {
            this.loading = true;
            this.message = data.message;
            console.log(data.message);
            this.fetchPosts();
          });
      },
      editPost(postId) {
        window.location.href = `/edit_post/${postId}`;
      },
      showPost(postId) {
        window.location.href = `/show_post/${postId}`;
      },
      formatDateTime(dateTime) {
        return dayjs(dateTime).format('YYYY.MM.DD HH:mm');
      },
      async changePage(newPage) {
        if (newPage >= 1 && newPage <= this.totalPages) {
          this.loading = true;
          this.currentPage = newPage;
          await this.fetchPosts();
        }
      },
      async fetchPosts() {
        const response = await fetch('/posts');
        const data = await response.json();
        this.posts = data;
        this.totalPosts = this.posts.length;

        const startIndex = (this.currentPage - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        this.paginatedPosts  = this.posts.slice(startIndex, endIndex);
        this.loading = false;
      },
    },
    computed: {
      totalPages() {
        return Math.ceil(this.totalPosts / this.itemsPerPage);
      },
    },
    async  mounted() {
      await this.fetchPosts();
    },
  };
  </script>