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
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td class="text-right">
                    <a @click="selectedProduct=product"
                       data-toggle="modal"
                       data-target="#exampleModal"
                       class="btn btn-success">Create auction
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="products" @pagination-change-page="getProducts"></pagination>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create auction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="selectedProduct">
                            <p>Name: {{selectedProduct.name}}</p>
                            <p>Description: {{selectedProduct.description}}</p>
                            <p>Price: ${{selectedProduct.price}}</p>
                        </div>
                        <datepicker placeholder="Select expiration date" v-model="selectedDate"></datepicker>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" data-dismiss="modal" @click.prevent="createAuction" class="btn btn-primary">Create auction</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import Datepicker from 'vuejs-datepicker';

export default {
    name: "Products",

    components: {
        Datepicker
    },

    data: () => ({
        products: {},
        lastPage: null,
        selectedDate: null,
        selectedProduct: null,
    }),
    mounted() {

        this.getProducts();
    },

    methods: {
        getProducts(page = 1) {
            if (this.lastPage === page) return;
            this.lastPage = page;
            axios.get('/api/products/pages/' + page)
                .then(response => {
                    this.products = response.data;
                });
        },

        refresh() {
            axios.get('/api/products/refresh').then((response) => {
                if (response) this.getProducts();
            });
        },

        createAuction() {
            axios.post('/api/auctions/create', {
                productId: this.selectedProduct.id,
                expires_at: this.selectedDate
            })
                .then((response) => {
                    if (response) {
                        window.alert("Auction created");
                    } else {
                        window.alert("Couldn't create auction");
                    }
                });
        },
    }
}
</script>

