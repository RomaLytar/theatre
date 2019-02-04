<template>
  <div class="poster-price">
    <table class="poster-price__table">
      <thead>
        <tr>
          <th>Пояс</th>
          <th>Цена</th>
          <th>Доступно</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(price, key) in prices" :key="key">
          <td
            class="poster-price__color"
            :style="{'background-color': price.color}"
          ></td>
          <td>{{ price.price }}</td>
          <td>{{ price.seats_count }}</td>
        </tr>
      </tbody>
    </table>
    <button
      type="button"
      class="btn btn-success btn-block"
      @click="$emit(`close`)"
    >Закрыть</button>
  </div>
</template>

<script>
  export default {
    props: {
      prices: {
        type: [Array, Object],
        required: true
      }
    }
  }
</script>
