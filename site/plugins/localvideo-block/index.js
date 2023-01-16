panel.plugin("schneyra/localvideo-block", {
  blocks: {
    vid: {
      computed: {
        cover() {
          return this.content.cover[0] || {};
        },
        video() {
          return this.content.video[0] || {};
        }
      },
      template: `
        <div>Video (selbstgehostet)</div>
      `
    }
  }
});

/**
 *         <div>
 *          <h1>{{ content.title }}</h1>
 *
 *          <video autoplay muted width="100%">
 *             <source :src="video.url" type="video/mp4">
 *          </video>
 *
 *          <p>{{ content.description }}</p>
 *         </div>
 */
