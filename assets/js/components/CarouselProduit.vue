<template>
  <div>
    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-height="1024"
      img-width="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
      
    >
      <b-carousel-slide v-for="img in tabImg" :key="img">
        <img
          slot="img"
          class="d-block img-fluid w-100"
          height="1024"
          width="480"
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
            type : Object,
            default () {
                return {'img1' :'http://calgarypma.ca/wp-content/uploads/2018/01/default-thumbnail.jpg',
                        'img2':'http://calgarypma.ca/wp-content/uploads/2018/01/default-thumbnail.jpg',
                        'img3':'http://calgarypma.ca/wp-content/uploads/2018/01/default-thumbnail.jpg'
                }
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