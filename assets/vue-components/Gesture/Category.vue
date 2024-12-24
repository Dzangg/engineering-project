<script>
import ListGesture from "./ListGesture.vue";
import DummyData from "../../DummyData/DummyData.json"
export default {
  name: "Category.vue",
  components: {
    ListGesture
  },
  data() {
    return {
      categories: DummyData,
    }
  }
}
</script>

<template>

<div class="mx-1">
  <div v-for="(category, index) in categories" class="row" :id="'category-' + category.categoryName.toLowerCase()">
    <div class="col m-0">
      <h3 class="my-2">{{category.categoryName + ' (' + category.gestures.length + ') '}}</h3>
      <ListGesture :gestures="category.gestures"/>
    </div>
  </div>
  <div class="row" style="height: 140px">
  </div>
</div>

</template>
