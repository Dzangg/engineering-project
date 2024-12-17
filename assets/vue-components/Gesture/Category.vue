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

<div>
  <div v-for="(category, index) in categories" class="row">
    <div class="col m-0">
      <h3>{{category.categoryName}}</h3>
      <ListGesture :gestures="category.gestures"/>
    </div>
  </div>
</div>

</template>
