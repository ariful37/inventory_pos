<template>
  <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Category
            <router-link to="/category-list" class="btn btn-sm btn-info" id="add_new"> All Category</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="categoryInsert" enctype="multipart/form-data">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-12">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.cat_name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.cat_name">{{ errors.cat_name[0] }}</small>
	                  <label for="firstName">Category Name</label>
	                </div>
	               </div>
	             </div>
	          </div>

               <button type="submit" class="btn btn-success">Submit</button>
              </form>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
         </div>
       </div>
   </div>
</template>
<script>

    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            }
        },
        data(){
        	return{
        		form:{
        			cat_name :'',
        		},
        		errors:{},
        	}
        },

        methods:{
        	categoryInsert(){
        		axios.post('/api/category/',this.form)
        		.then(() => {
        			this.$router.push({ name: 'category-list' })
        			Notification.success()
        		})
                 this.$router.push({ name : 'category-list'})
        		.catch(error => this.errors = error.response.data.errors)
        	},

        }


    }




</script>

