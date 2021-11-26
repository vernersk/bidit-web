<template>
    <div>
        <div class="container">
            <div v-if="data.length">
                <div class="card shadow-sm">
                    <div class="m-3">
                        <table class="table table-bordered" style="border:1px solid lightgray">
                            <thead>
                            <tr>
                                <th scope="col" style="width: 20%">Image</th>
                                <th scope="col" style="width: 20%">Name</th>
                                <th scope="col" style="width: 50%">Description</th>
                                <th scope="col" style="width: 5%">Price</th>
                                <th scope="col" style="width: 5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="datum in data">
                                    <td class="align-middle"> <img :src="datum.product.image" class="w-100"> </td>
                                    <td class="p align-middle">{{datum.product.name}}</td>
                                    <td class="p align-middle">{{datum.product.description}}</td>
                                    <td class="p align-middle">${{datum.highestBid.amount}}</td>
                                    <td class="align-middle">
                                        <a @click="removeFromCart(datum.auction.id)" type="button" class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-left">
                            <h5 class="font-weight-bold">Total price: ${{total}}</h5>
                            <a href="/checkout" class="btn btn-primary mt-2">
                                Proceed to check out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else></div>
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
            if(!auctionIds) return;
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
            return JSON.parse(window.localStorage.getItem("cart")) ?? null;
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
