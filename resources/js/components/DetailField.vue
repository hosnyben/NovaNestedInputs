<template>
  <PanelItem :index="index" :field="field" />
</template>

<script>
import { flatten } from 'lodash';

export default {
  props: ['index', 'field'],
  mounted: function() {
    const options = this.flattenOptions(this.field.options);

    if( this.field.type == 'checkbox' )
      this.field.value = options.filter(option => this.field.value.includes(option.id)).map(option => option.label).join(', ');
    else
      this.field.value = options.find(option => option.id == this.field.value)?.label || '';
  },
  methods: {
    flattenOptions(options) {
      return flatten(options.map(option => {
        return [option, ...this.flattenOptions(option.children || [])];
      }));
    }
  }
}
</script>
