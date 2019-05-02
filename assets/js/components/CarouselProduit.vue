<template>
  <div>
    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <b-carousel-slide v-for="img in tabImg" :key="img">
        <img
          slot="img"
          class="d-block img-fluid w-100"
          width="1024"
          height="480"
          :src="img"
          alt="image slot"
        >
      </b-carousel-slide>
      
    </b-carousel>

    
  </div>
</template>

<script>
  export default {
    data() {
      return {
        slide: 0,
        sliding: null
      }
    },
    props:{
        tabImg: {
            type : Array,
            default () {
                return ['http://calgarypma.ca/wp-content/uploads/2018/01/default-thumbnail.jpg',
                        'http://calgarypma.ca/wp-content/uploads/2018/01/default-thumbnail.jpg',
                        'http://calgarypma.ca/wp-content/uploads/2018/01/default-thumbnail.jpg'
                ]
            }
        }
    },
    methods: {
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = false
      }
    }
  }
</script>