<script>
import Gesture from "./Gesture.vue";

export default {
  name: "ListGesture",
  components: {
    Gesture
  },
  props: {
    gestures: {
      type: Array,
    },
  },
  data() {
    return {
      showLeftArrow: false,
      showRightArrow: false,
      imageContainerHeight: 226,
      arrowOffset: 0,
      isVisible: false,
      observer: null,
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
    addGesture(e, newGesture) {

      this.$emit('add-gesture', newGesture);

      const gesture = e.target;

      // Remove the animation class if it already exists
      gesture.classList.remove('pulse-effect');

      // Use a timeout to allow re-adding the animation class
      setTimeout(() => {
        gesture.classList.add('pulse-effect');
      }, 1);
    },
    changeVisibility() {
      const targetDiv = this.$refs.llistgesture;
      if (targetDiv && this.observer) {
        this.observer.observe(targetDiv);
      }
    }
  },
  mounted() {
    this.observer = new IntersectionObserver(
        ([entry]) => {
          this.isVisible = entry.isIntersecting;
        },
        { threshold: 1 }
    );

    this.changeVisibility();

    this.changeArrowsVisibility();
    this.$refs.scrollContainer.addEventListener("scroll", this.changeArrowsVisibility);
    this.arrowOffset = this.imageContainerHeight / 2;

    window.addEventListener('scroll', this.changeVisibility);
  },
  beforeDestroy() {
    if (this.observer) {
      this.observer.disconnect();
    }

    window.removeEventListener('scroll', this.changeVisibility);
    this.$refs.scrollContainer?.removeEventListener("scroll", this.changeArrowsVisibility);
  },
};
</script>

<template>
  <div ref="llistgesture" class="my-4 position-relative listgesture" style="max-width: 98%; width: fit-content">
    <!-- Left arrow -->
    <Transition>
      <div
          v-if="showLeftArrow"
          class="position-absolute start-0 translate-middle-y text-black pt-2"
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
      <div v-for="(gesture, index) in gestures" class="col pt-2 d-flex flex-column">
          <gesture :gesture="gesture" :play="isVisible"></gesture>
        <div class="text-center d-flex flex-column justify-content-center align-items-center">
          <p class="my-1">{{ gesture.label }}</p>
          <div class="add-icon d-flex justify-content-center align-items-center" @click="addGesture($event, gesture)">
            <i class="fa-solid fa-plus fa-lg"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Right arrow -->
    <Transition>
      <div
          v-if="showRightArrow"
          class="position-absolute end-0 translate-middle-y text-black pt-2"
          :style="{zIndex: 1, cursor: 'pointer', top: `${arrowOffset}px`}"
          @click="scrollToEnd"
      >
        <i class="fa-solid fa-chevron-right fa-2x"></i>
      </div>
    </Transition>
  </div>
</template>
