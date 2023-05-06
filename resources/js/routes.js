// import Home from './components/Home';
import Login from './components/auth/Login';
import Register from './components/auth/Register';
import Forgot from './components/auth/Forgot';
import Logout from './components/auth/logout';
let home = require('./components/home.vue').default;
// let emplayeeAdd = require('./components/emplayee/create.vue').default;
// let emplayeeList = require('./components/emplayee/index.vue').default;
import employeeAdd from './components/emplayee/create';
import employeeList from './components/emplayee/index';
import employeeEdit from './components/emplayee/edit';
//customer
import customerAdd from './components/customer/create';
import customerList from './components/customer/index';
import customerEdit from './components/customer/edit';
//category
import categoryAdd from './components/category/create'
import categoryList from './components/category/index'
import categoryEdit from './components/category/edit'

//products
import productsAdd from './components/products/create'
import productsList from './components/products/index'
import productsEdit from './components/products/edit'

//pos
import pointofsale from './components/pos/pointofsale'


export default {


    routes: [
        { path: '/home', component: home, name: 'home' },
        // { path: '/about', component: About },
        { path: '/', component: Login, name: '/' },
        { path: '/register', component: Register, name: 'register' },
        { path: '/forgot', component: Forgot, name: 'forgot' },
        { path: '/logout', component: Logout, name: 'logout' },
        //customer
        { path: '/customer-add', component: customerAdd, name: 'customer-add' },
        { path: '/customer-list', component: customerList, name: 'customer-list' },
        { path: '/customer-edit/:id', component: customerEdit, name: 'customer-edit' },

        //employee
        { path: '/employee-add', component: employeeAdd, name: 'employee-add' },
        { path: '/employee-list', component: employeeList, name: 'employee-list' },
        { path: '/employee-edit/:id', component: employeeEdit, name: 'employee-edit' },
        // { path: '/emplayee-add', component: emplayee, name: 'emplayee-add' },
        // { path: '/emplayee-list', component: emplayee, name: 'emplayee-list' },

        //catagory route
        { path: '/category-add', component: categoryAdd, name: 'category-add' },
        { path: '/category-list', component: categoryList, name: 'category-list' },
        { path: '/category-edit/:id', component: categoryEdit, name: 'category-edit' },
        //product route
        { path: '/products-add', component: productsAdd, name: 'products-add' },
        { path: '/products-list', component: productsList, name: 'products-list' },
        { path: '/products-edit/:id', component: productsEdit, name: 'products-edit' },

        //point of sale
        { path: '/pos', component: pointofsale, name: 'pos' },

    ]
}
