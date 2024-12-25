<script>
// import ChosenGestures from "../../DummyData/ChosenGestures.json"
export default {
  name: "Grid",
  inject: ['chosenGestures'],
  data() {
    return {
      // chosenGestures: [],
      isTranslated: false,
      editMode: false,
    }
  },
  methods: {
    changeView() {
      this.$emit('change-view', {view: 1});
    },
    handleEditMode() {
      this.editMode = !this.editMode;
    },
  },
  computed: {
    gestureCount() {
      return this.chosenGestures.length;
    },
    gesturesEmpty() {
      return this.gestureCount <= 0;
    },
    getGestureValues() {
      const gestureNames = [];

      for (const gesture of this.chosenGestures) {
        gestureNames.push(gesture.label);
      }
    }
  }
}
</script>

<template>
  <div class="container">
    <div class="title text-center">
      <h2 class="my-4 poppins-semibold">Create gesture sequence</h2>
    </div>

    <div id="grid-gesture-container" class="row row-cols-3 row-gap-2 py-3 overflow-y-scroll">
      <div v-if="gesturesEmpty" class="w-100 text-center text-danger">
        <h3>No gestures selected</h3>
      </div>
      <div v-else class="col mb-2"
           style="height: 110px"
           v-for="(chosenGesture, index) in chosenGestures">
        <div class="relative-container text-wrap d-flex flex-column align-items-center justify-content-center">
          <i class="fa-solid fa-circle-minus fa-xl position-absolute remove-icon" v-if="editMode"></i>
          <div class="card image-box" style="z-index: -1">
<!--      image      -->
          </div>
          <div style="height: 20px; width: 100%" class="text-center text-wrap text-break lh-sm fw-normal poppins-light my-2">
            <p>{{chosenGesture.label}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex flex-column flex-grow-1">
    <div class="horizontal-line-container">
      <hr>
    </div>

    <div class="d-flex flex-column justify-content-evenly align-items-center gap-3 flex-grow-1">
      <div class="d-flex flex-column justify-content-center align-items-center gap-3">
        <button v-if="!editMode" class="btn btn-dark p-2" @click="handleEditMode">
          Reorder
        </button>
        <button v-else class="btn btn-dark p-2" @click="handleEditMode">
          Done
        </button>
        <p class="m-0" :class="{ 'text-secondary': editMode }">
          Or
        </p>
        <button class="btn btn-outline-dark p-2" :disabled="editMode">
          Automatically reorder gestures
        </button>
      </div>

      <div class="d-flex flex-column justify-content-between align-items-center gap-3">
        <a class="btn btn-lg btn-dark" :class="{ disabled: editMode || gesturesEmpty }" data-bs-toggle="offcanvas" href="#offcanvasTranslator" aria-controls="offcanvasTranslator">
          Open translator <i class="fa-solid fa-hands-asl-interpreting"></i>
        </a>
        <button type="button" class="btn btn-dark" @click="changeView">
          <i class="fa-solid fa-lg fa-arrow-left"></i> Back
        </button>
      </div>
    </div>
  </div>


  <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="offcanvasTranslator" aria-labelledby="offcanvasTranslatorLabel">
    <div class="offcanvas-header">
      <h3 class="offcanvas-title" id="offcanvasTranslatorLabel">Translate gestures</h3>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-start align-items-center">
      <div class="d-flex flex-column justify-content-center align-items-center gap-4  w-100">
        <div>
          <label for="exampleSelect" class="form-label">Translate language</label>
          <select id="exampleSelect" class="form-select" aria-label="Default select example">
            <option selected value="pl">Polish</option>
            <option value="en">English</option>
            <option value="es">Spanish</option>
            <option value="fr">French</option>
            <option value="de">German</option>
            <option value="it">Italian</option>
            <option value="pt">Portuguese</option>
            <option value="ru">Russian</option>
            <option value="zh">Chinese</option>
            <option value="ja">Japanese</option>
            <option value="ko">Korean</option>
            <option value="ar">Arabic</option>
            <option value="hi">Hindi</option>
            <option value="bn">Bengali</option>
            <option value="id">Indonesian</option>
            <option value="vi">Vietnamese</option>
            <option value="th">Thai</option>
            <option value="tr">Turkish</option>
            <option value="nl">Dutch</option>
            <option value="sv">Swedish</option>
          </select>
        </div>
        <a href="#" class="btn btn-dark" :class="{ disabled: this.gesturesEmpty}">
          Translate {{this.gestureCount}} gestures
        </a>
        <div class="text-center">
          <h4>Before translation</h4>
          <p v-if="!this.gesturesEmpty" ref="gestureParagraph" class="text-break mb-0" style="overflow-wrap: break-word; white-space: normal;"></p>
          <p v-else>No gestures selected</p>
          <h4 class="mt-4">After translation</h4>
        </div>
      </div>

      <div class="form-floating w-100 h-100 flex-grow-1">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100%" readonly></textarea>
        <label for="floatingTextarea2">Translated text</label>
      </div>
      <div class="d-flex justify-content-center align-items-center w-100" style="height: 200px">
        <button type="button" class="btn btn-outline-dark" :disabled="!isTranslated">Copy text</button>
      </div>
    </div>
  </div>

</template>
