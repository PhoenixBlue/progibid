<script>
export default {
  data() {
    return {
      sVType: '',
      message: 'Hello Vue!'
    }
  },
    methods: {
        refreshMessage() {
            if (this.sVType) {
                fetch("/api/bidder/" + this.sVType, {"method": "GET"})
                .then(response => response.json())
                .then(data => {
                    this.message = data
                })
            } 
        }
    },
    watch: {
        sVType: function() {
            this.refreshMessage()
        }
    }
}
</script>

<template>
    <input type="text" v-model="sVType">
    <h1 v-show="!!message">{{ message }}</h1>
</template>