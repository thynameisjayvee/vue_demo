<template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'welcome'}" class="navbar-brand">Treclon</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                            <li class="nav-link" v-if="isLoggedIn"> Hi, {{this.name}}</li>
                            <router-link :to="{ name: 'home' }" class="nav-link" v-if="isLoggedIn">Home</router-link>
                            <router-link :to="{ name: 'board' }" class="nav-link" v-if="isLoggedIn">Board</router-link>
                            <a href="#" class="nav-link" @click.prevent="logout" v-if="isLoggedIn">Logout</a>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <router-view></router-view>
            </main>
        </div>
</template>
<script>
export default {
    data(){
        return {
            isLoggedIn : null,
            name : null,
        }
    },
    methods : {
      logout(){
        axios.post('api/logout').then(response => {
          this.$cookie.delete('user_id')
          this.$cookie.delete('user_name')
          this.$cookie.delete('jwt')
          location.reload()
        }).catch(error => {
          location.reload();
        });
      }
    },
    mounted(){
        this.isLoggedIn = this.$cookie.get('jwt')//localStorage.getItem('jwt')
        this.name = this.$cookie.get('user_name')
        //console.log(test)
    }
}
</script>
