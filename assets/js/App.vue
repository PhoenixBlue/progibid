<script>
export default {
  data() {
    return {
      arVehicleTypes: ["Luxury", "Common"],
      sVType: '',
      nBasicFee: 0,
      nVariableCost: 0,
      nSellerFee: 0,
      nAddedCost: 0,
      nStorageFee: 100,
      nTotalCost: 0,
    }
  },
    methods: {
        updateValues() {
            if(!this.nBasicFee) {
                this.nBasicFee = 0;
            }
            if (this.sVType) {
                fetch("/api/bidder/" + this.sVType + "/" + this.nBasicFee, {"method": "GET"})
                .then(response => response.json())
                .then(data => {
                    this.nBasicFee = data.basicFee;
                    this.nVariableCost = data.variableCost;
                    this.nSellerFee = data.sellerFee;
                    this.nAddedCost = data.addedCost;
                    this.nTotalCost = data.totalCost;
                })
            } 
        },
        isNumber: function (evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                evt.preventDefault();
            }
            return true;
        }

    },
    watch: {
        sVType: function() {
            this.updateValues()
        },
        nBasicFee: function() { 
            this.updateValues()
        }
    }
}
</script>

<template>
    <table>
        <tbody>
            <tr>
                <td>Vehicle type:</td>
                <td>       
                    <select v-model="sVType">
                        <option disabled value>Select here</option>
                        <option v-for="vType in arVehicleTypes">{{ vType }}</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Basic fee:</td>
                <td> 
                    <input idtype="number" v-model.number="nBasicFee" @keypress="isNumber($event)"></input>
                </td>
            </tr>
            <tr>
                <td>Variable cost:</td>
                <td>{{ nVariableCost }}</td>
            </tr>
            <tr>
                <td>Seller fee:</td>
                <td>{{ nSellerFee }}</td>
            </tr>
            <tr>
                <td>Added cost:</td>
                <td>{{ nAddedCost }}</td>
            </tr>
            <tr>
                <td>Storage fee:</td>
                <td>{{ nStorageFee }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Total cost: {{ nTotalCost }}</h2>
</template>