<script>
import Category from "./Gesture/Category.vue";
import GestureSequence from "./Gesture/GestureSequence.vue";
export default {
  name: "Dashboard",
  components: {Category, GestureSequence},
  data() {
    return {
      view: 1,
    }
  },
  computed: {
    isCategory() {
      return this.view === 1;
    }
  }
}
</script>

<template>

<div v-if="isCategory">
  <category></category>
</div>
<div v-else>
  <gesture-sequence></gesture-sequence>
</div>


</template>

<style scoped>

</style>