<template>
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1>Products</h1>
            <a @click="refresh" class="btn btn-secondary align-self-center">REFRESH PRODUCTS LIST</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" class="w-25">ID</th>
                <th scope="col" class="w-25">Name</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products.data" :key="product.id">
                <td>{{product.id}}</td>
                <td>{{product.name}}</td>
                <td class="text-right"><a class="btn btn-success">Create auction</a></td>
            </tr>
            </tbody>
        </table>
        <pagination :data="products" @pagination-change-page="getProducts"></pagination>
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

