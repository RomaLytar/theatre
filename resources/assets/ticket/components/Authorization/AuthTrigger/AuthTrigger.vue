<template>
  <div class="auth-trigger">
    <label
      class="auth-trigger__item"
      v-for="option in options"
      :key="option.value"
    >
      <input
        class="visually-hidden"
        type="radio"
        :value="option.value"
        v-model="userType"
      >
      <span class="auth-trigger__text">
        {{ option.text }}
      </span>
    </label>
  </div>
</template>

<script>
  export default {
    props: {
      options: {
        type: Array,
        required: true
      },
      default: {
        type: String
      }
    },
    created(){
      this.userType = this.default ? this.default : this.options[0].value
    },
    data() {
      return {
        userType: ``
      }
    },
    watch: {
      userType(val) {
        this.$emit(`user-type-changed`, val)
      }
    }
  }
</script>
