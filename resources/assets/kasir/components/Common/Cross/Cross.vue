<template>
  <button type="button" class="cross" @click="$emit('click')">
    <slot></slot>
    <svg viewBox="0 0 41.8 41.6" :width="width" :height="height" :fill="fill">
      <path d="M18.9,20.8L0.4,39.3c-0.5,0.5-0.5,1.3,0,1.9c0.3,0.3,0.6,0.4,0.9,0.4c0.3,0,0.7-0.1,0.9-0.4l18.7-18.7
    l18.7,18.7c0.3,0.3,0.6,0.4,0.9,0.4s0.7-0.1,0.9-0.4c0.5-0.5,0.5-1.3,0-1.9L22.9,20.8L41.5,2.2c0.5-0.5,0.5-1.3,0-1.9
    c-0.5-0.5-1.3-0.5-1.9,0L20.9,19.1L2.2,0.4c-0.5-0.5-1.3-0.5-1.9,0c-0.5,0.5-0.5,1.3,0,1.9L18.9,20.8z"/>
    </svg>
  </button>
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
        default: 16
      },
      fill: {
        type: String,
        default: `#333333`
      }
    }
  }
</script>
