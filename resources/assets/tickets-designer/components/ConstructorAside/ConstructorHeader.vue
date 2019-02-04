<template>
  <div class="constructor-header">
    <form action="/" method="POST">
      <label class="form-group d-block mb-3">
        <span>Назва квитка</span>
        <input
          type="text"
          class="form-control form-control-sm"
          v-model="ticketName"
        >
      </label>
      <div class="row">
        <label class="form-group col">
          <span>Довжина</span>
          <input
            type="number"
            step="0.1"
            class="form-control form-control-sm"
            v-model="ticketWidth"
          >
        </label>
        <label class="form-group col">
          <span >Висота</span>
          <input
            type="number"
            step="0.1"
            class="form-control form-control-sm"
            v-model="ticketHeight"
          >
        </label>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    computed: {
      ticketName: {
        get() {
          return this.$store.getters.getName
        },
        set(value) {
          this.changeName(value);
        }
      },
      ticketWidth: {
        get() {
          return this.$store.getters.getWidth
        },
        set(value) {
          this.changeWidth(value);
        }
      },
      ticketHeight: {
        get() {
          return this.$store.getters.getHeight
        },
        set(value) {
          this.changeHeight(value);
        }
      }
    },
    methods: {
      changeName(value) {
        this.$store.commit(`setName`, value)
      },
      changeWidth(value) {
        this.$store.commit(`setWidth`, value)
      },
      changeHeight(value) {
        this.$store.commit(`setHeight`, value)
      }
    }
  }
</script>
