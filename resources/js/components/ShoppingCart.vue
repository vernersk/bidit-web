<template>
    <div>
        <div class="container">
            <h1>Shopping cart:</h1>
            <div v-if="data.length">
                <div v-for="datum in data" class="card col-15 shadow-sm">
                    <div class="row m-3 justify-content-between align-items-center">
                        <div class="col-sm-2 justify-content-start">
                            <div class="card shadow-sm">
                                <img
                                    src="https://thumbs.dreamstime.com/b/old-worn-laced-boot-white-background-old-worn-boot-169699019.jpg"
                                    class="w-100 position-relative"
                                >
                            </div>
                        </div>
                        <div class="col">
                            <h5 >{{datum.product.name}}</h5>
                            <p>$ {{datum.highestBid.amount}}</p>
                        </div>
                        <div class="col-sm-2 justify-content-end">
                            <a @click="removeFromCart(datum.auction.id)" type="button" class="btn btn-primary">Remove</a>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-4">
                    <h5>Total price: ${{total}}</h5>
                    <a href="/checkout" class="btn btn-primary mt-2">
                        Proceed to check out
                    </a>
                </div>
            </div>
            <div v-else>
                Nothing here
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShoppingCart',

    data:() => ({
        data: [],
        total: 0,
    }),

    mounted() {
        this.getUserAuctions();
    },

    methods: {
        getUserAuctions()
        {
            const auctionIds = this.getAuctionsInCart();
            axios.get('api/wins', {
                params:{
                    isCart: Boolean(auctionIds.length),
                    auctionIds: auctionIds,
                }
            }).then( response => {
                this.data = response.data;
                this.getTotal();
            });
        },

        getAuctionsInCart(){
            return JSON.parse(window.localStorage.getItem("cart"));
        },

        getTotal(){
            this.total = 0;
            this.data.forEach((datum) => {
              this.total += datum.highestBid.amount;
            });
        },

        removeFromCart(auctionId)
        {
            const cart = JSON.parse(window.localStorage.getItem("cart")) ?? [];
            if(!cart.includes(auctionId)) return;
            const index = cart.indexOf(auctionId);
            if(index === -1) return;
            cart.splice(index, 1);
            window.localStorage.setItem("cart", JSON.stringify(cart));

            this.data.some( datum => {
                if(datum.auction.id === index){
                    this.data.splice(this.data.indexOf(datum), 1);
                    return true;
                }
            });

            this.getUserAuctions();
        }
    },
}
</script>
