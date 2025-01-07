<script>
import ListGesture from "./ListGesture.vue";

export default {
  name: "Category.vue",
  components: {
    ListGesture,
  },
  props: {
    chosenGestures: Array,
    categories: Array,
  },
  data() {
    return {
      sequenceChosenGestures: [],
    }
  },
  watch: {
    sequenceChosenGestures: {
      handler(newVal) {
        this.$emit('update-chosenGestures', newVal);
      },
    },
  },
  methods: {
    changeView() {
      this.$emit('change-view', {view: 2});
    },
    addChosenGesture(gesture) {
      this.sequenceChosenGestures.push(gesture);
    },
    removeLastGesture() {
      this.sequenceChosenGestures.pop();
    },
    clearGestures() {
      this.sequenceChosenGestures.length = 0;
    },
  },
  computed: {
    chosenGesturesLength() {
      return this.sequenceChosenGestures.length;
    },
    chosenGesturesEmpty() {
      return this.sequenceChosenGestures.length <= 0;
    }
  },
  mounted() {
    this.sequenceChosenGestures = [...this.chosenGestures];
  }
}
</script>

<template>
<div class="mx-1">
  <div v-for="(category, index) in categories" class="row" :id="'category-' + category.name">
    <div class="col m-0">
      <h3 class="my-0">{{category.name + ' (' + category.gestures.length + ') '}}</h3>
      <div>
          <ListGesture @add-gesture="addChosenGesture" :gestures="category.gestures"/>
      </div>
    </div>
  </div>
  <div style="height: 200px">
  </div>
</div>

<div class="fixed-bottom" style="width: 100%; height: 20%; pointer-events: none;">
  <div class="d-flex flex-column justify-content-center align-items-center h-100 gap-2">
    <div class="d-flex justify-content-center align-items-center gap-4">
      <button type="button" class="btn btn-dark" style="pointer-events: auto;" :disabled="chosenGesturesEmpty"  @click="clearGestures">
        Wyczyść <i class="fa-solid fa-trash"></i>
      </button>
      <button type="button" class="btn btn-dark" style="pointer-events: auto;" :disabled="chosenGesturesEmpty"  @click="removeLastGesture">
        Cofnij <i class="fa-solid fa-rotate-left"></i>
      </button>
    </div>
    <button type="button" class="btn btn-lg btn-dark" style="pointer-events: auto;" :class="{disabled: chosenGesturesEmpty}" @click="changeView">
      <span>Stwórz sekwencje ({{chosenGesturesLength}})</span>
    </button>
  </div>
</div>
</template>
