<template>
    <div class="container">
        <div class="row">
            <div class="justify-content-between col-md-8" style="height: 500px;">
                <div class="col-12 border shadow p-3 mb-5 bg-white">
                    <h3>Delivery information</h3>
                    <p>Please enter information about the person making this order and the exact address of delivery.</p>
                    <form method="post" action="">
                        <input hidden name="auctionId" value="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Name</label>
                                <input type="text" name="name" value="" class="form-control" id="inputName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputSurname">Surname</label>
                                <input type="text" name="surname" class="form-control" id="inputSurname" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" name="address" class="form-control" id="inputAddress" value=""
                                   placeholder="1234 Main St">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" name="address2" class="form-control" id="inputAddress2" value=""
                                   placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" name="city" class="form-control" id="inputCity" value="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <input type="text" name="state" class="form-control" id="inputState" value="">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Zip</label>
                                <input type="text" name="zip" class="form-control" id="inputZip" value="">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">To delivery</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="border shadow bg-white p-3" style="height: 508px;">
                    <div>
                        <h3>Confirm order</h3>
                        <h4>Nosaukums</h4>
                    </div>
                    <div>
                        <tbody style="font-size: 1.25em">
                        <tr>
                            <td>Subtotal:</td>
                            <td>$500</td>
                        </tr>
                        <tr>
                            <td>Delivery:</td>
                            <td>$2.99</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Total:</td>
                            <td class="font-weight-bold">$502.99</td>
                        </tr>
                        </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Checkout',

    data:() => ({

    }),

    mounted() {

    },

    methods: {
        getDeliveryData(){
            axios.get()
        },

        getSubtotal(){

        },

        getTotal(){

        },
    },
}
</script>
