<script>
export default {
  name: "Gesture",
  props: {
    gesture: Object,
  },
  data() {
    return {
      observer: null,
      isVisible: false,
      isPlaying: false,
    };
  },
  methods: {
    toggleAnimation(e) {
      const gesture = e.target;
      gesture.classList.remove("pulse-effect");
      setTimeout(() => {
        gesture.classList.add("pulse-effect");
      }, 1);
    },
    togglePlay(value) {
      const video = this.$refs.video;

      if (!video) {
        console.warn("Video ref not found");
        return;
      }

      if (value && !this.isPlaying) {
        video
            .play()
            .then(() => {
              this.isPlaying = true;
            })
            .catch((err) => {
              console.error("Error playing video:", err);
            });
      } else if (!value && this.isPlaying) {
        video.pause();
        this.isPlaying = false;
      }
    },
  },
  mounted() {
    const videoElement = this.$refs.video;

    if (videoElement) {
      this.observer = new IntersectionObserver(
          ([entry]) => {
            this.isVisible = entry.isIntersecting;
          },
          {threshold: 0.7 }
      );

      this.observer.observe(videoElement);
    }
  },
  watch: {
    isVisible(newVal) {
      this.togglePlay(newVal);
    },
  },
  beforeUnmount() {
    if (this.observer) {
      this.observer.disconnect();
    }
  },
};
</script>

<template>
  <video
      class="card d-inline-block"
      style="width: 8rem;"
      @click="toggleAnimation"
      ref="video"
      loop
      muted
      playsinline
  >
    <source :src="gesture.videoPath" type="video/mp4"/>
    Your browser does not support the video tag.
  </video>
</template>
