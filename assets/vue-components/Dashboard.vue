<script>
import Category from "./Gesture/Category.vue";
import GestureSequence from "./Gesture/GestureSequence.vue";
import Navbar from "./Semantic/Navbar.vue";

export default {
  name: "Dashboard",
  components: {Category, GestureSequence, Navbar},
  props: {
    categories: Array,
  },
  data() {
    return {
      view: 1,
      chosenGestures: [],
    }
  },
  methods: {
    handleChangeView({ view }) {
      this.view = view;
    },
    updateChosenGestures(newGestures) {
      console.log('update dash')
      console.log(newGestures)
      this.chosenGestures = newGestures;
    },
  },
  computed: {
    isCategory() {
      return this.view === 1;
    }
  },
  mounted() {
  }
}
</script>

<template>

  <div class="container-fluid text-justify p-0">
    <div v-if="isCategory">
      <div class="bg-dark sticky-top">
        <navbar :categories="categories" :menu="true"></navbar>
      </div>
      <div class="mx-4">
        <p class="word-space fw-normal pt-3 m-0">
          To translate PJM to text start adding gestures.
        </p>
        <category :categories="categories" :chosenGestures="chosenGestures" @change-view="handleChangeView" @update-chosenGestures="updateChosenGestures"></category>
      </div>
    </div>

    <div v-else class="d-flex flex-column vh-100">
      <div class="bg-dark">
        <navbar :back-button="true"></navbar>
      </div>
      <div class="d-flex flex-column flex-grow-1">
        <gesture-sequence :chosenGestures="chosenGestures" @change-view="handleChangeView" @update-chosenGestures="updateChosenGestures"></gesture-sequence>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>