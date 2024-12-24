<!--<script>-->
<!--export default {-->
<!--  name: "test",-->

<!--};-->
<!--</script>-->

<!--<template>-->
<!--  <div class="picker-container">-->
<!--    <div class="picker-wheel">-->
<!--      <div class="navbar-nav ms-auto">-->
<!--        <div class="picker-item">Greetings</div>-->
<!--        <div class="picker-item">Places</div>-->
<!--        <div class="picker-item">Emotions</div>-->
<!--        <div class="picker-item">People</div>-->
<!--        <div class="picker-item">Vers</div>-->
<!--        <div class="picker-item">Adjectives</div>-->
<!--        <div class="picker-item">Food</div>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="picker-overlay"></div>-->
<!--  </div>-->
<!--</template>-->

<template>
  <header>
    <nav class="navbar">
      <div class="navbar-container">
        <div class="navbar-logo">MyApp</div>
        <button class="hamburger" @click="toggleMenu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </button>
        <ul :class="{ 'active': menuOpen }" class="navbar-links">
          <li v-for="link in links" :key="link.id">
            <a @click="scrollToElement(link.target)" href="javascript:void(0)">
              {{ link.name }}
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
  data() {
    return {
      menuOpen: false,
      links: [
        { id: 1, name: 'Link 1', target: 'element1' },
        { id: 2, name: 'Link 2', target: 'element2' },
        { id: 3, name: 'Link 3', target: 'element3' }
      ]
    };
  },
  methods: {
    toggleMenu() {
      this.menuOpen = !this.menuOpen;
    },
    scrollToElement(target) {
      const element = document.getElementById(target);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
      this.menuOpen = false; // Close the menu after clicking
    }
  }
};
</script>

<style scoped>
.navbar {
  position: sticky;
  top: 0;
  z-index: 1000;
  background-color: #333;
  padding: 10px 0;
}

.navbar-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
}

.hamburger {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  height: 30px;
  width: 30px;
  background: transparent;
  border: none;
  cursor: pointer;
}

.hamburger .bar {
  height: 5px;
  width: 25px;
  background-color: #fff;
  border-radius: 5px;
}

.navbar-links {
  display: flex;
  list-style: none;
}

.navbar-links.active {
  display: block;
}

.navbar-links li {
  margin: 0 10px;
}

.navbar-links a {
  color: #fff;
  text-decoration: none;
}

@media screen and (max-width: 768px) {
  .navbar-links {
    display: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 100%;
    background-color: #333;
    padding: 10px 0;
  }
  .navbar-links.active {
    display: block;
  }
}
</style>

