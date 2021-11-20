<template>
    <div class="card container p-4">
        <div class="row g-0">
            <div class="col-md-5">
                <img
                    src="https://picsum.photos/500/586?random=1"
                    class="img-fluid rounded-start"
                />
            </div>

            <div v-if="data.auction" class="col-md-7">
                <div class="pb-4">
                    <h1 class="card-title">{{ data.product.name}}</h1>
                    <p class="card-text">{{ data.product.description}}</p>
                </div>
                <div class="">
                    <div id="scroller" class="" style="height: 367px; overflow-y: auto;">
                        <table class="table">
                            <tbody>
                            <tr v-for="(bid, key) in data.bids" :class="key === data.bids.length-1 ? 'bg-warning' : ''">
                                <td>{{bid.name}}</td>
                                <td class="text-right"><b>$</b> {{bid.amount}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-2 row text-right">
                    <div class="col-6">
                        <input
                            type="number"
                            name="bid"
                            v-model:value="bid"
                            class="w-100 h4"
                        >
                    </div>
                    <div class="col-6">
                        <a @pre.prevent @click="placeBid(this)" type="submit" class="btn btn-primary w-100 h4">
                            Place a bid
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

export default {
    name: "Auction",

    props: {
        auctionId: {
            default: null,
            required: true,
        },
        userId: {
          default: null,
          required: true,
        },
    },

    data: () => ({
        data: {
            auction: null,
            product: null,
            bids: null,
            highestBid: null,
        },
        bid: null,
    }),

    mounted() {
        this.getData();
        this.initPusher();
    },

    methods: {
        getData() {

            axios.get('/api/auctions/' + this.auctionId).then( response => {
                this.data = response.data;
            }).then(() => {
                this.bid = this.data.highestBid.amount ? this.data.highestBid.amount + 1 : 1;
            });
        },

        placeBid(){
            if(this.userId === this.data.highestBid.id) return;
            axios.post('/api/auctions/bids/create', {
                    auctionId: this.auctionId,
                    userId: this.userId,
                    bid: this.bid,
                },
            );
        },

        initPusher() {
            let vm = this;
            const channel = Echo.channel('auction.' + this.auctionId + '.bid');
            channel.listen('.bid.created', function() {
                vm.getData();
            });
        }
    }
}
</script>

<style scoped>

</style>
