<template>
  <label class="price-filter__label">
    <span class="price-filter__label-text">
      <slot></slot>
    </span>
    <span class="price-filter__input-wrap">
      <input
        class="price-filter__input"
        type="number"
        :value="value"
        :min="min"
        :max="max"
        :step="step"
        @change="$emit('input-change', $event.target.value)"
      >
    </span>
  </label>
</template>

<script>
  export default {
    props: {
      min: {
        type: Number,
        default: 0
      },
      max: {
        type: Number,
        default: 0
      },
      step: {
        type: Number,
        default: 1
      },
      value: {
        type: Number,
        default: 0
      }
    }
  }
</script>
