<template>
    <div class="container">
        <div class="row">
            <div class="justify-content-between col-md-8" style="height: 500px;">
                <div class="col-12 border shadow p-3 mb-5 bg-white">
                    <h3>Delivery information</h3>
                    <p>Please enter information about the person making this order and the exact address of delivery.</p>
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Name</label>
                                <input type="text" name="name" class="form-control" id="inputName" v-model="name" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputSurname">Surname</label>
                                <input type="text" name="surname" class="form-control" id="inputSurname" v-model="surname" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" name="address" class="form-control" id="inputAddress" v-model="address"
                                   placeholder="1234 Main St" required="required">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" name="address2" class="form-control" id="inputAddress2" v-model="address2"
                                   placeholder="Apartment, studio, or floor" >
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" name="city" class="form-control" id="inputCity" v-model="city" required="required">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <input type="text" name="state" class="form-control" id="inputState" v-model="state" required="required">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" name="zip" class="form-control" id="inputZip" v-model="zip" required="required">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" @click.prevent="setDeliveryData" class="btn btn-primary">To delivery</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border shadow bg-white p-3" style="height: 485px;">
                    <div>
                        <h3>Confirm order</h3>
                        <h4>Nosaukums</h4>
                    </div>
                    <div>
                        <table>
                            <tbody style="font-size: 1.25em">
                            <tr>
                                <td>Subtotal:</td>
                                <td>${{subtotal}}</td>
                            </tr>
                            <tr>
                                <td>Delivery:</td>
                                <td>${{delivery}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Total:</td>
                                <td class="font-weight-bold">${{total}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Checkout',

    props: {
        userId: Number,
    },

    data:() => ({
        data: [],
        name: '',
        surname: '',
        address: '',
        address2: '',
        city: '',
        state: '',
        zip: '',
        delivery: 2.99,
        subtotal: 0,
        total: 0,
        auctionIds: [],
    }),

    mounted() {
        this.setAuctionIds();
        if(!this.auctionIds) window.location.href = '/cart';
        this.getUserAuctions();
        this.getDeliveryData();
    },


    methods: {
        getDeliveryData(){
            axios.get('/api/users/' + this.userId + '/address-form-data').then( response => {
                this.name = response.data.name;
                this.surname = response.data.surname;
                this.address = response.data.address;
                this.address2 = response.data.address2;
                this.city = response.data.city;
                this.state = response.data.state;
                this.zip = response.data.zip;
            });
        },

        setDeliveryData(){
            axios.post('/api/users/set-address-form-data', {
                user_id: this.userId,
                name: this.name,
                surname: this.surname,
                address: this.address,
                address2: this.address2,
                city: this.city,
                state: this.state,
                zip: this.zip,
            }).then(response => {
               if(response){
                   this.createTransaction();
               }
            });
        },

        createTransaction(){
            axios.post('/api/transactions/create', {
                userId: this.userId,
                auctionIds: this.auctionIds
            }).then(response => {
                if(response){
                    this.emptyCart();
                    this.pay();
                }
            });
        },

        getUserAuctions()
        {
            axios.get('api/wins', {
                params:{
                    isCart: Boolean(this.auctionIds.length),
                    auctionIds: this.auctionIds,
                }
            }).then( response => {
                this.data = response.data;
                this.setSubtotal();
                this.setTotal();
            });
        },

        setSubtotal(){
            this.subtotal = 0;
            this.data.forEach((datum) => {
                this.subtotal += datum.highestBid.amount;
            })
        },

        emptyCart(){
            window.localStorage.clear();
        },

        pay(){
            const success = true;
            if(success){
                this.createDeliveryRequest();
                window.location.href = '/thank-you';
            }
        },

        createDeliveryRequest(){

        },

        setTotal(){
            this.total = this.subtotal + this.delivery;
        },

        setAuctionIds(){
            this.auctionIds =  JSON.parse(window.localStorage.getItem("cart")) ?? null;
        },
    },
}
</script>
