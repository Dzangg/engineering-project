<script>
import draggable from "vuedraggable";
import axios from "axios";

export default {
  name: "GestureSequence",
  components: {draggable},
  props: {
    chosenGestures: Array
  },
  data() {
    return {
      editMode: false,
      drag: false,
      sequenceChosenGestures: [],
      isLoading: false,
      translationLanguage: 'pl',
      translatedText: null,
      textCopied: false,
    }
  },
  watch: {
    sequenceChosenGestures: {
      handler(newVal) {
        this.$emit('update-chosenGestures', newVal);
        this.translatedText = '';
      },
    },
  },
  methods: {
    changeView() {
      this.$emit('change-view', {view: 1});
    },
    handleEditMode() {
      this.editMode = !this.editMode;
    },
    removeGesture(index) {
      this.sequenceChosenGestures.splice(index, 1);
    },
    async fetchTranslation() {
      this.isLoading = true;
      try {
        const response = await axios.post('/api/translate', {
          language: this.translationLanguage,
          gestures: this.gestureLabels,
        });
        this.translatedText = response.data.translatedText;
        console.log(response.data)
      } catch (err) {
        this.error = err.message;
      } finally {
        this.isLoading = false;
      }
    },
      copyText() {
        navigator.clipboard.writeText(this.translatedText)
            .then(() => {
              this.textCopied = true;

              setTimeout(() => {
                this.textCopied = false;
                console.log(this.translatedText)
              }, 3000);
            })
            .catch(err => {
              console.error('Failed to copy text: ', err);
            });
      }
  },
  computed: {
    gestureCount() {
      return this.sequenceChosenGestures.length;
    },
    gesturesEmpty() {
      return this.gestureCount <= 0;
    },
    gestureLabels() {
      return this.sequenceChosenGestures.map((element) => element.label);
    },
    gestureTranslated() {
      return this.translatedText !== '';
    }
  },
  mounted() {
    this.sequenceChosenGestures = this.chosenGestures.map((item, index) => ({ ...item, uniqueId: index }));
  }
}
</script>

