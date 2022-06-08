<template>
  <div>
    <div class="Licenses">
      <input v-model="$root.search">
      <tree-menu ref="menu" :label="tree.label" :nodes="tree.nodes" :depth="0"></tree-menu>
    </div>
    <div class="Content">Content</div>
  </div>
</template>

<script>
import TreeMenu from "./TreeMenu";

export default {
  data(){
    return{
      tree: {
        label: 'root',
        nodes: [{
          label: 'item1',
          nodes: [{
            label: 'item1.1'
          },
          {
            label: 'item1.2',
            nodes: [{
              label: 'item1.2.1'
            }]
          }]
        }, 
        {
          label: 'item2'  
        }]
      }
    }
  },

  components: {
    TreeMenu
  },


}
</script>

<style scoped>
.Licenses
{
  height: 600px;
  width: 23%;
  float: left;
  border: 3px solid;
}

.Content
{
  height: 600px;
  width: 77%;
  float: left;
  border: 3px solid;
}
</style>
