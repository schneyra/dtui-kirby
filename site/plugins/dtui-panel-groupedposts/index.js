panel.plugin('schneyra/groupedPosts', {
  sections: {
    groupedPosts: {
      data: function () {
        return {
          posts: []
        }
      },
      created: function() {
        this.load().then(response => {
          this.posts = response.groupedPosts;
          console.log(response);
        });
      },
      template: `
        <div>
        <section class="k-collection" v-for="(years, year in posts">
            <header class="k-section-header">
                <h2 class="k-headline">{{year}}</h2>
            </header>

                <ul>
                    {{ year }}
                    <li v-for="(months, month) in years.data">
                        {{ month }}
                        <ul>
                            <li v-for="post in months">
                                post
                            </li>
                        </ul>
                    </li>
                </ul>
        </section>
        </div>
      `
    }
  }
});
