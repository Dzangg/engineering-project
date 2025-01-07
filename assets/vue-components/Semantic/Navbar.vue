<script>
export default {
  props: {
    menu: false,
    categories: Array,
  },
  data() {
    return {
      title: 'PJM Translator',
      isCollapsed: false,
    }
  },
  methods: {
    closeMenu() {
      this.isCollapsed = !this.isCollapsed;
    },
    scrollToElement(id) {
      this.closeMenu();
      const element = document.getElementById(id);

      if (element) {
        const yOffset = -600;
        const yPosition = element.getBoundingClientRect().top + window.scrollY + yOffset;

        window.scrollTo({
          top: yPosition,
          behavior: 'smooth'
        });
      }
    }
  }
}
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-sm navbar-dark p-0 mx-2">
      <div class="container-fluid" style="overflow: visible;">
        <a class="navbar-brand fw-bold fs-1 text-white" href="/">{{ title }}</a>
        <button v-if="menu" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation-container" aria-controls="navigation-container" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navigation-container" :class="{'collapse': isCollapsed}" class="collapse navbar-collapse mt-2">
          <h4 class="text-white">Navigate to specific category <i class="fa-solid fa-arrow-down"></i></h4>
          <ul id="navigation-items-container" class="navbar-nav ms-auto my-3">
            <li class="nav-item mx-1" v-for="(category, index) in categories" :key="index">
              <a class="nav-link text-light" @click="scrollToElement('category-' + category.name)">{{ (index+1) + '. ' + category.name }}</a>
            </li>
          </ul>
          <div class="horizontal-line-container">
            <hr class="my-0">
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>

