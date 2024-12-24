<script>
import ChosenGestures from "../../DummyData/ChosenGestures.json"
export default {
  name: "Grid",
  data() {
    return {
      chosenGestures: ChosenGestures,
      activeReorder: true,
    }
  }
}
</script>

<template>
  <div class="container">
    <div class="my-4 title text-center">
      <h2 class="my-0 poppins-semibold">Create gesture sequence</h2>
    </div>

    <div id="grid-gesture-container" class="row row-cols-3 row-gap-2 py-3 overflow-y-scroll">
      <div class="col mb-2"
           style="height: 110px"
           v-for="(chosenGesture, index) in chosenGestures">
        <div class="relative-container text-wrap d-flex flex-column align-items-center justify-content-center">
          <i class="fa-solid fa-circle-minus fa-xl position-absolute remove-icon" v-if="activeReorder"></i>
          <div class="card image-box" style="z-index: -1">
<!--      image      -->
          </div>
          <div style="height: 20px; width: 100%" class="text-center text-wrap text-break lh-sm fw-normal poppins-light my-2">
            <p>{{chosenGesture.title}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="horizontal-line-container">
    <hr>
  </div>

  <div class="d-flex flex-column justify-content-center align-items-center gap-2 mt-2">
      <a class="btn btn-sm btn-dark p-2">
          Reorder
      </a>
    <p class="m-0">
      Or
    </p>
      <a class="btn btn-sm btn-outline-dark p-2">
        Automatically reorder gestures
      </a>
  </div>


  <div class="d-flex justify-content-center align-items-center mt-5">
    <a href="/translate" class="btn btn-dark">
      TRANSLATE
    </a>
  </div>

<!--  <button type="button" class="btn btn-dark py-1 dark-btn">Reorder</button>-->
<!--  <p class="my-2">or</p>-->
<!--  <button type="button" class="btn btn-light py-1 light-btn">Automatically reorder gestures</button>-->
<!--  <a href="/">-->
<!--    <button type="button" class="btn btn-lg btn-dark py-1 dark-btn mt-auto">BACK</button>-->
<!--  </a>-->
</template>
