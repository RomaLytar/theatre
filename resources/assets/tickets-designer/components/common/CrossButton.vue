<template>
  <button
    type="button"
    class="cross-btn"
    @click="$emit('click')"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 357 357"
      :width="size"
      :height="size"
      :fill="fill"
    >
      <polygon points="357,35.7 321.3,0 178.5,142.8 35.7,0 0,35.7 142.8,178.5 0,321.3 35.7,357 178.5,214.2 321.3,357 357,321.3 214.2,178.5"/>
    </svg>
  </button>
</template>

<script>
  export default {
    props: {
      size: {
        default: 15,
        type: [String, Number]
      },
      fill: {
        default: `#333`,
        type: String
      }
    }
  }
</script>
