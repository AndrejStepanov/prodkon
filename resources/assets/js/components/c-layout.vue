<template>
  <div :class="classnames" :style="{ width:config.width, height:config.height }" :name='config.name'>
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'c-layout',
  data() {
    return {
    }
  },
  props: {
	config:{type: Object,  default: () =>{return{  name: 'first',   width:'50%',	height:'100%',  layout: 'horizontal', isLast:false , data:[],} }},
	noMultiPane:{type: Boolean, default:false},
  },
  computed: {
    classnames() {
      return [
		    'multipane',
        'layout-' + this.config.layout.slice(0, 1),
        this.config.data!=undefined && this.config.data.length>0? 'custom-resizer ':'scroll',
        this.config.isLast? 'auto-size':'',
      ]
	},
  },
  methods: {
  },
}
</script>

<style lang="scss">
.multipane {   display: -webkit-box;  display: -ms-flexbox; overflow: hidden; 
    &.layout-h {flex-direction: column; }
    &.layout-v { flex-direction: row;    }
}

/*.multipane > div {  position: relative;  z-index: 1;}*/
.multipane.scroll {overflow: auto;  padding: 5px;   margin: 5px 5px 5px 0px;}
.multipane.auto-size {flex-grow: 1;}

.multipane-resizer {  display: block;  position: relative;  z-index: 2;}

.layout-h > .multipane-resizer {  width: 100%;  height: 3px;  margin-top: -10px;  top: 5px;  cursor: row-resize;}

.layout-v > .multipane-resizer {  width: 3px;  height: 100%;  margin-left: -10px;  left: 5px;  cursor: col-resize;}
</style>
