<?php
use Kirby\Cms\Html;
use Kirby\Http\Uri;

/**
 * @var App $kirby
 * @var Kirby\Cms\Block $block
 */

if ($video = Html::video($block->url(), [], ['class' => 'js-video-iframe'])):
    $video = str_replace('src=', 'data-src=', $video);
    $video = str_replace('youtube.com', 'youtube-nocookie.com', $video);

    $coverImageUrl = null;

    if (strpos($video, 'youtube') >= -1) {
        $uri    = new Uri($block->url());
        $videoId = $uri->query->v;
        $results = [];
        $request = Remote::get('https://www.googleapis.com/youtube/v3/videos?id=' . $videoId . '&key=' . $kirby->option('options.secrets.youTubeKey') . '&part=snippet');

        if ($request->code() === 200) {
            $results = $request->json(false);
            $coverImageUrl = $results->items[0]->snippet->thumbnails->maxres->url ?? $results->items[0]->snippet->thumbnails->high->url;
            $videoTitle = $results->items[0]->snippet->title;
            $video = str_replace('data-src="', 'title="' . htmlentities($videoTitle) . '" data-src="', $video);
        }
    }

    if (strpos($video, 'vimeo') >= -1) {
        /*echo "<pre>";
var_dump($block->parent()->root());
echo "</pre>";*/
    }

    /**
     * @todo Bild nur einmal laden
     * Eigentlich muss das hier alles nur beim ersten Lauf gemacht
     *  werden, danach liegt das Bild im Dateisystem vor.
     */
    if ($coverImageUrl) {
        $imageName = DtuiHelper::getRemoteImage($coverImageUrl, $block->parent()->root(), 'cover-remote-' . $videoId);

        if ($imageName) {
            $coverImage = $block->parent()->images()->find($imageName);
        }
    }
    ?>

  <figure class="video-wrapper">
    <div class="video js-video">
      <?= $video ?>
      <?php if ($coverImage) : ?>
        <?php $sizes = "(min-width: 800px) 800px, 100vw"; ?>
        <picture class="js-video-cover">
          <?php /*
          <source
            srcset="<?= $coverImage->srcset([
              '400w'  => ['width' => 400, 'format' => 'avif'],
              '800w'  => ['width' => 800, 'format' => 'avif'],
              '1200w' => ['width' => 1600, 'format' => 'avif']
            ]) ?>"
            type="image/avif"
            sizes="<?= $sizes ?>">
          */?>
          <source
            srcset="<?= $coverImage->srcset([
                    '400w'  => ['width' => 400, 'format' => 'webp'],
                    '800w'  => ['width' => 800, 'format' => 'webp'],
                    '1200w' => ['width' => 1600, 'format' => 'webp']
                  ]) ?>"
            type="image/webp"
            sizes="<?= $sizes ?>">

          <img
            src="<?= $coverImage->crop(800)->url() ?>"
            alt="<?= $coverImage->alt() ?>"
            width="<?= $coverImage->width() ?>"
            height="<?= $coverImage->height() ?>"
            loading="lazy"
            decoding="async"
          >
        </picture>
      <?php endif; ?>
      <button class="js-video-button"><span class="visually-hidden">Video abspielen</span></button>
      <p class="video__disclaimer js-video-disclaimer">Mit dem Klick werden Daten von YouTube nachgeladen.</p>
    </div>

    <?php if ($block->caption()->isNotEmpty()): ?>
      <figcaption><?= $block->caption() ?></figcaption>
    <?php endif ?>
  </figure>
<?php endif ?>