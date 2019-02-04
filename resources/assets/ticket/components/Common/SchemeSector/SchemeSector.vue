<template>
  <div class="scheme-sector">
    <svg
      class="scheme-sector__embed"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1829.9 1223.9">
      <g id="scene" disabled="">
        <path d="M1273,112.4L1273,112.4L1273,112.4c-1.1-3.8-2.8-6.5-5.1-10.8l-67-79C1192.4,12.1,1185.4,2,1172,2H908.3H644.6
        c-13.4,0-20.4,10.1-28.9,20.7l-67,79c-2.3,4.3-4,7-5.1,10.8l0,0l0,0c-1.1,3.7-1.8,7.2-1.3,11.4c1.6,15.7,15.3,27.4,31,27.4h334.1
        h1.9h334.1c15.8,0,29.4-11.7,31-27.4C1274.8,119.6,1274.1,116.2,1273,112.4z"/>
        <text transform="matrix(1 0 0 1 820.3643 99.5996)">{{ translation.scene[documentLang] }}</text>
      </g>
      <g
        @click="clickSvg(sectorList[0])"
        :disabled="!sectorList[0].checked"
      >
        <path d="M1561.1,734.9c0-0.1,0-0.2,0-0.3s0-0.3,0-0.4c-0.7-75.5-35.4-256-35.4-256c-1.6-9.4-3.1-11.1-6.2-17.7
          c-65.4-137.6-173-260.4-173-260.4h-0.1c-5.8-7.6-15-12.6-25.3-12.6c-0.4,0-0.8,0-1.2,0.1h-0.1H503.9c-7,0-13.5,2.3-18.7,6.1h-0.1
          c-44,31.7-161.5,222.6-182.3,266.8c-3.6,7.6-5.2,17.7-5.2,17.7c-34.1,129.5-23.6,249.9-22.7,259.5c0,0.1,0,0.2,0,0.3
          c0,0.2,0,0.4,0,0.4l0,0c1.9,15.8,15.3,28.1,31.6,28.1c0.4,0,0.8,0,1.2-0.1l0.1,0.1h1222.8l0.1-0.1c16.7-0.7,30.1-14.2,30.5-31.1l0,0
          C1561.1,735.2,1561.1,735,1561.1,734.9z"/>
        <g v-if="textVisible">
          <text transform="matrix(1 0 0 1 625.003 510.5996)">{{ translation.parter[documentLang] }}</text>
          <text transform="matrix(1 0 0 1 890.4073 510.249)">
            <tspan x="0" y="0">₴</tspan>
            <tspan x="48.4" y="0">{{ sectorList[0].prices.min }} - {{ sectorList[0].prices.max }}</tspan>
          </text>
        </g>
      </g>
      <g
        :disabled="!sectorList[1].checked"
        @click="clickSvg(sectorList[1])"
      >
        <path d="M1771.7,569.6c0-0.1,0-0.1,0-0.2v-0.5l0,0c-0.3-28.9,0.4-55.6-28.7-55.6c-14.3,0-22.8,7.8-34.7,51.7
        c-24.3,90.2-62.1,231.1-283.3,243.8l-497.3-1.2v-0.1h-13.2h-13.2v0.1L404,808.8c-221.1-12.6-259-153.5-283.3-243.7
        c-11.9-43.9-20.4-51.7-34.7-51.7c-29,0-28.3,26.6-28.7,55.6l0,0v0.5c0,0.1,0,0.1,0,0.2c0,0.1,0,0.1,0,0.2v10.9
        c-3.5,425.4,501.9,416.8,501.9,416.8s167.6,0.1,342.2,0.2l0,0c4.4,0,8.8,0,13.2,0s8.8,0,13.2,0l0,0c174.6-0.1,342.2-0.2,342.2-0.2
        s505.4,8.6,501.9-416.8v-10.9C1771.7,569.7,1771.7,569.7,1771.7,569.6z"/>
        <g v-if="textVisible">
          <text transform="matrix(1 0 0 1 470.003 919.5996)">{{ translation.balcony1[documentLang] }}</text>
          <text transform="matrix(1 0 0 1 1002.629 921.249)">
            <tspan x="0" y="0">₴</tspan>
            <tspan x="48.4" y="0">{{ sectorList[1].prices.min }} - {{ sectorList[1].prices.max }}</tspan>
          </text>
        </g>
      </g>
      <g
        :disabled="!sectorList[2].checked"
        @click="clickSvg(sectorList[2])"
      >
        <path d="M1825.8,796.6c0-0.1,0-0.1,0-0.2v-0.5l0,0c-0.3-28.9,0.4-55.6-30.6-55.6c-15.2,0-24.3,7.8-37,51.7
        c-25.9,90.2-66.1,231.1-301.7,243.8l-529.6-1.2v-0.1h-14.1h-14.1v0.1l-529.6,1.2C133.8,1023.2,93.4,882.3,67.5,792.1
        c-12.7-43.9-21.7-51.7-37-51.7C-0.3,740.4,0.4,767,0,796l0,0v0.5c0,0.1,0,0.1,0,0.2c0,0.1,0,0.1,0,0.2v10.9
        c-3.7,425.4,534.5,416.8,534.5,416.8s178.5,0.1,364.4,0.2l0,0c4.7,0,9.4,0,14.1,0c4.7,0,9.4,0,14.1,0l0,0
        c185.9-0.1,364.4-0.2,364.4-0.2s538.2,8.6,534.5-416.8v-10.9C1825.8,796.7,1825.8,796.7,1825.8,796.6z"/>
        <g v-if="textVisible">
          <text transform="matrix(1 0 0 1 470.003 1144.5996)">{{ translation.balcony2[documentLang] }}</text>
          <text transform="matrix(1 0 0 1 1006.629 1146.249)">
            <tspan x="0" y="0">₴</tspan>
            <tspan x="48.4" y="0">{{ sectorList[2].prices.min }} - {{ sectorList[2].prices.max }}</tspan>
          </text>
        </g>
      </g>
    </svg>
  </div>
</template>

<script>
  export default {
    props: {
      sectorList: {
        type: Array
      }
    },
    data() {
      return {
        translation: {
          scene: {
            ru: `СЦЕНА`,
            en: `SCENE`,
            ua: `СЦЕНА`
          },
          parter: {
            ru: `Партер`,
            en: `Parquet`,
            ua: `Партер`
          },
          balcony1: {
            ru: `Балкон I-го яруса`,
            en: `Balcony I-tier`,
            ua: `Балкон I-го ярусу`
          },
          balcony2: {
            ru: `Балкон II-го яруса`,
            en: `Balcony II tier`,
            ua: `Балкон II-го ярусу`
          }
        }
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      },
      windowWidth() {
        return this.$store.getters.windowWidth
      },
      textVisible() {
        return this.windowWidth <= 768 ? true : false;
      }
    },
    methods: {
      clickSvg(target) {
        this.$emit(`change-sector`, target)
      }
    }
  }
</script>

<style scoped>
  svg path{fill:#cb9210;transition:0.3s;}
  svg text{transition:0.3s;}
  svg g[disabled] path{fill:#ccc;}
  svg text{font-size:60px;font-family:'Arial',sans-serif;fill:#333;}
  svg g:not([id="scene"]) path{cursor:pointer;}
  svg g:not([id="scene"]):hover path{fill:#333;}
  svg g:not([id="scene"]):hover text{fill:#fff;}
  svg text{pointer-events:none;}
</style>
