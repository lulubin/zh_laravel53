<template>
  <button class="btn btn-default"
          v-text="text"
          v-on:click="follow"
          v-bind:class="{'btn-success': followed}"
  >
  </button>
</template>

<script>
export default {
  props:['question'],
  mounted() {
    this.$http.post('/api/questions/follower',{'question':this.question}).then(response => {
      this.followed = response.data.followed;
    })
  },
  data() {
    return {
      followed:false
    }
  },
  computed: {
    text() {
      return this.followed ? '已关注' : '关注该问题'
    }
  },
  methods: {
    follow() {
      this.$http.post('/api/questions/follow',{'question':this.question}).then(response => {
        this.followed = response.data.followed;
      })
    }
  }
}
</script>

