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
         <div class="card col-lg-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Customer
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="card in cards" :key="card.id">
                     <td style="width:20%">{{card.pro_name}}</td>
                       <td>
                        <input type="text" readonly="" style="width: 20px;" :value="card.pro_quantity">

                                <button @click.prevent="increment(card.id)" class="btn btn-sm btn-success">+</button>
                                <button  @click.prevent="decrement(card.id)" class=" btn-sm btn-danger" v-if="card.pro_quantity >= 2">-</button>
                                <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>

                        </td>
                      <td>{{card.product_price}} TK</td>
                       <td>{{ card.sub_total }} tk</td>
                       <td><a class="btn-sm btn-danger" @click="removeItem(card.id)"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                </tbody>
            </table>
             <div class="card-footer">
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         Total Quantity:
                          <strong>{{ qty }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         Sub Total:
                          <strong>{{ subtotal }}  Tk</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Vat:
                         <strong> {{ vats.vat }} % </strong>
                        </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                          Total:
                         <strong>{{ subtotal*vats.vat /100 +subtotal }} Tk</strong>
                        </li>
                      </ul>
                      <br>
                    <form @submit.prevent="orderdone">
                     <label>Customer Name</label>
                      <select class="form-control" v-model="customer_id">
                         <option :value="customer.id" v-for="customer in customers">{{ customer.name }}</option>
                      </select>
                      <label>Pay</label>
                      <input type="text" class="form-control" required="" v-model="pay">

                      <label>Due</label>
                      <input type="text" class="form-control" required="" v-model="due">

                      <label>Pay By </label>
                      <select class="form-control" v-model="payby">
                         <option value="HandCash">Hand Cash</option>
                         <option value="Cheaque">Cheaque</option>
                         <option value="GiftCard">Gift Card</option>
                      </select>

                      <br>
                      <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                  </div>
         </div>

          <div class="card col-lg-6">
            <div class="row">
                <div class="col-md-3" v-for="product in filtersearch" :key="product.id">
                    <button class="btn bt-sm" @click.prevent="AddToCart(product.id)">
                     <div class="card">
                        <img class="card-img-top" :src="product.image" id="em_photo" alt="Card image cap">
                            <p class="card-title">{{product.product_name}}</p>
                            <p class="card-text">{{product.selling_price}} Tk</p>
                             <span class="badge badge-success" v-if="product.product_quantity >= 1"> Availble ({{ product.product_quantity }}) </span>
                             <span class="badge badge-danger" v-else="">Stock Out</span>
                        </div>
                    </button>
                </div>
            </div>
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
        created(){
         this.allProduct();
         this.cartProduct();
         this.allCustomer();
         this.vat();
         Reload.$on('AfterAdd', ()=>{
           this.cartProduct();
         })
        },
        data(){
        	return{
        		form:{
                    name :'',
                    email :'',
                    address:'',
                    photo :'',
                    phone:'',
        		},
                 customer_id:'',
                 pay:'',
                 due:'',
                 payby:'',
                 products:[],
                 cards:[],
        		 errors:{},
                 customers:'',
                 vats:''
        	}
        },
       computed:{
         filtersearch(){
          return this.products.filter(product => {
             return product.product_name.match(this.searchTerm)
             return product.product_code.match(this.searchTerm)
           })
         },
         qty(){
            let sum=0;
            for(let i=0; i <this.cards.length; i++){
                sum +=(parseFloat(this.cards[i].pro_quantity));
            }
            return sum;
         },
          subtotal(){
            let sum=0;
              for(let i =0; i < this.cards.length; i++){
              sum += (parseFloat(this.cards[i].pro_quantity) * parseFloat(this.cards[i].product_price));
            }
            return sum;
         },
       },

        methods:{
         //cart methods here
          AddToCart(id){
            axios.get('/api/addTocart/'+id)
            .then(() => {
              Reload.$emit('AfterAdd');
               Notification.cart_success()
            })
          },
          cartProduct(){
            axios.get('/api/cart/product')
            .then(({data}) => (this.cards = data))
            .catch()
          },
         removeItem(id){
            axios.get('/api/remove/cart/'+id)
            .then(() => {
               Reload.$emit('AfterAdd');
               Notification.success()
            })
          },
         increment(id){
            axios.get('/api/increment/cart/'+id)
            .then(() => {
               Reload.$emit('AfterAdd');
               Notification.success()
            })
          },
         decrement(id){
            axios.get('/api/decrement/cart/'+id)
            .then(() => {
               Reload.$emit('AfterAdd');
               Notification.success()
            })
          },
          vat(){
            axios.get('/api/vats')
             .then(({data}) => (this.vats = data))
             .catch()
          },
          orderdone(){
            let total = this.subtotal*this.vats.vat /100 +this.subtotal;

            var data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, payby:this.payby, pay:this.pay, due:this.due, vat:this.vats.vat, total:total}

           axios.post('api/orderdone',data)
            .then(() => {
                this.$router.push({ name: 'home' })
                Notification.success()
            })

          },
           allProduct(){
            axios.get('/api/products')
            .then(({data}) => (this.products = data))
            .catch()
          },
           allCustomer(){
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch()
          },

        }

    }

</script>

<style>

#add_new{
	float: right;
}
#em_photo{
 height: 128px;
width: 130px;
}

</style>