<template>
  <div class="container" style="min-height: 465px">
    <div class="title text-center">
      <h2 class="my-4 poppins-semibold">Utwórz sekwencję gestów</h2>
    </div>

    <div id="grid-gesture-container" class="row py-3">
      <div v-if="gesturesEmpty" class="w-100 text-center text-danger">
        <h3>Nie wybrano gestów</h3>
      </div>
        <draggable
            v-model="sequenceChosenGestures"
            @start="drag=true"
            @end="drag=false"
            item-key="uniqueId"
            class="d-flex flex-row flex-wrap row-cols-3"
            :disabled="!editMode"
        >
          <template #item="{element, index}">
            <div class="col mb-2" style="height: 110px">
              <div class="relative-container text-wrap d-flex flex-column align-items-center justify-content-center">
                <div v-if="editMode" @click="removeGesture(index)">
                  <i class="fa-solid fa-circle-minus fa-xl position-absolute top-0 start-0 translate-middle-y remove-icon"></i>
                </div>
                <div class="card image-box" style="z-index: -1">
      <!--      video      -->
                </div>
                <div style="height: 20px; width: 100%" class="text-center text-wrap text-break lh-sm fw-normal poppins-light my-2">
                  <p>{{element.label}}</p>
                </div>
              </div>
            </div>
          </template>
        </draggable>
    </div>
  </div>

  <div class="d-flex flex-column flex-grow-1" style="max-height: 330px">
    <div class="horizontal-line-container">
      <hr>
    </div>

    <div class="d-flex flex-column justify-content-evenly align-items-center gap-3 flex-grow-1">
      <div class="d-flex flex-column justify-content-center align-items-center gap-3">
        <button class="btn btn-dark p-2" @click="handleEditMode">
          {{ !editMode ? 'Zmień kolejność' : 'Ukońćz' }}
        </button>
        <p class="m-0" :class="{ 'text-secondary': editMode }">
          Lub
        </p>
        <button class="btn btn-outline-dark p-2" :disabled="editMode">
          Automatycznie zmień kolejność gestów
        </button>
      </div>

      <div class="d-flex flex-column justify-content-between align-items-center gap-3">
        <a class="btn btn-lg btn-dark" :class="{ disabled: editMode || gesturesEmpty }" data-bs-toggle="offcanvas" href="#offcanvasTranslator" aria-controls="offcanvasTranslator">
          Otwórz tłumacz <i class="fa-solid fa-hands-asl-interpreting"></i>
        </a>
        <button type="button" class="btn btn-dark" @click="changeView">
          <i class="fa-solid fa-lg fa-arrow-left"></i> Cofnij
        </button>
      </div>
    </div>
  </div>


  <div class="offcanvas offcanvas-start w-100" tabindex="-1" id="offcanvasTranslator" aria-labelledby="offcanvasTranslatorLabel">
    <div class="offcanvas-header">
      <h3 class="offcanvas-title" id="offcanvasTranslatorLabel">Przetłumacz gesty</h3>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-start align-items-center">
      <div class="d-flex flex-column justify-content-center align-items-center gap-4 w-100">
        <div>
          <label for="language-select" class="form-label">Język tłumaczenia</label>
          <select id="language-select" class="form-select" aria-label="Wybór języka tłumaczenia" v-model="translationLanguage">
            <option value="pl">Polski</option>
            <option value="en">Angielski</option>
            <option value="es">Hiszpański</option>
            <option value="fr">Francuski</option>
            <option value="de">Niemiecki</option>
            <option value="it">Włoski</option>
            <option value="pt">Portugalski</option>
            <option value="ru">Rosyjski</option>
            <option value="zh">Chiński</option>
            <option value="ja">Japoński</option>
            <option value="ko">Koreański</option>
            <option value="ar">Arabski</option>
            <option value="hi">Hindi</option>
            <option value="bn">Bengalski</option>
            <option value="id">Indonezyjski</option>
            <option value="vi">Wietnamski</option>
            <option value="th">Tajski</option>
            <option value="tr">Turecki</option>
            <option value="nl">Holenderski</option>
            <option value="sv">Szwedzki</option>
          </select>
        </div>
        <button class="btn btn-dark" :disabled="gesturesEmpty" @click="fetchTranslation">
          Przetłumacz {{ gestureCount }} {{ gestureCount > 1 ? 'gesty' : 'gest' }}
        </button>
        <div class="text-center">
          <h4>Przed tłumaczeniem</h4>
          <p v-if="!gesturesEmpty" ref="gestureParagraph" class="text-break mb-0" style="overflow-wrap: break-word; white-space: normal;">
          <span v-for="(label, index) in gestureLabels" :key="index">
            {{ label }}<span v-if="index < gestureLabels.length - 1">, </span>
          </span>
          </p>
          <p v-else>Nie wybrano gestów</p>
          <h4 class="mt-4">Po tłumaczeniu</h4>
        </div>
      </div>

      <label for="floatingTextarea2">Przetłumaczony tekst</label>
      <div class="form-floating w-100 h-100 flex-grow-1 d-flex justify-content-center align-items-center">
        <div v-if="isLoading" class="spinner-border text-primary text-center" role="status">
          <span class="visually-hidden">Ładowanie...</span>
        </div>
        <textarea v-else class="form-control w-100" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100%" readonly v-model="translatedText"></textarea>
      </div>
      <div class="d-flex justify-content-center align-items-center w-100" style="height: 200px">
        <button type="button" class="btn btn-dark" :disabled="!gestureTranslated || isLoading" @click="copyText">Skopiuj tekst</button>
      </div>
    </div>
    <div v-if="textCopied" class="alert alert-primary fixed-bottom" role="alert" style="bottom: 15%">
      Tekst skopiowany!
    </div>
  </div>

</template>
