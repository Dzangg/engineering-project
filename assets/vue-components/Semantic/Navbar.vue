<script>
export default {
  data() {
    return {
      title: 'PJM Translator'
    }
  }
}
</script>

<template>
  <nav class="navbar navbar-expand-sm navbar-light p-0">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold fs-1" href="/">{{ title }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-1">
            <a class="nav-link text-dark" href="#">Your gestures</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link text-dark" href="#">Upload gesture</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="horizontal-line-container">
    <hr class="my-0">
  </div>
</template>

