<script>
import Gesture from "./Gesture.vue";

export default {
  name: "ListGesture",
  components: {Gesture},
  props: {
    gestures: {
      type: Array,
    },
  },
  data() {
    return {
      showLeftArrow: false,
      showRightArrow: false,
      arrowOffset: 0,
    };
  },
  methods: {
    changeArrowsVisibility() {
      const scrollContainer = this.$refs.scrollContainer;
      this.showLeftArrow = scrollContainer.scrollLeft > 0;
      this.showRightArrow =
          scrollContainer.scrollLeft + scrollContainer.clientWidth <
          scrollContainer.scrollWidth;
    },
    scrollToStart() {
      this.$refs.scrollContainer.scrollTo({ left: 0, behavior: "smooth" });
    },
    scrollToEnd() {
      const scrollContainer = this.$refs.scrollContainer;
      this.$refs.scrollContainer.scrollTo({
        left: scrollContainer.scrollWidth,
        behavior: "smooth",
      });
    },
    // handleArrowPosition(offset) {
    //   this.arrowOffset = offset;
    // },
    toggleAnimation(e) {
      const counter = document.querySelector('#gesture-counter-icon')

      // this.$refs.gestureContainer.classList.toggle('gesture-animation');
      // console.log(this.$refs.gestureContainer.classList)
      const gesture = e.target;

      // Remove the animation class if it already exists
      gesture.classList.remove('pulse-effect');
      counter.classList.remove('pulse-effect');

      // Use a timeout to allow re-adding the animation class
      setTimeout(() => {
        gesture.classList.add('pulse-effect');
        counter.classList.add('pulse-effect');
      }, 1);
    },
  },
  mounted() {
    this.changeArrowsVisibility();
    this.$refs.scrollContainer.addEventListener("scroll", this.changeArrowsVisibility);
    this.arrowOffset = (this.$refs.imageContainer[0].clientHeight / 2);
  },
  beforeUnmount() {
    this.$refs.scrollContainer.removeEventListener("scroll", this.changeArrowsVisibility);
  },
};
</script>

<template>
  <div class="my-2 position-relative">
    <!-- Left arrow -->
    <Transition>
      <div
          v-if="showLeftArrow"
          class="position-absolute start-0 translate-middle-y text-black"
          :style="{zIndex: 1, cursor: 'pointer', top: `${arrowOffset}px`}"
          @click="scrollToStart"
      >
        <i class="fa-solid fa-chevron-left fa-2x"></i>
      </div>
    </Transition>

    <!-- Scrollable container -->
    <div
        id="list-gesture-container"
        class="row flex-nowrap scrollbar-off"
        ref="scrollContainer"
        style="overflow-x: auto; scroll-behavior: smooth;"
    >
      <div v-for="(gesture, index) in gestures" class="col">
        <div class="card d-inline-block mt-2" style="width: 12rem; height: 12rem;" ref="imageContainer" @click="toggleAnimation">
          <gesture :gesture="gesture"></gesture>
        </div>
        <p class="text-center my-1">{{ gesture.title }}</p>
      </div>
    </div>

    <!-- Right arrow -->
    <Transition>
      <div
          v-if="showRightArrow"
          class="position-absolute end-0 translate-middle-y text-black"
          :style="{zIndex: 1, cursor: 'pointer', top: `${arrowOffset}px`}"
          @click="scrollToEnd"
      >
        <i class="fa-solid fa-chevron-right fa-2x"></i>
      </div>
    </Transition>
  </div>
</template>
