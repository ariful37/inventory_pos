<template>
  <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Products
            <router-link to="/products-list" class="btn btn-sm btn-info" id="add_new"> All Products</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="productsInsert" enctype="multipart/form-data">
                <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-4">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.product_name" class="form-control"   required="">
	                  <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
	                  <label for="firstName">Products Name</label>
	                </div>
	               </div>
	               <div class="col-md-4">
	                <div class="form-label-group">
	                  <input type="number" v-model="form.product_code" class="form-control" >
	                  <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
	                  <label for="lastName">Product Code</label>
	                </div>
	               </div>
                    <div class="col-md-4">
	                <div class="form-label-group">
	                  <input type="number" v-model="form.product_quantity" class="form-control"  required="">
	                  <label for="phone">Product Quantity</label>
	                  <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
	                </div>
	               </div>
	             </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                  <input type="number" v-model="form.root" class="form-control"  required="">
	                  <label for="lastName">Root</label>
	                  <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
	                </div>
	               </div>
	             </div>
                  <div class="col-md-6 mb-4">
	                  <div class="form-group">
					    <label for="exampleFormControlSelect1">Category</label>
					    <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
					      <option :value="category.id" v-for="category in categories">{{ category.cat_name }}</option>
					    </select>
					    <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
					  </div>
	               </div>
	          </div>
	          <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-4">
	                <div class="form-label-group">
	                  <input type="number" v-model="form.buying_price" class="form-control"  autofocus="autofocus" required="">
	                  <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
	                  <label for="firstName">Buying Price</label>
	                </div>
	               </div>
	               <div class="col-md-4">
	                <div class="form-label-group">
	                  <input type="number" v-model="form.selling_price" class="form-control"  required="">
	                  <label for="nid">Selling Price</label>
	                  <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
	                </div>
	               </div>
	               <div class="col-md-4">
	                <div class="form-label-group">
	                  <input type="date" v-model="form.buying_date" class="form-control"  required="">
	                  <label for="phone">Buying Date</label>
	                  <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
	                </div>
	               </div>
	             </div>
	          </div>
               <div class="form-group">
	              <div class="form-row">
	               <div class="col-md-6">
	                <div class="form-label-group">
	                 <input type="file" class="btn btn-info" @change="onFileselected">
	                  <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
	                </div>
	               </div>
	                <div class="col-md-6">
	                	<img :src="form.photo" style="height:40px; width: 40px;">
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
        			product_name :'',
        			category_id :'',
        			product_code :'',
        			root:'',
        			buying_price:'',
        			selling_price :'',
        			buying_date:'',
        			image : '',
        			product_quantity:''
        		},
        		errors:{},
                categories:{},
        	}
        },


        methods:{
        	onFileselected(event){
        		let file=event.target.files[0];
        		if (file.size > 1048770) {
        			Notification.image_validation()
        		}else{
        			let reader = new FileReader();
        			reader.onload = event => {
        				this.form.image = event.target.result

        				console.log(event.target.result);
        			};
        			reader.readAsDataURL(file);

        		}
        	},

        	productsInsert(){
        		axios.post('/api/products/',this.form)
        		.then(() => {
        			this.$router.push({ name: 'products-list' })
        			Notification.success()
        		})
                 this.$router.push({ name : 'products-list'})
        		.catch(error => this.errors = error.response.data.errors)
        	},

        },
         created(){
                axios.get('/api/category')
                .then(({data}) => (this.categories = data))

            },

    }




</script>

