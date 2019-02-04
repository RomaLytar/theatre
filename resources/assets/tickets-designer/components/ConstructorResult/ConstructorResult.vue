<template>
  <div class="constructor-result">
    <div class="d-flex mb-3 constructor-result__header">
      <form
        name="ticket"
        enctype="multipart/form-data"
        action="/admin/ticket-templates"
        class="visually-hidden"
        method="POST"
      >
        <input
          type="file"
          ref="file"
          name="poster"
          @change="chooseImage"
        >
      </form>

      <button
        type="button"
        class="btn btn-info mr-2 btn-form"
        @click="downloadImage"
      >
        Завантажити фон
      </button>
      <button
        type="button"
        class="btn btn-warning mr-2"
        @click="print"
      >Друк без фону</button>
      <button
        type="button"
        class="btn btn-primary"
        @click="printBg"
      >Друк з фоном</button>
      <router-link
        :to="{name: 'TicketsList'}"
        class="btn btn-success ml-auto"
      >До списка квиткiв</router-link>
    </div>
    <div class="constructor-canvas">
      <div class="constructor-canvas__inner">
        <div
          class='constructor-canvas__ticket'
          :class="{'no-img': noImg}"
          :style="ticketStyle"
          ref="ticketParent"
        >
          <ConstructorCanvasItem
            v-for="field in ticketFields"
            :key="field.id"
            :field="field"
          ></ConstructorCanvasItem>

          <img
            :src="ticketImg"
            v-if="ticketImg"
            alt=""
          >
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  import ConstructorCanvasItem from "./ConstructorCanvasItem"

  export default {
    components: {
      ConstructorCanvasItem
    },
    data() {
      return {
        noImg: false
      }
    },
    computed: {
      ticketStyle() {
        const ticketWidth = this.$store.getters.getWidth,
              ticketHeight = this.$store.getters.getHeight;

        return {
          width: `${ticketWidth * 1.25}mm`,
          height: `${ticketHeight * 1.25}mm`
        }
      },
      ticketFields() {
        return this.$store.getters.getTicketFields
      },
      ticketImg() {
        return this.$store.getters.getPoster
      }
    },
    methods: {
      downloadImage() {
        this.$refs.file.click()
      },
      chooseImage(e) {
        const files = e.target.files;

        if (files.length !== 0) {
          this.$store.commit(`setPoster`, window.URL.createObjectURL(files[0]));
        }
      },
      print() {
        this.noImg = true;

        setTimeout(() => {
          window.print();
        }, 100)
      },
      printBg() {
        this.noImg = false;

        setTimeout(() => {
          window.print();
        }, 100)
      }
    }
  }
</script>
