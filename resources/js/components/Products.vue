<template>
    <div class="container">
        <div class="card shadow-sm">
            <div class="m-3">
                <div class="d-flex justify-content-between">
                    <h1>Products</h1>
                    <a @click="refresh" class="btn btn-secondary align-self-center">REFRESH PRODUCTS LIST</a>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col" style="width: 14%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products.data" :key="product.id">
                        <td>{{product.id}}</td>
                        <td>{{product.name}}</td>
                        <td>{{product.description}}</td>
                        <td class="text-right"><a class="btn btn-success">Create auction</a></td>
                    </tr>
                    </tbody>
                </table>
                <pagination :data="products" @pagination-change-page="getProducts"></pagination>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Products",

    data: () => ({
        products: {},
        lastPage: null,
    }),
    mounted() {

        this.getProducts();
    },

    methods: {
        getProducts(page = 1) {
            if(this.lastPage === page) return;
            this.lastPage = page;
            axios.get('/api/products/pages/' + page)
                .then(response => {
                    this.products = response.data;
                });
        },

        refresh() {
            axios.get('/api/products/refresh').then((response) => {
                if(response) this.getProducts();
            });
        },
    }
}
</script>

