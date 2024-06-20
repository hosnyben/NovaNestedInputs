<template>
    <div class="space-y-2">
        <div 
            class="twts-rounded-md twts-border twts-p-2 twts-flex twts-relative twts-w-80"
            :class="{
                'twts-pl-8': props.option.children?.length,
                'opacity-50 twts-cursor-not-allowed': disabled(props.option),
            }"
            :style="{
                'border-color': checked(props.option) ? props.color : '#d1d5db',
            }"
        >
            <span 
                v-if="props.option.children?.length" 
                class="twts-absolute twts-top-2 twts-text-xl twts-left-2 twts-cursor-pointer"
                @click="showChildren = !showChildren"
            >
                <i v-if="showChildren" class="fi fi-rr-angle-small-down"></i>
                <i v-else class="fi fi-rr-angle-small-right"></i>
            </span>
            <input 
                :checked="checked(props.option)"
                :disabled="disabled(props.option)"
                :type="props.type"
                class="h-4 w-4 twts-mr-2 twts-ml-1 twts-mt-0.5 twts-border-gray-300 twts-cursor-pointer disabled:twts-cursor-not-allowed"
                @change="updateValue(props.option.id)"
                :value="props.option.id"
                :style="{
                    'color': props.color,
                }"
            />
            {{ props.option.label }}
        </div>
        <div class="twts-pl-10">
            <Tree
                v-if="showChildren"
                v-for="option in props.option.children"
    
                :key="option.id"
                :option="option"
                :type="props.type"
                :color="props.color"
    
                v-model="value"
            />
        </div>
    </div>
</template>
<script setup>
    import { ref, watch, onMounted } from 'vue';
    import Tree from './Tree.vue';

    const emit = defineEmits(['update:modelValue']);

    const props = defineProps({
        modelValue: {
            required: true,
        },
        option : {
            type: Object,
            required: true,
        },
        type: {
            type: String,
            default: 'radio',
        },
        color: {
            type: String,
            default: '#be860f',
        }
    });

    const value = ref(props.modelValue || []);
    const showChildren = ref(false);

    onMounted(() => {
        let ids = getId(props.option);

        showChildren.value = ( props.type == 'checkbox' ) ? value.value.some((item) => ids.includes(item)) : ids.includes(value.value);
    });

    const getId = (option) => {
        var id = [option.id];

        if (option.children?.length) {
            option.children.forEach((child) => {
                id = [...id, ...getId(child)];
            });
        }

        return id;
    }

    watch(() => props.modelValue, (newValue) => {
        value.value = newValue;
    });
    
    watch(() => value.value, (newValue) => {
        emit('update:modelValue', newValue);
    });

    const updateValue = (newValue) => {
        let finalValue = null;

        if( props.type == 'checkbox' ) {
            if( !value.value.includes(newValue) )
                finalValue = [...value.value, newValue];
            else
                finalValue = value.value.filter(item => item !== newValue);
        } else {
            finalValue = newValue;
        }

        value.value = finalValue;
    }

    const checked = ({id}) => {
        if( props.type == 'checkbox' )
            return value.value.includes(id);
        else
            return value.value == id;
    }

    const disabled = (option) => {
        return option.disabled || false;
    }
</script>