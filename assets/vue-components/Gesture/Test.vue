<template>
  <div id="app">
    <draggable
        v-model="items"
        group="people"
        @start="drag=true"
        @end="drag=false"
        item-key="id">
      <template #item="{element, index}">
        <h1>{{element.name + ' ' + index}}</h1>
      </template>
    </draggable>
  </div>
</template>

<script>
import draggable from "vuedraggable";

export default {
  components: {
    draggable,
  },
  data() {
    return {
      items: [
        { id: 1, name: "Item 1" },
        { id: 2, name: "Item 2" },
        { id: 3, name: "Item 3" },
        { id: 4, name: "Item 4" },
      ],
      drag: false,
    };
  },
};
</script>
