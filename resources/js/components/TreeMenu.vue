<template>
  <div class="tree-menu">
    <div :style="indent" @click="toggleChildren" :class="label.includes($root.search) && $root.search != '' ? 'text-primary' : ''">
      <span v-if="this.$props.nodes">[{{ showChildren ? '-' : '+' }}]</span> 
      {{ label }}
    </div>
    <tree-menu v-if="showChildren" v-for="node in nodes" :nodes="node.nodes" :label="node.label":depth="depth + 1"></tree-menu>
  </div>
</template>

<script>

export default { 
  props: [ 'label', 'nodes', 'depth'],

  data() {
    return { 
      showChildren: false 
    }
  },

  name: 'tree-menu',

  computed: {
    indent() {
      return { transform: `translate(${this.depth * 25}px)` }
    }
  },

  methods: {
    toggleChildren() {
      this.showChildren = !this.showChildren;
    },
    isFolder() {
      return this.node.children && this.node.children.length;
    }
  },
}
</script>