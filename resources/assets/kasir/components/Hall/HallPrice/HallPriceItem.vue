<template>
  <li>
    <div
      class="hall-price__color"
      :style="{backgroundColor: price.color}"
    ><span class="visually-hidden">{{ price.title }}</span></div>
    <p class="hall-price__price">{{ price.price }}</p>
  </li>
</template>

<script>
  export default {
    props: {
      price: {
        required: true,
        type: Object
      }
    }
  }
</script>
