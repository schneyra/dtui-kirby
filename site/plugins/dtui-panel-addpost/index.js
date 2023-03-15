panel.plugin('schneyra/addPost', {
  sections: {
    addPost: {
      data: function () {
        return {
          year: this.$library.dayjs().format("YYYY"),
          month: this.$library.dayjs().format("MM"),
          label: null
        }
      },
      created: function() {
        this.load().then(response => {
          this.label = response.label;
        });
      },
      methods: {
        createYear() {
          this.$api.pages.create('blog', {
            slug: this.$helper.slug(this.year),
            title: this.year,
            template: 'year'
          }).then((data) => {
            this.$api.pages.changeStatus(data.id, 'unlisted').then(_ => {
              this.createMonth();
            });
          }).catch(() => {
            this.createMonth();
          });
        },

        createMonth() {
          this.$api.pages.create(`blog/${this.year}`, {
            slug: this.$helper.slug(this.month),
            title: this.month,
            template: 'month'
          }).then((data) => {
            this.$api.pages.changeStatus(data.id, 'unlisted').then(_ => {
              this.createPost();
            });
          }).catch(() => {
            this.createPost();
          });
        },

        createPost() {
          this.$api.pages.create(`blog/${this.year}/${this.month}`, {
            slug: this.$helper.slug('neu'),
            title: '',
            template: 'article'
          }).then((data) => {
            this.$go(`pages/${data.id.replace(/\//g, '+')}`);
          });
        },

        createArticle() {
          this.createYear();
        }
      },
      template: `
        <div class="panel">
        <k-headline size="medium" class="headline">{{ label }}</k-headline>

        <div class="form">
          <k-form @submit="createArticle">
          <k-button
            icon="check"
            type="submit"
            theme="positive">
          Beitrag anlegen
          </k-button>
        </div>
      `
    }
  }
});
