<template>
  <div class="button-container" ref="container">
    <div
        class="button-wrapper"
        v-for="(button, index) in visibleButtons"
        :key="index"
    >
      <button
          :class="['button', { active: index === activeVisibleIndex }]"
          @click="setActive(index)"
      >
        {{ button.label }}
      </button>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      buttons: [
        { label: 'Przycisk 1' },
        { label: 'Przycisk 2' },
        { label: 'Przycisk 3' },
        { label: 'Przycisk 4' },
      ],
      activeIndex: 0, // Indeks rzeczywisty aktywnego przycisku
    };
  },
  computed: {
    // Wyświetlane przyciski z duplikatami
    visibleButtons() {
      return [
        this.buttons[this.buttons.length - 1], // Duplikat ostatniego na początku
        ...this.buttons,
        this.buttons[0], // Duplikat pierwszego na końcu
      ];
    },
    activeVisibleIndex() {
      return this.activeIndex + 1; // Dopasowanie do widocznej listy
    },
  },
  mounted() {
    this.scrollToActiveButton(this.activeVisibleIndex, false);
  },
  methods: {
    setActive(index) {
      const realIndex = (index - 1 + this.buttons.length) % this.buttons.length;
      this.activeIndex = realIndex;

      this.scrollToActiveButton(index, true);

      // Synchronizuj indeks po przewinięciu (dla zapętlenia)
      this.$nextTick(() => {
        if (index === 0) {
          // Gdy przewijasz do pierwszego duplikatu
          this.scrollToActiveButton(this.buttons.length, false);
        } else if (index === this.visibleButtons.length - 1) {
          // Gdy przewijasz do ostatniego duplikatu
          this.scrollToActiveButton(1, false);
        }
      });
    },
    scrollToActiveButton(index, smooth = true) {
      const container = this.$refs.container;
      const button = container.children[index];
      const offset =
          button.offsetLeft + button.offsetWidth / 2 - container.clientWidth / 2;

      container.scrollTo({
        left: offset,
        behavior: smooth ? 'smooth' : 'auto',
      });
    },
  },
};
</script>

<style scoped>
.button-container {
  display: flex;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding: 10px;
  scrollbar-width: none; /* Ukryj pasek przewijania w Firefoksie */
  position: relative;
  scroll-snap-type: x mandatory;
}
.button-container::-webkit-scrollbar {
  display: none; /* Ukryj pasek przewijania w Chrome */
}

.button-wrapper {
  flex: 0 0 auto;
  scroll-snap-align: center;
}

.button {
  flex: 0 0 auto;
  padding: 10px 20px;
  transition: all 0.3s ease;
}

.button.active {
  flex: 0 0 200px; /* Szerokość aktywnego przycisku */
  background-color: #007bff;
  color: white;
}
</style>
