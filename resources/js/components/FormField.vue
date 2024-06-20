<template>
  <DefaultField
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <div class="space-y-2">
        <Tree 
          v-for="option in options" 
          :option="option" 
          v-model="value"
          :type="type"
          :color="color"
        />
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { DependentFormField, HandlesValidationErrors } from 'laravel-nova'
import Tree from './Tree.vue'

export default {
  components: {Tree},
  mixins: [DependentFormField, HandlesValidationErrors],
  props: ['field'],
  data() {
    return {
      value: null,
      type: 'radio',
      options: [],
      color: 'gold',
    }
  },
  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = [this.field.value] || null;
      this.type = this.field.type || 'radio';
      this.options = this.field.options || [];
      this.color = this.field.color || 'gold';
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '');
    }
  },
  mounted() {
    this.setInitialValue();
  },
}
</script>
