<template>

  <!-- Icon Cards-->

         <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form @submit.prevent="login">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" v-model="form.email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" v-model="form.password" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
          <router-link class="d-block small mt-3" to="/register">Register an Account</router-link>
          <router-link class="d-block small" to="/forgot">Forgot Password?</router-link>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
    export default {
    created(){
        if (User.loggedIn()) {
        this.$router.push({name : 'home'})
        }
    },
     data(){
      return{
        form:{
          email:null,
          password:null
        },
      }
     },
     methods:{
       login(){
        axios.post('/api/auth/login',this.form)
        .then( res => {
           User.responseAfterLogin(res)
            Toast.fire({
            type: 'success',
            title: 'Signed in successfully'
            })
           this.$router.push({ name : 'home'})
        })
        .catch(error => this.errors = error.response.data.errors)
        .catch(
            Toast.fire({
            type: 'warning',
            title: 'Invalid Email Or Password !'
            })
        )
       }
     }
    }
</script>
