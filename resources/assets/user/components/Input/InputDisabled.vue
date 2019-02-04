<template>
  <div class="form__field">
    <div class="form__field-left form__field-left--disabled">
      <div class="form__label">
        <p
          class="form__input"
          :class="[fieldFull]"
        >{{getValue}}</p>
        <span class="form__label-text">
          <slot></slot>
        </span>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    props: [`obj`],
    computed: {
      fieldFull() {
        return {
          "form__input--value": this.obj.value
        }
      },
      getValue() {
        if (this.obj.textName) {
          return this.obj.textName
        }

        return this.obj.value
      }
    }
  }
</script>
