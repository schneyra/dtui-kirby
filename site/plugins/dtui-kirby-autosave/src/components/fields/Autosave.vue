<template>
  <div>
    <span class="k-field-header k-label">{{ label }}</span>
    <p>{{ saved }}</p>
  </div>
</template>

<script>
export default {
  props: {
    interval: {
      default: 5000
    },
    label: {
      default: 'Autosave'
    },
    saved: {
      default: 'Not yet saved.'
    }
  },
  mounted: function () {
    this.timer = setInterval(async () => {
      const hasChanges = this.$store.getters["content/hasChanges"]();

      if (hasChanges) {
        const date = new Date();
        const localeDate = date.toLocaleString();
        const content = this.$store.getters['content/values']();

        localStorage.setItem(`kirby-autosave_${content.uuid}`, JSON.stringify({
          date: date,
          content: content
        }));

        this.saved = `Saved: ${localeDate}`;
      }
    }, this.interval)
  },
  beforeDestroy() {
    clearInterval(this.timer)
  }
}
</script>