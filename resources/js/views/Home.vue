<template lang="html">
  <div class="container">
    <div class="row justify-content-center">
      <textarea v-model="post"></textarea>
      <button @click="createPost()">Post</button>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Post ID</th>
            <th scope="col">Post Body</th>
            <th scope="col">User ID</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in posts" :key="post.id">
            <th scope="row">{{post.id}}</th>
            <td>{{post.body}}</td>
            <td>{{post.user_id}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      post : "",
      posts: []
    }
  },
  methods : {
    createPost(){
      let body = this.post
      axios.post('api/home', {body}).then(response => {
        this.post = ""
        alert(response.data.status.toString())
        console.log(response.data.post)
      })
    },
    loadPost(){
      axios.get('api/home').then(response => {
        response.data.forEach((data) => {
          this.posts.push({
            id : data.id,
            body: data.body,
            user_id : data.user_id
          })
        })
      })
    }
  },
  mounted(){
    let token = this.$cookie.get('jwt')

    axios.defaults.headers.common['Content-Type'] = 'application/json'
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

    this.loadPost()
  }
}
</script>

<style lang="css">
</style>
