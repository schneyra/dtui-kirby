(() => {
  let videos = document.querySelectorAll(".js-video");

  if (videos.length) {
    videos.forEach((video) => {
      let button = video.querySelector(".js-video-button");
      let cover = video.querySelector(".js-video-cover");
      let iframe = video.querySelector(".js-video-iframe");
      let disclaimer = video.querySelector(".js-video-disclaimer");

      button.addEventListener("click", () => {
        iframe.setAttribute(
          "src",
          `${iframe.getAttribute("data-src")}?autoplay=1&modestbranding=1&showinfo=0`
        );
        iframe.removeAttribute("data-src");
        button.remove();
        cover.remove();
        disclaimer.remove();
      });
    });
  }
})();
