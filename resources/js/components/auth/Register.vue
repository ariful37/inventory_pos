<template>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form @submit.prevent="signup">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" placeholder="Full Name"  v-model="form.name">

              <!-- <label for="">Full Name</label> -->
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control" placeholder="Email address"   v-model="form.email">
              <!-- <label for="inputEmail">Email address</label> -->
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="" class="form-control" placeholder="password"  v-model="form.password">
              <!-- <label for="inputEmail">Email address</label> -->
            </div>
          </div>

           <div class="form-group">
            <div class="form-label-group">
              <input type="password"  class="form-control" placeholder="Re-type Password"   v-model="form.password_confirmation">

            </div>
          </div>

           <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        <div class="text-center">
          <router-link class="d-block small mt-3" to="/">Login Page</router-link>
          <router-link class="d-block small" href="/forgot">Forgot Password?</router-link>
        </div>
      </div>
    </div>
  </div>

</template>

<script type="text/javascript">
 export default {
  created(){
    if (User.loggedIn()) {
      this.$router.push({name : 'home'})
    }
  },
  data(){
    return {
      form:{
        name: null,
        email: null,
        password: null,
        password_confirmation: null
      },
    //   errors:{},
    }
  },
  methods:{
    signup(){
      axios.post('/api/auth/signup',this.form)
      .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
          type: 'success',
          title: 'Signed in successfully'
        })
        this.$router.push({ name : 'home'})
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }

}
</script>
