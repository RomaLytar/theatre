<template>
  <svg viewBox="0 0 37.7 19.8" :width="width" :height="height" :fill="fill">
    <path d="M35.6,19.4L18.8,2.9L2,19.5c-0.2,0.2-0.5,0.3-0.8,0.3c-0.3,0-0.6-0.1-0.8-0.3c-0.5-0.5-0.5-1.2,0-1.7L18,0.4
    c0.1-0.1,0.3-0.2,0.4-0.3c0.4-0.2,0.9-0.1,1.3,0.3l17.6,17.4c0.5,0.5,0.5,1.2,0,1.7C36.8,19.9,36,19.9,35.6,19.4z"/>
  </svg>
</template>

<script>
  export default {
    props: {
      width: {
        type: [Number, String],
        default: 16
      },
      height: {
        type: [Number, String],
        default: 10
      },
      fill: {
        type: String,
        default: `#333333`
      }
    }
  }
</script>
