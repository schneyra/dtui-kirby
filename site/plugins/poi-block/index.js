panel.plugin("schneyra/poi-block", {
  blocks: {
    poi: {
      computed: {
        source() {
          return "https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/"
            + this.content.lng
            + "," + this.content.lat
            + "," + this.content.zoom
            + ",0/300x200?access_token=" + "TODO:TOKEN"
        }
      },
      template: `
        <div>
         <h1>{{ content.title }}</h1>
         <img :src="source">
         <p>{{ content.description }}</p>
        </div>
      `
    }
  }
});
