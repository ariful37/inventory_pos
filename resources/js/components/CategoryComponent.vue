<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Employe Component</div>

                    <div class="card-body">
                         <div class="container">
                            <div class="row">
                               <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">name</label>
                                        <input type="text" class="form-control" id="" placeholder="Name">
                                    </div>
                                     <div class="mb-3">
                                        <label for="" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="" placeholder="Phone">
                                    </div>
                                     <div class="mb-3">
                                        <label for="" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="" placeholder="Email">
                                    </div>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                               </div>
                                 
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
