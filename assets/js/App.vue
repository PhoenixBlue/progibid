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

    },
    watch: {
        sVType: function() {
            this.updateValues()
        },
        nBasicFee: function(oldValue, newValue) {
            // TODO: fix numerical value only
            if (!parseFloat(this.nBasicFee)) {
                this.nBasicFee = 0
            } 
            this.updateValues()
        }
    }
}

</script>
<template>
    <p>
        <label>Vehicle type:</label>
        <select v-model="sVType">
            <option disabled value>Select here</option>
            <option v-for="vType in arVehicleTypes">{{ vType }}</option>
        </select>
    </p>
    <p>
        <label>Basic fee:</label>
        <input idtype="number" v-model.number="nBasicFee">
    </p>
    <p>
        <label>Variable cost: {{ nVariableCost }}</label>
    </p>
    <p>
        <label>Seller fee: {{ nSellerFee }}</label>
    </p>
    <p>
        <label>Added cost: {{ nAddedCost }}</label>
    </p>
    <p>
        <label>Storage fee: {{ nStorageFee }}</label>
    </p>

    <h1>Total cost: {{ nTotalCost }}</h1>
</template>