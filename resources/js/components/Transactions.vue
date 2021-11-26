<template>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Total</th>
                    <th scope="col">Transaction status</th>
                    <th scope="col">Order date</th>
                    <th scope="col">Package ID</th>
                    <th scope="col">Package status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transaction in transactions">
                    <td>${{transaction.total}}</td>
                    <td>{{transaction.status.toUpperCase()}}</td>
                    <td>{{new Date(transaction.created_at).toLocaleString("en-UK")}}</td>
                    <td>{{transaction.package_id}}</td>
                    <td>${{transaction.total}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Transactions",

    props: {
        userId: {
            required: true,
        }
    },

    data: () => ({
        transactions: [],
    }),

    mounted() {
        this.getTransactions();
    },

    methods: {
        getTransactions() {
            axios.get('/api/users/'+ this.userId +'/transactions').then((response) => {
                this.transactions = response.data;
            });
        }
    }
}
</script>

