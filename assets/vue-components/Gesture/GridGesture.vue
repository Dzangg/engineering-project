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
      <div class="col "
           style="height: 110px"
           v-for="(chosenGesture, index) in chosenGestures">
        <div class="relative-container text-wrap d-flex flex-column align-items-center justify-content-center">
          <i class="fa-solid fa-circle-minus fa-xl position-absolute remove-icon" v-if="activeReorder"></i>
          <div class="small-box">
          </div>
          <div style="height: 20px; width: 100%" class="text-center text-wrap text-break lh-sm fw-normal poppins-light my-2">
            <p>{{chosenGesture.title}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="d-f justify-content-md-center text-center row-gap-2 row py-4" style="height: 100%">
    <div class="col-md-auto">
      <button type="button" class="btn btn-dark py-1 dark-btn">Reorder</button>
    </div>
    <p class="my-2">or</p>
    <div class="col-md-auto">
      <button type="button" class="btn btn-light py-1 light-btn">Automatically reorder gestures</button>
    </div>
  </div>

<!--  <div class="horizontal-line-container">-->
<!--    <hr>-->
<!--  </div>-->

  <div class="fixed-bottom mb-5 mx-4 d-flex justify-content-between">
    <a href="/">
      <button type="button" class="btn btn-lg btn-dark py-1 dark-btn mt-auto" style="width: 120px; height: 45px; border-radius: 10px;">BACK</button>
    </a>
    <a href="/translate">
      <button type="button" class="btn btn-lg btn-dark py-1 dark-btn mt-auto" style="width: 120px; height: 45px; border-radius: 10px;">NEXT</button>
    </a>
  </div>
</template>
