<script>
import ListGesture from "./ListGesture.vue";
import DummyData from "../../DummyData/DummyData.json"

export default {
  name: "Category.vue",
  components: {
    ListGesture
  },
  inject: ['chosenGestures'],
  data() {
    return {
      categories: DummyData,
    }
  },
  methods: {
    changeView() {
      this.$emit('change-view', {view: 2});
    },
    addChosenGesture(gesture) {
      this.chosenGestures.push(gesture);
    },
    removeLastGesture() {
      this.chosenGestures.pop();
    },
    clearGestures() {
      this.chosenGestures.length = 0;
    }
  },
  computed: {
    chosenGesturesLength() {
      return this.chosenGestures.length;
    },
    chosenGesturesEmpty() {
      return this.chosenGestures.length <= 0;
    }
  }
}
</script>

<template>
  <i class="fa-solid fa-trash" style="color: #0000"></i>
<div class="mx-1">
  <div v-for="(category, index) in categories" class="row" :id="'category-' + category.categoryName.toLowerCase()">
    <div class="col m-0">
      <h3 class="my-2">{{category.categoryName + ' (' + category.gestures.length + ') '}}</h3>
      <ListGesture @add-gesture="addChosenGesture" :gestures="category.gestures"/>
    </div>
  </div>
</div>
  <div class="fixed-bottom" style="width: 100%; height: 150px;">
    <div class="d-flex flex-column justify-content-center align-items-center h-100 gap-4">
<!--  Add <Transition> here -->
      <div class="d-flex justify-content-center align-items-center gap-4">
        <button type="button" class="btn btn-dark" :class="{ hidden: chosenGesturesEmpty}" @click="clearGestures">
          Clear <i class="fa-solid fa-trash"></i>
        </button>
        <button type="button" class="btn btn-dark" :class="{ hidden: chosenGesturesEmpty}" @click="removeLastGesture">
          Undo <i class="fa-solid fa-rotate-left"></i>
        </button>
      </div>
      <button type="button" class="btn btn-lg btn-dark position-absolute" style="bottom: 38px" :class="{disabled: chosenGesturesEmpty}" @click="changeView">
        <span>Create Sequence ({{chosenGesturesLength}})</span>
      </button>
    </div>
  </div>
</template>
