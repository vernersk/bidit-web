<template>
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div v-for="datum in data" class="card col-md-3 m-2 shadow-sm" style="width: 18rem;">
                <img
                    src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                    class="w-100 position-relative"
                >
                <div class="py-2 flex-grow-1">
                    <h5 class="card-title">{{ datum.product.name }}</h5>
                    <p class="card-text">{{ datum.product.description }}</p>
                </div>
                <div class="my-2">
                    <div class="card-text block">
                        <div class="h5 rounded-sm p-2 text-white d-flex justify-content-between bg-success">
                            <div class="">{{ datum.highestBid.name }}</div>
                            <div class="">${{ datum.highestBid.amount }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <a v-if="inCart.includes(datum.auction.id)"@click="goToCart" class="btn w-100 bg-success">In cart</a>
                    <a v-else @click="addToCart(datum.auction.id)" class="btn btn-primary w-100">Add to cart</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyWins",

    data:() => ({
        data: [],
        inCart: JSON.parse(window.localStorage.getItem("cart")) ?? [],
    }),

    mounted() {
        this.getUserWins();
    },

    methods: {
        getUserWins()
        {
            axios.get('api/win').then( response => {
                this.data = response.data;
                console.log(this.data);
            });
        },

        addToCart(auctionId){
            const cart = JSON.parse(window.localStorage.getItem("cart")) ?? [];
            if(cart.includes(auctionId)) return;
            cart.push(auctionId);
            window.localStorage.setItem("cart", JSON.stringify(cart));
            this.inCart.push(auctionId);
        },

        goToCart(){
            window.location.href = '/cart';
        }

    }
}
</script>

<style scoped>

</style>
