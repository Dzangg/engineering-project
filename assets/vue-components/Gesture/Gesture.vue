<script>
export default {
  name: "Gesture",
  props: {
    gesture: Object,
    play: Boolean,
  },
  data() {
    return {
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
        // Play the video if not already playing
        video
            .play()
            .then(() => {
              this.isPlaying = true;
            })
            .catch((err) => {
              console.error("Error playing video:", err);
            });
      } else if (!value && this.isPlaying) {
        // Pause the video if not already paused
        video.pause();
        this.isPlaying = false;
      }
    },
  },
  mounted() {
    this.togglePlay(this.play);
  },
  watch: {
    play(newVal) {
      this.togglePlay(newVal);
    },
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
